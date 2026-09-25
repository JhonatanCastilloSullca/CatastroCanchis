<?php

namespace Tests\Feature;

use App\Services\RenumerarManzanaService;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class RenumerarManzanaServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        config(['database.default' => 'sqlite', 'database.connections.sqlite.database' => ':memory:', 'audit.enabled' => false]);
        DB::purge('sqlite');
        DB::unprepared('PRAGMA foreign_keys = ON;
            CREATE TABLE tf_manzanas (id_mzna TEXT PRIMARY KEY, id_sector TEXT, codi_mzna TEXT, nume_mzna TEXT);
            CREATE TABLE tf_lotes (id_lote TEXT PRIMARY KEY, id_mzna TEXT REFERENCES tf_manzanas(id_mzna) ON UPDATE CASCADE, codi_lote TEXT);
            CREATE TABLE tf_edificaciones (id_edificacion TEXT PRIMARY KEY, id_lote TEXT REFERENCES tf_lotes(id_lote) ON UPDATE CASCADE, codi_edificacion TEXT);
            CREATE TABLE tf_puertas (id_puerta TEXT PRIMARY KEY, id_lote TEXT REFERENCES tf_lotes(id_lote) ON UPDATE CASCADE, codi_puerta TEXT);
            CREATE TABLE tf_uni_cat (id_uni_cat TEXT PRIMARY KEY, id_lote TEXT REFERENCES tf_lotes(id_lote) ON UPDATE CASCADE, id_edificacion TEXT REFERENCES tf_edificaciones(id_edificacion) ON UPDATE CASCADE, codi_entrada TEXT, codi_piso TEXT, codi_unidad TEXT);
            CREATE TABLE tf_fichas (id_ficha TEXT PRIMARY KEY, id_lote TEXT REFERENCES tf_lotes(id_lote) ON UPDATE CASCADE, id_uni_cat TEXT REFERENCES tf_uni_cat(id_uni_cat) ON UPDATE CASCADE, dc TEXT);
            CREATE TABLE tf_ingresos (id_ficha TEXT, id_puerta TEXT REFERENCES tf_puertas(id_puerta) ON UPDATE CASCADE);');
    }

    public function test_updates_units_and_fichas_even_when_lot_fk_has_already_cascaded(): void
    {
        $this->fixture();
        $this->service()->ejecutar('08060105', '020', '035', 'Manzana 35');

        $this->assertSame('08060105035001010101001', DB::table('tf_uni_cat')->value('id_uni_cat'));
        $ficha = DB::table('tf_fichas')->first();
        $this->assertSame('08060105035001', $ficha->id_lote);
        $this->assertSame('08060105035001010101001', $ficha->id_uni_cat);
        $this->assertSame((string) (array_sum(str_split($ficha->id_uni_cat)) % 9), $ficha->dc);
        $this->assertSame('08060105035001P12', DB::table('tf_ingresos')->value('id_puerta'));
    }

    public function test_uses_real_keys_for_a_lot_with_a_legacy_prefix(): void
    {
        $this->fixture('08060105099001');
        $this->service()->ejecutar('08060105', '020', '035', 'Manzana 35');

        $this->assertSame('08060105035001010101001', DB::table('tf_uni_cat')->value('id_uni_cat'));
        $this->assertSame('08060105035001P12', DB::table('tf_puertas')->value('id_puerta'));
    }

    public function test_rejects_occupied_manzana_without_modifying_origin(): void
    {
        $this->fixture();
        DB::table('tf_manzanas')->insert(['id_mzna' => '08060105035', 'id_sector' => '08060105', 'codi_mzna' => '035']);
        try {
            $this->service()->ejecutar('08060105', '020', '035', 'Destino');
            $this->fail('The occupied key should be rejected.');
        } catch (ValidationException $exception) {
            $this->assertSame('08060105020001', DB::table('tf_lotes')->value('id_lote'));
        }
    }

    public function test_does_not_silently_skip_a_door_collision(): void
    {
        $this->fixture();
        DB::table('tf_puertas')->insert(['id_puerta' => '08060105035001P12', 'id_lote' => '08060105020001', 'codi_puerta' => 'P']);
        try {
            $this->service()->ejecutar('08060105', '020', '035', 'Destino');
            $this->fail('The duplicate door destination should be rejected.');
        } catch (ValidationException $exception) {
            $this->assertSame('08060105020', DB::table('tf_manzanas')->value('id_mzna'));
            $this->assertSame(2, DB::table('tf_puertas')->count());
        }
    }

    public function test_late_failure_rolls_back_the_entire_renumbering(): void
    {
        $this->fixture();
        DB::unprepared("CREATE TRIGGER fail_unit BEFORE UPDATE OF id_uni_cat ON tf_uni_cat BEGIN SELECT RAISE(ABORT, 'test failure'); END;");
        try {
            $this->service()->ejecutar('08060105', '020', '035', 'Destino');
            $this->fail('The injected error should be propagated.');
        } catch (QueryException $exception) {
            $this->assertSame('08060105020', DB::table('tf_manzanas')->value('id_mzna'));
            $this->assertSame('08060105020001', DB::table('tf_lotes')->value('id_lote'));
            $this->assertSame('08060105020001010101001', DB::table('tf_fichas')->value('id_uni_cat'));
            $this->assertSame('08060105020001P12', DB::table('tf_puertas')->value('id_puerta'));
        }
    }

    private function fixture(string $lote = '08060105020001'): void
    {
        DB::table('tf_manzanas')->insert(['id_mzna' => '08060105020', 'id_sector' => '08060105', 'codi_mzna' => '020', 'nume_mzna' => 'ORIGEN']);
        DB::table('tf_lotes')->insert(['id_lote' => $lote, 'id_mzna' => '08060105020', 'codi_lote' => '001']);
        DB::table('tf_edificaciones')->insert(['id_edificacion' => $lote.'01', 'id_lote' => $lote, 'codi_edificacion' => '01']);
        DB::table('tf_uni_cat')->insert(['id_uni_cat' => $lote.'010101001', 'id_lote' => $lote, 'id_edificacion' => $lote.'01', 'codi_entrada' => '01', 'codi_piso' => '01', 'codi_unidad' => '001']);
        DB::table('tf_fichas')->insert(['id_ficha' => 'F1', 'id_lote' => $lote, 'id_uni_cat' => $lote.'010101001', 'dc' => '0']);
        DB::table('tf_puertas')->insert(['id_puerta' => $lote.'P12', 'id_lote' => $lote, 'codi_puerta' => 'P']);
        DB::table('tf_ingresos')->insert(['id_ficha' => 'F1', 'id_puerta' => $lote.'P12']);
    }

    private function service(): RenumerarManzanaService
    {
        return new RenumerarManzanaService();
    }
}
