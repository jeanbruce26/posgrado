<div>
    <div class="row">
        <div class="col-sm-12">
            @if ($mostrar_alerta == 1)
                <div class="alert alert-warning alert-dismissible alert-label-icon rounded-label shadow fade show" role="alert">
                    <i class="ri-alert-line label-icon"></i><strong>Hay personas admitidas por generar su codigo</strong>
                </div>
            @endif
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <div wire:loading>
                        <div class="spinner-border text-success" role="status">
                            <span class="sr-only">Loading...</span>
                        </div> 
                    </div>
                </div>
                <div>
                    <button type="button" wire:click="export_no_admitidos()" class="btn btn-success btn-label waves-effect right waves-light w-md me-3"><i class="ri-file-excel-2-line label-icon align-middle fs-16 ms-2"></i> Excel No Admitidos</button>
                    <button type="button" wire:click="export()" class="btn btn-success btn-label waves-effect right waves-light w-md me-3"><i class="ri-file-excel-2-line label-icon align-middle fs-16 ms-2"></i> Excel</button>
                    <button type="button" wire:click="cargarAlertaCodigo()" class="btn btn-primary btn-label waves-effect right waves-light w-md" @if ($mostrar_alerta == 0) disabled @endif><i class="ri-add-line label-icon align-middle fs-16 ms-2"></i> Generar codigo de admitidos</button>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center gap-4">
                            <select class="form-select" wire:model="filtro_programa">
                                <option value="">Seleccione el programa</option>
                                @foreach ($programas as $item)
                                    <option value="{{ $item->id_mencion }}">
                                        @if ($item->mencion == null)
                                            {{$item->SubPrograma->Programa->descripcion_programa}} EN {{$item->SubPrograma->subprograma}}
                                        @else
                                            MENCION EN {{$item->mencion}}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            <select class="form-select" wire:model="filtro_pago">
                                <option value="">Filtro de Constancia y Matricula</option>
                                <option value="constancia">
                                    Solo Constancia de Ingreso
                                </option>
                                <option value="matricula">
                                    Solo Matricula
                                </option>
                                <option value="constancia_matricula">
                                    Constancia de Ingreso y Matricula
                                </option>
                                <option value="sin_constancia">
                                    No tienen Constancia de Ingreso
                                </option>
                                <option value="sin_matricula">
                                    No tienen Matricula
                                </option>
                            </select>
                            <button type="button" wire:click="limpiar_filtro()" class="btn btn-secondary">
                                Limpiar
                            </button>
                        </div>
                        <div class="w-25">
                            <input class="form-control text-muted" type="search" wire:model="search"
                                placeholder="Buscar...">
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-nowrap mb-0">
                            <thead>
                                <tr align="center" style="background-color: rgb(179, 197, 245)">
                                    <th scope="col" class="">ID</th>
                                    <th scope="col" class="">Codigo</th>
                                    <th scope="col" class="">Documento</th>
                                    <th scope="col" class="col-md-3">Apellidos y Nombres</th>
                                    <th scope="col" class="col-md-1">Celular</th>
                                    <th scope="col" class="col-md-3">Programa</th>
                                    <th scope="col" class="">Ficha Matricula</th>
                                    <th scope="col" class="">Pago Constancia</th>
                                    <th scope="col" class="">Pago Matricula</th>
                                    <th scope="col" class="col-md-1"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($admitidos_model->count() == 0)
                                    <tr>
                                        <td colspan="9" align="center" class="text-muted">No hay registros.</td>
                                    </tr>
                                @else
                                    @foreach ($admitidos_model as $item)
                                    @php
                                        $constancia = App\Models\ConstanciaIngresoPago::where('admitidos_id', $item->admitidos_id)->first();
                                        $matricula = App\Models\MatriculaPago::where('admitidos_id', $item->admitidos_id)->where('ciclo_id',1)->first();
                                    @endphp
                                    <tr>
                                        <td align="center" class="fw-bold">{{$item->admitidos_id}}</td>
                                        <td align="center">{{ $item->admitidos_codigo }}</td>
                                        <td align="center">{{ $item->num_doc }}</td>
                                        <td align="">{{ $item->apell_pater }} {{ $item->apell_mater }}, {{ $item->nombres }}</td>
                                        <td align="center">+51 {{ $item->celular1 }}</td>
                                        <td align="">
                                            @if ($item->mencion == null)
                                                {{$item->descripcion_programa}} EN {{$item->subprograma}}
                                            @else
                                                MENCION EN {{$item->mencion}}
                                            @endif
                                        </td>
                                        <td align="center">
                                            @php
                                                $ficha = App\Models\MatriculaPago::where('admitidos_id', $item->admitidos_id)->first();
                                            @endphp
                                            @if ($ficha)
                                                <a href="{{ asset($ficha->ficha_matricula) }}" target="_blank" class="btn btn-sm btn-secondary">
                                                    Ver Ficha
                                                </a>
                                            @else
                                                ---
                                            @endif
                                        </td>
                                        <td align="center">
                                            @if ($constancia)
                                                <button class="btn btn-sm btn-secondary" wire:click="cargar_pago(1, {{ $item->admitidos_id }})" data-bs-toggle="modal" data-bs-target="#modal_pago">
                                                    Ver pago
                                                </button>
                                            @else
                                                ---
                                            @endif
                                        </td>
                                        <td align="center">
                                            @if ($matricula)
                                                <button class="btn btn-sm btn-secondary" wire:click="cargar_pago(2, {{ $item->admitidos_id }})" data-bs-toggle="modal" data-bs-target="#modal_pago">
                                                    Ver pago
                                                </button>
                                            @else
                                                ---
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group shadow">
                                                <button type="button" class="btn btn-light shadow-none">Acciones</button>
                                                <button type="button" class="btn btn-light shadow-none dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" style="cursor: pointer;" wire:click="alerta_delete_pago_constancia({{ $item->admitidos_id }})">
                                                        Eliminar Pago Constancia de Ingreso
                                                    </a>
                                                    <a class="dropdown-item" style="cursor: pointer;" wire:click="alerta_delete_pago_matricula({{ $item->admitidos_id }})">
                                                        Eliminar Pago Matricula
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal --}}
    <div wire:ignore.self class="modal fade" id="modal_pago" tabindex="-1" role="dialog" aria-labelledby="modal_pago_label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title text-uppercase" id="modalNotaLabel">Ver Pago</h5>
                        <button type="button" wire:click="limpiar()" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body mb-3">
                        <div class="row g-2">
                            <div class="col-md-12">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span>
                                        Voucher
                                    </span>
                                    <a href="{{ asset($voucher) }}" target="_blank" class="btn btn-sm btn-primary">
                                        Ver Voucher Completo
                                    </a>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset($voucher) }}" alt="voucher" height="200">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="documento" class="col-form-label">Documento Identidad</label>
                                <input type="text" id="documento" class="form-control" wire:model="documento" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="operacion" class="col-form-label">Numero Operacion</label>
                                <input type="text" id="operacion" class="form-control" wire:model="operacion" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="fecha" class="col-form-label">Fecha Pago</label>
                                <input type="text" id="fecha" class="form-control" wire:model="fecha" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="monto" class="col-form-label">Monto Pago</label>
                                <input type="text" id="monto" class="form-control" wire:model="monto" readonly>
                            </div>
                            <div class="col-md-12">
                                <label for="concepto" class="col-form-label">Concepto de Pago</label>
                                <input type="text" id="concepto" class="form-control" wire:model="concepto" readonly>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
