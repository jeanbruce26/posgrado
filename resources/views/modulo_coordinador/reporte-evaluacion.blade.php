<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Evaluacion</title>
    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 0;
            border: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        table.customTable {
            width: 100%;
            background-color: #FFFFFF;
            border-collapse: collapse;
            border-width: 1px;
            border-color: #808080;
            border-style: solid;
            color: #000000;
        }

        table.customTable td,
        table.customTable th {
            border-width: 1px;
            border-color: #808080;
            border-style: solid;
            padding: 3px;
        }

        table.customTable thead {
            background-color: #83F87E;
        }
    </style>
</head>

<body>
    <div style="padding: 20px">
        <div style="margin: auto; width: 90%;">
            <div style="margin-top: 1rem;">
                <div>
                    <h4 style="text-align: center; font-weight: 700">{{$facultad}}</h4>
                </div>
                <br>
                <div>
                    <h5 style="text-align: center; font-weight: 700">
                        @if ($programa->mencion == null)
                            {{$programa->descripcion_programa}} EN {{$programa->subprograma}}
                        @else
                            {{$programa->descripcion_programa}} EN {{$programa->subprograma}} <br>
                            CON MENCION EN {{$programa->mencion}}
                        @endif
                    </h5>
                </div>
                <br>
                <div style="text-align: right">
                    <p style="font-size: 0.7rem; font-weight: 700;">FECHA: <span style="font-weight: 400;">{{date('d/m/Y', strtotime($fecha))}}</span></p>
                </div>
                <br>
                <table class="customTable">
                    <thead>
                        <tr style="font-size: 0.65rem; font-weight: 700;">
                            <th>NRO</th>
                            <th>APELLIDOS Y NOMBRES</th>
                            <th>DOCUMENTO</th>
                            <th>ENT. PERSONAL</th>
                            <th>EVA. EXPEDIENTE</th>
                            <th>TOTAL</th>
                            <th>CONDICIÓN</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $num = 1;
                        @endphp
                        @foreach ($evaluaciones as $item)
                            <tr style="font-size: 0.55rem">
                                <td align="center">{{ $num++ }}</td>
                                <td>{{ $item->apell_pater }} {{ $item->apell_mater }},{{ $item->nombres }}</td>
                                <td align="center">{{ $item->num_doc }}</td>
                                <td align="center">{{ number_format($item->nota_entrevista,0) }}</td>
                                <td align="center">{{ number_format($item->nota_expediente,0) }}</td>
                                <td align="center">{{ number_format($item->nota_final,0) }}</td>
                                @if ($item->evaluacion_estado == 3)
                                <td align="center">ADMITIDO</td>
                                @else
                                    @if ($item->evaluacion_estado == 2)
                                    <td align="center">NO ADMITIDO</td>
                                    @else
                                    <td align="center">POR EVALUAR</td>
                                    @endif
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <br>
                <br>
                <br>
                <div style="text-align: center; font-size: 0.7rem;">
                    <span>__________________________________________</span>
                </div>
                <div style="text-align: center; font-size: 0.7rem; margin-top: 00.4rem">
                    <span>{{$coordinador}}</span>
                </div>
                <div style="text-align: center;">
                    <span style="font-size: 0.55rem;">DIRECTOR DE UNIDAD DE POSGRADO</span>
                    <br>
                    <span style="font-size: 0.55rem;">DE LA {{$facultad}}</span>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
