@extends('admin')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1 fw-bold">INSCRIPCIÓN DE PAGO</h4>
                </div>
                <!-- end card header -->

                <div class="card-body">
                    <div class="live-preview">
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap table-bordered dt-responsive text-dark" id="tablaInscPago">
                                <thead class="table-light">
                                    <tr>
                                        <th class="col-1">Código</th>
                                        <th>Inscripción</th>
                                        <th>Pago</th>
                                        <th>Concepto Pago</th>
                                    </tr>
                                </thead>
                                
                                {{-- <tbody> --}}
                                <tbody>
                                    @foreach ($inscPago as $item)
                                        <tr>
                                            <td>{{$item->inscripcion_pago_id}}</td>
                                            @if($item->Inscripcion->persona_idpersona==null)
                                                <td>{{$item->inscripcion_id}} - Alumno No Inscrito</td>
                                            @else
                                                <td>{{$item->inscripcion_id}} - {{ $item->inscripcion->persona->apell_pater }} {{ $item->inscripcion->persona->apell_mater }}, {{ $item->inscripcion->persona->nombres }}</td>
                                            @endif
                                            <td>{{$item->pago->monto}}</td>
                                            <td>{{$item->ConceptoPago->concepto}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="d-none code-view">
                        <pre class="language-markup" style="height: 275px;"><code>&lt;table class=&quot;table table-nowrap&quot;&gt;
                    </div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
    </div>
    <!-- end row -->

@endsection

@section('javascript')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script>
    $('#tablaInscPago').DataTable({
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
@endsection