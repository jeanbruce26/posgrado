<div>
    <div class="tab-content">
        <div class="tab-pane fade show active">
            <div class="card">
                <h4 class="card-header d-flex fw-bold justify-content-star align-items-center">Bienvenido {{$nombre}}</h4>
                <div class="card-body">
                    <h5 class="d-flex justify-content-star align-items-center mt-2">Usted tiene expedientes pendientes por subir a la plataforma, por favor<a href="" class="mx-2 fw-bold" hover="text-decor"> presione aquí </a>para ingresar.</h5>
                </div>
            </div>
            <div class="card-text px-5 my-2 d-flex justify-content-around row g-3">
                <div class="col-1"></div>
                <div class="col-3">
                    <div class="card card-body text-center" style="background-color: #ebf7ff">
                        <div class="avatar-sm mx-auto mb-3">
                            <div class="avatar-title bg-soft-primary text-primary fs-17 rounded">
                                <i class="ri-newspaper-line fs-1"></i>
                            </div>
                        </div>
                        <h4 class="card-title mb-3"><strong>Ficha de Inscripción</strong></h4>
                        <a target="_blank" href="{{asset('Admision 2022 - I/'.auth('usuarios')->user()->id_inscripcion.'/'.auth('usuarios')->user()->inscripcion)}}" class="btn btn-success">Descargar</a>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card card-body" style="background-color: #ebf7ff">
                        <div class="avatar-sm mx-auto mb-3">
                            <div class="avatar-title bg-soft-primary text-primary fs-17 rounded">
                                <i class="ri-folder-5-line fs-1"></i>
                            </div>
                        </div>
                        <h4 class="card-title mb-3 text-center"><strong>Expedientes</strong></h4>
                        <a href="#detalleModal" type="button" data-bs-toggle="modal" data-bs-target="#showModal" class="btn btn-success">Ver detalle</a>

                        {{-- Modal Show --}}
                        <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="showModal" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                <div class="modal-content">
                                    @php
                                        $expInsc = App\Models\ExpedienteInscripcion::where('id_inscripcion', auth('usuarios')->user()->id_inscripcion)->get();
                                        $value = 0;
                                    @endphp
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="showModalLabel">Expedientes de Inscripción - {{$nombre}}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-2">
                                            <table class="table align-middle table-nowrap mb-0">
                                                <thead class="table-light">
                                                    <tr class="col-sm-12">
                                                        <th class="col-md-4">Documento</th>
                                                        <th class="col-md-1">Fecha</th>
                                                        <th class="col-md-3">Observación</th>
                                                        <th class="col-md-1">Estado</th>
                                                        <th class="col-md-1">Archivo</th>
                                                    </tr>
                                                </thead>
                                    
                                                <tbody>
                                                    @foreach ($expediente as $exp)
                                                        @foreach ($expInsc as $expInscripcion)
                                                            @if($exp->cod_exp == $expInscripcion->expediente_cod_exp)
                                                                <tr>
                                                                    <td>{{$expInscripcion->nom_exped}}</td>
                                                                    <td>{{date('d-m-Y', strtotime($expInscripcion->fecha_entre))}}</td>
                                                                    @if($expInscripcion->observacion == null)
                                                                        <td>Sin Observación</td>
                                                                    @else
                                                                        <td>{{$expInscripcion->observacion}}</td>
                                                                    @endif
                                                                    <td class="text-success"><i class="ri-checkbox-circle-line fs-17 align-middle"></i> {{$expInscripcion->estado}}</td>
                                                                    <td>
                                                                        <a target="_blank" href="{{asset('Admision 2022 - I/'.$expInscripcion->id_inscripcion.'/'.$expInscripcion->nom_exped)}}" class="ms-2"><i style="color:rgb(78, 78, 78)" class="bx bxs-file-pdf bx-sm bx-burst-hover"></i></a>
                                                                    </td>
                                                                </tr>
                                                                @php
                                                                    $value=1;
                                                                @endphp
                                                            @endif
                                                        @endforeach
                                                        @if($value != 1)
                                                            <tr>
                                                                <td>{{$exp->tipo_doc}}</td>
                                                                <td><p class="ms-4">-</p></td>
                                                                <td><p class="ms-5">-</p></td>
                                                                <td class="text-danger"><i class="ri-close-circle-line fs-17 align-middle"></i> No enviado</td>
                                                                <td><p class="ms-3">-</p></td>
                                                            </tr>
                                                        @endif
                                                        @php
                                                            $value=0;
                                                        @endphp
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Modal Show --}}
                    </div>
                </div>
                <div class="col-1"></div>
            </div> 
        </div>
        <!-- end tab pane -->
    </div>
    <!-- end tab content -->
</div>