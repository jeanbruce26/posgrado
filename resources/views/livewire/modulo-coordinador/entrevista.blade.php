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
    {{-- <div class="alert alert-info alert-dismissible alert-label-icon label-arrow shadow fade show mb-4" role="alert">
        <i class="ri-information-line label-icon"></i><strong>Recuerde</strong> - Una vez realizado la evaluación, no podrá realizar modificación de las notas ingresadas.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div> --}}
    <div class="alert alert-info alert-dismissible alert-additional shadow fade show" role="alert">
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
            <p class="mb-0">- El puntaje minimo para aprobar la evaluación de entrevista es de {{ number_format($puntaje->puntaje_minimo_entrevista) }} puntos.</p>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive table-card">
                <table class="table align-middle mb-0 table-hover table-nowrap table-bordered">
                    <thead style="background: rgb(199, 208, 219)">
                        <tr align="center">
                            <th class="col-md-6">DIMENSIONES DE EVALUACIÓN</th>
                            <th class="col-md-3">CALIFICACION</th>
                            <th class="col-md-3">NOTA</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $num = 1;
                        @endphp
                        @foreach ($evaluacion_entrevista_titulo as $item)
                        <tr>
                            <td colspan="3" scope="row">
                                <div class="d-flex flex-column">
                                    <strong><span class="me-3">{{$num++}}.</span>{{$item->evaluacion_entrevista_titulo}}</strong>
                                </div>
                            </td>
                        </tr>
                        @php
                            $suma_nota = 0;
                            $evaluacion_entrevista_items = App\Models\EvaluacionEntrevistaItem::where('evaluacion_entrevista_titulo_id',$item->evaluacion_entrevista_titulo_id)->get();
                            $evaluacion_entrevista_items_count = App\Models\EvaluacionEntrevistaItem::where('evaluacion_entrevista_titulo_id',$item->evaluacion_entrevista_titulo_id)->count();
                        @endphp
                            @foreach ($evaluacion_entrevista_items as $item2)
                            <tr>
                                <td scope="row">
                                    <div class="d-flex flex-column">
                                        <div class="ms-3">
                                            <div>
                                                <span class="me-2"><i class="ri-check-line"></i></span>{{$item2->evaluacion_entrevista_item}}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td align="center">
                                    <div>
                                        <button type="button" wire:click="cargarId({{$item2->evaluacion_entrevista_item_id}})" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalNota" @if ($boton != null) disabled @endif>Ingresar Nota</button>
                                    </div>
                                </td>
                                @php
                                    $evaluacion_entrevista_notas = App\Models\EvaluacionEntrevista::where('evaluacion_entrevista_item_id', $item2->evaluacion_entrevista_item_id)->where('evaluacion_id',$evaluacion_id)->first();
                                    if($evaluacion_entrevista_notas){
                                        $suma_nota += $evaluacion_entrevista_notas->evaluacion_entrevista_nota;
                                    }
                                @endphp
                                <td align="center">
                                    @if ($evaluacion_entrevista_notas)
                                    <strong>{{number_format($evaluacion_entrevista_notas->evaluacion_entrevista_nota,0)}}</strong>
                                    @else
                                    <strong>-</strong>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            @php
                                $promedio = $suma_nota / $evaluacion_entrevista_items_count;
                                $total += $promedio;
                            @endphp
                            <tr style="background-color: rgb(255, 255, 255)">
                                <td class="fw-bold text-center"></td>
                                <td class="fw-bold text-center">PROMEDIO</td>
                                <td align="center" class="fw-bold">{{ number_format($promedio,2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot style="background: rgb(199, 208, 219)">
                        <tr>
                            <td colspan="2" class="fw-bold text-center">TOTAL</td>
                            <td align="center" class="fw-bold">{{ number_format($total,2) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- end table responsive -->
        </div>
        <div class="card-footer">
            <div class="text-end">
                <button type="button" wire:click="evaluar({{ $total }})" class="btn btn-primary btn-label waves-effect waves-light w-lg" @if ($boton != null) disabled @endif><i class="ri-save-line label-icon align-middle fs-16 me-2"></i> Evaluar</button>
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
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalNotaLabel">Ingresar Nota</h5>
                        <button type="button" wire:click="limpiar()" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Table Head -->
                        <table class="table align-middle table-nowrap mb-0">
                            <thead  style="background: rgb(199, 208, 219)">
                                <tr align="center">
                                    <th>DIMENSIONES DE EVALUACIÓN</th>
                                    <th>MUY DEFICIENTE (1)</th>
                                    <th>DEFICIENTE (2)</th>
                                    <th>REGULAR (3)</th>
                                    <th>BUENO (4)</th>
                                    <th>EXCELENTE (5)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($evaluacion_entrevista_item)
                                    <tr>
                                        <td><strong>{{$evaluacion_entrevista_item->evaluacion_entrevista_item}}</strong></td>
                                        <td align="center">
                                            <input class="form-check-input @error('nota') is-invalid @enderror" type="radio" name="nota" wire:model="nota" value="1">
                                        </td>
                                        <td align="center">
                                            <input class="form-check-input @error('nota') is-invalid @enderror" type="radio" name="nota" wire:model="nota" value="2">
                                        </td>
                                        <td align="center">
                                            <input class="form-check-input @error('nota') is-invalid @enderror" type="radio" name="nota" wire:model="nota" value="3">
                                        </td>
                                        <td align="center">
                                            <input class="form-check-input @error('nota') is-invalid @enderror" type="radio" name="nota" wire:model="nota" value="4">
                                        </td>
                                        <td align="center">
                                            <input class="form-check-input @error('nota') is-invalid @enderror" type="radio" name="nota" wire:model="nota" value="5">
                                        </td>
                                    </tr>   
                                @endif
                            </tbody>    
                        </table>
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
