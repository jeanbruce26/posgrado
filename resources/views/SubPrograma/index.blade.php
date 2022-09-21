@extends('admin')

@section('content')
    
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header align-items-center">
                    <div class=" d-flex justify-content-between">
                        <h4 class="card-title mb-0 flex-grow-1 fw-bold">SUB PROGRAMA</h4>
                        <a href="#newModal" type="button" class="btn btn-x1 btn-primary pull-right d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#newModal">Nuevo <i class="ri-add-circle-fill ms-1"></i></a>
                    </div>
                        {{-- Modal Nuevo --}}
                        <div class="modal fade" id="newModal" tabindex="-1" aria-labelledby="newModal" aria-hidden="true">
                            <div class="modal-dialog modal-x1 modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Crear Sub Programa</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('SubPrograma.store') }}" method="POST">
                                            @csrf
                                            <div class="col-sm-12 row g-3">
                                                <div class="mb-3 col-md-12">
                                                    <label class="form-label">Código Sub Programa <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="cod_subprograma" maxlength="10" required>
                                                </div>
                                        
                                                <div class="mb-3 col-md-12">
                                                    <label class="form-label">Sub Programa <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="subprograma" onkeypress="return soloLetras(event)" maxlength="200" pattern="[a-zA-ZÀ-ÿ ]{2,200}" required>
                                                </div>

                                                <div class="mb-3 col-md-12">
                                                    <label class="form-label">Programa <span class="text-danger">*</span></label>
                                                    <select class="form-select" name="id_programa" required>
                                                        <option value="" selected>Seleccione</option>
                                                        @foreach ($pro as $item)
                                                        <option value="{{$item->id_programa}}">{{$item->sede->sede}} - {{$item->descripcion_programa}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer col-12 d-flex justify-content-between">
                                            <a type="button" class="btn btn-secondary d-flex justify-content-center align-items-center btn-x1" data-bs-dismiss="modal"><i class="bx bx-chevron-left me-1 bx-1x"></i>Cancelar</a>
                                            <button type="submit" class="btn btn-primary d-flex justify-content-center align-items-center btn-x1">Guardar <i class="ri-add-circle-fill ms-1"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- Modal Nuevo --}}
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="live-preview">
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="col-1">Código</th>
                                        <th class="col-2">Programa</th>
                                        <th class="col-2">Código</th>
                                        <th>Sub Programa</th>
                                        <th class="col-1">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sub as $item)
                                        <tr>
                                            <td>{{$item->id_subprograma}}</td>
                                            <td>{{$item->programa->descripcion_programa}}</td>
                                            <td>{{$item->cod_subprograma}}</td>
                                            <td>{{$item->subprograma}}</td>
                                            <td class="d-flex justify-content-star">
                                                <a href="#editModal" type="button" class="link-success fs-15" data-bs-toggle="modal" data-bs-target="#editModal{{$item->id_subprograma}}"><i class="bx bx-edit bx-sm bx-burst-hover"></i></a>

                                                {{-- Modal Editar --}}
                                                <div class="modal fade" id="editModal{{$item->id_subprograma}}" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
                                                    <div class="modal-dialog modal-x1 modal-dialog-scrollable">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Editar Programa</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('SubPrograma.update',$item->id_subprograma) }}" method="POST">
                                                                    @csrf @method('PUT')
                                                                    <div class="col-sm-12 row g-3">
                                                                        <div class="mb-3 col-md-12">
                                                                            <label class="form-label">Codigo Mención <span class="text-danger">*</span></label>
                                                                            <input type="text" class="form-control"  name="cod_subprograma" value="{{ $item->cod_subprograma }}" required>
                                                                        </div>
                                                            
                                                                        <div class="mb-3 col-md-12">
                                                                            <label class="form-label">Sub Programa <span class="text-danger">*</span></label>
                                                                            <input type="text" class="form-control" name="subprograma" value="{{ $item->subprograma }}" onkeypress="return soloLetras(event)" maxlength="200" pattern="[a-zA-ZÀ-ÿ ]{2,200}" required>
                                                                        </div>

                                                                        <div class="mb-3 col-md-12">
                                                                            <label class="form-label">Programa <span class="text-danger">*</span></label>
                                                                            <select class="form-select" name="id_programa" required>
                                                                                <option value="" selected>Seleccione</option>
                                                                                @foreach ($pro as $itempro)
                                                                                <option value="{{$itempro->id_programa}}" {{ $itempro->id_programa == $item->id_programa ? 'selected' : '' }}>{{$itempro->descripcion_programa}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
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
        {!! $sub->render() !!}
    </div>
    <!-- end row -->

@endsection