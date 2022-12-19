<div>
    
    <div class="row">
        <div class="col-sm-12">
            <div class="d-flex justify-content-end align-items-center mb-3">
                <a href="#modalPago" type="button" wire:click="modo()" class="btn btn-primary btn-label waves-effect right waves-light w-md" data-bs-toggle="modal" data-bs-target="#modalPago"><i class="ri-add-line label-icon align-middle fs-16 ms-2"></i> Nuevo</a>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex justify-content-between align-items-center gap-4">
                            
                        </div>
                        <div class="w-25">
                            <input class="form-control form-control-sm text-muted" type="search" wire:model="search"
                                placeholder="Buscar...">
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-nowrap mb-0">
                            <thead>
                                <tr align="center" style="background-color: rgb(179, 197, 245)">
                                    <th scope="col" class="col-md-1">ID</th>
                                    <th scope="col">Concepto</th>
                                    <th scope="col">Monto</th>
                                    <th scope="col" class="col-md-2">Estado</th>
                                    <th scope="col" class="col-md-1">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($conceptoPago as $item)
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

                                            
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-none code-view">
                        <pre class="language-markup" style="height: 275px;"><code>&lt;table class=&quot;table table-nowrap&quot;&gt;
                    </div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
    </div>
    <!-- end row -->


    {{-- Modal Nuevo --}}
    <div class="modal fade" id="newModal" tabindex="-1" aria-labelledby="newModal" aria-hidden="true">
        <div class="modal-dialog modal-x1 modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crear Concepto de Pago</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('ConceptoPago.store') }}" method="POST">
                        @csrf
                        <div class="col-sm-12 row g-3">
                            <div class="mb-3 col-md-12">
                                <label for="inputConcepto" class="form-label">Concepto <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="inputConcepto" name="concepto" maxlength="45" onkeypress="return soloLetras(event)" pattern="[a-zA-ZÀ-ÿ ]{2,254}" required>
                            </div>
                    
                            <div class="mb-3 col-md-12">
                                <label for="inputMonto" class="form-label">Monto <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="inputMonto" name="monto" maxlength="13" onkeypress="return soloNumeros(event)" pattern="[0-9]{1-13}" required>
                            </div>
                    
                            <div class="mb-3 col-md-12">
                                <label for="inputEstado" class="form-label">Estado <span class="text-danger">*</span></label>
                                <select id="inputEstado" class="form-select" name="estado" required>
                                    <option value="" selected>Seleccione</option>
                                    <option value="1"> Activo</option>
                                    <option value="2"> Inactivo</option>
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

    {{-- Modal Editar --}}
    <div class="modal fade" id="editModal{{$item->concepto_id}}" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
        <div class="modal-dialog modal-x1 modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Conbcepto de Pago</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('ConceptoPago.update',$item->concepto_id) }}" method="POST">
                        @csrf @method('PUT')
                        <div class="col-sm-12 row g-3">
                            <div class="mb-3 col-md-12">
                                <label for="inputConcepto" class="form-label">Concepto <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="inputConcepto" name="concepto" maxlength="45" value="{{ $item->concepto }}" onkeypress="return soloLetras(event)" pattern="[a-zA-ZÀ-ÿ ]{2,254}" required>
                            </div>
                
                            <div class="mb-3 col-md-12">
                                <label for="inputMonto" class="form-label">Monto <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="inputMonto" name="monto" maxlength="13" value="{{ $item->monto }}" onkeypress="return soloNumeros(event)" pattern="[0-9]{1-13}" required>
                            </div>
                
                            <div class="mb-3 col-md-12">
                                <label for="inputEstado" class="form-label">Estado <span class="text-danger">*</span></label>
                                <select id="inputEstado" class="form-select" name="estado" required>
                                    <option value="" selected>Seleccione</option>
                                    <option value="1" {{ $item->estado == 1 ? 'selected' : '' }}> Activo</option>
                                    <option value="2" {{ $item->estado == 2 ? 'selected' : '' }}> Inactivo</option>
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

</div>


