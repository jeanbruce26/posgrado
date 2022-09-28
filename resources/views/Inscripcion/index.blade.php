@extends('admin')

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="card">

                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1 fw-bold">INSCRIPCIÓN</h4>
                    <div class="col-sm">
                        <div class="d-flex justify-content-sm-end">
                            <div class="search-box ms-2">
                                <input type="text" class="form-control search" placeholder="Buscar...">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>
                    </div>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="live-preview">
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="col-1">ID</th>
                                        <th>Documento</th>
                                        <th>Persona</th>
                                        {{-- <th>Admisión</th> --}}
                                        <th>Programa</th>
                                        <th class="col-1">Estado</th>
                                        <th class="col-1">Expedientes</th>
                                        <th class="col-1">Acciones</th>
                                    </tr>
                                </thead>
                                {{-- <tbody> --}}
                                <tbody>
                                    @foreach ($insc as $item)
                                        @if($item->persona_idpersona!=null)
                                            <tr>
                                                <td>{{$item->id_inscripcion}}</td>
                                                <td>{{$item->persona->num_doc}}</td>
                                                <td>{{$item->persona->apell_pater}} {{$item->persona->apell_mater}}, {{$item->persona->nombres}}</td>
                                                {{-- <td>{{$item->admision->admision}}</td> --}}
                                                <td>
                                                    @if($item->mencion->mencion == null)
                                                        {{$item->mencion->subprograma->subprograma}}
                                                    @else
                                                        {{$item->mencion->subprograma->subprograma}} - {{$item->mencion->mencion}}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ( $item->estado == "Activo")
                                                        <span class="badge bg-success">Activo</span>
                                                    @else
                                                        <span class="badge bg-danger">Inactivo</span>
                                                    @endif
                                                </td>
                                                <td class="d-flex justify-content-star">
                                                    <a href="#detalleModal" type="button" class="link-info fs-15" data-bs-toggle="modal" data-bs-target="#showModal{{$item->id_inscripcion}}"><i class="bx bx-info-circle bx-sm bx-burst-hover ms-4"></i></a>

                                                    {{-- Modal Show --}}
                                                    <div class="modal fade" id="showModal{{$item->id_inscripcion}}" tabindex="-1" aria-labelledby="showModal" aria-hidden="true">
                                                        <div class="modal-dialog  modal-lg modal-dialog-scrollable">
                                                            <div class="modal-content">
                                                                @php
                                                                    $expInsc = App\Models\ExpedienteInscripcion::where('id_inscripcion', $item->id_inscripcion)->get();
                                                                    $value = 0;
                                                                @endphp
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="showModalLabel">Expedientes de Inscripción - {{ $item->persona->nombres }} {{$item->persona->apell_pater}} {{$item->persona->apell_mater}}</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="mb-3">
                                                                        <table class="table align-middle table-nowrap mb-0">
                                                                            <thead class="table-light">
                                                                                <tr class="col-sm-12">
                                                                                    <th class="col-md-4">Documento</th>
                                                                                    <th class="col-md-1">Fecha</th>
                                                                                    <th class="col-md-3">Observación</th>
                                                                                    <th class="col-md-1">Estado</th>
                                                                                    <th class="col-md-1">Archivo</th>
                                                                                </tr>
                                                                            </thead>
                                                                
                                                                            <tbody>
                                                                                @foreach ($expediente as $exp)
                                                                                    @foreach ($expInsc as $expInscripcion)
                                                                                        @if($exp->cod_exp == $expInscripcion->expediente_cod_exp)
                                                                                            <tr>
                                                                                                <td>{{$expInscripcion->nom_exped}}</td>
                                                                                                <td>{{date('d-m-Y', strtotime($expInscripcion->fecha_entre))}}</td>
                                                                                                @if($expInscripcion->observacion == null)
                                                                                                    <td>Sin Observación</td>
                                                                                                @else
                                                                                                    <td>{{$expInscripcion->observacion}}</td>
                                                                                                @endif
                                                                                                <td class="text-success"><i class="ri-checkbox-circle-line fs-17 align-middle"></i> {{$expInscripcion->estado}}</td>
                                                                                                <td>
                                                                                                    <a target="_blank" href="{{asset('Admision 2022 - I/'.$expInscripcion->id_inscripcion.'/'.$expInscripcion->nom_exped)}}" class="ms-2"><i style="color:rgb(78, 78, 78)" class="bx bxs-file-pdf bx-sm bx-burst-hover"></i></a>
                                                                                                </td>
                                                                                            </tr>
                                                                                            @php
                                                                                                $value=1;
                                                                                            @endphp
                                                                                        @endif
                                                                                    @endforeach
                                                                                    @if($value != 1)
                                                                                        <tr>
                                                                                            <td>{{$exp->tipo_doc}}</td>
                                                                                            <td><p class="ms-4">-</p></td>
                                                                                            <td><p class="ms-5">-</p></td>
                                                                                            <td class="text-danger"><i class="ri-close-circle-line fs-17 align-middle"></i> No enviado</td>
                                                                                            <td><p class="ms-3">-</p></td>
                                                                                        </tr>
                                                                                    @endif
                                                                                    @php
                                                                                        $value=0;
                                                                                    @endphp
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
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
                                                <td>
                                                    <a href="#editModal" type="button" class="link-success fs-15" data-bs-toggle="modal" data-bs-target="#editModal{{$item->id_inscripcion}}"><i class="bx bx-edit bx-sm bx-burst-hover ms-3"></i></a>

                                                    {{-- Modal Editar --}}
                                                    <div class="modal fade" id="editModal{{$item->id_inscripcion}}" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Editar Estado de Inscripción</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{ route('Inscripcion.update',$item->id_inscripcion) }}" method="POST">
                                                                        @csrf @method('PUT')
                                                                        <div class="mb-3">
                                                                            <label for="recipient-name" class="col-form-label">Estado <span class="text-danger">*</span></label>
                                                                            <select id="inputEstado" class="form-select" name="estado" required>
                                                                                <option value="" selected>Seleccione</option>
                                                                                <option value="Activo" {{ $item->estado == "Activo" ? 'selected' : '' }}> Activo</option>
                                                                                <option value="Inactivo" {{ $item->estado == "Inactivo" ? 'selected' : '' }}> Inactivo</option>
                                                                            </select>
                                                                            <label for="" id="lblEstado"></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer col-12 d-flex justify-content-between">
                                                                        <a type="button" class="btn btn-secondary d-flex justify-content-center align-items-center btn-x1" data-bs-dismiss="modal"><i class="bx bx-chevron-left me-1 bx-1x"></i>Cancelar</a>
                                                                        <button type="submit" class="btn btn-primary d-flex justify-content-center align-items-center btn-x1">Guardar <i class="bx bx-edit ms-1 ri-1x"></i></button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- Modal Editar --}}

                                                </td>
                                            </tr>
                                        @endif
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
        {!! $insc->render() !!}
    </div>
    <!-- end row -->

@endsection