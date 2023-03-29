<div>
    <div class="row">
        <div class="col-sm-12">
            <div class="d-flex justify-content-end align-items-center mb-3">
                <a href="#modalAdmision" type="button" wire:click="modo()" class="btn btn-primary btn-label waves-effect right waves-light w-md" data-bs-toggle="modal" data-bs-target="#modalAdmision"><i class="ri-user-add-line label-icon align-middle fs-16 ms-2"></i> Nuevo</a>
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
                                    <th scope="col" class="col-md-3">Admision</th>
                                    <th scope="col" class="col-md-2">Año</th>
                                    <th scope="col" class="col-md-2">Estado</th>
                                    <th scope="col" class="col-md-1">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admision_model as $item)
                                    <tr>
                                        <td align="center"><strong>{{ $item->cod_admi }}</strong></td>
                                        <td>{{ $item->admision }}</td>
                                        <td align="center">{{ $item->admision_year }}</td>
                                        <td align="center">
                                            @if ($item->estado == 1)
                                                <span style="cursor: pointer;" wire:click="cargarAlerta({{ $item->cod_admi }})" class="badge text-bg-primary">Activo</span>
                                            @endif
                                            @if ($item->estado == 0)
                                                <span style="cursor: pointer;" wire:click="cargarAlerta({{ $item->cod_admi }})" class="badge text-bg-danger">Inactivo</span>
                                            @endif
                                        </td>
                                        <td align="center">
                                            <div class="hstack gap-3 flex-wrap justify-content-center">
                                                <a href="#modalAdmision" wire:click="cargarAdmision({{ $item->cod_admi }})" class="link-success fs-16" data-bs-toggle="modal" data-bs-target="#modalAdmision"><i class="ri-edit-2-line"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if ($admision_model->count())
                            <div class="mt-2 d-flex justify-content-end text-muted">
                                {{ $admision_model->links() }}
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
    <div wire:ignore.self class="modal fade" id="modalAdmision" tabindex="-1" aria-labelledby="modalAdmision"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ $titulo }}</h5>
                    <button type="button" wire:click="limpiar()" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form novalidate>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Año <span
                                        class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('año') is-invalid  @enderror" wire:model="año" placeholder="Ingrese el año del proceso de admision">
                                @error('año') <span class="error text-danger" >{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Convocatoria</label>
                                <input type="text" class="form-control @error('convocatoria') is-invalid  @enderror" wire:model="convocatoria" placeholder="Ingrese la convocatoria del proceso de admision">
                                @error('convocatoria') <span class="error text-danger" >{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Fecha fin de admisión <span
                                        class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('fecha_final') is-invalid  @enderror" wire:model="fecha_final">
                                @error('fecha_final') <span class="error text-danger" >{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Fecha de expediente inicio <span
                                        class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('fecha_expediente_inicio') is-invalid  @enderror" wire:model="fecha_expediente_inicio">
                                @error('fecha_expediente_inicio') <span class="error text-danger" >{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Fecha de expediente fin <span
                                        class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('fecha_expediente_fin') is-invalid  @enderror" wire:model="fecha_expediente_fin">
                                @error('fecha_expediente_fin') <span class="error text-danger" >{{ $message }}</span> @enderror
                            </div>
                            
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Fecha de entrevista inicio <span
                                        class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('fecha_entrevista_inicio') is-invalid  @enderror" wire:model="fecha_entrevista_inicio">
                                @error('fecha_entrevista_inicio') <span class="error text-danger" >{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Fecha de entrevista inicio <span
                                        class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('fecha_entrevista_fin') is-invalid  @enderror" wire:model="fecha_entrevista_fin">
                                @error('fecha_fifecha_entrevista_finnal') <span class="error text-danger" >{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Fecha de admitidos <span
                                        class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('fecha_admitidos') is-invalid  @enderror" wire:model="fecha_admitidos">
                                @error('fecha_admitidos') <span class="error text-danger" >{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Fecha de constancia de ingreso <span
                                        class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('fecha_constancia') is-invalid  @enderror" wire:model="fecha_constancia">
                                @error('fecha_constancia') <span class="error text-danger" >{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Fecha de matricula extemporanea inicio <span
                                        class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('fecha_extemporanea_inicio') is-invalid  @enderror" wire:model="fecha_extemporanea_inicio">
                                @error('fecha_extemporanea_inicio') <span class="error text-danger" >{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Fecha de matricula extemporanea fin <span
                                        class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('fecha_extemporanea_fin') is-invalid  @enderror" wire:model="fecha_extemporanea_fin">
                                @error('fecha_extemporanea_fin') <span class="error text-danger" >{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer col-12 d-flex justify-content-between">
                    <button type="button" wire:click="limpiar()" class="btn btn-secondary btn-label waves-effect waves-light w-md" data-bs-dismiss="modal"><i class="ri-arrow-left-s-line label-icon align-middle fs-16 me-2"></i> Cancelar</button>
                    <button type="button" wire:click="guardarAdmision()" class="btn btn-primary btn-label waves-effect right waves-light w-md"><i class="ri-check-double-fill label-icon align-middle fs-16 ms-2"></i> Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>