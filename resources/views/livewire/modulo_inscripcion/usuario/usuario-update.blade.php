<div>
    <div class="tab-content">
        <div class="tab-pane fade show active">
            <div class="card">
                <div class="px-3 py-1">
                    <h4 class="mt-2 fw-bold">Bienvenido {{$nombre}}</h4>
                </div>
            </div>
            <div class="card">
                <div class="card-header d-flex fw-bold justify-content-star align-items-center fs-5">
                    Documentos ingresados en el proceso de inscripción
                </div>
                
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle table-nowrap mb-0">
                            <thead>
                                <tr align="center" style="background-color: rgb(179, 197, 245)">
                                    <th class="col-md-4">Documento</th>
                                    <th class="col-md-1">Fecha</th>
                                    <th class="col-md-1">Estado</th>
                                    <th class="col-md-1">Archivo</th>
                                    <th class="col-md-1">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $expediente_inscripcion = App\Models\ExpedienteInscripcion::where('id_inscripcion', auth('usuarios')->user()->id_inscripcion)->get();
                                    $value = 0;
                                @endphp
                                @foreach ($expediente_model as $item)
                                    @foreach ($expediente_inscripcion as $item2)
                                        @if($item->cod_exp == $item2->expediente_cod_exp)
                                            <tr>
                                                <td>{{$item->tipo_doc}}</td>
                                                <td align="center">{{date('d/m/Y', strtotime($item2->fecha_entre))}}</td>
                                                <td align="center" class="text-success"><i class="ri-checkbox-circle-line fs-17 align-middle"></i> {{$item2->estado}}</td>
                                                <td align="center">
                                                    <a target="_blank" href="{{asset('Admision 2022 - I/'.$item2->id_inscripcion.'/'.$item2->nom_exped)}}" class="ms-2"><i style="color:rgb(78, 78, 78)" class="bx bxs-file-pdf bx-sm bx-burst-hover"></i></a>
                                                </td>
                                                <td align="center">
                                                    @if ($final >= $fecha)
                                                    <a href="#modalExpediente" wire:click="cargarCodExpIns({{$item2->cod_ex_insc}})" type="button" class="link-success fs-15" data-bs-toggle="modal" data-bs-target="#modalExpediente"><i class="bx bx-edit bx-sm bx-burst-hover"></i></a>
                                                    @else
                                                    <span><strong>-</strong></span>
                                                    @endif
                                                </td>
                                            </tr>
                                            @php
                                                $value=1;
                                            @endphp
                                        @endif
                                    @endforeach
                                    @if($value != 1)
                                        <tr>
                                            <td>{{$item->tipo_doc}}</td>
                                            <td align="center"><p>-</p></td>
                                            <td align="center" class="text-danger"><i class="ri-close-circle-line fs-17 align-middle"></i> No enviado</td>
                                            <td align="center"><p>-</p></td>
                                            <td align="center">
                                                <a href="#modalExpediente" type="button" wire:click="cargarCodExpeAdd({{ $item->cod_exp }})" class="link-success fs-15" data-bs-toggle="modal" data-bs-target="#modalExpediente"><i class='bx bx-add-to-queue bx-sm bx-burst-hover text-info'></i></a>
                                            </td>
                                        </tr>
                                    @endif
                                    @php
                                        $value=0;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div> 
                
                    <div class="d-flex align-items-start justify-content-between gap-3 mt-4">
                        <a href="{{route('usuarios.index')}}" class="btn btn-secondary text-decoration-none btn-label"><i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i>Regresar</a>                
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal --}}
    <div wire:ignore.self class="modal fade" id="modalExpediente" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalExpediente" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showModalLabel">{{ $titulo }} - {{$nombre}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <form novalidate>
                    <div class="modal-body">
                        @if ($modo == 2)
                        <div>
                            <span><strong>Previsualización del documento existente</strong></span>
                            <table class="table mt-2 table-hover align-middle">
                                <thead>
                                    <tr style="background-color: rgb(179, 197, 245)">
                                        <th>DOCUMENTO</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                    
                                <tbody>
                                    @if ($expediente_inscripcion_model)
                                    <tr>
                                        <td>
                                            <label class="form-label">{{ $expediente_inscripcion_model->Expediente->tipo_doc }}</label>
                                        </td>
                                        <td class="col-md-2">
                                            <a target="_blank" href="{{asset('Admision 2022 - I/'.$expediente_inscripcion_model->id_inscripcion.'/'.$expediente_inscripcion_model->nom_exped)}}" class="ms-2 d-flex align-items-center bx-burst-hover"><i style="color:rgb(78, 78, 78)" class="bx bxs-file-pdf bx-sm bx-burst-hover"></i> <strong class="ms-2 text-dark">Descargar</strong></a>
                                        </td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        @endif
                        <span><strong>Formulario para ingresar nuevo documento</strong></span>
                        <table class="table mt-2 table-hover align-middle">
                            <thead>
                                <tr style="background-color: rgb(179, 197, 245)">
                                    <th>DOCUMENTO</th>
                                    <th>SELECCIONAR</th>
                                    <th class="col-1">FORMATO</th>
                                </tr>
                            </thead>
                                
                            <tbody>
                                <tr>
                                    <td>
                                        <label class="form-label mt-3">{{ $expediente_nombre }}</label>
                                    </td>
                                    <td class="col-md-6">
                                        <input type="file" class="mt-2 mb-2 form-control form-control-sm btn btn-primary @error('expediente') is-invalid  @enderror" style="color:azure" wire:model="expediente" accept=".pdf" id="upload{{ $iteration }}">
                                        @error('expediente')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </td>
                                    <td align="center">
                                        <label class="form-label mt-3">PDF</label>
                                    </td> 
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="modal-footer col-12 d-flex justify-content-between">
                        <button type="button" wire:click="limpiar()"
                            class="btn btn-secondary btn-label waves-effect waves-light w-md" data-bs-dismiss="modal"><i
                                class="ri-arrow-left-s-line label-icon align-middle fs-16 me-2"></i> Cancelar</button>
                        <button type="button" wire:click="guardarExpediente()"
                            class="btn btn-primary btn-label waves-effect right waves-light w-md"><i
                                class="ri-check-double-fill label-icon align-middle fs-16 ms-2"></i> Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Modal --}}
</div>