@extends('admin')

@section('content')
    
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header align-items-center">
                    <div class=" d-flex justify-content-between">
                        <h4 class="card-title mb-0 flex-grow-1 fw-bold">ADMISIÓN</h4>
                        <a href="#newModal" type="button" class="btn btn-x1 btn-primary pull-right d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#newModal">Nuevo <i class="ri-add-circle-fill ms-1"></i></a>
                    </div>
                    {{-- Modal Nuevo --}}
                    <div class="modal fade" id="newModal" tabindex="-1" aria-labelledby="newModal" aria-hidden="true">
                        <div class="modal-dialog modal-x1 modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Crear Admisión</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('Admision.store') }}" method="POST">
                                        @csrf
                                        <div class="col-sm-12 row g-3">
                                            <div class="mb-3 col-md-12">
                                                <label for="inputAdmision" class="form-label">Admisión *</label>
                                                <input type="text" class="form-control" id="inputAdmision" name="admision" maxlength="45" value="{{ old('admision') }}" required>
                                            </div>
                                    
                                            <div class="mb-3 col-md-12">
                                                <label class="form-label">Estado *</label>
                                                <select class="form-select" name="estado" required>
                                                        <option value="" selected>Seleccione</option>
                                                        <option value="1">Activo</option>
                                                        <option value="2">Inactivo</option>
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
                                        <th>Admisión</th>
                                        <th class="col-2">Estado</th>
                                        <th class="col-1">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($admi as $item)
                                        <tr>
                                            <td>{{$item->cod_admi}}</td>
                                            <td>{{$item->admision}}</td>
                                            @if($item->estado == 1)
                                                <td>
                                                    <span class="badge bg-success">Activo</span>
                                                </td>
                                            @else
                                                <td>
                                                    <span class="badge bg-danger">Inactivo</span>
                                                </td>
                                            @endif
                                            <td class="d-flex justify-content-star">
                                                <a href="#editModal" type="button" class="link-success fs-15" data-bs-toggle="modal" data-bs-target="#editModal{{$item->cod_admi}}"><i class="bx bx-edit bx-sm bx-burst-hover"></i></a>

                                                {{-- Modal Editar --}}
                                                <div class="modal fade" id="editModal{{$item->cod_admi}}" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
                                                    <div class="modal-dialog modal-x1 modal-dialog-scrollable">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Editar Admisión</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('Admision.update',$item->cod_admi) }}" method="POST">
                                                                    @csrf @method('PUT')
                                                                    <div class="col-sm-12 row g-3">
                                                                        <div class="mb-3 col-md-12">
                                                                            <label for="inputAdmision" class="form-label">Admisión *</label>
                                                                            <input type="text" class="form-control" id="inputAdmision" name="admision" value="{{ $item->admision }}" required>
                                                                        </div>
                                                            
                                                                        <div class="mb-3 col-md-12">
                                                                            <label class="form-label">Estado *</label>
                                                                            <select class="form-select" name="estado" required>
                                                                                    <option value="" selected>Seleccione</option>
                                                                                    <option value="1" {{ 1 == $item->estado ? 'selected' : '' }}>Activo</option>
                                                                                    <option value="2" {{ 2 == $item->estado ? 'selected' : '' }}>Inactivo</option>
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
        {!! $admi->render() !!}
    </div>
    <!-- end row -->

@endsection