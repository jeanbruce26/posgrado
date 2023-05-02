<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Evaluacion Doctorado</title>
    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 0;
            border: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 5rem 1rem 5rem 1rem;
        }

        table.customTable {
            width: 100%;
            background-color: #FFFFFF;
            border-collapse: collapse;
            border-width: 1px;
            border-color: #00000078;
            border-style: solid;
            color: #000000;
        }

        table.customTable td,
        table.customTable th {
            border-width: 1px;
            border-color: #00000078;
            border-style: solid;
            padding: 3px;
        }

        table.customTable thead {
            background-color: #BDD6EE;
        }
    </style>
</head>

<body>
    <table class="table" style="width:100%; padding-right: 1.4rem; padding-left: 1.4rem; padding-bottom: 1.5rem;">
        <thead>
            <tr>
                <th>
                    <div style="display: flex; align-items: center; margin-left: 35px;">
                        <img src="{{ storage_path('app/public/asset-pdf/unu.png') }}" width="80px" height="100px" alt="logo unu">
                    </div>
                </th>
                <th>
                    <div style="text-align: center">
                        <div class="" style="font-weight: 700; font-size: 1.5rem;">
                            UNIVERSIDAD NACIONAL DE UCAYALI
                        </div>
                        <div style="margin: 0.2rem"></div>
                        <div class="" style="font-weight: 700; font-size: 1.6rem;">
                            Escuela de Posgrado
                        </div>
                    </div>
                </th>
                <th>
                    <div style="display: flex; align-items: center; margin-right: 35px;">
                        <img src="{{ storage_path('app/public/asset-pdf/posgrado.png') }}" width="80px" height="100px" alt="logo posgrado">
                    </div>
                </th>
            </tr>
        </thead>
    </table>
    <div>
        <div style="margin: auto; width: 80%;">
            <div style="margin-top: 0.5rem;">
                <div>
                    <h4 style="text-align: center; font-weight: 700; text-decoration-line: underline">ACTA DE EVALUACIÓN DE POSTULANTES A DOCTORADO</h4>
                </div>
            </div>
        </div>
    </div>
    <div style="padding-right: 6rem; padding-left: 6rem; padding-top: 1.5rem; font-size: 0.9rem; text-align: justify; line-height: 1.5;">
        En Pucallpa a los días ..... días del mes de .................. del 202...., se reunieron en los ambientes de la Escuela de Posgrado de la UNU, en concordancia con la Resolución N° 001-2023-CAREPG-UNU que aprueba el Concurso de {{ $admision }} de la Escuela de Posgrado, la Comisión de Evaluación de Postulantes del <strong>Doctorado 
            @if ($mencion == null)
                en {{ $doctorado }}
            @endif
        </strong> integrada por los siguientes docentes:
    </div>
    <div style="padding-right: 9rem; padding-left: 9rem; padding-top: 1rem; font-size: 0.9rem; text-align: justify; line-height: 1.5;">
        <table>
            <tbody>
                <tr>
                    <td><strong>Presidente</strong></td>
                    <td><strong>:</strong></td>
                    <td></td>
                </tr>
                <tr>
                    <td><strong>Secretario</strong></td>
                    <td><strong>:</strong></td>
                    <td></td>
                </tr>
                <tr>
                    <td><strong>Vocal</strong></td>
                    <td><strong>:</strong></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div style="padding-right: 6rem; padding-left: 6rem; padding-top: 1.5rem; font-size: 0.9rem; text-align: justify; line-height: 1.5;">
        Con	la	finalidad	de	evaluar	a	los	postulantes	de Doctorado y después de realizado el Proceso de Evaluación, la relación de postulantes es como sigue:
    </div>
    <div style="padding-right: 7rem; padding-left: 6rem; padding-top: 1.5rem; font-size: 0.9rem; text-align: justify;">
        <table class="customTable">
            <thead>
                <tr style="font-size: 0.7rem; font-weight: 700;">
                    <th rowspan="2">N°</th>
                    <th rowspan="2">APELLIDOS Y NOMBRES</th>
                    <th colspan="3">EVALUACION</th>
                    <th rowspan="2">PUNTAJE <br> TOTAL</th>
                    <th rowspan="2">RESULTADO</th>
                    <th rowspan="2">OBSERVACION</th>
                </tr>
                <tr style="font-size: 0.7rem; font-weight: 700;">
                    <th>EXPEDIENTE <br> C. VITAE <br> (40)</th>
                    <th>PERFIL DEL <br> PROYECTO <br> (40)</th>
                    <th>ENTREVISTA <br> PERSONAL <br> (20)</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $num = 1;
                @endphp
                @foreach ($evaluaciones as $item)
                    <tr style="font-size: 0.55rem">
                        <td align="center">{{ $num++ }}</td>
                        <td>{{ $item->apell_pater }} {{ $item->apell_mater }}, {{ $item->nombres }}</td>
                        <td align="center">{{ number_format($item->p_expediente,0) }}</td>
                        <td align="center">{{ number_format($item->p_investigacion,0) }}</td>
                        <td align="center">{{ number_format($item->p_entrevista,0) }}</td>
                        <td align="center">{{ number_format($item->p_final,0) }}</td>
                        @if ($item->evaluacion_estado == 3)
                        <td align="center">ADMITIDO</td>
                        @else
                            @if ($item->evaluacion_estado == 2)
                            <td align="center">NO ADMITIDO</td>
                            @else
                            <td align="center">POR EVALUAR</td>
                            @endif
                        @endif
                        <td>{{ $item->evaluacion_observacion }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div style="padding-right: 6rem; padding-left: 6rem; padding-top: 1rem; font-size: 0.9rem; text-align: justify; line-height: 1.5;">
        Terminado el acto de evaluación, a los ..... días del mes de .................. del 202...., se hace llegar los resultados a la Dirección de la Escuela de Posgrado de la UNU y se procede a firmar el acta en señal de conformidad.
    </div>
    <div style="padding-right: 6rem; padding-left: 6rem; padding-top: 3.5rem; font-size: 0.9rem; text-align: justify;">
        <table style="width: 100%">
            <tbody>
                <tr>
                    <td align="center"><strong>...........................................</strong></td>
                    <td align="center"><strong>...........................................</strong></td>
                </tr>
                <tr>
                    <td align="center"><strong>PRESIDENTE</strong></td>
                    <td align="center"><strong>SECRETARIO</strong></td>
                </tr>
            </tbody>
        </table>
        <table style="width: 100%; margin-top: 2rem">
            <tbody>
                <tr>
                    <td align="center"><strong>...........................................</strong></td>
                </tr>
                <tr>
                    <td align="center"><strong>VOCAL</strong></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
