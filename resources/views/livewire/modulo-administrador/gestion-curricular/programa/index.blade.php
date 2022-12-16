<div>
    <div class="row">
        <div class="col-sm-12">
            <div class="d-flex justify-content-end align-items-center mb-3">
                <a href="#modalPrograma" type="button" wire:click="modo()" class="btn btn-primary btn-label waves-effect right waves-light w-md" data-bs-toggle="modal" data-bs-target="#modalPlan"><i class="ri-user-add-line label-icon align-middle fs-16 ms-2"></i> Nuevo</a>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="d-flex justify-content-between align-items-center gap-4">
                            <div>
                                <select wire:model="buscar_programa" class="form-select text-muted" local>
                                    <option value="all">Seleccione un programa</option>
                                    @foreach ($programa_model as $item)
                                        <option value="{{ $item->descripcion_programa }}">{{ $item->descripcion_programa }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <select wire:model="buscar_plan" class="form-select text-muted">
                                    <option value="all">Seleccione el plan</option>
                                    @foreach ($plan_model as $item)
                                        <option value="{{ $item->id_plan }}">{{ $item->plan }}</option>
                                    @endforeach
                                </select>
                            </div>
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
                                    <th scope="col" class="col-md-1">ID</th>
                                    <th scope="col" class="col-md-1">Programa</th>
                                    <th scope="col" class="col-md-2">Subrograma</th>
                                    <th scope="col" class="col-md-2">Mencion</th>
                                    <th scope="col" class="col-md-1">Plan</th>
                                    <th scope="col" class="col-md-2">Sede</th>
                                    <th scope="col" class="col-md-1">Estado</th>
                                    <th scope="col" class="col-md-1">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($programas as $item)
                                    <tr>
                                        <td align="center"><strong>{{ $item->id_mencion }}</strong></td>
                                        <td>{{ $item->descripcion_programa }}</td>
                                        <td>{{ $item->subprograma }}</td>
                                        <td>
                                            @if ($item->mencion == null)
                                                SIN MENCION
                                            @else
                                                {{ $item->mencion }}
                                            @endif
                                        </td>
                                        <td align="center">{{ $item->plan }}</td>
                                        <td align="center">{{ $item->sede }}</td>
                                        <td align="center">
                                            @if ($item->estado == 1)
                                                <span style="cursor: pointer;" wire:click="cargarAlerta({{ $item->id_plan }})" class="badge text-bg-primary">Activo</span>
                                            @endif
                                            @if ($item->estado == 0)
                                                <span style="cursor: pointer;" wire:click="cargarAlerta({{ $item->id_plan }})" class="badge text-bg-danger">Inactivo</span>
                                            @endif
                                        </td>
                                        <td align="center">
                                            <div class="hstack gap-3 flex-wrap justify-content-center">
                                                <a href="#modalPrograma" wire:click="cargarPrograma({{ $item->id_plan }})" class="link-success fs-16" data-bs-toggle="modal" data-bs-target="#modalPlan"><i class="ri-edit-2-line"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if ($programas->count())
                            <div class="mt-2 d-flex justify-content-end text-muted">
                                {{ $programas->links() }}
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
    <div wire:ignore.self class="modal fade" id="modalPlan" tabindex="-1" aria-labelledby="modalPrograma"
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
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Plan <span
                                        class="text-danger">*</span></label>
                                <select wire:model="plan" class="form-select @error('plan') is-invalid  @enderror">
                                    <option value="">Seleccione el plan</option>
                                    @foreach ($plan_model as $item)
                                        <option value="{{ $item->id_plan }}">{{ $item->plan }}</option>
                                    @endforeach
                                </select>
                                @error('plan') <span class="error text-danger" >{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Sede <span
                                        class="text-danger">*</span></label>
                                <select wire:model="sede" class="form-select @error('sede') is-invalid  @enderror">
                                    <option value="">Seleccione la sede</option>
                                    @foreach ($sede_model as $item)
                                        <option value="{{ $item->cod_sede }}">{{ $item->sede }}</option>
                                    @endforeach
                                </select>
                                @error('sede') <span class="error text-danger" >{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Programa <span
                                        class="text-danger">*</span></label>
                                <select wire:model="programa" class="form-select @error('programa') is-invalid  @enderror">
                                    <option value="">Seleccione la sede</option>
                                    @if ($programa_model_form)
                                        @foreach ($programa_model_form as $item)
                                            <option value="{{ $item->id_programa }}">{{ $item->descripcion_programa }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('programa') <span class="error text-danger" >{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer col-12 d-flex justify-content-between">
                    <button type="button" wire:click="limpiar()" class="btn btn-secondary btn-label waves-effect waves-light w-md" data-bs-dismiss="modal"><i class="ri-arrow-left-s-line label-icon align-middle fs-16 me-2"></i> Cancelar</button>
                    <button type="button" wire:click="guardarPrograma()" class="btn btn-primary btn-label waves-effect right waves-light w-md"><i class="ri-check-double-fill label-icon align-middle fs-16 ms-2"></i> Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>