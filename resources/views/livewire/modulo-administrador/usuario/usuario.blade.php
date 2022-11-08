<div>
    <div class="row">
        <div class="col-sm-12">
            <div class="d-flex justify-content-end align-items-center mb-3">
                <a href="#modalUsuario" type="button" wire:click="modo()" class="btn btn-primary btn-label waves-effect right waves-light w-md" data-bs-toggle="modal" data-bs-target="#modalUsuario"><i class="ri-user-add-line label-icon align-middle fs-16 ms-2"></i> Nuevo</a>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="d-flex justify-content-between align-items-center gap-4">
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
                                    <th scope="col" class="col-md-3">Username</th>
                                    <th scope="col" class="col-md-5">Correo</th>
                                    <th scope="col" class="col-md-2">Estado</th>
                                    <th scope="col" class="col-md-1">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($usuarios as $item)
                                    <tr>
                                        <td align="center"><strong>{{ $item->usuario_id }}</strong></td>
                                        <td>{{ $item->usuario_nombre }}</td>
                                        <td>{{ $item->usuario_correo }}</td>
                                        <td align="center">
                                            @if ($item->usuario_estado == 1)
                                                <span style="cursor: pointer;" wire:click="cargarAlerta({{ $item->usuario_id }})" class="badge text-bg-primary">Activo</span>
                                            @endif
                                            @if ($item->usuario_estado == 2)
                                                <span style="cursor: pointer;" wire:click="cargarAlerta({{ $item->usuario_id }})" class="badge text-bg-success">Asignado</span>
                                            @endif
                                            @if ($item->usuario_estado == 0)
                                                <span style="cursor: pointer;" wire:click="cargarAlerta({{ $item->usuario_id }})" class="badge text-bg-danger">Inactivo</span>
                                            @endif
                                        </td>
                                        <td align="center">
                                            <div class="hstack gap-3 flex-wrap justify-content-center">
                                                <a href="#modalUsuario" wire:click="cargarUsuario({{ $item->usuario_id }})" class="link-success fs-16" data-bs-toggle="modal" data-bs-target="#modalUsuario"><i class="ri-edit-2-line"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if ($usuarios->count())
                            <div class="mt-2 d-flex justify-content-end text-muted">
                                {{ $usuarios->links() }}
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
    {{-- Modal Usuario --}}
    <div wire:ignore.self class="modal fade" id="modalUsuario" tabindex="-1" aria-labelledby="modalUsuario"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-uppercase" id="exampleModalLabel">{{ $titulo }}</h5>
                    <button type="button" wire:click="limpiar()" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form novalidate>
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Username <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('username') is-invalid  @enderror" wire:model="username" placeholder="Ingrese su nombre de usuario">
                                @error('username') <span class="error text-danger" >{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3 col-md-12">
                                <label class="form-label">Correo <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('correo') is-invalid  @enderror"
                                    wire:model="correo" placeholder="Ingrese su correo electrónico" autocomplete="off">
                                @error('correo')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Contraseña @if($modo==1) <span class="text-danger">*</span> @endif</label>
                                <input type="password" class="form-control @error('password') is-invalid  @enderror" wire:model="password" placeholder="Ingrese su contraseña" autocomplete="off">
                                @error('password') <span class="error text-danger" >{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer col-12 d-flex justify-content-between">
                    <button type="button" wire:click="limpiar()" class="btn btn-secondary btn-label waves-effect waves-light w-md" data-bs-dismiss="modal"><i class="ri-arrow-left-s-line label-icon align-middle fs-16 me-2"></i> Cancelar</button>
                    <button type="button" wire:click="guardarUsuario()" class="btn btn-primary btn-label waves-effect right waves-light w-md"><i class="ri-check-double-fill label-icon align-middle fs-16 ms-2"></i> Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>