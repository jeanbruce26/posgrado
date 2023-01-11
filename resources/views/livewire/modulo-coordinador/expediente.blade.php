<div>
    <div class="card">
        <div class="p-2 d-flex justify-content-between align-items-center">
            <a href="{{route('coordinador.inscripciones',$inscripcion->id_mencion)}}" type="button" class="btn btn-label w-md waves-effect waves-light fw-bold" style="background: rgb(151, 151, 151); color: white"><i class="ri-arrow-left-s-line label-icon align-middle fs-16 me-2"></i> Regresar</a>
            <h4 class="mt-2 text-center fw-bold">
                EVALUACIÓN DE EXPEDIENTE DEL POSTULANTE
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
                    @if ($evaluacion_data->fecha_expediente)
                        {{date('d/m/Y', strtotime($evaluacion_data->fecha_expediente))}}
                    @else
                        {{date('d/m/Y', strtotime($fecha))}}
                    @endif
                </strong>
            </span>
        </div>
    </div>
    <div class="alert alert-info alert-dismissible alert-label-icon label-arrow shadow fade show mb-4" role="alert">
        <i class="ri-information-line label-icon"></i><strong>Recuerde</strong> - Una vez realizado la evaluación, no podrá realizar modificación de las notas ingresadas.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @php
        $expedientes = App\Models\ExpedienteInscripcion::where('id_inscripcion', $inscripcion->id_inscripcion)->get();
    @endphp
    <div class="row">
        @foreach ($expedientes as $item)       
            <div class="col-md-4">
                <div class="card card-primary">
                    <div class="p-3">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="ri-book-3-line label-icon align-middle fs-3"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="card-text text-white"><span class="fw-medium">{{$item->Expediente->tipo_doc}}.</span></h5>
                            </div>
                        </div>
                    </div>
                    <div class="pb-3 mx-3">
                        <div class="text-center">
                            <a target="_blank" href="{{asset($item->nom_exped)}}" class="link-light fw-bold">Abrir <i class="ri-arrow-right-s-line align-middle lh-1"></i></a>
                        </div>
                    </div>
                </div>
            </div><!-- end col -->
        @endforeach
    </div>
    @if (session()->has('message'))
        <div class="alert alert-success alert-border-left alert-dismissible fade shadow show mb-3" role="alert">
            <i class="ri-check-double-line me-3 align-middle"></i> <strong> {{ session('message') }} </strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <div class="table-responsive table-card">
                <table class="table align-middle mb-0 table-hover table-striped table-nowrap table-bordered">
                    <thead style="background: rgb(199, 208, 219)">
                        <tr align="center">
                            <th scope="col" class="col-md-5">CONCEPTO</th>
                            <th scope="col" class="col-md-3">PUNTAJE ESPECIFICO</th>
                            <th scope="col" class="col-md-2">CALIFICACION</th>
                            <th scope="col" class="col-md-2">NOTA</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $num = 1;
                        @endphp
                        @foreach ($evaluacion_expediente as $item)
                        @php
                            $evaluacion_expediente_items = App\Models\EvaluacionExpedienteItem::where('evaluacion_expediente_titulo_id', $item->evaluacion_expediente_titulo_id)->get();
                        @endphp
                        <tr>
                            <td scope="row">
                                <div class="d-flex flex-column">
                                    <strong><span class="me-2">{{$num++}}</span>{{$item->evaluacion_expediente_titulo}}</strong>
                                    <div class="ms-3">
                                    @foreach ($evaluacion_expediente_items as $item2)
                                        <div>
                                            <span class="me-2"><i class="ri-check-line"></i></span>{{$item2->evaluacion_expediente_item}}
                                        </div>
                                    @endforeach
                                    </div>
                                </div>
                            </td>
                            <td align="center">
                                <strong>PUNTAJE MAXIMO ({{$item->evaluacion_expediente_titulo_puntaje_maximo}})</strong>
                                <div class="ms-3">
                                    @foreach ($evaluacion_expediente_items as $item2)
                                        @if ($item2->evaluacion_expediente_puntaje != null)
                                        <div>
                                            <span class="me-2"><i class="ri-arrow-right-line"></i></span>{{number_format($item2->evaluacion_expediente_puntaje,2)}}
                                        </div>
                                        @endif
                                    @endforeach
                                </div>
                            </td>
                            <td align="center">
                                <div>
                                    <button type="button" wire:click="cargarId({{$item->evaluacion_expediente_titulo_id}})" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalNota" @if ($boton != null) disabled @endif>Ingresar Nota</button>
                                </div>
                            </td>
                            @php
                                $evaluacion_expediente_notas = App\Models\EvaluacionExpediente::where('evaluacion_expediente_titulo_id', $item->evaluacion_expediente_titulo_id)->where('evaluacion_id',$evaluacion_id)->first();
                            @endphp
                            <td align="center">
                                @if ($evaluacion_expediente_notas)
                                <strong>{{number_format($evaluacion_expediente_notas->evaluacion_expediente_nota,0)}}</strong>
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
                            <td align="center" class="fw-bold">{{$total}}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- end table responsive -->
        </div>
        <div class="card-footer">
            <div class="text-end">
                <button type="button" wire:click="evaluar()" class="btn btn-primary btn-label waves-effect waves-light w-lg" @if ($boton != null) disabled @endif><i class="ri-save-line label-icon align-middle fs-16 me-2"></i> Evaluar</button>
            </div>
        </div>
    </div>
    @if (session()->has('danger'))
        <div class="alert alert-danger alert-border-left alert-dismissible fade shadow show mb-4" role="alert">
            <i class="ri-error-warning-line me-3 align-middle"></i> <strong> {{ session('danger') }} </strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    {{-- Modal --}}
    <div wire:ignore.self class="modal fade" id="modalNota" tabindex="-1" role="dialog" aria-labelledby="modalNotaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalNotaLabel">Ingresar Nota</h5>
                        <button type="button" wire:click="limpiar()" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex align-items-center">
                            <div class="text-muted">Nota: </div>
                            <div class="text-center ms-4">
                                <input type="number" class="form-control @error('nota') is-invalid @enderror" wire:model="nota">
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