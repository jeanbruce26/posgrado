<div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center gap-4">
                            <select class="form-select w-75" wire:model="filtro_programa">
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
                        <table class="table table-hover align-middle table-nowrap mb-0">
                            <thead>
                                <tr align="center" style="background-color: rgb(179, 197, 245)">
                                    <th scope="col">ID</th>
                                    <th scope="col">Documento</th>
                                    <th scope="col">Persona</th>
                                    <th scope="col">Programa</th>
                                    <th scope="col" class="col-md-1">Eva. Expediente</th>
                                    <th scope="col" class="col-md-1">Eva. Investigacion</th>
                                    <th scope="col" class="col-md-1">Eva. Entrevista</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inscripcion as $item)
                                @php
                                    $expediente_seguimiento_count = App\Models\ExpedienteInscripcionSeguimiento::join('ex_insc', 'expediente_inscripcion_seguimiento.cod_ex_insc', '=', 'ex_insc.cod_ex_insc')
                                                ->where('id_inscripcion', $item->id_inscripcion)
                                                ->where('expediente_inscripcion_seguimiento.tipo_seguimiento', 1)
                                                ->where('expediente_inscripcion_seguimiento.expediente_inscripcion_seguimiento_estado', 1)
                                                ->count();
                                    $evaluacion = App\Models\Evaluacion::where('inscripcion_id', $item->id_inscripcion)->first();
                                @endphp
                                    @if($item->persona_idpersona!=null)
                                        <tr>
                                            <td align="center" class="fw-bold">{{ $item->id_inscripcion }}</td>
                                            <td align="center">{{ $item->persona->num_doc }}</td>
                                            <td>
                                                <div class="d-flex align-items-center gap-3">
                                                    {{ $item->persona->nombre_completo }}
                                                    @if ($expediente_seguimiento_count > 0)
                                                        <i class="ri-information-line text-danger fs-5"></i>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                @if ($item->Mencion->mencion == null)
                                                    {{$item->Mencion->SubPrograma->Programa->descripcion_programa}} EN {{$item->Mencion->SubPrograma->subprograma}}
                                                @else
                                                    MENCION EN {{$item->Mencion->mencion}}
                                                @endif
                                            </td>
                                            <td align="center">
                                                @if($evaluacion->p_expediente) {{ number_format($evaluacion->p_expediente).' pts.' }} @else - @endif
                                            </td>
                                            <td align="center">
                                                @if($evaluacion->p_investigacion) {{ number_format($evaluacion->p_investigacion).' pts.' }} @else - @endif
                                            </td>
                                            <td align="center">
                                                @if($evaluacion->p_entrevista) {{ number_format($evaluacion->p_entrevista).' pts.' }} @else - @endif
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                        @if ($inscripcion->count())
                            <div class="mt-2 d-flex justify-content-end text-muted">
                                {{ $inscripcion->links() }}
                            </div>
                        @elseif ($search != null)
                            <div class="text-center p-3 text-muted">
                                <span>No hay resultados para la busqueda "<strong>{{ $search }}</strong>"</span>
                            </div>
                        @else
                            <div class="text-center p-3 text-muted">
                                <span>No hay resultados</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- modal cambiar programa --}}
    {{-- <div wire:ignore.self class="modal fade" id="modalCambiarPrograma" tabindex="-1" aria-labelledby="modalCambiarPrograma" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showModalLabel">Cambiar Programa</h5>
                    <button type="button" wire:click="limpiar()" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form novalidate>
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Programa <span class="text-danger">*</span></label>
                                <select class="form-select @error('programa') is-invalid  @enderror"
                                    wire:model="programa">
                                    <option value="" selected>Seleccione</option>
                                    @if ($programa_model)
                                    @foreach ($programa_model as $item)
                                        <option value="{{ $item->id_programa }}">{{ $item->descripcion_programa }}
                                        </option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="mb-3 col-md-12">
                                <label class="form-label">@if($programa_nombre) {{ $programa_nombre }} @else Esperando Programa... @endif <span class="text-danger">*</span></label>
                                <select class="form-select @error('subprograma') is-invalid  @enderror"
                                    wire:model="subprograma">
                                    <option value="" selected>Seleccione</option>
                                    @if ($subprograma_model)
                                    @foreach ($subprograma_model as $item)
                                        <option value="{{ $item->id_subprograma }}">{{ $item->subprograma }}
                                        </option>
                                    @endforeach
                                    @endif
                                </select>
                                @error('subprograma')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            @if ($subprograma_model)

                            @php
                                $valor = null;
                                if ($mencion_model) {
                                    foreach ($mencion_model as $item){
                                        $valor = $item->mencion;
                                    } 
                                }
                                @endphp

                            @if ($valor)  
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Mención <span class="text-danger">*</span></label>
                                <select class="form-select @error('mencion') is-invalid  @enderror"
                                    wire:model="mencion">
                                    <option value="" selected>Seleccione</option>
                                    @foreach ($mencion_model as $item)
                                        <option value="{{ $item->id_mencion }}">{{ $item->mencion }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('mencion')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>  
                            @endif
                                
                            @endif
                        </div>
                    </form>
                </div>
                <div class="modal-footer col-12 d-flex justify-content-between">
                    <button type="button" wire:click="limpiar()"
                        class="btn btn-secondary btn-label waves-effect waves-light w-md" data-bs-dismiss="modal"><i
                            class="ri-arrow-left-s-line label-icon align-middle fs-16 me-2"></i> Cancelar</button>
                    <button type="button" wire:click="guardarCambioPrograma()"
                        class="btn btn-primary btn-label waves-effect right waves-light w-md"><i
                            class="ri-check-double-fill label-icon align-middle fs-16 ms-2"></i> Guardar</button>
                </div>
            </div>
        </div>
    </div> --}}
</div>