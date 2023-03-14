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
  <div class="card-body">
      <figure class="highcharts-figure">
          <div id="reporte_encuesta">
          </div>
      </figure>
  </div>
</div>
@endsection

@section('javascript')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $('#tablaDashboard').DataTable({
            autoWidth: true,
            "language": {
                "lengthMenu": "Mostrar _MENU_ registros por páginas",
                "zeroRecords": "Nada encontrado - disculpa",
                "info": "Mostrando la página _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros",
                "infoFiltered": "(filtrado de _MAX_ registros totales)",
                "search": "Buscar:",
                "order": "desc",
                "paginate": {
                    "next": "Siguiente",
                    "previous": "Anterior",
                }
            }
        });
    </script>
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