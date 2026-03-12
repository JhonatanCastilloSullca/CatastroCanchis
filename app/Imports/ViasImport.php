<?php

namespace App\Imports;

use App\Models\Via;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Carbon\Carbon;

class ViasImport implements OnEachRow, WithHeadingRow, WithBatchInserts, WithChunkReading, WithValidation
{
    public $ubigeo = '080601';

    public function __construct()
    {
    }

    public function onRow(Row $row)
    {
        $codevia = Via::where('codi_via',$row['codi_via'])->first();
        if(!$codevia){
                $codevia = new Via();
                $codevia->id_via = $this->ubigeo.$row['codi_via'];
                $codevia->id_ubi_geo = $this->ubigeo;
                $codevia->fecha_via = Carbon::now()->format("Y-m-d");
                $codevia->estado = 1;    
        }
        $codevia->nomb_via = $row['nomb_via'];
        $codevia->tipo_via = $row['tipo_via'];
        $codevia->codi_via = $row['codi_via'];            
        $codevia->save();
        
    }

    public function batchSize(): int
    {
        return 4000;
    }
    
    public function chunkSize(): int
    {
        return 4000;
    }

    public function rules(): array
    {
        return [
            '*.nomb_via' => 'required',
            '*.tipo_via' => 'required',
            '*.codi_via' => 'required',
        ];
    }
}
