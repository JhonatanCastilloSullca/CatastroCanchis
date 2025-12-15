<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ficha Informativa</title>
    <style>
        body {
            background-color: #FFF;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            font-size: 7px;
            font-weight: normal;
            margin: 5px;
            color: #151b1e;
            TEXT-TRANSFORM: UPPERCASE;

        }

        div {
            border: 0.5px solid;
        }

        .bprueba {
            background-color: #333;
        }

        .numeros {
            background-color: #777777;
            color: #000;
            width: 15px;
            height: 15px;
            border: none;
            float: left;
        }

        .numerosblanco {
            background-color: #fff;
            color: #000;
            width: 15px;
            height: 15px;
            border: none;
            float: left;
        }

        .textotop {
            background-color: #FFF;
            color: #000;
            width: 80px;
            height: 15px;
            border: none;
            float: left;
        }

        .texto {
            float: right;
            border: none;

            text-align: center;
            vertical-align: middle;
        }

        .texto2 {
            float: right;

            text-align: center;
            vertical-align: middle;
        }

        .textotitulo {
            float: right;
            border: none;
            font-weight: bold;
            text-align: left;
            vertical-align: middle;
        }

        .ti {
            text-align: left;
        }

        .td {
            text-align: right;
        }

        .tc {
            text-align: center;
        }

        .pr5 {
            padding-right: 5px;
        }

        .pr15 {
            padding-right: 15px;
        }

        .pr25 {
            padding-right: 25px;
        }

        .pl5 {
            padding-left: 5px;
        }

        .pl15 {
            padding-left: 15px;
        }

        .pl25 {
            padding-left: 25px;
        }

        .ptb5 {
            padding-top: 5px;
            padding-bottom: 5px;
        }

        .ptb10 {
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .fondoclaro {
            background-color: #7effff;
        }

        .fondoclarito {
            background-color: #ffff7e;
            color: #c62200;

        }

        .fz4 {

            font-weight: bolder;
            font-size: 4px !important;
        }

        .fz5 {

            font-weight: bolder;
            font-size: 5px !important;
        }

        .fz6 {

            font-weight: bolder;
            font-size: 6px !important;
        }

        .fz7 {

            font-weight: bolder;
            font-size: 7px !important;
        }

        .fz8 {

            font-weight: bolder;
            font-size: 8px !important;
        }

        .fz10 {

            font-weight: bolder;
            font-size: 10px !important;
        }

        .fz12 {

            font-weight: bolder;
            font-size: 12px !important;
        }

        .fz14 {

            font-weight: bolder;
            font-size: 14px !important;
        }

        .fz16 {

            font-weight: bolder;
            font-size: 16px !important;
        }

        .fz18 {

            font-weight: bolder;
            font-size: 18px !important;
        }

        .lh2 {
            line-height: 2px;
        }

        .lh4 {
            line-height: 4px;
        }

        .lh6 {
            line-height: 6px;
        }

        .lh7 {
            line-height: 7px;
        }

        .lh8 {
            line-height: 8px;
        }

        .lh10 {
            line-height: 10px;
        }

        .lh12 {
            line-height: 12px;
        }

        .lh14 {
            line-height: 14px;
        }

        .lh16 {
            line-height: 16px;
        }

        .lh18 {
            line-height: 18px;
        }

        .lh20 {
            line-height: 20px;
        }

        .bn {
            border: none !important;
        }

        .bp {
            background-color: #342;
        }

        #pagebreak1 {
            page-break-after: always;
        }

        .bgfdc {
            background-color: #5d0d0d;
            color: #fff;
        }

        .bgfdd {
            background-color: #CFCFE9;
        }








        .table {
            display: table;
            width: 100%;
            max-width: 100%;
            margin-bottom: 0.3rem;
            background-color: transparent;
            border-collapse: collapse;
        }

        thead {
            display: table-header-group;
            vertical-align: middle;
            border-color: inherit;
        }

        tr {
            display: table-row;
            vertical-align: inherit;
            border-color: inherit;
        }

        .table th,
        .table td {
            padding: 0.3rem;
            vertical-align: top;
        }

        .table thead th {
            vertical-align: bottom;
            background-color: #5d0d0d;
            color: #fff;
            border: 1px solid #fff;
        }

        .table-bordered thead th,
        .table-bordered thead td {
            border-bottom-width: 1px;
        }

        th,
        td {
            display: table-cell;
            vertical-align: inherit;
            line-height: 1.6;
        }

        th {
            font-weight: bold;
            text-align: -internal-center;
            text-align: left;
            line-height: 1.6;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tbody {
            vertical-align: middle;
            border-color: inherit;
        }
    </style>

</head>

<body>

    <div style="width: 716px;height:16px;margin: auto;border:none;">
    </div>

    <div style="width: 716px;height:16px;margin: auto;border:none; margin-bottom:5px;background-color:#fff;">

        <div style="width: 120px;height: 120px;float:left;border:none;vertical-align:middle">
            <img src="{{ $logos?->logo_institucion }}" alt="Logo" style="width: 200px;">
        </div>

        <div style="width: 473px;height: 8px;float:left;border:none;">
            <div style="width: 473px;height:16px;margin: auto;" class="bn">
                <div class="texto fz18 lh14">
                    <b style="color:#5d0d0d"> MUNIPALIDAD PROVINCIAL DE </b>
                </div>
            </div>
            <div style="width: 473px;height:16px;margin: auto;" class="bn">
                <div class="texto fz12 lh14">
                    CUSCO - PERÚ
                </div>
            </div>
            <div style="width: 473px;height:16px;margin: auto;" class="bn">
                <div class="texto fz8 lh14">
                    GERENCIA DE DESARROLLO URBANO Y RURAL<br>
                    FECHA: {{ $fecha }} / HORA: {{ $hora }}
                </div>
            </div>
            <div style="width: 473px;height:16px;margin: auto; padding-top:5px;padding-bottom:5px; " class="bgfdc">
                <div class="texto fz14 lh10">
                    <b>REPORTE DE TITULARES CATASTRAL</b>
                </div>
            </div>

        </div>

        <div style="width: 120px;height: 120px;float:left;border:none;">
            <img src="{{ $logos?->logo_catastro }}" alt="">
        </div>
    </div>
    <br></br>
    <div style="width: 716px;height:20px;  float:left;" class="bn">
        <div style="width: 716px;height:20px;  float:left;text-align:left;" class="texto fz10 lh10">
            <b>DEPARTAMENTO:</b> CUSCO
        </div>
    </div>
    <div style="width: 716px;height:20px;  float:left;" class="bn">
        <div style="width: 716px;height:20px;  float:left;text-align:left;" class="texto fz10 lh10">
            <b>PROVINCIA:</b> CANCHIS
        </div>
    </div>
    <div style="width: 716px;height:20px;  float:left;" class="bn">
        <div style="width: 716px;height:20px;  float:left;text-align:left;" class="texto fz10 lh10">
            <b>DISTRITO:</b> CANCHIS
        </div>
    </div>
    <div style="width: 716px;height:20px;  float:left;" class="bn">
        <div style="width: 716px;height:20px;  float:left;text-align:left;" class="texto fz10 lh10">
            <b>SECTOR:</b> {{ $sectores?->nomb_sector }}

        </div>
    </div>


    <div style="margin-top:10px;width: 716px;height:100px;  float:left;" class="bn">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th rowspan="2">Ref. Catastral</th>
                    <th rowspan="2">CUC Unidad Catastral</th>
                    <th rowspan="2">Titular(es) Catastral(es)</th>
                    <th rowspan="2">% Propiedad</th>
                    <th rowspan="2">DNI / RUC</th>
                    <th colspan="8" class="text-center">UBICACIÓN DEL PREDIO CATASTRAL</th>
                    <th rowspan="2">Área de titulo (m2)</th>
                    <th rowspan="2">Área de terreno verificada (m2)</th>
                    <th rowspan="2">Área de construida verificada total (m2)</th>
                    <th rowspan="2">Uso</th>
                </tr>
                <tr>
                    <th>Tipo Via</th>
                    <th>Nombre de Via</th>
                    <th>Número</th>
                    <th>Tipo Interior</th>
                    <th>Nº Interior</th>
                    <th>Manzana</th>
                    <th>Lote</th>
                    <th>Nombre de Hab. Urb.</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($titulares as $titular)
                    <tr>
                        <td>{{$titular->id_uni_cat}}</td>
                        <td>{{ $titular->cuc }}</td>
                        <td>
                            @foreach ($titular->titularesPersonalizados as $titular1)
                                {{ $titular1->nombres }}<br>
                            @endforeach
                        </td>
                        <td>
                            @foreach ($titular->titularesPersonalizados as $titular1)
                                {{ $titular1->porc_cotitular }}<br>
                            @endforeach
                        </td>
                        <td>
                            @foreach ($titular->titularesPersonalizados as $titular1)
                                {{ $titular1->nume_doc }}<br>
                            @endforeach
                        </td>
                        <td>{{ $titular->puertaPersonalizada?->tipo_via }}</td>
                        <td>{{ $titular->puertaPersonalizada?->nomb_via }}</td>
                        <td>{{ $titular->puertaPersonalizada?->nume_muni }}</td>
                        <td>{{ $titular->tipo_interior }}</td>
                        <td>{{ $titular->nume_interior }}</td>
                        <td>{{ $titular->lote->manzana->codi_mzna }}</td>
                        <td>{{ $titular->lote->codi_lote }}</td>
                        <td>{{ $titular->lote?->hab_urbana?->nomb_hab_urba }}</td>
                        <td>{{$titular->totalareaporlotetitulo}}</td>
                        <td>{{ $titular->totalareaporlote }}</td>
                        <td>{{ $titular->totalareaporpiso }}</td>
                        <td>{{ $titular->usoUniCat()->desc_uso }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>



    <div style="width: 716px;height:20px;  float:left;" class="bn">

    </div>




</body>

</html>
