@extends('admin')

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1 fw-bold">ESTUDIANTE</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="live-preview">
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="col-1">ID</th>
                                        <th class="col-1">Documento</th>
                                        <th>Nombre Completo</th>
                                        <th class="col-2">Fecha de Nacimiento</th>
                                        <th class="col-2">Sexo</th>
                                        <th class="col-1">Celular</th>
                                        <th class="col-1">Acciones</th>
                                    </tr>
                                </thead>

                                {{-- <tbody> --}}
                                <tbody>
                                    @foreach ($perso as $item)
                                        <tr>
                                            <td>{{$item->idpersona}}</td>
                                            <td>{{$item->num_doc}}</td>
                                            <td>{{$item->nombres}} {{$item->apell_pater}} {{$item->apell_mater}}</td>
                                            <td>{{date('d-m-Y', strtotime($item->fecha_naci))}}</td>
                                            <td>{{$item->sexo}}</td>
                                            <td>{{$item->celular1}}</td>
                                            <td class="d-flex justify-content-star">
                                                <a href="#detalleModal" type="button" class="link-info fs-15" data-bs-toggle="modal" data-bs-target="#showModal{{$item->idpersona}}"><i class="bx bx-info-circle bx-sm bx-burst-hover ms-4"></i></a>

                                                {{-- Modal Show --}}
                                                <div class="modal fade" id="showModal{{$item->idpersona}}" tabindex="-1" aria-labelledby="showModal" aria-hidden="true">
                                                    <div class="modal-dialog  modal-lg modal-dialog-scrollable">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="showModalLabel">Detalles de Alumno</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <div class="col-sm-12 row g-3">
                                                                        <div class="col-md-4">
                                                                            <label>{{ $item->TipoDocumento->doc  }}</label>
                                                                            <input class="form-control" type="text" value="{{ $item->num_doc }}" disabled>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label>Nombres</label>
                                                                            <input class="form-control" type="text" value="{{ $item->nombres }} {{ $item->apell_pater }} {{ $item->apell_mater }}" disabled>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label>Apellido Paterno</label>
                                                                            <input class="form-control" type="text" value="{{ $item->apell_pater }}" disabled>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label>Apellido Materno</label>
                                                                            <input class="form-control" type="text" value="{{ $item->apell_mater }}" disabled>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label>Fecha de Nacimiento</label>
                                                                            <input class="form-control" type="text" value="{{ date('d-m-Y', strtotime($item->fecha_naci)) }}" disabled>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label>Sexo</label>
                                                                            @if($item->sexo == "M")
                                                                                <input class="form-control" type="text" value="Masculino" disabled>
                                                                            @else
                                                                                <input class="form-control" type="text" value="Femenino" disabled> 
                                                                            @endif 
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label>Estado Civil</label>
                                                                            <input class="form-control" type="text" value="{{ $item->EstadoCivil->est_civil }}" disabled>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label>Dirección</label>
                                                                            <input class="form-control" type="text" value="{{ $item->direccion }}" disabled>
                                                                        </div>
                                                                        @if($item->discapacidad_cod_disc != null)
                                                                            <div class="col-md-4">
                                                                                <label>Discapacidad</label>
                                                                                <input class="form-control" type="text" value="{{$item->Discapacidad->discapacidad}}"disabled> 
                                                                            </div>
                                                                        @endif
                                                                        <div class="col-md-4">
                                                                            <label>Celular</label>
                                                                            <input class="form-control" type="text" value="{{ $item->celular1 }}" disabled>
                                                                        </div>
                                                                        @if($item->celular2 != null)
                                                                            <div class="col-md-4">
                                                                                <label>Celular Opcional</label>
                                                                                <input class="form-control" type="text" value="{{$item->celular2}}"disabled> 
                                                                            </div>
                                                                        @endif 
                                                                        <div class="col-md-4">
                                                                            <label>Email</label>
                                                                            <input class="form-control" type="text" value="{{ $item->email }}" disabled>
                                                                        </div>
                                                                        @if($item->email2 != null)
                                                                            <div class="col-md-4">
                                                                                <label>Email Opcional</label>
                                                                                <input class="form-control" type="text" value="{{$item->email2}}"disabled> 
                                                                            </div>
                                                                        @endif
                                                                        <div class="col-md-4">
                                                                            <label>Centro de Trabajo</label>
                                                                            <input class="form-control" type="text" value="{{ $item->centro_trab }}" disabled>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label>Universidad</label>
                                                                            <input class="form-control" type="text" value="{{ $item->Universidad->universidad }}" disabled>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label>Año de Egreso</label>
                                                                            <input class="form-control" type="text" value="{{ $item->año_egreso }}" disabled>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label>Grado Académico</label>
                                                                            <input class="form-control" type="text" value="{{ $item->GradoAcademico->nom_grado }}" disabled>
                                                                        </div>
                                                                        @if($item->especialidad != null)
                                                                            <div class="col-md-4">
                                                                                <label>Especialidad</label>
                                                                                <input class="form-control" type="text" value="{{$item->especialidad}}"disabled> 
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <a type="button" class="btn btn-secondary d-flex justify-content-center align-items-center btn-x1" data-bs-dismiss="modal"> <i class=" ri-close-line me-1 ri-lg"></i>Cerrar</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- Modal Show --}}
                                            </td>
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
        {!! $perso->render() !!}
    </div>
    <!-- end row -->

@endsection