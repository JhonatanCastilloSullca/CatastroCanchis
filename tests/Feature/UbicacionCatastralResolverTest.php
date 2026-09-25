<?php

namespace Tests\Feature;

use App\Services\UbicacionCatastralResolver;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class UbicacionCatastralResolverTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        config(['database.default' => 'sqlite', 'database.connections.sqlite.database' => ':memory:']);
        DB::purge('sqlite');

        Schema::create('tf_lotes', function (Blueprint $table) {
            $table->string('id_lote')->primary();
            $table->string('id_mzna');
            $table->string('codi_lote');
        });
        Schema::create('tf_edificaciones', function (Blueprint $table) {
            $table->string('id_edificacion')->primary();
            $table->string('id_lote');
            $table->string('codi_edificacion');
        });
        Schema::create('tf_uni_cat', function (Blueprint $table) {
            $table->string('id_uni_cat')->primary();
            $table->string('id_lote');
            $table->string('id_edificacion');
            $table->string('codi_entrada');
            $table->string('codi_piso');
            $table->string('codi_unidad');
        });
    }

    public function test_edit_keeps_current_lot_when_a_reconstructed_key_belongs_to_another_manzana(): void
    {
        $this->lot('08060105020001', '08060105035', '001');
        $this->lot('08060105035001', '08060105050', '001');

        $lot = $this->resolver()->lote('08060105035', '1', '08060105020001');

        $this->assertSame('08060105020001', $lot->id_lote);
        $this->assertSame('08060105035', $lot->id_mzna);
    }

    public function test_existing_identity_disambiguates_duplicate_logical_locations(): void
    {
        $this->lot('08060105005013', '08060105003', '013');
        $this->lot('08060105003013', '08060105003', '013');

        $this->assertSame('08060105005013', $this->resolver()->lote('08060105003', '13', '08060105005013')->id_lote);
    }

    public function test_transfer_to_an_ambiguous_location_is_rejected(): void
    {
        $this->lot('08060105005013', '08060105003', '013');
        $this->lot('08060105003013', '08060105003', '013');

        $this->expectException(ValidationException::class);
        $this->resolver()->lote('08060105003', '13', null);
    }

    public function test_transfer_uses_the_unique_actual_location_instead_of_the_encoded_prefix(): void
    {
        $this->lot('08060105020001', '08060105035', '001');
        $this->lot('08060105035001', '08060105050', '001');

        $this->assertSame('08060105020001', $this->resolver()->lote('08060105035', '1', '08060105035001')->id_lote);
    }

    public function test_creation_cannot_reuse_a_key_owned_by_another_location(): void
    {
        $this->lot('08060105035001', '08060105050', '001');

        $this->expectException(ValidationException::class);
        $this->resolver()->lote('08060105035', '1', null);
    }

    public function test_unoccupied_location_allows_existing_creation_flow(): void
    {
        $this->assertNull($this->resolver()->lote('08060105035', '1', null));
    }

    public function test_building_and_unit_keep_their_ids_after_their_parent_lot_was_renumbered(): void
    {
        DB::table('tf_edificaciones')->insert([
            'id_edificacion' => '0806010502000101', 'id_lote' => '08060105035001', 'codi_edificacion' => '01',
        ]);
        DB::table('tf_uni_cat')->insert([
            'id_uni_cat' => '08060105020001010101001', 'id_lote' => '08060105035001',
            'id_edificacion' => '0806010502000101', 'codi_entrada' => '01', 'codi_piso' => '01', 'codi_unidad' => '001',
        ]);

        $building = $this->resolver()->edificacion('08060105035001', '1', '0806010502000101');
        $unit = $this->resolver()->unidad('08060105035001', $building->id_edificacion, '1', '1', '1', '08060105020001010101001');

        $this->assertSame('0806010502000101', $building->id_edificacion);
        $this->assertSame('08060105020001010101001', $unit->id_uni_cat);
    }

    public function test_unit_with_inconsistent_parent_is_not_silently_reassigned(): void
    {
        DB::table('tf_uni_cat')->insert([
            'id_uni_cat' => '08060105020001010101001', 'id_lote' => '08060105099001',
            'id_edificacion' => '0806010502000101', 'codi_entrada' => '01', 'codi_piso' => '01', 'codi_unidad' => '001',
        ]);

        $this->expectException(ValidationException::class);
        $this->resolver()->unidad('08060105020001', '0806010502000101', '1', '1', '1', '08060105020001010101001');
    }

    private function lot(string $id, string $manzana, string $codigo): void
    {
        DB::table('tf_lotes')->insert(['id_lote' => $id, 'id_mzna' => $manzana, 'codi_lote' => $codigo]);
    }

    private function resolver(): UbicacionCatastralResolver
    {
        return new UbicacionCatastralResolver();
    }
}
