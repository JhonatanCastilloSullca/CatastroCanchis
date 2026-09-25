<?php

namespace App\Services;

use App\Models\Edificaciones;
use App\Models\Ficha;
use App\Models\Lote;
use App\Models\Manzana;
use App\Models\Puerta;
use App\Models\UniCat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class RenumerarManzanaService
{
    public function ejecutar(string $sector, string $codigoAnterior, string $codigoNuevo, string $nombre): void
    {
        DB::transaction(function () use ($sector, $codigoAnterior, $codigoNuevo, $nombre) {
            $manzana = Manzana::where('id_sector', $sector)
                ->where('codi_mzna', str_pad($codigoAnterior, 3, '0', STR_PAD_LEFT))
                ->lockForUpdate()->first();

            if ($manzana === null) {
                $this->rechazar('La manzana de origen ya no existe. Actualice la página.');
            }

            $codigoNuevo = str_pad($codigoNuevo, 3, '0', STR_PAD_LEFT);
            $idNuevo = $sector . $codigoNuevo;
            $this->validarDestinos(new Manzana(), [$manzana->id_mzna => $idNuevo]);

            // Capture the complete graph by real keys BEFORE any ON UPDATE CASCADE runs.
            $lotes = Lote::where('id_mzna', $manzana->id_mzna)->lockForUpdate()->get();
            $edificaciones = Edificaciones::whereIn('id_lote', $lotes->modelKeys())->lockForUpdate()->get();
            $puertas = Puerta::whereIn('id_lote', $lotes->modelKeys())->lockForUpdate()->get();
            $unidades = UniCat::where(function ($query) use ($lotes, $edificaciones) {
                $query->whereIn('id_lote', $lotes->modelKeys())
                    ->orWhereIn('id_edificacion', $edificaciones->modelKeys());
            })->lockForUpdate()->get();
            $fichas = Ficha::whereIn('id_uni_cat', $unidades->modelKeys())
                ->lockForUpdate()->get(['id_ficha', 'id_uni_cat'])->groupBy('id_uni_cat');

            $mapLotes = [];
            $mapEdificaciones = [];
            $mapPuertas = [];
            $mapUnidades = [];

            foreach ($lotes as $lote) {
                $mapLotes[$lote->id_lote] = $idNuevo . $lote->codi_lote;
            }
            foreach ($edificaciones as $edificacion) {
                $mapEdificaciones[$edificacion->id_edificacion] = $mapLotes[$edificacion->id_lote] . $edificacion->codi_edificacion;
            }
            foreach ($puertas as $puerta) {
                if (!preg_match('/^\d{14}(.+)$/D', $puerta->id_puerta, $partes)) {
                    $this->rechazar('Una puerta tiene un identificador inválido: ' . $puerta->id_puerta);
                }
                $mapPuertas[$puerta->id_puerta] = $mapLotes[$puerta->id_lote] . $partes[1];
            }
            $edificacionesPorId = $edificaciones->keyBy('id_edificacion');
            foreach ($unidades as $unidad) {
                $edificacion = $edificacionesPorId->get($unidad->id_edificacion);
                if ($edificacion === null || $unidad->id_lote !== $edificacion->id_lote) {
                    $this->rechazar('La unidad ' . $unidad->id_uni_cat . ' no coincide con el lote de su edificación. Corrija esa relación primero.');
                }
                $mapUnidades[$unidad->id_uni_cat] = $mapEdificaciones[$unidad->id_edificacion]
                    . $unidad->codi_entrada . $unidad->codi_piso . $unidad->codi_unidad;
            }

            $this->validarDestinos(new Lote(), $mapLotes);
            $this->validarDestinos(new Edificaciones(), $mapEdificaciones);
            $this->validarDestinos(new Puerta(), $mapPuertas);
            $this->validarDestinos(new UniCat(), $mapUnidades);

            $manzana->id_mzna = $idNuevo;
            $manzana->codi_mzna = $codigoNuevo;
            $manzana->nume_mzna = mb_strtoupper($nombre);
            $manzana->save();

            foreach ($lotes as $lote) {
                $lote->id_lote = $mapLotes[$lote->id_lote];
                $lote->id_mzna = $idNuevo;
                $lote->save();
            }
            foreach ($puertas as $puerta) {
                $puerta->id_puerta = $mapPuertas[$puerta->id_puerta];
                $puerta->id_lote = $mapLotes[$puerta->id_lote];
                $puerta->save();
            }
            foreach ($edificaciones as $edificacion) {
                $edificacion->id_edificacion = $mapEdificaciones[$edificacion->id_edificacion];
                $edificacion->id_lote = $mapLotes[$edificacion->id_lote];
                $edificacion->save();
            }
            foreach ($unidades as $unidad) {
                $idAnterior = $unidad->id_uni_cat;
                $unidad->id_uni_cat = $mapUnidades[$idAnterior];
                $unidad->id_edificacion = $mapEdificaciones[$unidad->id_edificacion];
                $unidad->id_lote = $mapLotes[$unidad->id_lote];
                $unidad->save();

                // Use captured ficha IDs; their foreign keys may already have cascaded.
                Ficha::whereIn('id_ficha', $fichas->get($idAnterior, collect())->pluck('id_ficha'))
                    ->update([
                        'id_uni_cat' => $unidad->id_uni_cat,
                        'id_lote' => $unidad->id_lote,
                        'dc' => array_sum(str_split($unidad->id_uni_cat)) % 9,
                    ]);
            }
        });
    }

    private function validarDestinos(Model $modelo, array $mapa): void
    {
        if (count(array_unique(array_values($mapa))) !== count($mapa)) {
            $this->rechazar('La renumeración produce claves duplicadas en ' . $modelo->getTable() . '. No se realizó ningún cambio.');
        }

        $ocupados = $modelo->newQuery()->whereKey(array_values($mapa))->lockForUpdate()->pluck($modelo->getKeyName())->flip();
        foreach ($mapa as $anterior => $nuevo) {
            if ((string) $anterior !== (string) $nuevo && $ocupados->has($nuevo)) {
                $this->rechazar('El código ' . $nuevo . ' ya está ocupado. Los intercambios de códigos requieren una renumeración planificada.');
            }
        }
    }

    private function rechazar(string $mensaje): void
    {
        throw ValidationException::withMessages(['codi_mzna' => $mensaje]);
    }
}
