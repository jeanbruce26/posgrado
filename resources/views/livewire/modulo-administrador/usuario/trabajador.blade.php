<div>
    <div class="row">
        <div class="col-sm-12">
            <div class="d-flex justify-content-end align-items-center mb-3">
                <a href="#modalTra" type="button" wire:click="modo()"
                    class="btn btn-primary btn-label waves-effect right waves-light w-md" data-bs-toggle="modal"
                    data-bs-target="#modalTra"><i class="ri-user-add-line label-icon align-middle fs-16 ms-2"></i>
                    Nuevo</a>
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
                                        <option value="{{ $item->tipo_trabajador_id }}">{{ $item->tipo_trabajador }}
                                        </option>
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
                        <table class="table table-hover align-middle table-nowrap mb-0">
                            <thead>
                                <tr align="center" style="background-color: rgb(179, 197, 245)">
                                    <th scope="col" class="col-md-1">ID</th>
                                    <th scope="col" class="col-md-1">Documento</th>
                                    <th scope="col">Nombres</th>
                                    <th scope="col" class="col-md-1">Grado</th>
                                    <th scope="col" class="col-md-2">Correo</th>
                                    <th scope="col" class="col-md-2">Tipo</th>
                                    <th scope="col" class="col-md-1">Estado</th>
                                    <th scope="col" class="col-md-2">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $num = 1;
                                @endphp
                                @foreach ($trabajadores as $item)
                                    <tr>
                                        <td align="center">
                                            @if ($num < 10)
                                                <strong>0{{ $num }}</strong>
                                            @else
                                                <strong>{{ $num }}</strong>
                                            @endif
                                        </td>
                                        <td align="center">{{ $item->trabajador_numero_documento }}</td>
                                        <td>
                                            <div class="d-flex justify-conten-star align-items-center">
                                                <div class="flex-shirnk-0">
                                                    @if ($item->trabajador_perfil)
                                                        <img class="rounded-circle avatar-xs"
                                                            src="{{ asset('Perfil/' . $item->trabajador_perfil) }}"
                                                            alt="perfil Avatar">
                                                    @else
                                                        <img class="rounded-circle avatar-xs"
                                                            src="{{ asset('assets/images/avatar.png') }}"
                                                            alt="perfil Avatar">
                                                    @endif
                                                </div>
                                                <div class="ms-2">
                                                    {{ $item->trabajador_nombres }} {{ $item->trabajador_apellidos }}
                                                </div>
                                            </div>
                                        </td>
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
                                                    Coordinador de Unidad
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
                                                <span style="cursor: pointer;"
                                                    wire:click="cambiarEstado({{ $item->trabajador_id }})"
                                                    class="badge text-bg-primary">Activo</span>
                                            @else
                                                <span style="cursor: pointer;"
                                                    wire:click="cambiarEstado({{ $item->trabajador_id }})"
                                                    class="badge text-bg-danger">Inactivo</span>
                                            @endif
                                        </td>
                                        <td align="center">
                                            <div class="hstack gap-3 flex-wrap justify-content-center">
                                                <a href="#modalTra"
                                                    wire:click="cargarTrabajador({{ $item->trabajador_id }})"
                                                    class="link-success fs-16" data-bs-toggle="modal"
                                                    data-bs-target="#modalTra"><i class="ri-edit-2-line"></i></a>
                                                @if ($item->trabajador_estado == 1)
                                                <a href="#modalAsignar"
                                                    wire:click="cargarTrabajadorId({{ $item->trabajador_id }})"
                                                    class="link-info fs-16"data-bs-toggle="modal"
                                                    data-bs-target="#modalAsignar"><i class="ri-user-add-line"></i></a>
                                                <a href="#modaldDesAsignar"
                                                    wire:click="cargarTrabajadorId({{ $item->trabajador_id }})"
                                                    class="link-danger fs-16"data-bs-toggle="modal"
                                                    data-bs-target="#modalDesAsignar"><i class="ri-user-unfollow-line
                                                    "></i></a>
                                                @endif
                                                <a href="#modalInfo"
                                                    wire:click="cargarInfoTrabajador({{ $item->trabajador_id }})"
                                                    class="link-warning fs-16"data-bs-toggle="modal"
                                                    data-bs-target="#modalInfo"><i class="ri-information-line"></i></a>
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

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Foto de perfil</label>
                                <input type="file" class="form-control @error('perfil') is-invalid  @enderror"
                                    wire:model="perfil" id="upload{{ $iteration }}">
                                @error('perfil')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer col-12 d-flex justify-content-between">
                    <button type="button" wire:click="limpiar()"
                        class="btn btn-secondary btn-label waves-effect waves-light w-md" data-bs-dismiss="modal"><i
                            class="ri-arrow-left-s-line label-icon align-middle fs-16 me-2"></i> Cancelar</button>
                    <button type="button" wire:click="guardarTrabajador()"
                        class="btn btn-primary btn-label waves-effect right waves-light w-md"><i
                            class="ri-check-double-fill label-icon align-middle fs-16 ms-2"></i> Guardar</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Asiganar Tipo Trabajador --}}
    <div wire:ignore.self class="modal fade" id="modalAsignar" tabindex="-1" aria-labelledby="modalAsignar"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-uppercase" id="exampleModalLabel">{{ $titulo_modal }}</h5>
                    <button type="button" wire:click="limpiarAsignacion()" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form novalidate>
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Tipo de trabajador <span
                                        class="text-danger">*</span></label>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" wire:model="docente" disabled>
                                    <label class="form-check-label">
                                        Docente
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" wire:model="coordinador"
                                        @if ($administrativo == true) disabled @endif>
                                    <label class="form-check-label">
                                        Coordinador de Unidad
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" wire:model="administrativo"
                                        @if ($coordinador == true) disabled @endif disabled>
                                    <label class="form-check-label">
                                        Administrativo
                                    </label>
                                </div>
                                
                                <div class="border-bottom mt-3"></div>
                            </div>

                            @if ($tipo_docente == 1)
                                <div class="col-md-12">
                                    <div class="row">
                                        <div @if ($tipo_docentes == 'DOCENTE EXTERNO') class="mb-3 col-md-6" @else class="mb-3 col-md-12" @endif>
                                            <label class="form-label">Tipo de Docente <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select @error('tipo_docentes') is-invalid  @enderror"
                                                wire:model="tipo_docentes">
                                                <option value="" selected>Seleccione</option>
                                                <option>DOCENTE INTERNO</option>
                                                <option>DOCENTE EXTERNO</option>
                                            </select>
                                            @error('tipo_docentes')
                                                <span class="error text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        @if ($tipo_docentes == 'DOCENTE EXTERNO')
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Curriculum Vitae <span
                                                        class="text-danger">*</span></label>
                                                <input type="file"
                                                    class="form-control @error('cv') is-invalid  @enderror"
                                                    wire:model="cv">
                                                @error('cv')
                                                    <span class="error text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        @endif
                                    </div>
                                    <div class="border-bottom mb-3"></div>
                                </div>
                            @endif
                            @if ($tipo_coordinador == 1)
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Categoria</label>
                                            <select class="form-select @error('categoria') is-invalid  @enderror"
                                                wire:model="categoria">
                                                <option value="" selected>Seleccione</option>
                                                <option>DOCENTE PRINCIPAL</option>
                                                <option>DOCENTE AUXILIAR</option>
                                                <option>DOCENTE ASOCIADO</option>
                                                <option>DOCENTE CONTRATADO</option>
                                            </select>
                                            @error('categoria')
                                                <span class="error text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
    
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Facultad <span class="text-danger">*</span></label>
                                            <select class="form-select @error('facultad') is-invalid  @enderror"
                                                wire:model="facultad">
                                                <option value="" selected>Seleccione</option>
                                                @foreach ($facultad_model as $item)
                                                    <option value="{{ $item->facultad_id }}" @if($item->facultad_estado == 2) disabled @endif>{{ $item->facultad }}</option>
                                                @endforeach
                                            </select>
                                            @error('facultad')
                                                <span class="error text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if ($tipo_administrativo == 1)
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="mb-3 col-md-12">
                                            <label class="form-label">Area <span class="text-danger">*</span></label>
                                            <select class="form-select @error('area') is-invalid  @enderror"
                                                wire:model="area">
                                                <option value="" selected>Seleccione</option>
                                                @foreach ($area_model as $item)
                                                    <option value="{{ $item->area_id }}">
                                                        {{ $item->area }}</option>
                                                @endforeach
                                            </select>
                                            @error('area')
                                                <span class="error text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if ($tipo_administrativo == 1 || $tipo_coordinador == 1)
                                <div class="col-md-12">
                                    <div class="mb-3 col-md-12">
                                        <label class="dorm label">Usuario <span class="text-danger">*</span></label>
                                        <div class="col-md-12">
                                            <input class="form-control @error('usuario') is-invalid  @enderror" wire:model="usuario" list="datalistOptions" type="text" placeholder="Ingrese el usuario a buscar...">
                                            <datalist id="datalistOptions">
                                                <select class="form-control @error('usuario') is-invalid  @enderror" wire:model="usuario">
                                                @foreach ($usuario_model as $item)
                                                <option value="{{ $item->usuario_correo }}" @if($item->usuario_estado == 0 || $item->usuario_estado == 2) disabled @endif>{{ $item->usuario_nombre }}</option>
                                                @endforeach
                                                </select>
                                            </datalist>
                                            @error('usuario')
                                                <span class="error text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="border-bottom mb-3"></div>
                                </div>
                            @endif
                        </div>
                    </form>
                </div>
                <div class="modal-footer col-md-12 d-flex justify-content-between">
                    <button type="button" wire:click="limpiarAsignacion()"
                        class="btn btn-secondary btn-label waves-effect waves-light w-md" data-bs-dismiss="modal"><i
                            class="ri-arrow-left-s-line label-icon align-middle fs-16 me-2"></i> Cancelar</button>
                    <button type="button" wire:click="asignarTrabajador()"
                        class="btn btn-primary btn-label waves-effect right waves-light w-md"><i
                            class="ri-check-double-fill label-icon align-middle fs-16 ms-2"></i> Guardar</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Informacion del TrABAJADOR --}}
    <div wire:ignore.self class="modal fade" id="modalInfo" tabindex="-1" aria-labelledby="modalInfo"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-uppercase" id="exampleModalLabel">{{ $titulo_modal }}</h5>
                    <button type="button" wire:click="limpiarAsignacion()" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            @if ($trabajador_model)
                                <div class="row mb-1">
                                    <h6 class="fw-bold">Datos Personales</h6>
                                </div>
                                <div class="col-md-12">
                                    <table style="width: 100%">
                                        <tbody>
                                            <tr>
                                                <td width="180">Nombres</td>
                                                <td width="20">:</td>
                                                <td>{{ $trabajador_model->trabajador_nombres }} {{ $trabajador_model->trabajador_apellidos }}</td>
                                            </tr>
                                            <tr>
                                                <td>Documento</td>
                                                <td>:</td>
                                                <td>{{ $trabajador_model->trabajador_numero_documento }}</td>
                                            </tr>
                                            <tr>
                                                <td>Correo</td>
                                                <td>:</td>
                                                <td>{{ $trabajador_model->trabajador_correo }}</td>
                                            </tr>
                                            <tr>
                                                <td>Direccion</td>
                                                <td>:</td>
                                                <td>{{ $trabajador_model->trabajador_direccion }}</td>
                                            </tr>
                                            <tr>
                                                <td>Grado</td>
                                                <td>:</td>
                                                <td>{{ ucwords(strtolower($trabajador_model->trabajador_grado)) }}</td>
                                            </tr>
                                            @if ($trabajador_model->trabajador_estado == 2)
                                            <tr>
                                                <td>Estado</td>
                                                <td>:</td>
                                                <td class="text-danger">Inactivo</td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                            @if ($trabajador_tipo_trabajador)
                                @if ($docente_model)
                                    <div class="row mb-1 mt-4">
                                        <h6 class="fw-bold">Datos de Docente</h6>
                                    </div>
                                    <div class="col-md-12">
                                        <table style="width: 100%">
                                            <tbody>
                                                <tr>
                                                    <td width="180">Tipo de docente</td>
                                                    <td width="20">:</td>
                                                    <td>{{ $docente_model->docente_tipo_docente }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Curriculum Vitae</td>
                                                    <td>:</td>
                                                    <td>{{ $docente_model->docente_cv }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                                @if ($coordinador_model)
                                    <div class="row mb-1 mt-4">
                                        <h6 class="fw-bold">Datos de Coordinador</h6>
                                    </div>
                                    <div class="col-md-12">
                                        <table style="width: 100%">
                                            <tbody>
                                                <tr>
                                                    <td width="180">Categoria de docente</td>
                                                    <td width="20">:</td>
                                                    <td>{{ ucwords(strtolower($coordinador_model->categoria_docente)) }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Facultad</td>
                                                    <td>:</td>
                                                    <td>{{ ucwords(strtolower($coordinador_model->Facultad->facultad)) }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                                @if ($administrativo_model)
                                    <div class="row mb-1 mt-4">
                                        <h6 class="fw-bold">Datos de Administrativo</h6>
                                    </div>
                                    <div class="col-md-12">
                                        <table style="width: 100%">
                                            <tbody>
                                                <tr>
                                                    <td width="180">Area</td>
                                                    <td width="20">:</td>
                                                    <td>{{ $administrativo_model->AreaAdministrativa->area }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                                @if ($user_model)
                                    <div class="row mb-1 mt-4">
                                        <h6 class="fw-bold">Datos de Usuario</h6>
                                    </div>
                                    @php
                                        $num = 0;
                                    @endphp
                                    @foreach ($user_model as $item)
                                    @php
                                        $num++;
                                    @endphp
                                    <div class="col-md-12 mb-2">
                                        <table style="width: 100%">
                                            <tbody>
                                                <tr>
                                                    <td width="180">Usuario @if($num<10)0{{ $num }}@else{{ $num }}@endif</td>
                                                    <td width="20">:</td>
                                                    <td>{{ $item->usuario_nombre }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Correo</td>
                                                    <td>:</td>
                                                    <td>{{ $item->usuario_correo }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Contraseña</td>
                                                    <td>:</td>
                                                    <td>{{ Illuminate\Support\Facades\Crypt::decryptString($item->usuario_contraseña) }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    @endforeach
                                @endif
                            @endif
                            {{-- <div class="border-bottom mt-3"></div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
