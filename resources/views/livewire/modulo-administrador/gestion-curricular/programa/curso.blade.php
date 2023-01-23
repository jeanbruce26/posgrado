<div>
    <div class="row">
        <div class="col-sm-12">
            <div class="d-flex justify-content-end align-items-center mb-3">
                <a href="#modalCurso" type="button" wire:click="modo()" class="btn btn-primary btn-label waves-effect right waves-light w-md" data-bs-toggle="modal" data-bs-target="#modalCurso"><i class="ri-user-add-line label-icon align-middle fs-16 ms-2"></i> Nuevo</a>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="d-flex justify-content-between align-items-center gap-4">
                            
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
                                    <th scope="col" class="col-md-1">Nro</th>
                                    <th scope="col" class="col-md-1">Código</th>
                                    <th scope="col" class="">Curso</th>
                                    <th scope="col" class="col-md-1">Ciclo</th>
                                    <th scope="col" class="col-md-1">Creditos</th>
                                    <th scope="col" class="col-md-1">Horas</th>
                                    <th scope="col" class="col-md-1">Estado</th>
                                    <th scope="col" class="col-md-1">Creación</th>
                                    <th scope="col" class="col-md-1">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cursos as $item)
                                <tr>
                                    <td align="center"><strong>{{ $item->curso_id }}</strong></td>
                                    <td align="center">{{ $item->curso_codigo }}</td>
                                    <td>{{ $item->curso_nombre }}</td>
                                    <td align="center">{{ $item->Ciclo->ciclo }}</td>
                                    <td align="center">{{ $item->curso_credito }}</td>
                                    <td align="center">{{ $item->curso_horas }}</td>
                                    <td align="center">
                                        @if ($item->curso_estado == 1)
                                            <span style="cursor: pointer;" wire:click="cargarAlerta({{ $item->curso_id }})" class="badge text-bg-primary">Activo</span>
                                        @endif
                                        @if ($item->curso_estado == 0)
                                            <span style="cursor: pointer;" wire:click="cargarAlerta({{ $item->curso_id }})" class="badge text-bg-danger">Inactivo</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->curso_creacion }}</td>
                                    <td align="center">
                                        <div class="hstack gap-3 flex-wrap justify-content-center">
                                            <a href="#modalCurso" wire:click="cargarCurso({{ $item->curso_id }})" class="link-success fs-16" data-bs-toggle="modal" data-bs-target="#modalCurso"><i class="ri-edit-2-line"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if ($cursos->count() == 0)
                            <div class="text-center p-3 text-muted">
                                <span>No hay resultados para la busqueda "<strong>{{ $search }}</strong>"</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Modales --}}
    <div wire:ignore.self class="modal fade" id="modalCurso" tabindex="-1" aria-labelledby="modalCurso"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ $titulo }}</h5>
                    <button type="button" wire:click="limpiar()" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form novalidate>
                        <div class="row">
                            <div class="mb-3 col-md-12 col-sm-12">
                                <label class="form-label">Código <span
                                    class="text-danger">*</span></label>
                                <input wire:model="codigo" type="text" class="form-control @error('codigo') is-invalid  @enderror" placeholder="Ingrese el codigo del curso">
                                @error('codigo') <span class="error text-danger" >{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3 col-md-12 col-sm-12">
                                <label class="form-label">Curso <span
                                    class="text-danger">*</span></label>
                                <input wire:model="curso" type="text" class="form-control @error('curso') is-invalid  @enderror" placeholder="Ingrese el nombre del curso">
                                @error('curso') <span class="error text-danger" >{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3 col-md-12 col-sm-12">
                                <label class="form-label">Ciclo <span
                                        class="text-danger">*</span></label>
                                <select wire:model="ciclo" class="form-select @error('ciclo') is-invalid  @enderror">
                                    <option value="">Seleccione su ciclo</option>
                                    @foreach ($ciclo_model as $item)
                                        <option value="{{ $item->ciclo_id }}">{{ $item->ciclo }}</option>
                                    @endforeach
                                </select>
                                @error('ciclo') <span class="error text-danger" >{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <label class="form-label">Credito <span
                                    class="text-danger">*</span></label>
                                <input wire:model="credito" type="number" class="form-control @error('credito') is-invalid  @enderror" placeholder="Ingrese los creditos del curso">
                                @error('credito') <span class="error text-danger" >{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <label class="form-label">Horas <span
                                    class="text-danger">*</span></label>
                                <input wire:model="horas" type="number" class="form-control @error('horas') is-invalid  @enderror" placeholder="Ingrese las horas del curso">
                                @error('horas') <span class="error text-danger" >{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer col-12 d-flex justify-content-between">
                    <button type="button" wire:click="limpiar()" class="btn btn-secondary btn-label waves-effect waves-light w-md" data-bs-dismiss="modal"><i class="ri-arrow-left-s-line label-icon align-middle fs-16 me-2"></i> Cancelar</button>
                    <button type="button" wire:click="guardarCurso()" class="btn btn-primary btn-label waves-effect right waves-light w-md"><i class="ri-check-double-fill label-icon align-middle fs-16 ms-2"></i> Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>