<div>
    
    <div class="row">
        <div class="col-sm-12">
            <div class="d-flex justify-content-end align-items-center mb-3">
                <a href="#modalConceptoPago" type="button" wire:click="modo()" class="btn btn-primary btn-label waves-effect right waves-light w-md" data-bs-toggle="modal" data-bs-target="#modalConceptoPago"><i class="ri-add-line label-icon align-middle fs-16 ms-2"></i> Nuevo</a>
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
                                @foreach ($conceptoPagoModel as $item)
                                    <tr>
                                        <td align="center"><strong>{{$item->concepto_id}}</strong></td>
                                        <td>{{$item->concepto}}</td>
                                        <td align="center">{{$item->monto}}</td>
                                        <td align="center">
                                            @if ( $item->estado == 1)
                                                <span style="cursor: pointer;" wire:click="cargarAlerta({{ $item->concepto_id }})" class="badge text-bg-primary">Activo</span>
                                            @else
                                                <span style="cursor: pointer;" wire:click="cargarAlerta({{ $item->concepto_id }})" class="badge text-bg-danger">Inactivo</span>
                                            @endif
                                        </td>
                                        <td align="center" class="d-flex justify-content-center">
                                                <a href="#modalConceptoPago" wire:click="cargarConceptoPago({{ $item->concepto_id }})" class="link-success fs-16" data-bs-toggle="modal" data-bs-target="#modalConceptoPago"><i class="ri-edit-2-line"></i></a>
                                            </div>
                                            
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
    <div wire:ignore.self class="modal fade" id="modalConceptoPago" tabindex="-1" aria-labelledby="modalConceptoPago" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ $titulo }}</h5>
                    <button type="button" class="btn-close" wire:click="limpiar()" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form novalidate>
                        <div class="col-sm-12 row g-3">
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Concepto <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('concepto') is-invalid @enderror" wire:model="concepto">
                                @error('concepto')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                    
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Monto <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('monto') is-invalid @enderror" wire:model="monto">
                                @error('monto')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer col-12 d-flex justify-content-between">
                        <button type="button" wire:click="limpiar()" class="btn btn-secondary btn-label waves-effect waves-light w-md" data-bs-dismiss="modal"><i class="ri-arrow-left-s-line label-icon align-middle fs-16 me-2"></i> Cancelar</button>
                        <button type="button" wire:click="guardarConceptoPago()" class="btn btn-primary btn-label waves-effect right waves-light w-md"><i class="ri-check-double-fill label-icon align-middle fs-16 ms-2"></i>
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


