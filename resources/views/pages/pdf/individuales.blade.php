<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ficha Catastral Urbana Individual</title>

    <style>
        @page {
            margin: 8mm 8mm 8mm 8mm;
        }

        body {
            margin: 0;
            color: #151b1e;
            background: #ffffff;
            font-family: dejavusans, sans-serif;
            font-size: 6.4px;
            text-transform: uppercase;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        td,
        th {
            border: 0.45px solid #222;
            padding: 2px 3px;
            vertical-align: middle;
            overflow-wrap: break-word;
        }

        .sin-borde,
        .sin-borde td {
            border: 0;
        }

        .cabecera {
            margin-bottom: 4px;
        }

        .logo {
            width: 18%;
            height: 58px;
            text-align: center;
            border: 0;
        }

        .logo img {
            max-width: 90px;
            max-height: 55px;
        }

        .titulo-principal {
            width: 64%;
            text-align: center;
            font-size: 11px;
            font-weight: bold;
            border: 0;
        }

        .datos-ficha {
            width: 18%;
            border: 0;
        }

        .datos-ficha table td {
            text-align: center;
        }

        .seccion {
            margin-top: 5px;
            background: #ffffff;
            border: 0;
            border-bottom: 1.2px solid #222;
            font-size: 8px;
            font-weight: bold;
            text-align: left;
            padding: 2px 4px;
        }

        .rotulo {
            background: #a9e5ff;
            font-weight: bold;
            text-align: center;
        }

        .ayuda {
            background: #ffff7e;
            color: #c62200;
            font-size: 5px;
            text-align: center;
        }

        .numero {
            display: inline-block;
            min-width: 14px;
            margin-right: 3px;
            padding: 1px 2px;
            background: #777777;
            color: #000000;
            font-weight: bold;
            text-align: center;
        }

        .valor {
            min-height: 12px;
            text-align: center;
            font-weight: bold;
        }

        .izquierda {
            text-align: left;
        }

        .derecha {
            text-align: right;
        }

        .centro {
            text-align: center;
        }

        .pequeno {
            font-size: 5px;
        }

        .muy-pequeno {
            font-size: 4.5px;
        }

        .alto-16 {
            height: 16px;
        }

        .alto-22 {
            height: 22px;
        }

        .alto-30 {
            height: 30px;
        }

        .sin-salto {
            page-break-inside: avoid;
        }

        .salto-ficha {
            page-break-after: always;
        }

        .lista td {
            height: 13px;
        }

        .firma {
            height: 36px;
            vertical-align: bottom;
            text-align: center;
        }

        .observacion {
            height: 42px;
            vertical-align: top;
            text-align: left;
        }
    </style>
</head>

<body>
@foreach ($fichas as $ficha)
    @php
        $titulares = collect($ficha?->titulars ?? []);
        $puertas = collect($ficha?->puertas ?? []);
        $construcciones = collect($ficha?->construccions ?? []);
        $instalaciones = collect($ficha?->instalacions ?? []);
        $documentos = collect($ficha?->documento_adjuntos ?? []);
        $litigantes = collect($ficha?->litigantes ?? []);

        $titularPrincipal = $ficha?->titular;
        $domicilio = $ficha?->domiciliotitular;

        $nombreDistrito = '';
        foreach (collect($domicilio?->distritos ?? []) as $distrito) {
            if (
                ($distrito?->cod_dep ?? null) == ($domicilio?->codi_dep ?? null) &&
                ($distrito?->cod_pro ?? null) == ($domicilio?->codi_pro ?? null) &&
                ($distrito?->codi_dis ?? null) == ($domicilio?->codi_dis ?? null)
            ) {
                $nombreDistrito = $distrito?->descri ?? '';
                break;
            }
        }

        $nombreProvincia = '';
        foreach (collect($domicilio?->provincias ?? []) as $provincia) {
            if (
                ($provincia?->cod_dep ?? null) == ($domicilio?->codi_dep ?? null) &&
                ($provincia?->cod_pro ?? null) == ($domicilio?->codi_pro ?? null) &&
                ($provincia?->codi_dis ?? null) == '00'
            ) {
                $nombreProvincia = $provincia?->descri ?? '';
                break;
            }
        }

        $nombreDepartamento = $domicilio?->departamento?->descri ?? '';
    @endphp

    <table class="cabecera sin-borde">
        <tr>
            <td class="logo">
                @if (!empty($logos?->logo_institucion))
                    <img src="{{ $logos->logo_institucion }}" alt="Logo institución">
                @endif
            </td>

            <td class="titulo-principal">
                FICHA CATASTRAL URBANA INDIVIDUAL
            </td>

            <td class="datos-ficha">
                <table>
                    <tr>
                        <td class="rotulo">NÚMERO DE FICHA</td>
                    </tr>
                    <tr>
                        <td class="valor">{{ $ficha?->nume_ficha }}</td>
                    </tr>
                    <tr>
                        <td class="rotulo pequeno">CONTADOR DE FICHAS POR LOTE</td>
                    </tr>
                    <tr>
                        <td class="valor">{{ $ficha?->nume_ficha_lote }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table class="sin-salto">
        <tr>
            <td class="rotulo" colspan="4">
                <span class="numero">01</span>CÓDIGO ÚNICO CATASTRAL - CUC
            </td>
            <td class="rotulo" colspan="8">
                <span class="numero">02</span>CÓDIGO DE REFERENCIA CATASTRAL
            </td>
        </tr>

        <tr>
            <td class="valor" colspan="4">{{ $ficha?->unicat?->cuc }}</td>
            <td class="rotulo">DPTO.</td>
            <td class="rotulo">PROV.</td>
            <td class="rotulo">DIST.</td>
            <td class="rotulo">SECTOR</td>
            <td class="rotulo">MANZANA</td>
            <td class="rotulo">LOTE</td>
            <td class="rotulo">EDIF.</td>
            <td class="rotulo">ENTRADA</td>
        </tr>

        <tr>
            <td class="rotulo" colspan="2"><span class="numero">03</span>CÓD. CONTRIBUYENTE RENTAS</td>
            <td class="valor" colspan="2">{{ $ficha?->unicat?->codi_cont_rentas }}</td>

            <td class="valor">08</td>
            <td class="valor">06</td>
            <td class="valor">01</td>
            <td class="valor">{{ $ficha?->unicat?->edificacion?->lote?->manzana?->sectore?->codi_sector }}</td>
            <td class="valor">{{ $ficha?->unicat?->edificacion?->lote?->manzana?->codi_mzna }}</td>
            <td class="valor">{{ $ficha?->unicat?->edificacion?->lote?->codi_lote }}</td>
            <td class="valor">{{ $ficha?->unicat?->edificacion?->codi_edificacion }}</td>
            <td class="valor">{{ $ficha?->unicat?->codi_entrada }}</td>
        </tr>

        <tr>
            <td class="rotulo" colspan="2"><span class="numero">04</span>CÓDIGO PREDIAL RENTAS</td>
            <td class="valor" colspan="2">{{ $ficha?->unicat?->codi_pred_rentas }}</td>

            <td class="rotulo">PISO</td>
            <td class="valor">{{ $ficha?->unicat?->codi_piso }}</td>
            <td class="rotulo">UNIDAD</td>
            <td class="valor">{{ $ficha?->unicat?->codi_unidad }}</td>
            <td class="rotulo">DC</td>
            <td class="valor">{{ $ficha?->dc }}</td>
            <td class="rotulo" colspan="2">REGISTRO</td>
            <td class="valor" colspan="2">{{ $ficha?->nume_registro }}</td>
        </tr>
    </table>

    <div class="seccion">UBICACIÓN DEL PREDIO CATASTRAL</div>

    <table class="lista">
        <thead>
        <tr>
            <th class="rotulo"><span class="numero">05</span>CÓDIGO VÍA</th>
            <th class="rotulo"><span class="numero">06</span>TIPO VÍA</th>
            <th class="rotulo" colspan="3"><span class="numero">07</span>NOMBRE DE VÍA</th>
            <th class="rotulo"><span class="numero">08</span>TIPO PUERTA</th>
            <th class="rotulo"><span class="numero">09</span>N° MUNICIPAL</th>
            <th class="rotulo"><span class="numero">10</span>COND.</th>
        </tr>
        </thead>

        <tbody>
        @forelse ($puertas as $puerta)
            <tr>
                <td class="valor">{{ $puerta?->via?->codi_via }}</td>
                <td class="valor">{{ $puerta?->via?->tipo_via }}</td>
                <td class="valor" colspan="3">{{ $puerta?->via?->nomb_via }}</td>
                <td class="valor">{{ $puerta?->tipo_puerta }}</td>
                <td class="valor">{{ $puerta?->nume_muni }}</td>
                <td class="valor">{{ $puerta?->cond_nume }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="8">&nbsp;</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <table class="sin-salto">
        <tr>
            <td class="rotulo"><span class="numero">11</span>TIPO EDIFICACIÓN</td>
            <td class="valor">{{ $ficha?->unicat?->edificacion?->tipo_edificacion }}</td>

            <td class="rotulo"><span class="numero">12</span>TIPO INTERIOR</td>
            <td class="valor">{{ $ficha?->unicat?->tipo_interior }}</td>

            <td class="rotulo"><span class="numero">13</span>N° INTERIOR</td>
            <td class="valor">{{ $ficha?->unicat?->nume_interior }}</td>
        </tr>

        <tr>
            <td class="rotulo"><span class="numero">14</span>CÓDIGO HU</td>
            <td class="valor">{{ $ficha?->unicat?->edificacion?->lote?->hab_urbana?->codi_hab_urba }}</td>

            <td class="rotulo"><span class="numero">15</span>NOMBRE HABILITACIÓN URBANA</td>
            <td class="valor" colspan="3">
                {{ $ficha?->unicat?->edificacion?->lote?->hab_urbana?->tipo_hab_urba }}
                {{ $ficha?->unicat?->edificacion?->lote?->hab_urbana?->nomb_hab_urba }}
            </td>
        </tr>

        <tr>
            <td class="rotulo"><span class="numero">16</span>ZONA / SECTOR / ETAPA</td>
            <td class="valor">{{ $ficha?->unicat?->edificacion?->lote?->zona_dist }}</td>

            <td class="rotulo"><span class="numero">17</span>MANZANA</td>
            <td class="valor">{{ $ficha?->unicat?->edificacion?->lote?->mzna_dist }}</td>

            <td class="rotulo"><span class="numero">18</span>LOTE</td>
            <td class="valor">{{ $ficha?->unicat?->edificacion?->lote?->lote_dist }}</td>
        </tr>

        <tr>
            <td class="rotulo"><span class="numero">19</span>SUB-LOTE</td>
            <td class="valor">{{ $ficha?->unicat?->edificacion?->lote?->sub_lote_dist }}</td>
            <td class="ayuda" colspan="4">
                VÍA: AV / CA / JR / PJE &nbsp;&nbsp; PUERTA: P / S / G / E
            </td>
        </tr>
    </table>

    <div class="seccion">IDENTIFICACIÓN DEL TITULAR CATASTRAL</div>

    <table class="sin-salto">
        <tr>
            <td class="rotulo"><span class="numero">20</span>TIPO DE TITULAR</td>
            <td class="valor">{{ $titularPrincipal?->persona?->tipo_persona }}</td>
            <td class="ayuda">1 = PERSONA NATURAL / 2 = PERSONA JURÍDICA</td>

            <td class="rotulo"><span class="numero">21</span>ESTADO CIVIL</td>
            <td class="valor">{{ $titularPrincipal?->esta_civil }}</td>
            <td class="ayuda">01 SOLTERO / 02 CASADO / 03 DIVORCIADO / 04 VIUDO / 05 CONVIVIENTE</td>
        </tr>
    </table>

    <table class="lista">
        <thead>
        <tr>
            <th class="rotulo"><span class="numero">22</span>TIPO DOC.</th>
            <th class="rotulo"><span class="numero">23</span>N° DOCUMENTO</th>
            <th class="rotulo"><span class="numero">24</span>NOMBRES / RAZÓN SOCIAL</th>
            <th class="rotulo"><span class="numero">25</span>APELLIDO PATERNO</th>
            <th class="rotulo"><span class="numero">26</span>APELLIDO MATERNO</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($titulares as $titular)
            <tr>
                <td class="valor">{{ $titular?->persona?->tipo_doc }}</td>
                <td class="valor">{{ $titular?->persona?->nume_doc }}</td>
                <td class="valor">
                    {{ $titular?->persona?->tipo_persona == 2
                        ? $titular?->persona?->razon_social
                        : $titular?->persona?->nombres }}
                </td>
                <td class="valor">{{ $titular?->persona?->ape_paterno }}</td>
                <td class="valor">{{ $titular?->persona?->ape_materno }}</td>
            </tr>
        @empty
            <tr><td colspan="5">&nbsp;</td></tr>
        @endforelse
        </tbody>
    </table>

    <table class="sin-salto">
        <tr>
            <td class="rotulo"><span class="numero">27</span>N° RUC</td>
            <td class="valor">{{ $titularPrincipal?->persona?->tipo_persona == 2 ? $titularPrincipal?->persona?->nume_doc : '' }}</td>

            <td class="rotulo"><span class="numero">28</span>RAZÓN SOCIAL</td>
            <td class="valor">{{ $titularPrincipal?->persona?->razon_social }}</td>

            <td class="rotulo"><span class="numero">29</span>TIPO PERSONA JURÍDICA</td>
            <td class="valor">{{ $titularPrincipal?->persona?->tipo_persona_juridica }}</td>
        </tr>
    </table>

    <div class="seccion">DOMICILIO FISCAL DEL TITULAR CATASTRAL</div>

    <table class="sin-salto">
        <tr>
            <td class="rotulo"><span class="numero">30</span>UBICACIÓN</td>
            <td class="valor">{{ $domicilio?->ubicacion }}</td>

            <td class="rotulo"><span class="numero">31</span>DISTRITO</td>
            <td class="valor">{{ $nombreDistrito }}</td>

            <td class="rotulo"><span class="numero">32</span>PROVINCIA</td>
            <td class="valor">{{ $nombreProvincia }}</td>

            <td class="rotulo"><span class="numero">33</span>DEPARTAMENTO</td>
            <td class="valor">{{ $nombreDepartamento }}</td>
        </tr>

        <tr>
            <td class="rotulo">CÓDIGO VÍA</td>
            <td class="valor">{{ $domicilio?->codi_via }}</td>

            <td class="rotulo">TIPO VÍA</td>
            <td class="valor">{{ $domicilio?->tipo_via }}</td>

            <td class="rotulo">NOMBRE VÍA</td>
            <td class="valor" colspan="3">{{ $domicilio?->nomb_via }}</td>
        </tr>

        <tr>
            <td class="rotulo">N° MUNICIPAL</td>
            <td class="valor">{{ $domicilio?->nume_muni }}</td>

            <td class="rotulo">N° INTERIOR</td>
            <td class="valor">{{ $domicilio?->nume_interior }}</td>

            <td class="rotulo">CÓDIGO HU</td>
            <td class="valor">{{ $domicilio?->codi_hab_urba }}</td>

            <td class="rotulo">HABILITACIÓN URBANA</td>
            <td class="valor">{{ $domicilio?->nomb_hab_urba }}</td>
        </tr>

        <tr>
            <td class="rotulo">ZONA / SECTOR</td>
            <td class="valor">{{ $domicilio?->sector }}</td>

            <td class="rotulo">MANZANA</td>
            <td class="valor">{{ $domicilio?->mzna }}</td>

            <td class="rotulo">LOTE</td>
            <td class="valor">{{ $domicilio?->lote }}</td>

            <td class="rotulo">SUB-LOTE</td>
            <td class="valor">{{ $domicilio?->sublote }}</td>
        </tr>

        <tr>
            <td class="rotulo"><span class="numero">34</span>TELÉFONO</td>
            <td class="valor">{{ $titularPrincipal?->telf }}</td>

            <td class="rotulo"><span class="numero">35</span>ANEXO</td>
            <td class="valor">{{ $titularPrincipal?->anexo }}</td>

            <td class="rotulo"><span class="numero">36</span>CORREO ELECTRÓNICO</td>
            <td class="valor" colspan="3">{{ $titularPrincipal?->email }}</td>
        </tr>
    </table>

    <div class="seccion">CARACTERÍSTICAS DE LA TITULARIDAD</div>

    <table class="sin-salto">
        <tr>
            <td class="rotulo">CONDICIÓN DEL TITULAR</td>
            <td class="valor">{{ $titularPrincipal?->cond_titular }}</td>

            <td class="rotulo">FORMA DE ADQUISICIÓN</td>
            <td class="valor">{{ $titularPrincipal?->form_adquisicion }}</td>

            <td class="rotulo">FECHA DE ADQUISICIÓN</td>
            <td class="valor">{{ $titularPrincipal?->fecha_adquisicion }}</td>
        </tr>
    </table>

    <div class="seccion">DESCRIPCIÓN DEL PREDIO</div>

    <table class="sin-salto">
        <tr>
            <td class="rotulo">CÓDIGO DE USO</td>
            <td class="valor">{{ $ficha?->fichaindividual?->uso?->codi_uso }}</td>

            <td class="rotulo">USO DEL PREDIO</td>
            <td class="valor" colspan="3">{{ $ficha?->fichaindividual?->uso?->desc_uso }}</td>
        </tr>

        <tr>
            <td class="rotulo">CLASIFICACIÓN</td>
            <td class="valor">{{ $ficha?->fichaindividual?->clasificacion }}</td>

            <td class="rotulo">CONTENIDO EN</td>
            <td class="valor">{{ $ficha?->fichaindividual?->cont_en }}</td>

            <td class="rotulo">ZONIFICACIÓN</td>
            <td class="valor">{{ $ficha?->unicat?->edificacion?->lote?->zonificacion }}</td>
        </tr>

        <tr>
            <td class="rotulo">ÁREA DECLARADA</td>
            <td class="valor">{{ $ficha?->fichaindividual?->area_declarada }}</td>

            <td class="rotulo">ÁREA VERIFICADA</td>
            <td class="valor">{{ $ficha?->fichaindividual?->area_verificada }}</td>

            <td class="rotulo">N° HABITANTES / FAMILIAS</td>
            <td class="valor">
                {{ $ficha?->fichaindividual?->nume_habitantes }}
                /
                {{ $ficha?->fichaindividual?->nume_familias }}
            </td>
        </tr>
    </table>

    <div class="seccion">LINDEROS Y MEDIDAS PERIMÉTRICAS</div>

    <table class="sin-salto">
        <tr>
            <th class="rotulo">LADO</th>
            <th class="rotulo">MEDIDA DE CAMPO</th>
            <th class="rotulo" colspan="3">COLINDANCIA</th>
        </tr>
        <tr>
            <td class="rotulo">FRENTE</td>
            <td class="valor">{{ $ficha?->lindero?->fren_campo }}</td>
            <td class="valor" colspan="3">{{ $ficha?->lindero?->fren_colinda_campo }}</td>
        </tr>
        <tr>
            <td class="rotulo">DERECHA</td>
            <td class="valor">{{ $ficha?->lindero?->dere_campo }}</td>
            <td class="valor" colspan="3">{{ $ficha?->lindero?->dere_colinda_campo }}</td>
        </tr>
        <tr>
            <td class="rotulo">IZQUIERDA</td>
            <td class="valor">{{ $ficha?->lindero?->izqu_campo }}</td>
            <td class="valor" colspan="3">{{ $ficha?->lindero?->izqu_colinda_campo }}</td>
        </tr>
        <tr>
            <td class="rotulo">FONDO</td>
            <td class="valor">{{ $ficha?->lindero?->fond_campo }}</td>
            <td class="valor" colspan="3">{{ $ficha?->lindero?->fond_colinda_campo }}</td>
        </tr>
    </table>

    <div class="seccion">SERVICIOS QUE CUENTA EL PREDIO</div>

    <table class="sin-salto">
        <tr>
            <td class="rotulo">LUZ</td>
            <td class="valor">{{ $ficha?->serviciobasico?->luz }}</td>

            <td class="rotulo">AGUA</td>
            <td class="valor">{{ $ficha?->serviciobasico?->agua }}</td>

            <td class="rotulo">DESAGÜE</td>
            <td class="valor">{{ $ficha?->serviciobasico?->desague }}</td>

            <td class="rotulo">TELÉFONO</td>
            <td class="valor">{{ $ficha?->serviciobasico?->telefono }}</td>
        </tr>
        <tr>
            <td class="rotulo">GAS</td>
            <td class="valor">{{ $ficha?->serviciobasico?->gas }}</td>

            <td class="rotulo">INTERNET</td>
            <td class="valor">{{ $ficha?->serviciobasico?->internet }}</td>

            <td class="rotulo">TV CABLE</td>
            <td class="valor">{{ $ficha?->serviciobasico?->tvcable }}</td>

            <td class="rotulo">MANTENIMIENTO</td>
            <td class="valor">{{ $ficha?->fichaindividual?->mantenimiento }}</td>
        </tr>
    </table>

    <div class="seccion">CONSTRUCCIONES</div>

    <table class="lista">
        <thead>
        <tr>
            <th class="rotulo">BLOQUE</th>
            <th class="rotulo">PISO</th>
            <th class="rotulo">FECHA</th>
            <th class="rotulo">MEP</th>
            <th class="rotulo">ECS</th>
            <th class="rotulo">ECC</th>
            <th class="rotulo">MURO / COLUMNA</th>
            <th class="rotulo">TECHO</th>
            <th class="rotulo">PISO</th>
            <th class="rotulo">PUERTA / VENT.</th>
            <th class="rotulo">REVEST.</th>
            <th class="rotulo">BAÑO</th>
            <th class="rotulo">INSTAL.</th>
            <th class="rotulo">ÁREA VERIF.</th>
            <th class="rotulo">UCA</th>
        </tr>
        </thead>

        <tbody>
        @forelse ($construcciones as $construccion)
            <tr>
                <td class="valor">{{ $construccion?->bloque }}</td>
                <td class="valor">{{ $construccion?->nume_piso }}</td>
                <td class="valor">{{ $construccion?->fecha }}</td>
                <td class="valor">{{ $construccion?->mep }}</td>
                <td class="valor">{{ $construccion?->ecs }}</td>
                <td class="valor">{{ $construccion?->ecc }}</td>
                <td class="valor">{{ $construccion?->estr_muro_col }}</td>
                <td class="valor">{{ $construccion?->estr_techo }}</td>
                <td class="valor">{{ $construccion?->acab_piso }}</td>
                <td class="valor">{{ $construccion?->acab_puerta_ven }}</td>
                <td class="valor">{{ $construccion?->acab_revest }}</td>
                <td class="valor">{{ $construccion?->acab_bano }}</td>
                <td class="valor">{{ $construccion?->inst_elect_sanita }}</td>
                <td class="valor">{{ $construccion?->area_verificada }}</td>
                <td class="valor">{{ $construccion?->uca }}</td>
            </tr>
        @empty
            <tr><td colspan="15">&nbsp;</td></tr>
        @endforelse
        </tbody>
    </table>

    <div class="seccion">OBRAS COMPLEMENTARIAS / OTRAS INSTALACIONES</div>

    <table class="lista">
        <thead>
        <tr>
            <th class="rotulo">CÓDIGO</th>
            <th class="rotulo" colspan="3">DESCRIPCIÓN</th>
            <th class="rotulo">FECHA</th>
            <th class="rotulo">MEP</th>
            <th class="rotulo">ECS</th>
            <th class="rotulo">ECC</th>
            <th class="rotulo">PRODUCTO TOTAL</th>
            <th class="rotulo">UNIDAD</th>
            <th class="rotulo">UCA</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($instalaciones as $instalacion)
            <tr>
                <td class="valor">{{ $instalacion?->codiinstalacion?->codi_instalacion }}</td>
                <td class="valor" colspan="3">{{ $instalacion?->codiinstalacion?->desc_instalacion }}</td>
                <td class="valor">{{ $instalacion?->fecha }}</td>
                <td class="valor">{{ $instalacion?->mep }}</td>
                <td class="valor">{{ $instalacion?->ecs }}</td>
                <td class="valor">{{ $instalacion?->ecc }}</td>
                <td class="valor">{{ $instalacion?->prod_total }}</td>
                <td class="valor">{{ $instalacion?->uni_med }}</td>
                <td class="valor">{{ $instalacion?->uca }}</td>
            </tr>
        @empty
            <tr><td colspan="11">&nbsp;</td></tr>
        @endforelse
        </tbody>
    </table>

    <div class="seccion">DOCUMENTOS</div>

    <table class="lista">
        <thead>
        <tr>
            <th class="rotulo">TIPO DOCUMENTO</th>
            <th class="rotulo">N° DOCUMENTO</th>
            <th class="rotulo">FECHA</th>
            <th class="rotulo">ÁREA AUTORIZADA</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($documentos as $documento)
            <tr>
                <td class="valor">{{ $documento?->tipo_doc }}</td>
                <td class="valor">{{ $documento?->nume_doc }}</td>
                <td class="valor">{{ $documento?->fecha_doc }}</td>
                <td class="valor">{{ $documento?->area_autorizada }}</td>
            </tr>
        @empty
            <tr><td colspan="4">&nbsp;</td></tr>
        @endforelse
        </tbody>
    </table>

    <div class="seccion">INSCRIPCIÓN DEL PREDIO CATASTRAL EN EL REGISTRO DE PREDIOS</div>

    <table class="sin-salto">
        <tr>
            <td class="rotulo">TIPO PARTIDA</td>
            <td class="valor">{{ $ficha?->sunarp?->tipo_partida }}</td>

            <td class="rotulo">N° PARTIDA</td>
            <td class="valor">{{ $ficha?->sunarp?->nume_partida }}</td>

            <td class="rotulo">FOJAS</td>
            <td class="valor">{{ $ficha?->sunarp?->fojas }}</td>

            <td class="rotulo">ASIENTO</td>
            <td class="valor">{{ $ficha?->sunarp?->asiento }}</td>
        </tr>

        <tr>
            <td class="rotulo">FECHA INSCRIPCIÓN</td>
            <td class="valor">{{ $ficha?->sunarp?->fecha_inscripcion }}</td>

            <td class="rotulo">DECLARATORIA FÁBRICA</td>
            <td class="valor">{{ $ficha?->sunarp?->codi_decla_fabrica }}</td>

            <td class="rotulo">ASIENTO FÁBRICA</td>
            <td class="valor">{{ $ficha?->sunarp?->asie_fabrica }}</td>

            <td class="rotulo">FECHA FÁBRICA</td>
            <td class="valor">{{ $ficha?->sunarp?->fecha_fabrica }}</td>
        </tr>
    </table>

    @if ($litigantes->isNotEmpty())
        <div class="seccion">LITIGANTES</div>

        <table class="lista">
            <thead>
            <tr>
                <th class="rotulo">CÓD. CONTRIBUYENTE</th>
                <th class="rotulo">TIPO DOC.</th>
                <th class="rotulo">N° DOCUMENTO</th>
                <th class="rotulo" colspan="3">NOMBRES / RAZÓN SOCIAL</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($litigantes as $litigante)
                <tr>
                    <td class="valor">{{ $litigante?->codi_contribuye }}</td>
                    <td class="valor">{{ $litigante?->persona?->tipo_doc }}</td>
                    <td class="valor">{{ $litigante?->persona?->nume_doc }}</td>
                    <td class="valor" colspan="3">
                        {{ $litigante?->persona?->razon_social
                            ?: trim(
                                ($litigante?->persona?->nombres ?? '') . ' ' .
                                ($litigante?->persona?->ape_paterno ?? '') . ' ' .
                                ($litigante?->persona?->ape_materno ?? '')
                            ) }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif

    <div class="seccion">EVALUACIÓN E INFORMACIÓN COMPLEMENTARIA</div>

    <table class="sin-salto">
        <tr>
            <td class="rotulo">EVALUACIÓN</td>
            <td class="valor">{{ $ficha?->fichaindividual?->evaluacion }}</td>

            <td class="rotulo">COND. DECLARANTE</td>
            <td class="valor">{{ $ficha?->fichaindividual?->cond_declarante }}</td>

            <td class="rotulo">ESTADO DE LLENADO</td>
            <td class="valor">{{ $ficha?->fichaindividual?->esta_llenado }}</td>
        </tr>

        <tr>
            <td class="rotulo">EN COLINDANTE</td>
            <td class="valor">{{ $ficha?->fichaindividual?->en_colindante }}</td>

            <td class="rotulo">JARDÍN AISLAMIENTO</td>
            <td class="valor">{{ $ficha?->fichaindividual?->en_jardin_aislamiento }}</td>

            <td class="rotulo">ÁREA PÚBLICA / INTANGIBLE</td>
            <td class="valor">
                {{ $ficha?->fichaindividual?->en_area_publica }}
                /
                {{ $ficha?->fichaindividual?->en_area_intangible }}
            </td>
        </tr>
    </table>

    <div class="seccion">OBSERVACIONES</div>

    <table>
        <tr>
            <td class="observacion">
                {{ $ficha?->fichaindividual?->observaciones }}
            </td>
        </tr>
    </table>

    <table class="sin-borde" style="margin-top: 8px;">
        <tr>
            <td class="firma">
                ___________________________________<br>
                DECLARANTE<br>
                {{ trim(
                    ($ficha?->declarante?->nombres ?? '') . ' ' .
                    ($ficha?->declarante?->ape_paterno ?? '') . ' ' .
                    ($ficha?->declarante?->ape_materno ?? '')
                ) }}<br>
                {{ $ficha?->fecha_declarante }}
            </td>

            <td class="firma">
                ___________________________________<br>
                TÉCNICO CATASTRAL<br>
                {{ trim(
                    ($ficha?->tecnico?->nombres ?? '') . ' ' .
                    ($ficha?->tecnico?->ape_paterno ?? '') . ' ' .
                    ($ficha?->tecnico?->ape_materno ?? '')
                ) }}<br>
                {{ $ficha?->fecha_levantamiento }}
            </td>

            <td class="firma">
                ___________________________________<br>
                SUPERVISOR<br>
                {{ trim(
                    ($ficha?->supervisor?->nombres ?? '') . ' ' .
                    ($ficha?->supervisor?->ape_paterno ?? '') . ' ' .
                    ($ficha?->supervisor?->ape_materno ?? '')
                ) }}<br>
                {{ $ficha?->fecha_supervision }}
            </td>

            <td class="firma">
                ___________________________________<br>
                VERIFICADOR<br>
                {{ trim(
                    ($ficha?->verificador?->nombres ?? '') . ' ' .
                    ($ficha?->verificador?->ape_paterno ?? '') . ' ' .
                    ($ficha?->verificador?->ape_materno ?? '')
                ) }}<br>
                {{ $ficha?->fecha_verificacion }}
            </td>
        </tr>
    </table>

    @if (!$loop->last)
        <div class="salto-ficha"></div>
    @endif
@endforeach
</body>
</html>
