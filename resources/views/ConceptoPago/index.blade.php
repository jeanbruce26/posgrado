@extends('admin')

@section('content')
    @if ($errors->any())
    <div class="alert alert-danger alert-border-left alert-dismissible fade shadow show" role="alert">
        <i class="ri-error-warning-line me-3 align-middle fs-16"></i> <strong>Errror al registrar o actualizar Concepto de Pago</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header align-items-center">
                    <div class=" d-flex justify-content-between">
                        <h4 class="card-title mb-0 flex-grow-1 fw-bold">CONCEPTO DE PAGO</h4>
                        <a href="#newModal" type="button" class="btn btn-x1 btn-primary pull-right d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#newModal">Nuevo <i class="ri-add-circle-fill ms-1"></i></a>
                    </div>
                        {{-- Modal Nuevo --}}
                        <div class="modal fade" id="newModal" tabindex="-1" aria-labelledby="newModal" aria-hidden="true">
                            <div class="modal-dialog modal-x1 modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Crear Concepto de Pago</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('ConceptoPago.store') }}" method="POST">
                                    @csrf
                                        <div class="modal-body row g-3">
                                            <div class="mb-3 col-md-12">
                                                <label for="inputConcepto" class="form-label">Concepto *</label>
                                                <input type="text" class="form-control" id="inputConcepto" name="concepto" maxlength="45" onkeypress="return soloLetras(event)" pattern="[a-zA-ZÀ-ÿ ]{2,254}" required>
                                            </div>
                                    
                                            <div class="mb-3 col-md-12">
                                                <label for="inputMonto" class="form-label">Monto *</label>
                                                <input type="text" class="form-control" id="inputMonto" name="monto" maxlength="13" onkeypress="return soloNumeros(event)" pattern="[1-9]{1-13}" required>
                                            </div>
                                    
                                            <div class="mb-3 col-md-12">
                                                <label for="inputEstado" class="form-label">Estado *</label>
                                                <select id="inputEstado" class="form-select" name="estado" required>
                                                    <option value="" selected>Seleccione</option>
                                                    <option value="1"> Activo</option>
                                                    <option value="2"> Inactivo</option>
                                                </select>
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
                                        <th>Concepto</th>
                                        <th >Monto</thc>
                                        <th class="col-2">Estado</th>
                                        <th class="col-1">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($conPago as $item)
                                        <tr>
                                            <td>{{$item->concepto_id}}</td>
                                            <td>{{$item->concepto}}</td>
                                            <td>{{$item->monto}}</td>
                                            <td>
                                                @if ( $item->estado == 1)
                                                    <span class="badge bg-success">Activo</span>
                                                @else
                                                    <span class="badge bg-danger">Inactivo</span>
                                                @endif
                                            </td>
                                            <td class="d-flex justify-content-star">
                                                <a href="#editModal" type="button" class="link-success fs-15" data-bs-toggle="modal" data-bs-target="#editModal{{$item->concepto_id}}"><i class="bx bx-edit bx-sm bx-burst-hover"></i></a>

                                                {{-- Modal Editar --}}
                                                <div class="modal fade" id="editModal{{$item->concepto_id}}" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
                                                    <div class="modal-dialog modal-x1 modal-dialog-scrollable">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Editar Conbcepto de Pago</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="{{ route('ConceptoPago.update',$item->concepto_id) }}" method="POST">
                                                            @csrf @method('PUT')
                                                                <div class="modal-body row g-3">
                                                                    <div class="mb-3 col-md-12">
                                                                        <label for="inputConcepto" class="form-label">Concepto *</label>
                                                                        <input type="text" class="form-control" id="inputConcepto" name="concepto" maxlength="45" value="{{ $item->concepto }}" onkeypress="return soloLetras(event)" pattern="[a-zA-ZÀ-ÿ ]{2,254}" required>
                                                                    </div>
                                                        
                                                                    <div class="mb-3 col-md-12">
                                                                        <label for="inputMonto" class="form-label">Monto *</label>
                                                                        <input type="text" class="form-control" id="inputMonto" name="monto" maxlength="13" value="{{ $item->monto }}" onkeypress="return soloNumeros(event)" pattern="[1-9]{1-13}" required>
                                                                    </div>
                                                        
                                                                    <div class="mb-3 col-md-12">
                                                                        <label for="inputEstado" class="form-label">Estado *</label>
                                                                        <select id="inputEstado" class="form-select" name="estado" required>
                                                                            <option value="" selected>Seleccione</option>
                                                                            <option value="1" {{ $item->estado == 1 ? 'selected' : '' }}> Activo</option>
                                                                            <option value="2" {{ $item->estado == 2 ? 'selected' : '' }}> Inactivo</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="modal-footer col-12 d-flex justify-content-between">
                                                                        <a type="button" class="btn btn-secondary d-flex justify-content-center align-items-center btn-x1" data-bs-dismiss="modal"><i class="bx bx-chevron-left me-1 bx-1x"></i>Cancelar</a>
                                                                        <button type="submit" class="btn btn-primary d-flex justify-content-center align-items-center btn-x1">Guardar <i class="bx bx-edit ms-1 ri-1x"></i></button>
                                                                    </div>
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
        {!! $conPago->render() !!}
    </div>
    <!-- end row -->

@endsection