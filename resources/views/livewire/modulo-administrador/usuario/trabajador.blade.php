<div>
    <div class="row">
        <div class="col-sm-12">
            <div class="d-flex justify-content-end align-items-center mb-3">
                <a href="#modalTra" type="button" wire:click="modo()" class="btn btn-primary btn-label waves-effect right waves-light w-md" data-bs-toggle="modal" data-bs-target="#modalTra"><i class="ri-user-add-line label-icon align-middle fs-16 ms-2"></i> Nuevo</a>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="d-flex justify-content-between align-items-center gap-4">
                            <div class="text-muted d-flex align-items-center">
                                <label class="col-form-label me-2">Mostrar</label>
                                <select class="form-select form-select-sm text-muted" wire:model="mostrar"
                                    aria-label="Default select example">
                                    <option value="10" selected>10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                            <div class="text-muted d-flex align-items-center">
                                <label class="col-form-label me-2">Tipo</label>
                                <select class="form-select form-select-sm text-muted" wire:model="tipo"
                                    aria-label="Default select example">
                                    <option value="all" selected>Mostrar todos</option>
                                    @foreach ($tipo_trabajadores as $item)
                                    <option value="{{ $item->tipo_trabajador_id }}">{{ $item->tipo_trabajador }}</option>
                                    @endforeach
                                </select>
                            </div>
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
                                    <th scope="col" class="col-md-1">Documento</th>
                                    <th scope="col">Nombres</th>
                                    <th scope="col" class="col-md-1">Grado</th>
                                    <th scope="col" class="col-md-2">Correo</th>
                                    <th scope="col" class="col-md-2">Tipo</th>
                                    <th scope="col" class="col-md-2">Estado</th>
                                    <th scope="col" class="col-md-1">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $num = 1;
                                @endphp
                                @foreach ($trabajadores as $item)
                                    <tr>
                                        <td align="center">
                                            @if (($num) < 10)
                                            <strong>0{{ $num }}</strong>
                                            @else
                                            <strong>{{ $num }}</strong>
                                            @endif
                                        </td>
                                        <td align="center">{{ $item->trabajador_numero_documento }}</td>
                                        <td>{{ $item->trabajador_nombres }} {{ $item->trabajador_apellidos }}</td>
                                        <td align="center">{{ $item->trabajador_grado }}</td>
                                        <td>{{ $item->trabajador_correo }}</td>
                                        @php
                                            $tra_tipo_tra = App\Models\TrabajadorTipoTrabajador::where('trabajador_id', $item->trabajador_id)->first();
                                        @endphp
                                        <td align="center">
                                            @if ($tra_tipo_tra)
                                                @if ($tra_tipo_tra->tipo_trabajador_id == 1)
                                                    Docente
                                                @endif
                                                @if ($tra_tipo_tra->tipo_trabajador_id == 2)
                                                    Coordinador
                                                @endif
                                                @if ($tra_tipo_tra->tipo_trabajador_id == 3)
                                                    Administrativo
                                                @endif
                                                @if ($tra_tipo_tra->tipo_trabajador_id == 4)
                                                    Super Administrador
                                                @endif
                                            @else
                                                No asignado
                                            @endif
                                        </td>
                                        <td align="center">
                                            @if ($item->trabajador_estado == 1)
                                                <span style="cursor: pointer;" wire:click="cambiarEstado({{ $item->trabajador_id }})" class="badge badge-soft-primary">Activo</span>
                                            @else
                                                <span style="cursor: pointer;" wire:click="cambiarEstado({{ $item->trabajador_id }})" class="badge badge-soft-danger">Inactivo</span>
                                            @endif
                                        </td>
                                        <td align="center">
                                            <div class="hstack gap-3 flex-wrap justify-content-center">
                                                <a href="#modalTra" wire:click="cargarTrabajador({{ $item->trabajador_id }})" class="link-success fs-16" data-bs-toggle="modal" data-bs-target="#modalTra"><i class="ri-edit-2-line"></i></a>
                                                <a href="" wire:click="cargarTrabajador({{ $item->trabajador_id }})" class="link-info fs-16"><i class="ri-user-add-line"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    @php
                                        $num++;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                        @if ($trabajadores->count())
                            <div class="mt-2 d-flex justify-content-end text-muted">
                                {{ $trabajadores->links() }}
                            </div>
                        @else
                            <div class="text-center p-3 text-muted">
                                <span>No hay resultados para la busqueda "<strong>{{ $search }}</strong>" en la
                                    pagina <strong>{{ $page }}</strong> al mostrar
                                    <strong>{{ $mostrar }}</strong> por pagina</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal Trabajador --}}
    <div wire:ignore.self class="modal fade" id="modalTra" tabindex="-1" aria-labelledby="modalTra"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-uppercase" id="exampleModalLabel">{{ $titulo_modal }}</h5>
                    <button type="button" wire:click="limpiar()" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form novalidate>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Tipo de Documento <span class="text-danger">*</span></label>
                                <select class="form-select @error('tipo_documento') is-invalid  @enderror"
                                    wire:model="tipo_documento">
                                    <option value="" selected>Seleccione</option>
                                    @foreach ($tipo_doc as $item)
                                        <option value="{{ $item->id_tipo_doc }}">{{ $item->doc }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('tipo_documento')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Documento <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('documento') is-invalid  @enderror"
                                    wire:model="documento" placeholder="Ingrese su número de documento">
                                @error('documento')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Nombres <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nombres') is-invalid  @enderror"
                                    wire:model="nombres" placeholder="Ingrese su nombre">
                                @error('nombres')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Apellidos <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('apellidos') is-invalid  @enderror"
                                    wire:model="apellidos" placeholder="Ingrese sus apellidos">
                                @error('apellidos')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Correo <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('correo') is-invalid  @enderror"
                                    wire:model="correo" placeholder="Ingrese su correo electrónico">
                                @error('correo')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Dirección <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('direccion') is-invalid  @enderror"
                                    wire:model="direccion" placeholder="Ingrese su direccion de domicilio">
                                @error('direccion')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Grado <span class="text-danger">*</span></label>
                                <select class="form-select @error('grado') is-invalid  @enderror" wire:model="grado">
                                    <option value="" selected>Seleccione</option>
                                    <option>BACHILLER</option>
                                    <option>MAGISTER</option>
                                    <option>DOCTOR</option>
                                </select>
                                @error('grado')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer col-12 d-flex justify-content-between">
                    <button type="button" wire:click="limpiar()" class="btn btn-secondary btn-label waves-effect waves-light w-md" data-bs-dismiss="modal"><i class="ri-arrow-left-s-line label-icon align-middle fs-16 me-2"></i> Cancelar</button>
                    <button type="button" wire:click="guardarTrabajador()" class="btn btn-primary btn-label waves-effect right waves-light w-md"><i class="ri-check-double-fill label-icon align-middle fs-16 ms-2"></i> Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>
