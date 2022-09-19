@extends('admin')

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
                            <table class="table align-middle table-nowrap mb-0">
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
        {!! $inscPago->render() !!}
    </div>
    <!-- end row -->

@endsection