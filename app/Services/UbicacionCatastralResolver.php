<?php

namespace App\Services;

use App\Models\Edificaciones;
use App\Models\Lote;
use App\Models\UniCat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;

class UbicacionCatastralResolver
{
    public function lote(string $manzana, string $codigo, ?string $actual): ?Lote
    {
        $codigo = str_pad($codigo, 3, '0', STR_PAD_LEFT);

        return $this->buscar(new Lote(), [
            'id_mzna' => $manzana,
            'codi_lote' => $codigo,
        ], $actual, $manzana . $codigo, 'lote');
    }

    public function edificacion(string $lote, string $codigo, ?string $actual): ?Edificaciones
    {
        $codigo = str_pad($codigo, 2, '0', STR_PAD_LEFT);

        return $this->buscar(new Edificaciones(), [
            'id_lote' => $lote,
            'codi_edificacion' => $codigo,
        ], $actual, $lote . $codigo, 'edifica');
    }

    public function unidad(string $lote, string $edificacion, string $entrada, string $piso, string $unidad, ?string $actual): ?UniCat
    {
        $entrada = str_pad($entrada, 2, '0', STR_PAD_LEFT);
        $piso = str_pad($piso, 2, '0', STR_PAD_LEFT);
        $unidad = str_pad($unidad, 3, '0', STR_PAD_LEFT);

        return $this->buscar(new UniCat(), [
            'id_lote' => $lote,
            'id_edificacion' => $edificacion,
            'codi_entrada' => $entrada,
            'codi_piso' => $piso,
            'codi_unidad' => $unidad,
        ], $actual, $edificacion . $entrada . $piso . $unidad, 'unidad');
    }

    /**
     * Resolve from current relationships, not from prefixes left by a renumbering.
     * Call within the save transaction so the selected parent remains locked.
     * A null result permits the caller's existing creation flow only if the key is free.
     */
    private function buscar(Model $modelo, array $ubicacion, ?string $actual, string $claveNueva, string $campo): ?Model
    {
        if ($actual !== null) {
            $existente = $modelo->newQuery()->where($ubicacion)->whereKey($actual)->lockForUpdate()->first();

            if ($existente !== null) {
                return $existente;
            }
        }

        $coincidencias = $modelo->newQuery()->where($ubicacion)->lockForUpdate()->limit(2)->get();

        if ($coincidencias->count() > 1) {
            throw ValidationException::withMessages([
                $campo => 'La ubicación corresponde a varios registros. Revise la renumeración antes de trasladar la ficha.',
            ]);
        }

        if ($coincidencias->isNotEmpty()) {
            return $coincidencias->first();
        }

        if ($modelo->newQuery()->whereKey($claveNueva)->lockForUpdate()->first() !== null) {
            throw ValidationException::withMessages([
                $campo => 'El código está ocupado por otra ubicación. Debe corregirse la renumeración antes de guardar.',
            ]);
        }

        return null;
    }
}
