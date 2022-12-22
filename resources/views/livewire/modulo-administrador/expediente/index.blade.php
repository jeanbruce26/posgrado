<div>
    <div class="row">
        <div class="col-sm-12">
            <div class="d-flex justify-content-end align-items-center mb-3">
                <a href="#modalExpediente" type="button" wire:click="modo()" class="btn btn-primary btn-label waves-effect right waves-light w-md" data-bs-toggle="modal" data-bs-target="#modalExpediente"><i class="ri-add-line label-icon align-middle fs-16 ms-2"></i> Nuevo</a>
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
                                    <th scope="col">Tipo de documento</th>
                                    <th scope="col">Texto complementario</th>
                                    <th scope="col" class="col-md-1">Requerido</th>
                                    <th scope="col" class="col-md-1">Estado</th>
                                    <th scope="col" class="col-md-1">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($expedienteModel as $item)
                                    <tr>
                                        <td align="center"><strong>{{$item->cod_exp}}</strong></td>
                                        <td>{{$item->tipo_doc}}</td>
                                        <td>
                                            @if($item->complemento != null)
                                                {{$item->complemento}}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td align="center">
                                            @if($item->requerido == 1)
                                                <i class="ri-checkbox-circle-line align-middle text-success ri-lg me-1"></i> Si
                                            @else
                                                <i class="ri-close-circle-line align-middle text-danger ri-lg me-1"></i> No
                                            @endif
                                        </td>
                                        <td align="center">
                                            @if($item->estado == 1)
                                                <span class="badge bg-success">Activo</span>
                                            @else
                                                <span class="badge bg-danger">Inactivo</span>
                                            @endif
                                        </td>
                                        <td align="center" class="d-flex justify-content-center">
                                            <a href="#modalExpediente" wire:click="cargarExpediente({{ $item->cod_exp }})" class="link-success fs-16" data-bs-toggle="modal" data-bs-target="#modalExpediente"><i class="ri-edit-2-line"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
    </div>
    <!-- end row -->


    {{-- Modal Nuevo --}}
    <div wire:ignore.self class="modal fade" id="modalExpediente" tabindex="-1" aria-labelledby="modalExpediente" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ $titulo }}</h5>
                    <button type="button" class="btn-close" wire:click="limpiar()" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form novalidate>
                        <div class="col-sm-12 row g-3">
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Tipo de Documento <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('tipoDocumento') is-invalid @enderror" wire:model="tipoDocumento">
                                @error('tipoDocumento')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-12">
                                <label class="form-label">Texto complemento del documento</label>
                                <input type="text" class="form-control @error('complemento') is-invalid @enderror" wire:model="complemento">
                                @error('complemento')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-2">
                                <label class="form-label">Requerido <span class="text-danger">*</span></label><br>
                                
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <input class="form-check-input @error('nota') is-invalid @enderror" type="radio" name="nota" wire:model="nota" value="1">
                                        <label for="nota">Si</label>
                                    </div>
                                    <div>
                                        <input class="form-check-input @error('nota') is-invalid @enderror" type="radio" name="nota" wire:model="nota" value="2">
                                        <label for="nota">No</label>
                                    </div>
                                </div>
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
    {{-- <div class="modal fade" id="editModal{{$item->cod_exp}}" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Expediente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('Expediente.update',$item->cod_exp) }}" method="POST">
                        @csrf @method('PUT')
                        <div class="col-sm-12 row g-3">
                            <div class="mb-3 col-md-12">
                                <label for="inputExp" class="form-label">Tipo de Documento <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="inputExp" name="tipo_doc"  value="{{ $item->tipo_doc }}" onkeypress="return soloLetras(event)" pattern="[a-zA-ZÀ-ÿ ]{2,254}" required>
                            </div>
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Texto complemento del documento</label>
                                <input type="text" class="form-control" name="complemento" value="{{ $item->complemento }}" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="inputRequerido" class="form-label">Requerido <span class="text-danger">*</span></label>
                                <select id="inputRequerido" class="form-select" name="requerido" required>
                                    <option value="" selected>Seleccione</option>
                                    <option value="1" {{ $item->requerido == 1 ? 'selected' : '' }}> Si</option>
                                    <option value="2" {{ $item->requerido == 2 ? 'selected' : '' }}> No</option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-6">
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
    </div> --}}
    {{-- Modal Editar --}}

</div>
