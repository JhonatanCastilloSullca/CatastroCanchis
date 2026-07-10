<?php

namespace App\Imports;

use App\Models\Ficha;
use App\Models\UniCat;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class CucImport implements OnEachRow, WithHeadingRow, WithBatchInserts, WithChunkReading, WithValidation
{
    public function __construct()
    {
    }

    public function onRow(Row $row)
    {
        $uni_cat = UniCat::find($row['cod_referencia']);
        if($uni_cat)
        {  
            $uni_cat->cuc = $row['cuc'];
            $uni_cat->save();

            $fichas = Ficha::where('id_uni_cat',$row['cod_referencia'])->get();
            if($fichas){
                foreach($fichas as $ficha){
                    $ficha->cuc = $row['cuc'];
                    $ficha->save();
                }
            }
        }
        
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
            '*.cod_referencia' => 'required',
        ];
    }
}
