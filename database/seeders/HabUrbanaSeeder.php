<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\HabUrbana; 

class HabUrbanaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $haburbanas = [
            ['id_hab_urba'=>'0806011001','grup_urba'=>NULL,'tipo_hab_urba'=>'AA.HH.','nomb_hab_urba'=>'JOSE OLAYA','codi_hab_urba'=>'1001','id_ubi_geo'=>'080601','estado'=>'1'],
            ['id_hab_urba'=>'0806011002','grup_urba'=>NULL,'tipo_hab_urba'=>'AA.HH.','nomb_hab_urba'=>'PROGRAMA DE VIVIENDA TTIO SUR','codi_hab_urba'=>'1002','id_ubi_geo'=>'080601','estado'=>'1'],
            ['id_hab_urba'=>'0806011003','grup_urba'=>NULL,'tipo_hab_urba'=>'URB.','nomb_hab_urba'=>'REYNA DE BELEN','codi_hab_urba'=>'1003','id_ubi_geo'=>'080601','estado'=>'1'],
            ['id_hab_urba'=>'0806011004','grup_urba'=>NULL,'tipo_hab_urba'=>'HU.PR.','nomb_hab_urba'=>'SIMON HERRERA','codi_hab_urba'=>'1004','id_ubi_geo'=>'080601','estado'=>'1'],
            ['id_hab_urba'=>'0806011005','grup_urba'=>NULL,'tipo_hab_urba'=>'AA.HH.','nomb_hab_urba'=>'VALLECITO','codi_hab_urba'=>'1005','id_ubi_geo'=>'080601','estado'=>'1'],
            ['id_hab_urba'=>'0806011006','grup_urba'=>NULL,'tipo_hab_urba'=>'HU.PR.','nomb_hab_urba'=>'CAPAC YUPANQUI','codi_hab_urba'=>'1006','id_ubi_geo'=>'080601','estado'=>'1'],
            ['id_hab_urba'=>'0806011007','grup_urba'=>NULL,'tipo_hab_urba'=>'CA.','nomb_hab_urba'=>'HILARIO MENDIVIL 1 ETAPA','codi_hab_urba'=>'1007','id_ubi_geo'=>'080601','estado'=>'1'],
            ['id_hab_urba'=>'0806011008','grup_urba'=>NULL,'tipo_hab_urba'=>'CA.','nomb_hab_urba'=>'HILARIO MENDIVIL 2 ETAPA','codi_hab_urba'=>'1008','id_ubi_geo'=>'080601','estado'=>'1'],
            ['id_hab_urba'=>'0806011009','grup_urba'=>NULL,'tipo_hab_urba'=>'ASOC.','nomb_hab_urba'=>'INGENIERIA','codi_hab_urba'=>'1009','id_ubi_geo'=>'080601','estado'=>'1'],
            ['id_hab_urba'=>'0806011010','grup_urba'=>NULL,'tipo_hab_urba'=>'ASOC.','nomb_hab_urba'=>'KENNEDY "B"','codi_hab_urba'=>'1010','id_ubi_geo'=>'080601','estado'=>'1'],

            ['id_hab_urba'=>'0806010660','grup_urba'=>NULL,'tipo_hab_urba'=>'PRG. VIV. ','nomb_hab_urba'=>'URB. TTIO','codi_hab_urba'=>'0660','id_ubi_geo'=>'080601','estado'=>'1'],
            ['id_hab_urba'=>'0806010670','grup_urba'=>NULL,'tipo_hab_urba'=>'PP.JJ.','nomb_hab_urba'=>'SIMON HERRERA FARFAN','codi_hab_urba'=>'0670','id_ubi_geo'=>'080601','estado'=>'1'],
            ['id_hab_urba'=>'0806010680','grup_urba'=>NULL,'tipo_hab_urba'=>'S/T.','nomb_hab_urba'=>'SIN DENOMINACION','codi_hab_urba'=>'0680','id_ubi_geo'=>'080601','estado'=>'1'],
            ['id_hab_urba'=>'0806010690','grup_urba'=>NULL,'tipo_hab_urba'=>'AA.HH.','nomb_hab_urba'=>'PUEBLO JOVEN "JOSE OLAYA"','codi_hab_urba'=>'0690','id_ubi_geo'=>'080601','estado'=>'1'],
            ['id_hab_urba'=>'0806010700','grup_urba'=>NULL,'tipo_hab_urba'=>'S/T.','nomb_hab_urba'=>'SIN DENOMINACION','codi_hab_urba'=>'0700','id_ubi_geo'=>'080601','estado'=>'1'],
            ['id_hab_urba'=>'0806010710','grup_urba'=>NULL,'tipo_hab_urba'=>'AA.HH. MRG','nomb_hab_urba'=>'PUEBLO JOVEN VALLECITO','codi_hab_urba'=>'0710','id_ubi_geo'=>'080601','estado'=>'1'],
            ['id_hab_urba'=>'0806010720','grup_urba'=>NULL,'tipo_hab_urba'=>'S/T.','nomb_hab_urba'=>'SIN DENOMINACION','codi_hab_urba'=>'0720','id_ubi_geo'=>'080601','estado'=>'1'],
            ['id_hab_urba'=>'0806010730','grup_urba'=>NULL,'tipo_hab_urba'=>'S/T.','nomb_hab_urba'=>'SIN DENOMINACION','codi_hab_urba'=>'0730','id_ubi_geo'=>'080601','estado'=>'1'],
            ['id_hab_urba'=>'0806010740','grup_urba'=>NULL,'tipo_hab_urba'=>'S/T.','nomb_hab_urba'=>'SIN DENOMINACION','codi_hab_urba'=>'0740','id_ubi_geo'=>'080601','estado'=>'1'],
            ['id_hab_urba'=>'0806010750','grup_urba'=>NULL,'tipo_hab_urba'=>'APV.','nomb_hab_urba'=>'JOHN F. KENNEDY "B"','codi_hab_urba'=>'0750','id_ubi_geo'=>'080601','estado'=>'1'],
            ['id_hab_urba'=>'0806010760','grup_urba'=>NULL,'tipo_hab_urba'=>'APV.','nomb_hab_urba'=>'SAN JUDAS CHICO N° 3','codi_hab_urba'=>'0760','id_ubi_geo'=>'080601','estado'=>'1'],
            ['id_hab_urba'=>'0806010770','grup_urba'=>NULL,'tipo_hab_urba'=>'APV.','nomb_hab_urba'=>'LOS ALAMOS','codi_hab_urba'=>'0770','id_ubi_geo'=>'080601','estado'=>'1'],
            ['id_hab_urba'=>'0806010780','grup_urba'=>NULL,'tipo_hab_urba'=>'URB.','nomb_hab_urba'=>'VELASCO ASTETE','codi_hab_urba'=>'0780','id_ubi_geo'=>'080601','estado'=>'1'],
            ['id_hab_urba'=>'0806010790','grup_urba'=>NULL,'tipo_hab_urba'=>'S/T.','nomb_hab_urba'=>'LAS ORQUIDEAS','codi_hab_urba'=>'0790','id_ubi_geo'=>'080601','estado'=>'1'],
            ['id_hab_urba'=>'0806010800','grup_urba'=>NULL,'tipo_hab_urba'=>'S/T.','nomb_hab_urba'=>'SIN DENOMINACION','codi_hab_urba'=>'0800','id_ubi_geo'=>'080601','estado'=>'1'],
            ['id_hab_urba'=>'0806010810','grup_urba'=>NULL,'tipo_hab_urba'=>'CC. HH. ','nomb_hab_urba'=>'HILARIO MENDIVIL','codi_hab_urba'=>'0810','id_ubi_geo'=>'080601','estado'=>'1'],
            ['id_hab_urba'=>'0806010820','grup_urba'=>NULL,'tipo_hab_urba'=>'APV.','nomb_hab_urba'=>'SAN JUDAS CHICO N° 3','codi_hab_urba'=>'0820','id_ubi_geo'=>'080601','estado'=>'1'],
            ['id_hab_urba'=>'0806010830','grup_urba'=>NULL,'tipo_hab_urba'=>'ADV.','nomb_hab_urba'=>'SANTA LUCILA','codi_hab_urba'=>'0830','id_ubi_geo'=>'080601','estado'=>'1'],
            ['id_hab_urba'=>'0806010840','grup_urba'=>NULL,'tipo_hab_urba'=>'ADV.','nomb_hab_urba'=>'SEÑOR DE LOS MILAGROS','codi_hab_urba'=>'0840','id_ubi_geo'=>'080601','estado'=>'1'],
            ['id_hab_urba'=>'0806010850','grup_urba'=>NULL,'tipo_hab_urba'=>'AA.HH. MRG','nomb_hab_urba'=>'SOL NACIENTE','codi_hab_urba'=>'0850','id_ubi_geo'=>'080601','estado'=>'1'],
            ['id_hab_urba'=>'0806010860','grup_urba'=>NULL,'tipo_hab_urba'=>'S/T.','nomb_hab_urba'=>'SIN DENOMINACION','codi_hab_urba'=>'0860','id_ubi_geo'=>'080601','estado'=>'1'],
            ['id_hab_urba'=>'0806010870','grup_urba'=>NULL,'tipo_hab_urba'=>'SUBDIVISIO ','nomb_hab_urba'=>'PREDIO AÑAYPAMPA','codi_hab_urba'=>'0870','id_ubi_geo'=>'080601','estado'=>'1'],
            ['id_hab_urba'=>'0806010880','grup_urba'=>NULL,'tipo_hab_urba'=>'APV.','nomb_hab_urba'=>'CAPAC YUPANQUI','codi_hab_urba'=>'0880','id_ubi_geo'=>'080601','estado'=>'1'],
            ['id_hab_urba'=>'0806010890','grup_urba'=>NULL,'tipo_hab_urba'=>'S/T.','nomb_hab_urba'=>'SIN DENOMINACION','codi_hab_urba'=>'0890','id_ubi_geo'=>'080601','estado'=>'1'],
            ['id_hab_urba'=>'0806010900','grup_urba'=>NULL,'tipo_hab_urba'=>'S/T.','nomb_hab_urba'=>'SIN DENOMINACION','codi_hab_urba'=>'0900','id_ubi_geo'=>'080601','estado'=>'1'],
            ['id_hab_urba'=>'0806010910','grup_urba'=>NULL,'tipo_hab_urba'=>'ASOC.','nomb_hab_urba'=>'INGENIERIA','codi_hab_urba'=>'0910','id_ubi_geo'=>'080601','estado'=>'1'],



            
        ];
        
        foreach ($haburbanas as $haburb) {
            HabUrbana::create($haburb);
        }
        
    }
}
