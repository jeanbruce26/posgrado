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
                                    <th class="text-center" style="cursor: pointer;" wire:click="sort('nombre_completo')">
                                        <div class="d-flex gap-2 alig-items-center justify-content-center">
                                            <span>Postulante</span>
                                            <div>
                                                @if ($sort_nombre == 'nombre_completo')
                                                    @if ($sort_direccion == 'asc')
                                                        <i class="ri ri-arrow-up-s-line"></i>
                                                    @else
                                                        <i class="ri ri-arrow-down-s-line"></i>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </th>
                                    <th scope="col">Programa</th>
                                    <th class="col-md-1 text-center" style="cursor: pointer;" wire:click="sort('p_expediente')">
                                        <div class="d-flex gap-2 alig-items-center justify-content-center">
                                            <span>Eva. Expediente</span>
                                            <div>
                                                @if ($sort_nombre == 'p_expediente')
                                                    @if ($sort_direccion == 'asc')
                                                        <i class="ri ri-arrow-up-s-line"></i>
                                                    @else
                                                        <i class="ri ri-arrow-down-s-line"></i>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </th>
                                    <th class="col-md-1 text-center" style="cursor: pointer;" wire:click="sort('p_investigacion')">
                                        <div class="d-flex gap-2 alig-items-center justify-content-center">
                                            <span>Eva. Investigacion</span>
                                            <div>
                                                @if ($sort_nombre == 'p_investigacion')
                                                    @if ($sort_direccion == 'asc')
                                                        <i class="ri ri-arrow-up-s-line"></i>
                                                    @else
                                                        <i class="ri ri-arrow-down-s-line"></i>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </th>
                                    <th class="col-md-1 text-center" style="cursor: pointer;" wire:click="sort('p_entrevista')">
                                        <div class="d-flex gap-2 alig-items-center justify-content-center">
                                            <span>Eva. Entrevista</span>
                                            <div>
                                                @if ($sort_nombre == 'p_entrevista')
                                                    @if ($sort_direccion == 'asc')
                                                        <i class="ri ri-arrow-up-s-line"></i>
                                                    @else
                                                        <i class="ri ri-arrow-down-s-line"></i>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($evaluaciones as $item)
                                @php
                                    $expediente_seguimiento_count = App\Models\ExpedienteInscripcionSeguimiento::join('ex_insc', 'expediente_inscripcion_seguimiento.cod_ex_insc', '=', 'ex_insc.cod_ex_insc')
                                                ->where('id_inscripcion', $item->id_inscripcion)
                                                ->where('expediente_inscripcion_seguimiento.tipo_seguimiento', 1)
                                                ->where('expediente_inscripcion_seguimiento.expediente_inscripcion_seguimiento_estado', 1)
                                                ->count();
                                    // $evaluacion = App\Models\Evaluacion::where('inscripcion_id', $item->id_inscripcion)->first();
                                @endphp
                                    @if($item->persona_idpersona!=null)
                                        <tr>
                                            <td align="center" class="fw-bold">{{ $item->id_inscripcion }}</td>
                                            <td align="center">{{ $item->num_doc }}</td>
                                            <td>
                                                <div class="d-flex align-items-center gap-3">
                                                    {{ $item->nombre_completo }}
                                                    @if ($expediente_seguimiento_count > 0)
                                                        <i class="ri-information-line text-danger fs-5"></i>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                @if ($item->mencion == null)
                                                    {{$item->descripcion_programa}} EN {{$item->subprograma}}
                                                @else
                                                    MENCION EN {{$item->mencion}}
                                                @endif
                                            </td>
                                            <td align="center">
                                                @if($item->p_expediente) 
                                                    {{ number_format($item->p_expediente).' pts.' }} 
                                                @else 
                                                    - 
                                                @endif 
                                            </td>
                                            <td align="center">
                                                @if($item->p_investigacion) 
                                                    {{ number_format($item->p_investigacion).' pts.' }} 
                                                @else 
                                                    - 
                                                @endif 
                                            </td>
                                            <td align="center">
                                                @if($item->p_entrevista) 
                                                    {{ number_format($item->p_entrevista).' pts.' }} 
                                                @else 
                                                    - 
                                                @endif 
                                            </td>
                                            <td align="center">
                                                <a href="#modal_evaluacion" wire:click="cargar_eva_expediente({{ $item->id_inscripcion }})" class="link-primary fs-16" data-bs-toggle="modal" data-bs-target="#modal_evaluacion"><i class="ri-pencil-line"></i></a>
                                                <a wire:click="alerta_evaluacion_cero({{ $item->id_inscripcion }})" style="cursor: pointer;" class="link-danger fs-16"><i class="ri-delete-bin-2-line"></i></a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                        @if ($evaluaciones->count())
                            <div class="mt-2 d-flex justify-content-end text-muted">
                                {{ $evaluaciones->links() }}
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
    <div wire:ignore.self class="modal fade" id="modal_evaluacion" tabindex="-1" aria-labelledby="modalCambiarPrograma" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showModalLabel">
                        Editar Evaluacion
                    </h5>
                    <button type="button" wire:click="limpiar()" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="nav nav-tabs mb-3" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" data-bs-toggle="tab" href="#expediente" role="tab" aria-selected="true">
                                Eva. Expediente
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#investigacion" role="tab" aria-selected="false" tabindex="-1">
                                Eva. Investigacion
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#entrevista" role="tab" aria-selected="false" tabindex="-1">
                                Eva. Entrevista
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content  text-muted mb-3">
                        <div class="tab-pane active show" id="expediente" role="tabpanel">
                            <h6 class="mb-4">
                                Evaluacion de Expediente
                            </h6>
                            <div class="px-3">
                                <div class="table-responsive table-card">
                                    <table class="table align-middle mb-0 table-hover table-striped table-nowrap table-bordered">
                                        <thead style="background: rgb(199, 208, 219)">
                                            <tr align="center">
                                                <th scope="col" class="col-md-5">CONCEPTO</th>
                                                <th scope="col" class="col-md-3">PUNTAJE ESPECIFICO</th>
                                                <th scope="col" class="col-md-2">CALIFICACION</th>
                                                <th scope="col" class="col-md-2">PUNTAJE</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $num = 1;
                                            @endphp
                                            @if ($evaluacion_expediente_titulo_model)
                                                @foreach ($evaluacion_expediente_titulo_model as $item)
                                                @php
                                                    $evaluacion_expediente_items = App\Models\EvaluacionExpedienteItem::where('evaluacion_expediente_titulo_id', $item->evaluacion_expediente_titulo_id)->get();
                                                @endphp
                                                <tr>
                                                    <td scope="row">
                                                        <div class="d-flex flex-column">
                                                            <strong><span class="me-2">{{$num++}}</span>{{$item->evaluacion_expediente_titulo}}</strong>
                                                            <div class="ms-3">
                                                            @foreach ($evaluacion_expediente_items as $item2)
                                                            @php
                                                                $evaluacion_expediente_subitems = App\Models\EvaluacionExpedienteSubitem::where('evaluacion_expediente_item_id', $item2->evaluacion_expediente_item_id)->get();
                                                            @endphp
                                                                <div>
                                                                    <span class="me-2"><i class="ri-check-line"></i></span>{{ $item2->evaluacion_expediente_item }}
                                                                    @foreach ($evaluacion_expediente_subitems as $item3)
                                                                    <div>
                                                                        <span class="me-2 ms-3"><i class="ri-check-line"></i></span>{{ $item3->evaluacion_expediente_subitem }}
                                                                    </div>
                                                                    @endforeach
                                                                </div>
                                                            @endforeach
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td align="center">
                                                        <strong>PUNTAJE MAXIMO ({{ number_format($item->evaluacion_expediente_titulo_puntaje_maximo,0) }})</strong>
                                                        <div class="ms-3">
                                                            @foreach ($evaluacion_expediente_items as $item2)
                                                                @if ($item2->evaluacion_expediente_puntaje != null)
                                                                <div>
                                                                    @if ($evaluacion_expediente_subitems->count() > 0)
                                                                        <strong>Maximo {{ number_format($item2->evaluacion_expediente_puntaje,2) }}</strong>
                                                                    @else
                                                                        <span class="me-2"><i class="ri-arrow-right-line"></i></span>{{ number_format($item2->evaluacion_expediente_puntaje,2) }}
                                                                    @endif
                                                                    @foreach ($evaluacion_expediente_subitems as $item3)
                                                                    <div>
                                                                        <span class="me-2"><i class="ri-arrow-right-line"></i></span>{{ number_format($item3->evaluacion_expediente_subitem_puntaje,2) }}
                                                                    </div>
                                                                    @endforeach
                                                                </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                    <td align="center">
                                                        <button type="button" wire:click="cargarId({{$item->evaluacion_expediente_titulo_id}})" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalNota">Ingresar Puntaje</button>
                                                    </td>
                                                    @php
                                                        $evaluacion = App\Models\Evaluacion::where('inscripcion_id', $id_inscripcion)->first();
                                                        $evaluacion_expediente_notas = App\Models\EvaluacionExpediente::where('evaluacion_expediente_titulo_id', $item->evaluacion_expediente_titulo_id)->where('evaluacion_id',$evaluacion->evaluacion_id)->first();
                                                    @endphp
                                                    <td align="center" class="fs-5">
                                                        @if ($evaluacion_expediente_notas)
                                                        <strong>{{number_format($evaluacion_expediente_notas->evaluacion_expediente_puntaje,0)}}</strong>
                                                        @else
                                                        <strong>-</strong>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                        <tfoot style="background: rgb(199, 208, 219)">
                                            <tr>
                                                <td colspan="3" class="fw-bold text-center">TOTAL</td>
                                                <td align="center" class="fw-bold fs-5">{{$total}}</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="investigacion" role="tabpanel">
                            <h6 class="mb-4">
                                Evaluacion de Investigacion
                            </h6>
                            <div class="alert alert-dark shadow text-center" role="alert">
                                <strong>
                                    No es posible cambiar la evaluacion de la investigacion de tema de Tesis.
                                </strong>
                            </div>
                        </div>
                        <div class="tab-pane" id="entrevista" role="tabpanel">
                            <h6 class="mb-4">
                                Evaluacion de Entrevista
                            </h6>
                            <div class="alert alert-dark shadow text-center" role="alert">
                                <strong>
                                    No es posible cambiar la evaluacion de la entrevista.
                                </strong>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="modal-footer col-12 d-flex justify-content-between">
                    <button type="button" wire:click="limpiar()"
                        class="btn btn-secondary btn-label waves-effect waves-light w-md" data-bs-dismiss="modal"><i
                            class="ri-arrow-left-s-line label-icon align-middle fs-16 me-2"></i> Cancelar</button>
                    <button type="button" wire:click="guardarCambioPrograma()"
                        class="btn btn-primary btn-label waves-effect right waves-light w-md"><i
                            class="ri-check-double-fill label-icon align-middle fs-16 ms-2"></i> Guardar</button>
                </div> --}}
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="modalNota" tabindex="-1" role="dialog" aria-labelledby="modalNotaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title text-uppercase" id="modalNotaLabel">Ingresar su puntaje</h5>
                        <button type="button" wire:click="limpiar()" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex align-items-center">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="puntaje" class="col-form-label">Puntaje</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="number" class="form-control @error('puntaje') is-invalid @enderror" wire:model="puntaje">
                                    @error('puntaje')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="d-flex justify-content-between w-100">
                            <button type="button" wire:click="cancelar_modal_puntaje()" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" wire:click="agregarNota()" class="btn btn-success">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>