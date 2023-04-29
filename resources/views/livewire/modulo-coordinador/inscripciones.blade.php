<div>
    <div class="card">
        <div class="p-2 d-flex justify-content-between align-items-center">
            <!-- Buttons with Label -->
            <a href="{{route('coordinador.index')}}" type="button" class="btn btn-label w-md waves-effect waves-light fw-bold" style="background: rgb(151, 151, 151); color: white"><i class="ri-arrow-left-s-line label-icon align-middle fs-16 me-2"></i> Regresar</a>
            <div class="d-flex align-items-center text-center mt-2 fw-bold">
                @if ($mencion->mencion == null)
                <h5>
                    {{$mencion->descripcion_programa}} EN {{$mencion->subprograma}}
                </h5>
                @else
                <h5>
                    {{$mencion->descripcion_programa}} EN {{$mencion->subprograma}} <br>
                    CON MENCION EN {{$mencion->mencion}}
                </h5>
                @endif
            </div>
            @if($inscripciones_count != $evaluaciones_count)
            <button type="button" class="btn btn-primary btn-animation waves-effect waves-light w-md fw-bold" data-text="Generar acta de evaluación" disabled><span>Generar acta de evaluación</span></button>
            @else
                @if ($mencion->descripcion_programa == 'DOCTORADO')
                <a target="_blank" href="{{route('coordinador.reportes.doctorado',$id_mencion)}}" type="button" class="btn btn-primary btn-animation waves-effect waves-light w-md fw-bold" data-text="Generar acta de evaluación"><span>Generar acta de evaluación</span></a>
                @else
                <a target="_blank" href="{{route('coordinador.reportes.maestria',$id_mencion)}}" type="button" class="btn btn-primary btn-animation waves-effect waves-light w-md fw-bold" data-text="Generar acta de evaluación"><span>Generar acta de evaluación</span></a>
                @endif
            @endif
        </div>
    </div>

    @if ($mencion->descripcion_programa === 'DOCTORADO')
    <div class="alert alert-info alert-top-border alert-dismissible shadow fade show" role="alert">
        <i class="ri-information-line me-3 align-middle fs-18 text-info"></i>
        <strong>Recuerde: La nota aprobatoria para ser admitido es de 40 puntos totales (EVA. EXPEDIENTE + ENTREVISTA + TEMA DE TESIS).
Una vez realizado la evaluación, no podrá realizar modificación de las notas ingresadas.</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @else
    <div class="alert alert-info alert-top-border alert-dismissible shadow fade show" role="alert">
        <i class="ri-information-line me-3 align-middle fs-18 text-info"></i>
        <strong>Recuerde: La nota aprobatoria para ser admitido es de 20 puntos totales (EVA. EXPEDIENTE + ENTREVISTA). 
        Una vez realizado la evaluación, no podrá realizar modificación de las notas ingresadas.</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card mt-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="text-muted d-flex align-items-center mb-1">
                    <label class="col-form-label me-2">Mostrar</label>
                    <select class="form-select text-muted" wire:model="mostrar" aria-label="Default select example">
                        <option value="50" selected>50</option>
                        <option value="100">100</option>
                        <option value="200">200</option>
                        <option value="300">300</option>
                    </select>
                </div>
                <div class="w-25 mb-1">
                    <input class="form-control text-muted" type="search" wire:model="search" placeholder="Buscar...">
                </div>
            </div>
            <div class="table-responsive table-card">
                <table class="table align-middle mb-0 table-hover table-striped table-nowrap table-bordered">
                    <thead style="background: rgb(199, 208, 219)">
                        <tr align="center">
                            <th scope="col" class="col-md-1">ID</th>
                            <th scope="col">INSCRITO</th>
                            <th scope="col" class="col-md-1">DOCUMENTO</th>
                            <th scope="col" class="col-md-2">EVA. EXPEDIENTE</th>
                            @if ($mencion->descripcion_programa == 'DOCTORADO')
                            <th scope="col" class="col-md-2">TEMA TESIS</th>
                            @endif
                            <th scope="col" class="col-md-2">EVA. ENTREVISTA</th>
                            <th scope="col" class="col-md-1">ESTADO</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inscripciones as $item)
                        @php
                            $evalu = App\Models\Evaluacion::where('inscripcion_id', $item->id_inscripcion)->first();
                            $expediente_seguimiento_count = App\Models\ExpedienteInscripcionSeguimiento::join('ex_insc', 'expediente_inscripcion_seguimiento.cod_ex_insc', '=', 'ex_insc.cod_ex_insc')
                                                ->where('id_inscripcion', $item->id_inscripcion)
                                                ->where('expediente_inscripcion_seguimiento.tipo_seguimiento', 1)
                                                ->where('expediente_inscripcion_seguimiento.expediente_inscripcion_seguimiento_estado', 1)
                                                ->count();
                        @endphp
                        <tr>
                            <td scope="row" class="fw-bold" align="center">{{$item->id_inscripcion}}</td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    {{$item->apell_pater}} {{$item->apell_mater}}, {{$item->nombres}}
                                    @if ($expediente_seguimiento_count > 0)
                                        <i class="ri-information-line text-danger fs-5" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Presento Declaración Jurada"></i>
                                    @endif
                                </div>
                            </td>
                            <td align="center">{{$item->num_doc}}</td>
                            <td align="center" class="fs-6">
                                @if ($evalu)
                                    @if ($evalu->p_expediente != null)
                                    <button wire:click="evaExpe({{$item->id_inscripcion}})" type="button" class="btn btn-sm btn-primary btn-label waves-effect rounded-pill w-md waves-light"><i class="ri-file-text-line label-icon align-middle fs-16"></i> Evaluar</button>
                                    <strong class="ms-3">{{ number_format($evalu->p_expediente, 0) }} pts.</strong> 
                                    @else
                                    <button wire:click="evaExpe({{$item->id_inscripcion}})" type="button" class="btn btn-sm btn-primary btn-label waves-effect rounded-pill w-md waves-light"><i class="ri-file-text-line label-icon align-middle fs-16"></i> Evaluar</button>
                                    @endif
                                @else
                                <button wire:click="evaExpe({{$item->id_inscripcion}})" type="button" class="btn btn-sm btn-primary btn-label waves-effect rounded-pill w-md waves-light"><i class="ri-file-text-line label-icon align-middle fs-16"></i> Evaluar</button>
                                @endif
                            </td>
                            @php $tipo = 1; @endphp
                            @if ($mencion->descripcion_programa == 'DOCTORADO')
                            @php $tipo = 2; @endphp
                            <td align="center" class="fs-6">
                                @if ($evalu)
                                    @if ($evalu->p_investigacion != null)
                                    <button wire:click="evaInvestigacion({{$item->id_inscripcion}})" type="button" class="btn btn-sm btn-primary btn-label waves-effect rounded-pill w-md waves-light"><i class="ri-file-text-line label-icon align-middle fs-16"></i> Evaluar</button>
                                    <strong class="ms-3">{{ number_format($evalu->p_investigacion, 0) }} pts.</strong> 
                                    @else
                                    <button wire:click="evaInvestigacion({{$item->id_inscripcion}})" type="button" class="btn btn-sm btn-primary btn-label waves-effect rounded-pill w-md waves-light"><i class="ri-file-text-line label-icon align-middle fs-16"></i> Evaluar</button>
                                    @endif
                                @else
                                <button wire:click="evaInvestigacion({{$item->id_inscripcion}})" type="button" class="btn btn-sm btn-primary btn-label waves-effect rounded-pill w-md waves-light"><i class="ri-file-text-line label-icon align-middle fs-16"></i> Evaluar</button>
                                @endif
                            </td>
                            @else
                            @php $tipo = 1; @endphp
                            @endif
                            <td align="center" class="fs-6">
                                @if ($evalu)
                                    @if ($evalu->p_entrevista != null)
                                    <button wire:click="evaEntre({{$item->id_inscripcion}},{{ $tipo }})" type="button" class="btn btn-sm btn-primary btn-label waves-effect rounded-pill w-md waves-light"><i class="ri-file-text-line label-icon align-middle fs-16"></i> Evaluar</button>
                                    <strong class="ms-3">{{ number_format($evalu->p_entrevista, 0) }} pts.</strong> 
                                    @else
                                    <button wire:click="evaEntre({{$item->id_inscripcion}},{{ $tipo }})" type="button" class="btn btn-sm btn-primary btn-label waves-effect rounded-pill w-md waves-light"><i class="ri-file-text-line label-icon align-middle fs-16"></i> Evaluar</button>
                                    @endif
                                @else
                                <button wire:click="evaEntre({{$item->id_inscripcion}},{{ $tipo }})" type="button" class="btn btn-sm btn-primary btn-label waves-effect rounded-pill w-md waves-light"><i class="ri-file-text-line label-icon align-middle fs-16"></i> Evaluar</button>
                                @endif
                            </td>
                            <td align="center">
                                @if ($evalu)
                                    @if ($evalu->evaluacion_estado == 1)
                                    <span class="badge text-bg-warning"><i class="ri-error-warning-line label-icon align-middle fs-12 me-1"></i>Por Evaluar</span>
                                    @endif
                                    @if ($evalu->evaluacion_estado == 2)
                                    <span class="badge text-bg-danger"><i class="ri-error-warning-line label-icon align-middle fs-12 me-1"></i>Evaluacion Jalada</span>
                                    @endif
                                    @if ($evalu->evaluacion_estado == 3)
                                    <span class="badge text-bg-success"><i class="ri-check-double-line label-icon align-middle fs-12 me-1"></i>Evaluado</span>
                                    @endif
                                @else
                                <span class="badge text-bg-warning"><i class="ri-error-warning-line label-icon align-middle fs-12 me-1"></i>Por Evaluar</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- end table -->
                @if ($inscripciones->count())
                <div class="mt-3 mx-3">
                    <div class="d-flex justify-content-end text-muted">
                        <div>
                            {{$inscripciones->links()}}
                        </div>
                    </div>
                </div>
                @else
                <div class="text-center p-3 text-muted">
                    <span>No hay resultados para la busqueda "<strong>{{$search}}</strong>" en la pagina <strong>{{$page}}</strong> al mostrar <strong>{{$mostrar}}</strong> por pagina</span>
                </div>
                @endif
            </div>
            <!-- end table responsive -->
        </div>
    </div>
</div>
