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
                                                <td style="white-space: initial;">{{$item->tipo_doc}}</td>
                                                <td align="center">{{date('d/m/Y', strtotime($item2->fecha_entre))}}</td>
                                                <td align="center" class="text-success"><i class="ri-checkbox-circle-line fs-17 align-middle"></i> {{$item2->estado}}</td>
                                                <td align="center">
                                                    <a target="_blank" href="{{asset($item2->nom_exped)}}" class="ms-2"><i style="color:rgb(78, 78, 78)" class="bx bxs-file-pdf bx-sm bx-burst-hover"></i></a>
                                                </td>
                                                <td align="center">
                                                    {{-- @if ($final >= $fecha) --}}
                                                    <a href="#modalExpediente" wire:click="cargarCodExpIns({{$item2->cod_ex_insc}})" type="button" class="link-success fs-15" data-bs-toggle="modal" data-bs-target="#modalExpediente"><i class="bx bx-edit bx-sm bx-burst-hover"></i></a>
                                                    {{-- @else
                                                    <span><strong>-</strong></span>
                                                    @endif --}}
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
        <div class="modal-dialog modal-lg">
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
                            <div>
                                <a target="_blank" href="{{asset($expediente_inscripcion_model->nom_exped)}}" class="mt-2 mb-4 d-flex align-items-center"><i style="color:rgb(78, 78, 78)" class="bx bxs-file-pdf bx-sm"></i> <strong class="ms-2 text-dark" style="text-decoration: underline">Descargar</strong></a>
                            </div>
                        </div>
                        @endif
                        <div class="d-flex justify-content-between mt-2">
                            <label class="form-label">{{ $expediente_nombre }} <span class="text-danger">(obligatorio)</span>
                            </label>
                            <span class="text-danger">
                                (.pdf)
                            </span>
                        </div>
                        <input type="file" class="form-control @error('expediente') is-invalid  @enderror" wire:model="expediente" accept=".pdf" id="upload{{ $iteration }}">
                        <p class="text-muted mt-1">
                            Max. 10MB
                        </p>
                        @error('expediente')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="modal-footer col-12 d-flex justify-content-between">
                        <button type="button" wire:click="limpiar()"
                            class="btn btn-secondary btn-label waves-effect waves-light w-md" data-bs-dismiss="modal"><i
                                class="ri-arrow-left-s-line label-icon align-middle fs-16 me-2"></i> Cancelar</button>
                        <button type="button" wire:click="guardarExpediente()" @if($expediente===null) disabled @endif
                            class="btn btn-primary btn-label waves-effect right waves-light w-md"><i
                                class="ri-check-double-fill label-icon align-middle fs-16 ms-2"></i> Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Modal --}}
</div>