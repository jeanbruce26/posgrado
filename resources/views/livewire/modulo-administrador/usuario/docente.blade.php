<div>
    <div class="row">
        <div class="col-sm-12">
            @if (session()->has('message'))
                <div class="alert alert-success alert-border-left alert-dismissible fade shadow show mb-3" role="alert">
                    <i class="ri-check-double-line me-3 align-middle"></i> <strong> {{ session('message') }} </strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="card">
                <div class="card-header align-items-center">
                    <div class=" d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0 flex-grow-1 fw-bold">DOCENTE</h4>
                        <a href="#newDocente" type="button" wire:click="modo()"
                            class="btn btn-x1 btn-primary pull-right d-flex justify-content-center align-items-center"
                            data-bs-toggle="modal" data-bs-target="#newDocente">Nuevo <i
                                class="ri-add-circle-fill ms-1"></i>
                        </a>

                        {{-- Modal Nuevo --}}
                        <div wire:ignore.self class="modal fade" id="newDocente" tabindex="-1"
                            aria-labelledby="newDocente" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Crear Docente</h5>
                                        <button type="button" wire:click="limpiar()" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                            <div class="row">
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">Tipo de Documento <span
                                                            class="text-danger">*</span></label>
                                                    <select class="form-select @error('tipo_documento') is-invalid  @enderror" wire:model="tipo_documento">
                                                        <option value="" selected>Seleccione</option>
                                                        @foreach ($tipo_doc as $item)
                                                            <option value="{{ $item->id_tipo_doc }}">{{ $item->doc }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('tipo_documento') <span class="error text-danger" >{{ $message }} </span> @enderror
                                                </div>

                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">Documento <span
                                                            class="text-danger">*</span></label>
                                                    <input type="number" class="form-control @error('documento') is-invalid  @enderror" wire:model="documento" placeholder="Ingrese su número de documento">
                                                    @error('documento') <span class="error text-danger" >{{ $message }}</span> @enderror
                                                </div>

                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">Nombres <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control @error('nombres') is-invalid  @enderror" wire:model="nombres" placeholder="Ingrese su nombre">
                                                    @error('nombres') <span class="error text-danger" >{{ $message }}</span> @enderror
                                                </div>

                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">Apellidos <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control @error('apellidos') is-invalid  @enderror" wire:model="apellidos" placeholder="Ingrese sus apellidos">
                                                    @error('apellidos') <span class="error text-danger" >{{ $message }}</span> @enderror
                                                </div>

                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">Correo <span
                                                            class="text-danger">*</span></label>
                                                    <input type="email" class="form-control @error('correo') is-invalid  @enderror" wire:model="correo" placeholder="Ingrese su correo electrónico">
                                                    @error('correo') <span class="error text-danger" >{{ $message }}</span> @enderror
                                                </div>

                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">Dirección <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control @error('direccion') is-invalid  @enderror" wire:model="direccion" placeholder="Ingrese su direccion de domicilio">
                                                    @error('direccion') <span class="error text-danger" >{{ $message }}</span> @enderror
                                                </div>

                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">Grado <span
                                                            class="text-danger">*</span></label>
                                                    <select class="form-select @error('grado') is-invalid  @enderror" wire:model="grado">
                                                        <option value="" selected>Seleccione</option>
                                                        <option>BACHILLER</option>
                                                        <option>MAGISTER</option>
                                                        <option>DOCTOR</option>
                                                    </select>
                                                    @error('grado') <span class="error text-danger" >{{ $message }}</span> @enderror
                                                </div>

                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">Tipo de Docente <span
                                                            class="text-danger">*</span></label>
                                                    <select class="form-select @error('tipo_docente') is-invalid  @enderror" wire:model="tipo_docente">
                                                        <option value="" selected>Seleccione</option>
                                                        <option>DOCENTE INTERNO</option>
                                                        <option>DOCENTE EXTERNO</option>
                                                    </select>
                                                    @error('tipo_docente') <span class="error text-danger" >{{ $message }}</span> @enderror
                                                </div>

                                                <div class="mb-3 col-md-12">
                                                    <label class="form-label">CV     <span
                                                            class="text-danger">*</span></label>
                                                    <input class="form-control @error('cv') is-invalid  @enderror form-control-sm btn btn-primary" type="file" style="color:azure" wire:model="cv" accept=".pdf">
                                                    @error('cv') <span class="error text-danger" >{{ $message }}</span> @enderror
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <label class="form-label">Username <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control @error('username') is-invalid  @enderror" wire:model="username" placeholder="Ingrese su nombre de usuario">
                                                    @error('username') <span class="error text-danger" >{{ $message }}</span> @enderror
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label">Contraseña <span
                                                            class="text-danger">*</span></label>
                                                    <input type="password" class="form-control @error('password') is-invalid  @enderror" wire:model="password" placeholder="Ingrese su contraseña">
                                                    @error('password') <span class="error text-danger" >{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer col-12 d-flex justify-content-between">
                                        <a type="button" wire:click="limpiar()"
                                            class="btn btn-secondary d-flex justify-content-center align-items-center btn-x1"
                                            data-bs-dismiss="modal"><i
                                                class="bx bx-chevron-left me-1 bx-1x"></i>Cancelar</a>
                                        <button type="button" wire:click="crear()" class="btn btn-primary d-flex justify-content-center align-items-center btn-x1">Guardar<i class="ri-add-circle-fill ms-1"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Modal Nuevo --}}
                    </div>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        <div class="table-responsive">
                            <table wire:ignore.self class="table align-middle table-nowrap table-bordered dt-responsive text-dark"
                                id="tablaCoordinadores">
                                <thead class="table-light">
                                    <tr>
                                        <th class="col-1">ID</th>
                                        <th class="col-1">Documento</th>
                                        <th class="col-2">Nombres</th>
                                        <th class="col-1">Grado</th>
                                        <th class="col-2">Correo</th>
                                        <th class="col-2">Tipo de Docente</th>
                                        <th class="col-1">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mostrar_docente as $item)
                                        @php
                                            $docente = App\Models\Docente::where('trabajador_id',$item->trabajador_id)->first();
                                            $trabajador_tipo_trabajador_id = $item->trabajador_tipo_trabajador_id;
                                        @endphp
                                        <tr>
                                            <td>{{$item->trabajador_id}}</td>
                                            <td>{{$item->Trabajador->trabajador_numero_documento}}</td>
                                            <td>{{$item->Trabajador->trabajador_nombres}} {{$item->Trabajador->trabajador_apellidos}}</td>
                                            <td>{{$item->Trabajador->trabajador_grado}}</td>
                                            <td>{{$item->Trabajador->trabajador_correo}}</td>
                                            @if($docente)
                                                <td>{{$docente->docente_tipo_docente}}</td>
                                            @endif
                                            <td align="center">
                                                <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                    <a href="#updateDocente" type="button" class="fs-15 btn btn-outline-success d-flex align-items-center" wire:click="cargarDocente({{$trabajador_tipo_trabajador_id}})" data-bs-toggle="modal" data-bs-target="#updateDocente{{$trabajador_tipo_trabajador_id}}"><i class="bx bx-edit bx-sm bx-burst-hover"></i></a>
                                                    {{-- Modal Actualizar --}}
                                                    <div wire:ignore.self class="modal fade" id="updateDocente{{$trabajador_tipo_trabajador_id}}" tabindex="-1"
                                                        aria-labelledby="updateDocente" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Actualizar Docente</h5>
                                                                    <button type="button" wire:click="limpiar()" class="btn-close" data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form>
                                                                        <div class="row">
                                                                            <div class="mb-3 col-md-6" style="text-align: left">
                                                                                <label class="form-label">Tipo de Documento <span
                                                                                        class="text-danger">*</span></label>
                                                                                <select class="form-select @error('tipo_documento_update') is-invalid  @enderror" wire:model="tipo_documento_update">
                                                                                    <option value="" selected>Seleccione</option>
                                                                                    @foreach ($tipo_doc as $item)
                                                                                        <option value="{{ $item->id_tipo_doc }}">{{ $item->doc }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                                {{-- @error('tipo_documento_update') <span class="error text-danger" >{{ $message }}</span> @enderror --}}
                                                                            </div>

                                                                            <div class="mb-3 col-md-6" style="text-align: left">
                                                                                <label class="form-label">Documento <span
                                                                                        class="text-danger">*</span></label>
                                                                                <input type="number" class="form-control @error('documento_update') is-invalid  @enderror" wire:model="documento_update" placeholder="Ingrese su número de documento">
                                                                                {{-- @error('documento_update') <span class="error text-danger" >{{ $message }}</span> @enderror --}}
                                                                            </div>

                                                                            <div class="mb-3 col-md-6" style="text-align: left">
                                                                                <label class="form-label">Nombres <span
                                                                                        class="text-danger">*</span></label>
                                                                                <input type="text" class="form-control @error('nombres_update') is-invalid  @enderror" wire:model="nombres_update" placeholder="Ingrese su nombre">
                                                                                {{-- @error('nombres_update') <span class="error text-danger" >{{ $message }}</span> @enderror --}}
                                                                            </div>

                                                                            <div class="mb-3 col-md-6" style="text-align: left">
                                                                                <label class="form-label">Apellidos <span
                                                                                        class="text-danger">*</span></label>
                                                                                <input type="text" class="form-control @error('apellidos_update') is-invalid  @enderror" wire:model="apellidos_update" placeholder="Ingrese sus apellidos">
                                                                                {{-- @error('apellidos_update') <span class="error text-danger" >{{ $message }}</span> @enderror --}}
                                                                            </div>

                                                                            <div class="mb-3 col-md-6" style="text-align: left">
                                                                                <label class="form-label">Correo <span
                                                                                        class="text-danger">*</span></label>
                                                                                <input type="email" class="form-control @error('correo_update') is-invalid  @enderror" wire:model="correo_update" placeholder="Ingrese su correo electrónico">
                                                                                {{-- @error('correo_update') <span class="error text-danger" >{{ $message }}</span> @enderror --}}
                                                                            </div>

                                                                            <div class="mb-3 col-md-6" style="text-align: left">
                                                                                <label class="form-label">Dirección <span
                                                                                        class="text-danger">*</span></label>
                                                                                <input type="text" class="form-control @error('direccion_update') is-invalid  @enderror" wire:model="direccion_update" placeholder="Ingrese su direccion de domicilio">
                                                                                {{-- @error('direccion_update') <span class="error text-danger" >{{ $message }}</span> @enderror --}}
                                                                            </div>

                                                                            <div class="mb-3 col-md-6" style="text-align: left">
                                                                                <label class="form-label">Grado <span
                                                                                        class="text-danger">*</span></label>
                                                                                <select class="form-select @error('grado_update') is-invalid  @enderror" wire:model="grado_update">
                                                                                    <option value="" selected>Seleccione</option>
                                                                                    <option value="BACHILLER">BACHILLER</option>
                                                                                    <option value="MAGISTER">MAGISTER</option>
                                                                                    <option value="DOCTOR">DOCTOR</option>
                                                                                </select>
                                                                                {{-- @error('grado_update') <span class="error text-danger" >{{ $message }}</span> @enderror --}}
                                                                            </div>

                                                                            <div class="mb-3 col-md-6" style="text-align: left">
                                                                                <label class="form-label">Tipo de Docente <span
                                                                                        class="text-danger">*</span></label>
                                                                                <select class="form-select @error('tipo_docente_update') is-invalid  @enderror" wire:model="tipo_docente_update">
                                                                                    <option value="" selected>Seleccione</option>
                                                                                    <option value="DOCENTE INTERNO">DOCENTE INTERNO</option>
                                                                                    <option value="DOCENTE EXTERNO">DOCENTE EXTERNO</option>
                                                                                </select>
                                                                                {{-- @error('tipo_docente_update') <span class="error text-danger" >{{ $message }}</span> @enderror --}}
                                                                            </div>

                                                                            <div class="mb-3 col-md-12" style="text-align: left">
                                                                                <div>
                                                                                    <label class="form-label">CV <span
                                                                                            class="text-danger">*</span></label>
                                                                                </div>
                                                                                <input class="form-control @error('cv_update') is-invalid  @enderror form-control-sm btn btn-primary" type="file" style="color:azure" wire:model="cv_update" accept=".pdf">
                                                                            </div>
                                                                            
                                                                            <div class="col-md-6" style="text-align: left">
                                                                                <label class="form-label">Username <span
                                                                                        class="text-danger">*</span></label>
                                                                                <input type="text" class="form-control @error('username_update') is-invalid  @enderror" wire:model="username_update" placeholder="Ingrese su nombre de usuario">
                                                                                {{-- @error('username_update') <span class="error text-danger" >{{ $message }}</span> @enderror --}}
                                                                            </div>

                                                                            <div class="col-md-6" style="text-align: left">
                                                                                <label class="form-label">Contraseña <span
                                                                                        class="text-danger"></span></label>
                                                                                <input type="password" class="form-control @error('password_update') is-invalid  @enderror" wire:model="password_update" placeholder="Ingrese su nueva contraseña">
                                                                                {{-- @error('password_update') <span class="error text-danger" >{{ $message }}</span> @enderror --}}
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer col-12 d-flex justify-content-between">
                                                                    <a type="button" wire:click="limpiar()"
                                                                        class="btn btn-secondary d-flex justify-content-center align-items-center btn-x1"
                                                                        data-bs-dismiss="modal"><i
                                                                            class="bx bx-chevron-left me-1 bx-1x"></i>Cancelar</a>
                                                                    <button type="button" wire:click="actualizar()" class="btn btn-primary d-flex justify-content-center align-items-center btn-x1">Guardar<i class="ri-add-circle-fill ms-1"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- Modal Actualizar --}}
                                                    <a type="button" wire:click="eliminar({{ $trabajador_tipo_trabajador_id }})" class="fs-15 btn btn-outline-danger d-flex align-items-center"><i class="bx bx-trash bx-sm bx-burst-hover"></i></a>
                                                </div>                                                
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
    </div>
    <!-- end row -->
</div>
