@extends('admin')

@section('css')

@endsection

@section('content')
<div class="page-title-box d-sm-flex align-items-center justify-content-between">
    <h4 class="mb-sm-0">Encuestas</h4>
    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Encuestas</a></li>
        </ol>
    </div>
</div>

<div class="card">
    <div class="card-header mt-1">
        <span class="fs-4 fw-bold text-uppercase">
            Total de encuestados: {{ $total_ecuestados }}
        </span>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
        <div class="card-body">
            <figure class="highcharts-figure">
                <div id="reporte_encuesta">
                </div>
            </figure>
        </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
        <div class="card-header">
            <h5 class="card-title mt-1 fw-bold">Encuestas Otros</h5>
        </div>
        <div class="card-body">
            <ul class="mb-0">
            @foreach ($encuesta_otros as $item)
            <li class="list-group-item"><i class="ri-arrow-right-line align-middle me-2"></i> {{ $item->otros }}</li>
            @endforeach
            </ul>
        </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script>
        var cDataPro = '<?php echo $data_encuesta; ?>';
        const datosPro = JSON.parse(cDataPro);
        console.log(datosPro);
        const nombre = datosPro.map(data => data.label);
        const cantidad = datosPro.map(data => data.data);
        Highcharts.chart('reporte_encuesta', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'REPORTE DE ENCUESTA'
            },
            xAxis: {
                categories: nombre,
                crosshair: true
            },
            yAxis: {
                title: {
                    useHTML: true,
                    text: 'Cantidad'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            colors: ['#e5b72e'],
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        format: '{point.y:.0f}'
                    }
                },
                series: {
                    colorByPoint: true
                }
            },
            series: [{
                name: 'Cantidad de Proyectos',
                data: cantidad
            }]
        });
    </script>
@endsection