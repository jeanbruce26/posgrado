<div class="">
    <div class="profile-foreground position-relative mx-n4 mt-n4">
        <div class="profile-wid-bg">
            <img src="{{ asset('asset-pdf/bg_unu.jpg') }}" alt="" class="profile-wid-img">
        </div>
    </div>

    <div class="pt-5 mb-lg-2 pb-lg-2">
        <div class="row g-4">
            <div class="col-auto">
                <div class="avatar-xl">
                    @if ($trabajador_model->trabajador_perfil)
                    <img src="{{ asset($trabajador_model->trabajador_perfil) }}" alt="user-img" class="img-thumbnail rounded-circle">
                    @else
                    <img src="{{ asset('assets/images/avatar.png') }}" alt="user-img" class="img-thumbnail rounded-circle">
                    @endif
                </div>
            </div>
            <!--end col-->
            <div class="col">
                <div class="p-2">
                    <h3 class="text-white mt-2 mb-2">{{ $trabajador_model->trabajador_nombres }} {{ $trabajador_model->trabajador_apellidos }}</h3>
                    <p class="text-white-75">
                        @foreach ($tipo_trabajador_model as $item)
                            {{ $item->TipoTrabajador->tipo_trabajador }} <br>
                        @endforeach
                    </p>
                </div>
            </div>
        </div>
        <!--end row-->
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div>
                <div class="d-flex justify-content-end">
                    <!-- Nav tabs -->
                    <div class="flex-shrink-0">
                        <a href="#modalPerfil" wire:click="cargarTrabajador" data-bs-toggle="modal" data-bs-target="#modalPerfil" class="btn btn-success"><i class="ri-edit-box-line align-bottom"></i> Editar Perfil</a>
                    </div>
                </div>
                <!-- Tab panes -->
                <div class="tab-content pt-4 text-muted">
                    <div class="tab-pane active" id="overview-tab" role="tabpanel">
                        <div class="row">
                            <div class="col-xxl-6">
                                <div class="card">
                                    <div class="card-body p-4">
                                        <h5 class="card-title mb-3 text-uppercase fw-bold">Información Personal</h5>
                                        <div class="table-responsive">
                                            <table class="table table-borderless mb-0">
                                                <tbody>
                                                    <tr>
                                                        <th class="ps-0 col-md-4" scope="row">Nombre y Apellidos :</th>
                                                        <td class="text-muted">{{ $trabajador_model->trabajador_nombres }} {{ $trabajador_model->trabajador_apellidos }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">Documento de Identidad :</th>
                                                        <td class="text-muted">{{ $trabajador_model->trabajador_numero_documento }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">Correo Electrónico :</th>
                                                        <td class="text-muted">{{ $trabajador_model->trabajador_correo }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">Diección :</th>
                                                        <td class="text-muted">{{ $trabajador_model->trabajador_direccion }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">Grado Académico</th>
                                                        <td class="text-muted">{{ $trabajador_model->trabajador_grado }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div>
                            <!--end col-->
                            <div class="col-xxl-6">
                                @foreach ($tipo_trabajador_model as $item)
                                @php
                                    $usuario_model = App\Models\UsuarioTrabajador::where('trabajador_tipo_trabajador_id', $item->trabajador_tipo_trabajador_id)->first();
                                @endphp
                                <div class="card">
                                    <div class="card-body p-4">
                                        <h5 class="card-title mb-3 text-uppercase fw-bold">Información de Usuario {{ $item->TipoTrabajador->tipo_trabajador }}</h5>
                                        <div class="table-responsive">
                                            <table class="table table-borderless mb-0">
                                                <tbody>
                                                    <tr>
                                                        <th class="ps-0 col-md-4" scope="row">Username :</th>
                                                        <td class="text-muted">{{ $usuario_model->usuario_nombre }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">Correo Electrónico :</th>
                                                        <td class="text-muted">{{ $usuario_model->usuario_correo }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                                @endforeach
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </div>
                </div>
                <!--end tab-content-->
            </div>
        </div>
        <!--end col-->
    </div>
    <!--end row-->
    {{-- Modal Usuario --}}
    <div wire:ignore.self class="modal fade" id="modalPerfil" tabindex="-1" aria-labelledby="modalPerfil"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-uppercase" id="exampleModalLabel">{{ $titulo }}</h5>
                    <button type="button" wire:click="limpiar()" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form novalidate autocomplete="off">
                        <div class="row">
                            @if ($paso == 1)
                                <div class="col-md-12">
                                    <label class="form-label mb-2 fw-bold fs-5">Datos Personales</label>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Apellidos <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('apellido') is-invalid  @enderror" wire:model="apellido" placeholder="Ingrese su apellido">
                                    @error('apellido') <span class="error text-danger" >{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Nombres <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('nombre') is-invalid  @enderror" wire:model="nombre" placeholder="Ingrese su nombre">
                                    @error('nombre') <span class="error text-danger" >{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Documento de Identidad <span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('documento') is-invalid  @enderror" wire:model="documento" placeholder="Ingrese su documento de identidad">
                                    @error('documento') <span class="error text-danger" >{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Dirección <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('direccion') is-invalid  @enderror" wire:model="direccion" placeholder="Ingrese su dirección">
                                    @error('direccion') <span class="error text-danger" >{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Correo Electrónico <span
                                            class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('correo') is-invalid  @enderror" wire:model="correo" placeholder="Ingrese su correo electrónico" autocomplete="off">
                                    @error('correo') <span class="error text-danger" >{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Grado Académico <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select @error('grado_academico') is-invalid  @enderror" wire:model="grado_academico">
                                        <option value="">Seleccione</option>
                                        <option value="BACHILLER">Bachiller</option>
                                        <option value="MAGISTER">Magister</option>
                                        <option value="DOCTOR">Doctor</option>
                                    </select>
                                    @error('grado_academico') <span class="error text-danger" >{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3 col-md-12">
                                    <label class="form-label">Foto de Perfil</label>
                                    <input type="file" class="form-control @error('perfil') is-invalid  @enderror" wire:model="perfil" id="udpload({{ $iteracion++ }})">
                                    @error('perfil') <span class="error text-danger" >{{ $message }}</span> @enderror
                                </div>

                                @if ($perfil)
                                <div class="mb-3 col-md-12 text-center">
                                    <img src="{{ asset($perfil->temporaryUrl()) }}" alt="perfil" class="rounded-circle shadow-lg border border-4" width="20%">
                                </div>
                                @endif
                            @elseif ($paso == 2)
                                <div class="col-md-12">
                                    <label class="form-label mb-2 fw-bold fs-5">Datos de Usuario {{ ucfirst(strtolower($tipo_trabajador)) }}</label>
                                </div>

                                <div class="mb-3 col-md-12">
                                    <label class="form-label">Username <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('username') is-invalid  @enderror" wire:model="username" placeholder="Ingrese su nombre de usuario">
                                    @error('username') <span class="error text-danger" >{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Correo <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('correo_usuario') is-invalid  @enderror"
                                        wire:model="correo_usuario" placeholder="Ingrese su correo electrónico" autocomplete="off">
                                    @error('correo_usuario')<span class="error text-danger">{{ $message }}</span>@enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Contraseña</label>
                                    <input type="password" class="form-control @error('password') is-invalid  @enderror" wire:model="password" autocomplete="off">
                                    @error('password') <span class="error text-danger" >{{ $message }}</span> @enderror
                                </div>
                            @endif
                        </div>
                    </form>
                </div>
                <div class="modal-footer col-12 d-flex justify-content-between">
                @if ($paso == 1)
                    <button type="button" wire:click="limpiar()" class="btn btn-secondary btn-label waves-effect waves-light w-md" data-bs-dismiss="modal"><i class="ri-arrow-left-s-line label-icon align-middle fs-16 me-2"></i> Cancelar</button>
                    <button type="button" wire:click="siguiente()" class="btn btn-success btn-label waves-effect right waves-light w-md"><i class="ri-arrow-right-s-line label-icon align-middle fs-16 ms-2"></i> Siguiente</button>
                @elseif ($paso == 2)
                    <button type="button" wire:click="regresar()" class="btn btn-secondary btn-label waves-effect waves-light w-md"><i class="ri-arrow-left-s-line label-icon align-middle fs-16 me-2"></i> Regresar</button>
                    <button type="button" wire:click="guardarPerfil()" class="btn btn-primary btn-label waves-effect right waves-light w-md"><i class="ri-check-double-fill label-icon align-middle fs-16 ms-2"></i> Guardar</button>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>