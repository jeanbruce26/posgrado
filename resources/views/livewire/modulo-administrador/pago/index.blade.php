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
                            <div class="btn-group">
                                <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Filtro</button>
                                <div class="dropdown-menu">
                                    <form novalidate autocomplete="off" class="px-4 py-3" style="width: 300px">
                                        <!-- Switches Color -->
                                        {{-- <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch" wire:model="" value="all" id="all">
                                            <label class="form-check-label" for="all">
                                                Todos los pagos
                                            </label>
                                        </div> --}}
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch" wire:model="filtro_estado" value="1" id="sin_concepto">
                                            <label class="form-check-label" for="sin_concepto">
                                                Pagos sin concepto
                                            </label>
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch" wire:model="filtro_estado" value="3" id="inscripcion">
                                            <label class="form-check-label" for="inscripcion">
                                                Pagos por Inscripcion
                                            </label>
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch" wire:model="filtro_estado" value="4" id="constancia">
                                            <label class="form-check-label" for="constancia">
                                                Pagos por Constancia de Ingreso
                                            </label>
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch" wire:model="filtro_estado" value="5" id="matricula">
                                            <label class="form-check-label" for="matricula">
                                                Pagos por Matricula
                                            </label>
                                        </div>
                                    </form>
                                </div>
                            </div><!-- /btn-group -->
                        </div>
                        <div class="w-25">
                            <input class="form-control text-muted" type="search" wire:model="search"
                                placeholder="Buscar...">
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle table-nowrap mb-0">
                            <thead>
                                <tr align="center" style="background-color: rgb(179, 197, 245)">
                                    <th class="col-md-1" style="cursor: pointer;" wire:click="sort('pago_id')">
                                        <div class="d-flex gap-2 alig-items-center justify-content-center">
                                            <span class="fw-bold">ID</span>
                                            <div>
                                                @if ($sort_nombre == 'pago_id')
                                                    @if ($sort_direccion == 'asc')
                                                        <i class="ri ri-arrow-up-s-line"></i>
                                                    @else
                                                        <i class="ri ri-arrow-down-s-line"></i>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </th>
                                    <th scope="col">Documento</th>
                                    <th scope="col">Número de Operación</th>
                                    <th style="cursor: pointer;" wire:click="sort('monto')">
                                        <div class="d-flex gap-2 alig-items-center justify-content-center">
                                            <span class="fw-bold">Monto</span>
                                            <div>
                                                @if ($sort_nombre == 'monto')
                                                    @if ($sort_direccion == 'asc')
                                                        <i class="ri ri-arrow-up-s-line"></i>
                                                    @else
                                                        <i class="ri ri-arrow-down-s-line"></i>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </th>
                                    <th scope="col">Fecha de Pago</th>
                                    <th scope="col">Canal Pago</th>
                                    <th scope="col" class="col-md-2">Estado</th>
                                    <th scope="col">Voucher</th>
                                    <th scope="col" class="col-md-1">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pago as $item)
                                    <tr>
                                        <td align="center" class="fw-bold">{{$item->pago_id}}</td>
                                        <td align="center">{{$item->dni}}</td>
                                        <td align="center">{{$item->nro_operacion}}</td>
                                        <td align="center">S/. {{$item->monto}}</td>
                                        <td align="center">{{date('d/m/Y', strtotime($item->fecha_pago))}}</td>
                                        <td align="center">{{$item->CanalPago->descripcion}}</td>
                                        <td align="center">
                                            <div class="row">
                                                <div class="col-md-7 mt-2">
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
                                                </div>
                                                <div class="col-md-5">
                                                    @if($item->estado == 1)
                                                        <span class="badge bg-warning">Pagado</span>
                                                    @else
                                                        @if ($item->estado == 2)
                                                            <span class="badge bg-secondary">Verificado</span>
                                                        @else
                                                            <span class="badge bg-success">Inscripto</span>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                            
                                        </td>
                                        <td align="center">
                                            @if ($item->voucher)
                                                <a href="{{ asset($item->voucher) }}" target="_blank" class="btn btn-primary btn-sm">
                                                Abrir
                                                </>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td align="center">
                                            <div class="hstack gap-3 flex-wrap justify-content-center">
                                                {{-- @if($item->estado == 1 || $item->estado == 2) --}}
                                                <a href="#modalPago" wire:click="cargarIdPago({{ $item->pago_id }})" class="link-success fs-16" data-bs-toggle="modal" data-bs-target="#modalPago"><i class="ri-edit-2-line"></i></a>
                                                {{-- @endif --}}
                                                @if($item->estado == 1)
                                                    <a style="cursor: pointer" wire:click="eliminar({{ $item->pago_id }})" class="link-danger fs-16"><i class="ri-delete-bin-line"></i></a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if ($pago->count())
                            <div class="mt-2 d-flex justify-content-end text-muted">
                                {{ $pago->links() }}
                            </div>
                        @else
                            <div class="text-center p-3 text-muted">
                                <span>No hay resultados para la busqueda "<strong>{{ $search }}</strong>"</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal --}}
    <div wire:ignore.self class="modal fade" id="modalPago" tabindex="-1" aria-labelledby="modalPago" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ $titulo }}</h5>
                    <button type="button" class="btn-close" wire:click="limpiar()" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form novalidate>
                        <div class="col-sm-12 row g-3">
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Documento <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('documento') is-invalid  @enderror" wire:model="documento">
                                @error('documento')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                                
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Número de Operación <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('numero_operacion') is-invalid  @enderror" wire:model="numero_operacion">
                                @error('numero_operacion')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Monto <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('monto') is-invalid  @enderror" wire:model="monto">
                                @error('monto')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Fecha de Pago <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('fecha_pago') is-invalid  @enderror" wire:model="fecha_pago"> 
                                @error('fecha_pago')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Canal de Pago <span class="text-danger">*</span></label>
                                <select class="form-select @error('canal_pago') is-invalid  @enderror" wire:model="canal_pago">
                                    <option value="" selected>Seleccione</option>
                                    @foreach ($canalPago as $item)
                                        <option value="{{$item->canal_pago_id}}">{{$item->descripcion}}</option>
                                    @endforeach
                                </select>
                                @error('canal_pago')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-12">
                                <label class="form-label"> Voucher de Pago
                                    <span class="text-danger">*</span></label>
                                <input type="file" class="form-control @error('voucher') is-invalid  @enderror"
                                    wire:model="voucher" accept="image/*,application/pdf"
                                    id="upload{{ $iteration }}">
                                <span class="fs-7 mt-2" style="color: #626262">
                                    Nota: El voucher debe ser en formato PDF o imagen JPG, JPEG, PNG <br>
                                </span>
                                @error('voucher')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal-footer col-12 d-flex justify-content-between">
                        <button type="button" wire:click="limpiar()" class="btn btn-secondary btn-label waves-effect waves-light w-md" data-bs-dismiss="modal"><i class="ri-arrow-left-s-line label-icon align-middle fs-16 me-2"></i> Cancelar</button>
                        <button type="button" wire:click="guardarPago()" class="btn btn-primary btn-label waves-effect right waves-light w-md"><i class="ri-check-double-fill label-icon align-middle fs-16 ms-2"></i> Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Modal --}}
</div>
