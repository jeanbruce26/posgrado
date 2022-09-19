@extends('admin')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger alert-border-left alert-dismissible fade shadow show" role="alert">
            <i class="ri-error-warning-line me-3 align-middle fs-16"></i> <strong>Errror al registrar Pago</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header align-items-center">
                    <div class=" d-flex justify-content-between">
                        <h4 class="card-title mb-0 flex-grow-1 fw-bold">PAGO</h4>
                        <a href="#newModal" type="button" class="btn btn-x1 btn-primary pull-right d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#newModal">Nuevo <i class="ri-add-circle-fill ms-1"></i></a>
                    </div>
                        {{-- Modal Nuevo --}}
                        <div class="modal fade" id="newModal" tabindex="-1" aria-labelledby="newModal" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Crear Pago</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('Pago.store') }}" method="POST" id="formu">
                                            @csrf
                                            <div class="col-sm-12 row g-3">
                                                <div class="mb-3 col-md-4">
                                                    <label for="inputDNI" class="form-label">Documento *</label>
                                                    <input type="text" class="form-control" id="inputDNI" name="dni" minlength="8" maxlength="9" onkeypress="return soloNumeros(event)" pattern="[1-9]+" required>
                                                    
                                                </div>
                                                <div class="mb-3 col-md-4">
                                                    <label for="inputNumOpe" class="form-label">Número de Operación *</label>
                                                    <input type="text" class="form-control" id="inputNumOpe" name="nro_operacion" onkeypress="return soloNumeros(event)" pattern="[1-9]+" required>
                                                </div>
                                                <div class="mb-3 col-md-4">
                                                    <label for="inputMonto" class="form-label">Monto *</label>
                                                    <input type="text" class="form-control" id="inputMonto" name="monto" onkeypress="return soloNumeros(event)" pattern="[1-9]{1-13}" required>
                                                </div>
                                                <div class="mb-3 col-md-4">
                                                    <label for="inputFechaPago" class="form-label">Fecha de Pago *</label>
                                                    <input type="date" class="form-control" id="inputFechaPago" name="fecha_pago" required> 
                                                </div>
                                                <div class="mb-3 col-md-4">
                                                    <label for="inputCanalPago" class="form-label">Canal de Pago *</label>
                                                    <select class="form-select" name="canal_pago_id" required>
                                                        <option value="" selected>Seleccione</option>
                                                        @foreach ($canalPago as $item)
                                                            <option value="{{$item->canal_pago_id}}">{{$item->descripcion}}</option>
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
                                        <th class="col-1">ID</th>
                                        <th>Documento</th>
                                        <th>Número de Operación</th>
                                        <th>Monto</th>
                                        <th>Fecha de Pago</th>
                                        <th>Canal Pago</th>
                                        <th class="col-1">Estado</th>
                                        <th> </th>
                                        <th class="col-1">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pago as $item)
                                        <tr>
                                            <td>{{$item->pago_id}}</td>
                                            <td>{{$item->dni}}</td>
                                            <td>{{$item->nro_operacion}}</td>
                                            <td>S/. {{$item->monto}}</td>
                                            <td>{{date('d-m-Y', strtotime($item->fecha_pago))}}</td>
                                            <td>{{$item->CanalPago->descripcion}}</td>
                                            <td>
                                                @if($item->estado == 1)
                                                    <div class="progress progress-sm">
                                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                @else
                                                    @if ($item->estado == 2)
                                                        <div class="progress progress-sm">
                                                            <div class="progress-bar bg-secondary" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    @else
                                                        <div class="progress progress-sm">
                                                            <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    @endif
                                                    
                                                @endif
                                            </td>
                                            <td>
                                                @if($item->estado == 1)
                                                    <span class="badge bg-warning">Pagado</span>
                                                @else
                                                    @if ($item->estado == 2)
                                                        <span class="badge bg-secondary">Verificado</span>
                                                    @else
                                                        <span class="badge bg-success">Inscripto</span>
                                                    @endif
                                                @endif
                                            </td>
                                            <td class="d-flex justify-content-star">
                                                <a href="#editModal" type="button" class="link-success fs-15" data-bs-toggle="modal" data-bs-target="#editModal{{$item->pago_id}}"><i class="bx bx-edit bx-sm bx-burst-hover"></i></a>

                                                {{-- Modal Editar --}}
                                                <div class="modal fade" id="editModal{{$item->pago_id}}" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Editar Pago</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('Pago.update',$item->pago_id) }}" method="POST">
                                                                    @csrf @method('PUT')
                                                                    <div class="col-sm-12 row g-3">
                                                                        <div class="mb-3 col-md-4">
                                                                            <label for="inputDNI" class="form-label">Documento *</label>
                                                                            <input type="text" class="form-control" id="inputDNI" name="dni" maxlength="9" value="{{ $item->dni }}" onkeypress="return soloNumeros(event)" pattern="[1-9]+" required>
                                                                        </div>
                                                                        <div class="mb-3 col-md-4">
                                                                            <label for="inputNumOpe" class="form-label">Número de Operación *</label>
                                                                            <input type="text" class="form-control" id="inputNumOpe" name="nro_operacion" maxlength="10" value="{{ $item->nro_operacion }}" onkeypress="return soloNumeros(event)" pattern="[1-9]+" required>
                                                                        </div>
                                                                        <div class="mb-3 col-md-4">
                                                                            <label for="inputMonto" class="form-label">Monto *</label>
                                                                            <input type="text" class="form-control" id="inputMonto" name="monto" maxlength="13" value="{{ $item->monto }}" onkeypress="return soloNumeros(event)" required>
                                                                        </div>
                                                                        <div class="mb-3 col-md-4">
                                                                            <label for="inputFechaPago" class="form-label">Fecha de Pago *</label>
                                                                            <input type="date" class="form-control" id="inputFechaPago" name="fecha_pago" value="{{ $item->fecha_pago }}" required>
                                                                        </div>
                                                                        <div class="mb-3 col-md-4">
                                                                            <label for="inputModalidadPago" class="form-label">Canal de Pago *</label>
                                                                            <select class="form-select" name="canal_pago_id" required>
                                                                                <option value="" selected>Seleccione</option>
                                                                                @foreach ($canalPago as $itemca)
                                                                                    <option value="{{$itemca->canal_pago_id  }}" {{ $itemca->canal_pago_id == $item->canal_pago_id ? 'selected' : '' }}>{{$itemca->descripcion}}</option>
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
        {!! $pago->render() !!}
    </div>
    <!-- end row -->

@endsection