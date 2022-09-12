@extends('admin')

@section('content')
    
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header align-items-center">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mb-0 flex-grow-1 fw-bold">UNIVERSIDAD</h4>
                    </div>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="live-preview">
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="col-1">Código</th>
                                        <th>Universidad</th>
                                        <th>Departamento</th>
                                        <th>Tipo Gestión</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($uni as $item)
                                        <tr>
                                            <td>{{$item->cod_uni}}</td>
                                            <td>{{$item->universidad}}</td>
                                            <td>{{$item->depart}}</td>
                                            <td>{{$item->tipo_gesti}}</td>
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
        {!! $uni->render() !!}
    </div>
    <!-- end row -->

@endsection