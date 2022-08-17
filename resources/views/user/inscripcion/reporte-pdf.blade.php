<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte</title>
    <style>
        * {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto,
                Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
        }
        html,
        body,
        div,
        span,
        applet,
        object,
        iframe,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        blockquote,
        pre,
        a,
        abbr,
        acronym,
        address,
        big,
        cite,
        code,
        del,
        dfn,
        em,
        img,
        ins,
        kbd,
        q,
        s,
        samp,
        small,
        strike,
        strong,
        sub,
        sup,
        tt,
        var,
        b,
        u,
        i,
        center,
        dl,
        dt,
        dd,
        ol,
        ul,
        li,
        fieldset,
        form,
        label,
        legend,
        table,
        caption,
        tbody,
        tfoot,
        thead,
        tr,
        th,
        td,
        article,
        aside,
        canvas,
        details,
        embed,
        figure,
        figcaption,
        footer,
        header,
        hgroup,
        menu,
        nav,
        output,
        ruby,
        section,
        summary,
        time,
        mark,
        audio,
        video {
        margin: 0;
        padding: 0;
        border: 0;
        font-size: 100%;
        font: inherit;
        vertical-align: baseline;
        }
        body {
        line-height: 1;
        font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto,
            Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
        }
        .titulo {
        font-weight: 700;
        font-size: large;
        text-align: initial;
        }
        .titulo2 {
        font-weight: 700;
        font-size: medium;
        text-align: initial;
        }
        .titulo3 {
        font-weight: 700;
        font-size: small;
        text-align: initial;
        }
        .titulo4{
        font-weight: 700;
        font-size: small;
        }
        .titulo5 {
            font-size: small;
            text-align: initial;
        }
        .linea {
        border-top: 1px solid black;
        height: 5px;
        max-width: 100%;
        padding: 0;
        }
        .linea2 {
        border-top: 1px solid black;
        height: 5px;
        max-width: 45%;
        padding: 0;
        }
        .parent {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
        grid-template-rows: repeat(3, 1fr);
        grid-column-gap: 0px;
        grid-row-gap: 0px;
        }
        hr {
        height: 100vh;
        width: 0.5vw;
        border-width: 0;
        color: #000;
        background-color: #000;
        }
        .tabla4 {
        padding: 5px;
        border:1px solid black;
        }
        .tablita{
        border-collapse: collapse;
        }

        .d-flex {
        display: -webkit-box !important;
        display: -ms-flexbox !important;
        display: flex !important;
        }

        .justify-content-start {
        -webkit-box-pack: start !important;
        -ms-flex-pack: start !important;
        justify-content: flex-start !important;
        }
        .justify-content-end {
        -webkit-box-pack: end !important;
        -ms-flex-pack: end !important;
        justify-content: flex-end !important;
        }
        .justify-content-center {
        -webkit-box-pack: center !important;
        -ms-flex-pack: center !important;
        justify-content: center !important;
        }
        .justify-content-between {
        -webkit-box-pack: justify !important;
        -ms-flex-pack: justify !important;
        justify-content: space-between !important;
        }
        .justify-content-around {
        -ms-flex-pack: distribute !important;
        justify-content: space-around !important;
        }
        .justify-content-evenly {
        -webkit-box-pack: space-evenly !important;
        -ms-flex-pack: space-evenly !important;
        justify-content: space-evenly !important;
        }
        .align-items-start {
        -webkit-box-align: start !important;
        -ms-flex-align: start !important;
        align-items: flex-start !important;
        }
        .align-items-end {
        -webkit-box-align: end !important;
        -ms-flex-align: end !important;
        align-items: flex-end !important;
        }
        .align-items-center {
        -webkit-box-align: center !important;
        -ms-flex-align: center !important;
        align-items: center !important;
        }
        .align-items-baseline {
        -webkit-box-align: baseline !important;
        -ms-flex-align: baseline !important;
        align-items: baseline !important;
        }
        .align-items-stretch {
        -webkit-box-align: stretch !important;
        -ms-flex-align: stretch !important;
        align-items: stretch !important;
        }
        .align-content-start {
        -ms-flex-line-pack: start !important;
        align-content: flex-start !important;
        }
        .align-content-end {
        -ms-flex-line-pack: end !important;
        align-content: flex-end !important;
        }
        .align-content-center {
        -ms-flex-line-pack: center !important;
        align-content: center !important;
        }
        .align-content-between {
        -ms-flex-line-pack: justify !important;
        align-content: space-between !important;
        }
        .align-content-around {
        -ms-flex-line-pack: distribute !important;
        align-content: space-around !important;
        }
        .align-content-stretch {
        -ms-flex-line-pack: stretch !important;
        align-content: stretch !important;
        }
        .align-self-auto {
        -ms-flex-item-align: auto !important;
        align-self: auto !important;
        }
        .align-self-start {
        -ms-flex-item-align: start !important;
        align-self: flex-start !important;
        }
        .align-self-end {
        -ms-flex-item-align: end !important;
        align-self: flex-end !important;
        }
        .align-self-center {
        -ms-flex-item-align: center !important;
        align-self: center !important;
        }
        .align-self-baseline {
        -ms-flex-item-align: baseline !important;
        align-self: baseline !important;
        }
        .align-self-stretch {
        -ms-flex-item-align: stretch !important;
        align-self: stretch !important;
        }
        .m-0 {
        margin: 0 !important;
        }
        .m-1 {
        margin: 0.25rem !important;
        }
        .m-2 {
        margin: 0.5rem !important;
        }
        .m-3 {
        margin: 1rem !important;
        }
        .m-4 {
        margin: 1.5rem !important;
        }
        .m-5 {
        margin: 3rem !important;
        }
        .m-auto {
        margin: auto !important;
        }
        .mx-0 {
        margin-right: 0 !important;
        margin-left: 0 !important;
        }
        .mx-1 {
        margin-right: 0.25rem !important;
        margin-left: 0.25rem !important;
        }
        .mx-2 {
        margin-right: 0.5rem !important;
        margin-left: 0.5rem !important;
        }
        .mx-3 {
        margin-right: 1rem !important;
        margin-left: 1rem !important;
        }
        .mx-4 {
        margin-right: 1.5rem !important;
        margin-left: 1.5rem !important;
        }
        .mx-5 {
        margin-right: 3rem !important;
        margin-left: 3rem !important;
        }
        .mx-auto {
        margin-right: auto !important;
        margin-left: auto !important;
        }
        .my-0 {
        margin-top: 0 !important;
        margin-bottom: 0 !important;
        }
        .my-1 {
        margin-top: 0.25rem !important;
        margin-bottom: 0.25rem !important;
        }
        .my-2 {
        margin-top: 0.5rem !important;
        margin-bottom: 0.5rem !important;
        }
        .my-3 {
        margin-top: 1rem !important;
        margin-bottom: 1rem !important;
        }
        .my-4 {
        margin-top: 1.5rem !important;
        margin-bottom: 1.5rem !important;
        }
        .my-5 {
        margin-top: 3rem !important;
        margin-bottom: 3rem !important;
        }
        .my-auto {
        margin-top: auto !important;
        margin-bottom: auto !important;
        }
        .mt-0 {
        margin-top: 0 !important;
        }
        .mt-1 {
        margin-top: 0.25rem !important;
        }
        .mt-2 {
        margin-top: 0.5rem !important;
        }
        .mt-3 {
        margin-top: 1rem !important;
        }
        .mt-4 {
        margin-top: 1.5rem !important;
        }
        .mt-5 {
        margin-top: 3rem !important;
        }
        .mt-auto {
        margin-top: auto !important;
        }
        .me-0 {
        margin-right: 0 !important;
        }
        .me-1 {
        margin-right: 0.25rem !important;
        }
        .me-2 {
        margin-right: 0.5rem !important;
        }
        .me-3 {
        margin-right: 1rem !important;
        }
        .me-4 {
        margin-right: 1.5rem !important;
        }
        .me-5 {
        margin-right: 3rem !important;
        }
        .me-auto {
        margin-right: auto !important;
        }
        .mb-0 {
        margin-bottom: 0 !important;
        }
        .mb-1 {
        margin-bottom: 0.25rem !important;
        }
        .mb-2 {
        margin-bottom: 0.5rem !important;
        }
        .mb-3 {
        margin-bottom: 1rem !important;
        }
        .mb-4 {
        margin-bottom: 1.5rem !important;
        }
        .mb-5 {
        margin-bottom: 3rem !important;
        }
        .mb-auto {
        margin-bottom: auto !important;
        }
        .ms-0 {
        margin-left: 0 !important;
        }
        .ms-1 {
        margin-left: 0.25rem !important;
        }
        .ms-2 {
        margin-left: 0.5rem !important;
        }
        .ms-3 {
        margin-left: 1rem !important;
        }
        .ms-4 {
        margin-left: 1.5rem !important;
        }
        .ms-5 {
        margin-left: 3rem !important;
        }
        .ms-auto {
        margin-left: auto !important;
        }
        .p-0 {
        padding: 0 !important;
        }
        .p-1 {
        padding: 0.25rem !important;
        }
        .p-2 {
        padding: 0.5rem !important;
        }
        .p-3 {
        padding: 1rem !important;
        }
        .p-4 {
        padding: 1.5rem !important;
        }
        .p-5 {
        padding: 3rem !important;
        }
        .px-0 {
        padding-right: 0 !important;
        padding-left: 0 !important;
        }
        .px-1 {
        padding-right: 0.25rem !important;
        padding-left: 0.25rem !important;
        }
        .px-2 {
        padding-right: 0.5rem !important;
        padding-left: 0.5rem !important;
        }
        .px-3 {
        padding-right: 1rem !important;
        padding-left: 1rem !important;
        }
        .px-4 {
        padding-right: 1.5rem !important;
        padding-left: 1.5rem !important;
        }
        .px-5 {
        padding-right: 3rem !important;
        padding-left: 3rem !important;
        }
        .py-0 {
        padding-top: 0 !important;
        padding-bottom: 0 !important;
        }
        .py-1 {
        padding-top: 0.25rem !important;
        padding-bottom: 0.25rem !important;
        }
        .py-2 {
        padding-top: 0.5rem !important;
        padding-bottom: 0.5rem !important;
        }
        .py-3 {
        padding-top: 1rem !important;
        padding-bottom: 1rem !important;
        }
        .py-4 {
        padding-top: 1.5rem !important;
        padding-bottom: 1.5rem !important;
        }
        .py-5 {
        padding-top: 3rem !important;
        padding-bottom: 3rem !important;
        }
        .pt-0 {
        padding-top: 0 !important;
        }
        .pt-1 {
        padding-top: 0.25rem !important;
        }
        .pt-2 {
        padding-top: 0.5rem !important;
        }
        .pt-3 {
        padding-top: 1rem !important;
        }
        .pt-4 {
        padding-top: 1.5rem !important;
        }
        .pt-5 {
        padding-top: 3rem !important;
        }
        .pe-0 {
        padding-right: 0 !important;
        }
        .pe-1 {
        padding-right: 0.25rem !important;
        }
        .pe-2 {
        padding-right: 0.5rem !important;
        }
        .pe-3 {
        padding-right: 1rem !important;
        }
        .pe-4 {
        padding-right: 1.5rem !important;
        }
        .pe-5 {
        padding-right: 3rem !important;
        }
        .pb-0 {
        padding-bottom: 0 !important;
        }
        .pb-1 {
        padding-bottom: 0.25rem !important;
        }
        .pb-2 {
        padding-bottom: 0.5rem !important;
        }
        .pb-3 {
        padding-bottom: 1rem !important;
        }
        .pb-4 {
        padding-bottom: 1.5rem !important;
        }
        .pb-5 {
        padding-bottom: 3rem !important;
        }
        .ps-0 {
        padding-left: 0 !important;
        }
        .ps-1 {
        padding-left: 0.25rem !important;
        }
        .ps-2 {
        padding-left: 0.5rem !important;
        }
        .ps-3 {
            padding-left: 1rem !important;
        }
        .ps-4 {
            padding-left: 1.5rem !important;
        }
        .ps-5 {
            padding-left: 3rem !important;
        }
    </style>
</head>
<body style="padding: 1rem;">
    <div style="display: flex; justify-content: space-around;">
        <div style="display: flex; align-items: center;">
            <img src="{{ storage_path('app/public/asset-pdf/unu.png') }}" width="60px" height="70px" alt="logo unu">
        </div>
        <div style="text-align: center">
            <div class="mb-3" style="font-weight: 700; font-size:large;">
                UNIVERSIDAD NACIONAL DE UCAYALI
            </div>
            <div class="mb-3" style="font-weight: 700; font-size:medium;">
                ESCUELA DE POSGRADO
            </div>
            @foreach ($admisionn as $item)
            <div style="font-weight: 700; font-size:medium;">
                FICHA DE INSCRIPCION: {{$item->admision}}
            </div>
            @endforeach
        </div>
        <div style="display: flex; align-items: center;">
            <img src="{{ storage_path('app/public/asset-pdf/posgrado.png') }}" width="60px" height="70px" alt="logo posgrado">
        </div>
    </div>
    <div class="d-flex justify-content-between mt-2">
        @foreach ($mencion as $item)
        <div class="titulo2">
            Sede: {{ $item->subprograma->programa->sede->sede }}
        </div>
        @endforeach
        @foreach ($inscrip as $item)
        <div class="titulo2">
            Nro Ficha: 00000{{$item->id_inscripcion}}
        </div>
        @endforeach
    </div>
    <div class="linea mt-1">
    </div>
    <div class="">
        <div class="mt-2">
            <div class="titulo2">
                INFORMACIÓN DE INSCRIPCIÓN
            </div>
            <div class="linea mt-2 mb-2"></div>
            <div>
                <table>
                    <tr>
                        <th><div class="titulo3 my-1">Fecha de inscripción</div></th>
                        <th><div class="mx-2">:</div></th>
                        <th style="text-align: initial;">{{$fecha_actual}}</th>
                    </tr>
                    <tr>
                        <th><div class="titulo3 my-1">Programa</div></th>
                        <th><div class="mx-2">:</div></th>
                        @foreach ($mencion as $item)
                        <th style="text-align: initial;">{{ $item->subprograma->programa->descripcion_programa }}</th>
                        @endforeach
                    </tr>
                    <tr>
                        @foreach ($mencion as $item)
                        <th><div class="titulo3 my-1">{{ $item->subprograma->programa->descripcion_programa }}</div></th>
                        @endforeach
                        <th><div class="mx-2">:</div></th>
                        @foreach ($mencion as $item)
                        <th style="text-align: initial;">{{ $item->subprograma->subprograma }}</th>
                        @endforeach
                    </tr>
                    <tr>
                        @foreach ($mencion as $item)
                        @if ($item->mencion == null)
                        @else
                        <th><div class="titulo3 my-1">Mención</div></th>
                        <th><div class="mx-2">:</div></th>
                        <th style="text-align: initial;">{{ $item->mencion }}</th>
                        @endif
                        @endforeach
                    </tr>
                </table>
            </div>
        </div>
        <div class="mt-2">
            <div class="titulo2">
                INFORMACIÓN PERSONAL
            </div>
            <div class="linea mt-2 mb-2"></div>
            <div>
                <table>
                    <tr>
                        <th><div class="titulo3 my-1">Documento de identidad</div></th>
                        <th><div class="mx-2">:</div></th>
                        <th style="text-align: initial;">{{ $persona->num_doc }}</th>
                    </tr>
                    <tr>
                        <th><div class="titulo3 my-1">Apellidos</div></th>
                        <th><div class="mx-2">:</div></th>
                        <th style="text-align: initial;">{{ $persona->apell_pater }} {{ $persona->apell_mater }}</th>
                    </tr>
                    <tr>
                        <th><div class="titulo3 my-1">Nombres</div></th>
                        <th><div class="mx-2">:</div></th>
                        <th style="text-align: initial;">{{ $persona->nombres }}</th>
                    </tr>
                    <tr>
                        <th><div class="titulo3 my-1">Fecha de nacimiento</div></th>
                        <th><div class="mx-2">:</div></th>
                        <th style="text-align: initial;">{{ $persona->fecha_naci }}</th>
                    </tr>
                    <tr>
                        <th><div class="titulo3 my-1">Sexo</div></th>
                        <th><div class="mx-2">:</div></th>
                        <th style="text-align: initial;">{{ $persona->sexo }}</th>
                    </tr>
                    <tr>
                        <th><div class="titulo3 my-1">Estado Civil</div></th>
                        <th><div class="mx-2">:</div></th>
                        <th style="text-align: initial;">{{ $persona->est_civil_cod_est }}</th>
                    </tr>
                </table>
            </div>
        </div>
        <div class="mt-2">
            <div class="titulo2">
                INFORMACIÓN DE CONTACTO
            </div>
            <div class="linea mt-2 mb-2"></div>
            <div>
                <table>
                    <tr>
                        <th><div class="titulo3 my-1">Domicilio</div></th>
                        <th><div class="mx-2">:</div></th>
                        <th style="text-align: initial;">{{ $persona->direccion }}</th>
                    </tr>
                    <tr>
                        <th><div class="titulo3 my-1">Correo electronico</div></th>
                        <th><div class="mx-2">:</div></th>
                        <th style="text-align: initial;">{{ $persona->email }}</th>
                    </tr>
                    <tr>
                        <th><div class="titulo3 my-1">Celular</div></th>
                        <th><div class="mx-2">:</div></th>
                        <th style="text-align: initial;">{{ $persona->celular1 }}</th>
                    </tr>
                    <tr>
                        <th><div class="titulo3 my-1">Celular opcional</div></th>
                        <th><div class="mx-2">:</div></th>
                        <th style="text-align: initial;">{{ $persona->celular2 }}</th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="mt-2">
        <div class="titulo2">
            INFORMACIÓN DE PAGO
        </div>
        <div class="linea mt-2 mb-2"></div>
        <div>
            <table>
                @foreach ($inscripcion_pago as $item)
                <tr>
                    <th><div class="titulo3 my-1">Concepto de pago</div></th>
                    <th><div class="mx-2">:</div></th>
                    <th style="text-align: initial;">{{ $item->ConceptoPago->concepto }}</th>
                </tr>
                <tr>
                    <th><div class="titulo3 my-1">Monto</div></th>
                    <th><div class="mx-2">:</div></th>
                    <th style="text-align: initial;">S/. {{ $item->ConceptoPago->monto }}</th>
                </tr>
                @php
                    break;
                @endphp
                @endforeach
            </table>
        </div>
        <table class="mt-2 tablita" width="100%">
            <tr>
                <th class="tabla4"><div class="titulo3">Nro</div></th>
                <th class="tabla4" width="35%"><div class="titulo3">Fecha</div></th>
                <th class="tabla4" width="35%"><div class="titulo3 ">Nro. Operación</div></th>
                <th class="tabla4"><div class="titulo3 tabla">Importe</div></th>
            </tr>
            @foreach ($inscripcion_pago as $item)
            <tr>
                <th class="tabla4"><div class="titulo5">{{ $item->pago->pago_id }}</div></th>
                <th class="tabla4"><div class="titulo5">{{ $item->pago->fecha_pago }}</div></th>
                <th class="tabla4"><div class="titulo5">{{ $item->pago->nro_operacion }}</div></th>
                <th class="tabla4"><div class="titulo5">{{ $item->pago->monto }}</div></th>
            </tr>
            @endforeach
            <tr>
                <th><div class="titulo3"></div></th>
                <th><div class="titulo3"></div></th>
                <th class="tabla4"><div class="titulo3">Total</div></th>
                <th class="tabla4"><div class="titulo3">S/.{{$montoTotal}}</div></th>
            </tr>
        </table>
    </div>
    <br>
    <div class="mt-2">
        @foreach ($admisionn as $item)
        <div class="" style="text-align: justify;">
            Hasta el ({{$final}}); caso contrario perderé mi ingreso y, el monto abonado por derecho de inscripcion, carpeta y prospecto de postulante, de
acuerdo a los articulos 29 e), 81 y la tercera disposicion complementaria del Reglamento General de {{ $item->admision }}. En fe de lo cual firmo y estampo mi huella digital en el presente compromiso.
        </div>
        @endforeach
    </div>
    <br>
    <div class="d-flex justify-content-end mt-1">
        <div class="titulo4">
            ESTADO: INSCRITO
        </div>
    </div>
</body>
</html>