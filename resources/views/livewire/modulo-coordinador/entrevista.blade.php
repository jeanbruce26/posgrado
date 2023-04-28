<div>
    <div class="card">
        <div class="p-2 d-flex justify-content-between align-items-center">
            <a href="{{route('coordinador.inscripciones',$inscripcion->id_mencion)}}" type="button" class="btn btn-label w-md waves-effect waves-light fw-bold" style="background: rgb(151, 151, 151); color: white"><i class="ri-arrow-left-s-line label-icon align-middle fs-16 me-2"></i> Regresar</a>
            <h4 class="mt-2 text-center fw-bold">
                EVALUACIÓN DE LA ENTREVISTA PERSONAL
            </h4>
            <div class="w-md"></div>
        </div>
    </div>
    <div class="card">
        <div class="p-2 d-flex justify-content-between align-items-center mx-3">
            <span class="fs-5">NOMBRE: <strong>{{$inscripcion->Persona->apell_pater}} {{$inscripcion->Persona->apell_mater}}, {{$inscripcion->Persona->nombres}}</strong></span>
            <span class="fs-5">
                FECHA: 
                <strong>
                    @if ($evaluacion_data->fecha_entrevista)
                        {{date('d/m/Y', strtotime($evaluacion_data->fecha_entrevista))}}
                    @else
                        {{date('d/m/Y', strtotime($fecha))}}
                    @endif
                </strong>
            </span>
        </div>
    </div>
    {{-- <div class="alert alert-info alert-dismissible alert-additional shadow fade show" role="alert">
        <div class="alert-body">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <div class="d-flex">
                <div class="flex-shrink-0 me-3">
                    <i class="ri-information-line fs-16 align-middle"></i>
                </div>
                <div class="flex-grow-1">
                    <h5 class="alert-heading">Recuerda</h5>
                    <p class="mb-0">Una vez realizado la evaluación, no podrá realizar modificación de las notas ingresadas. </p>
                </div>
            </div>
        </div>
        <div class="alert-content">
            @if ($tipo_evaluacion_id == 1)
            <p class="mb-1">
                - El puntaje maximo para la evaluación de entrevista de maestria es de {{ number_format($puntaje_model->puntaje_maximo_entrevista_maestria) }} puntos.
            </p>
            @else
            <p class="mb-1">
                - El puntaje maximo para la evaluación de entrevista de doctorado es de {{ number_format($puntaje_model->puntaje_maximo_expediente_doctorado) }} puntos.
            </p>
            @endif
        </div>
    </div> --}}
    <div class="row">
        @foreach ($expedientes as $item)  
            @php
                $expediente_tipo_evaluacion = App\Models\ExpedienteTipoEvaluacion::where('tipo_expediente_evaluacion', 3)->where('cod_exp', $item->cod_exp)->first();
            @endphp
            @if ($expediente_tipo_evaluacion)
                <div class="col-md-4">
                    <div class="card card-primary">
                        <div class="p-3">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <i class="ri-book-3-line label-icon align-middle fs-3"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="card-text text-white"><span class="fw-medium">{{$expediente_tipo_evaluacion->expediente->tipo_doc}}.</span></h5>
                                </div>
                            </div>
                        </div>
                        <div class="pb-3 mx-3">
                            <div class="text-center">
                                <a target="_blank" href="{{asset($item->nom_exped)}}" class="link-light fw-bold">Abrir <i class="ri-arrow-right-s-line align-middle lh-1"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive table-card">
                <table class="table align-middle mb-0 table-hover table-nowrap table-bordered">
                    <thead style="background: rgb(199, 208, 219)">
                        <tr align="center">
                            <th class="col-md-6">DIMENSIONES DE EVALUACIÓN</th>
                            <th class="col-md-2">PUNTAJE ESPECIFICO</th>
                            <th class="col-md-2">CALIFICACION</th>
                            <th class="col-md-2">PUNTAJE</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $num = 1;
                        @endphp
                        @foreach ($evaluacion_entrevista_item as $item)
                        <tr>
                            <td scope="row">
                                <span class="me-3">{{$num++}}.</span>{{$item->evaluacion_entrevista_item}}
                            </td>
                            <td align="center">
                                <strong>PUNTAJE MAXIMO ({{ number_format($item->evaluacion_entrevista_item_puntaje,0) }})</strong>
                            </td>
                            <td align="center">
                                <div>
                                    {{-- <button type="button" wire:click="cargarId({{$item->evaluacion_entrevista_item_id}})" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalNota" @if ($boton != null) disabled @endif>Ingresar Puntaje</button> --}}
                                    <button type="button" wire:click="cargarId({{$item->evaluacion_entrevista_item_id}})" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalNota">Ingresar Puntaje</button>
                                </div>
                            </td>
                            <td align="center" class="fs-5">
                                @php
                                    $evaluacion_entrevista_notas = App\Models\EvaluacionEntrevista::where('evaluacion_entrevista_item_id', $item->evaluacion_entrevista_item_id)->where('evaluacion_id',$evaluacion_id)->first();
                                @endphp
                                @if ($evaluacion_entrevista_notas)
                                <strong>{{number_format($evaluacion_entrevista_notas->evaluacion_entrevista_puntaje,0)}}</strong>
                                @else
                                <strong>-</strong>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot style="background: rgb(199, 208, 219)">
                        <tr>
                            <td colspan="3" class="fw-bold text-center">TOTAL</td>
                            <td align="center" class="fw-bold fs-5">{{ number_format($total,0) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- end table responsive -->
        </div>
        <div class="card-footer">
            <div class="mb-3">
                <form novalidate autocomplete="off">
                    <!-- Example Textarea -->
                    <div>
                        <label class="form-label">Ingrese observación</label>
                        <textarea class="form-control" rows="3" wire:model="observacion" ></textarea>
                    </div>
                </form>
            </div>
            <div class="text-end">
                {{-- <button type="button" wire:click="evaluarPaso2()" class="btn btn-primary btn-label waves-effect waves-light w-lg" @if ($boton != null) disabled @endif><i class="ri-save-line label-icon align-middle fs-16 me-2"></i> Evaluar</button> --}}
                <button type="button" wire:click="evaluarPaso2()" class="btn btn-primary btn-label waves-effect waves-light w-lg"><i class="ri-save-line label-icon align-middle fs-16 me-2"></i> Evaluar</button>
            </div>
        </div>
    </div>
    {{-- Modal --}}
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
                            <button type="button" wire:click="limpiar()" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" wire:click="agregarNota()" class="btn btn-success">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
