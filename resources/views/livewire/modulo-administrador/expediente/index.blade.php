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
                                    <th scope="col" class="col-md-1">Tipo</th>
                                    <th scope="col" class="col-md-1">Estado</th>
                                    <th scope="col" class="col-md-1">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($expedienteModel as $item)
                                    <tr>
                                        <td align="center"><strong>{{$item->cod_exp}}</strong></td>
                                        <td style="white-space: initial;">{{$item->tipo_doc}}</td>
                                        <td style="white-space: initial;">
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
                                            @if ($item->expediente_tipo == 0)
                                                <span class="badge badge-soft-primary">Maestria y Doctorado</span>
                                            @endif
                                            @if ($item->expediente_tipo == 1)
                                                <span class="badge badge-soft-primary">Maestria</span>
                                            @endif
                                            @if ($item->expediente_tipo == 2)
                                                <span class="badge badge-soft-primary">Doctorado</span>
                                            @endif
                                        </td>
                                        <td align="center">
                                            @if ( $item->estado == 1)
                                                <span style="cursor: pointer;" wire:click="cargarAlerta({{ $item->cod_exp }})" class="badge text-bg-primary">Activo</span>
                                            @else
                                                <span style="cursor: pointer;" wire:click="cargarAlerta({{ $item->cod_exp }})" class="badge text-bg-danger">Inactivo</span>
                                            @endif
                                        </td>
                                        <td align="center" class="d-flex justify-content-center">
                                            <a href="#modalExpediente" wire:click="cargarExpediente({{ $item->cod_exp }})" class="link-success fs-16" data-bs-toggle="modal" data-bs-target="#modalExpediente"><i class="ri-edit-2-line"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" align="center" class="text-muted">No hay registros</td>
                                    </tr>
                                @endforelse
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

                            <div class="mb-3 col-md-12">
                                <label class="form-label">Nombre del archivo</label>
                                <input type="text" class="form-control @error('nombre_archivo') is-invalid @enderror" wire:model="nombre_archivo" placeholder="Ejemplo: formato-expediente-2023" readonly>
                                @error('nombre_archivo')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-2">
                                <label class="form-label">Requerido <span class="text-danger">*</span></label><br>
                                
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <input class="form-check-input @error('requerido') is-invalid @enderror" type="radio" name="requerido" wire:model="requerido" value="1">
                                        <label for="requerido">Si</label>
                                    </div>
                                    <div>
                                        <input class="form-check-input @error('requerido') is-invalid @enderror" type="radio" name="requerido" wire:model="requerido" value="2">
                                        <label for="requerido">No</label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 col-md-12">
                                <label class="form-label">Tipo de Expediente <span class="text-danger">*</span></label>
                                <select type="text" class="form-select @error('tipo') is-invalid @enderror" wire:model="tipo">
                                    <option value="">Seleccione</option>
                                    <option value="0">Maestria y Doctorado</option>
                                    <option value="1">Maestria</option>
                                    <option value="2">Doctorado</option>
                                </select>
                                @error('tipo')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer col-12 d-flex justify-content-between">
                        <button type="button" wire:click="limpiar()" class="btn btn-secondary btn-label waves-effect waves-light w-md" data-bs-dismiss="modal"><i class="ri-arrow-left-s-line label-icon align-middle fs-16 me-2"></i> Cancelar</button>
                        <button type="button" wire:click="guardarExpediente()" class="btn btn-primary btn-label waves-effect right waves-light w-md"><i class="ri-check-double-fill label-icon align-middle fs-16 ms-2"></i>
                            @if($modo = 1)
                                Guardar
                            @else
                                Actualizar
                            @endif 
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Modal Nuevo --}}

</div>
