<div>
    <div class="tab-content">
        <div class="tab-pane fade show active">
            <div class="card">
                <h4 class="card-header d-flex fw-bold justify-content-star align-items-center">Bienvenido {{$nombre}}.</h4>
            </div>
            @php
                $expInsc = App\Models\ExpedienteInscripcion::where('id_inscripcion', auth('usuarios')->user()->id_inscripcion)->get();
                $value = 0;
            @endphp
            @if (session()->has('message'))
                <div class="alert alert-success alert-border-left alert-dismissible fade shadow show" role="alert">
                    <i class="ri-check-double-line me-3 align-middle"></i> <strong> {{ session('message') }} </strong> 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session()->has('error'))
                <div class="alert alert-danger alert-border-left alert-dismissible fade shadow show" role="alert">
                    <i class="ri-error-warning-line me-3 align-middle"></i> <strong> {{ session('error') }} </strong> 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if ($errors->any())
            <div class="alert alert-danger my-4 alert-dismissible shadow fade show" role="alert">
                <strong> Error al momento de subir su documento. </strong> 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="card-text px-5">
                <h5><strong>Documentos ingresados en el proceso de inscripción</strong></h5>
            </div>
            <div class="card-text px-5 my-2 d-flex justify-content-around row g-3">
                <table class="table align-middle table-nowrap mb-0">
                    <thead class="table-light">
                        <tr class="col-sm-12">
                            <th class="col-md-4">Documento</th>
                            <th class="col-md-1">Fecha</th>
                            <th class="col-md-3">Observación</th>
                            <th class="col-md-1">Estado</th>
                            <th class="col-md-1">Archivo</th>
                            <th class="col-md-1">Acción</th>
                        </tr>
                    </thead>
        
                    <tbody>
                        @foreach ($expediente as $exp)
                            @foreach ($expInsc as $expInscripcion)
                                @if($exp->cod_exp == $expInscripcion->expediente_cod_exp)
                                    <tr>
                                        <td>{{$exp->tipo_doc}}</td>
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
                                        <td>
                                            @if ($final >= $fecha)
                                            <a href="#editModal" type="button" class="link-success fs-15" data-bs-toggle="modal" data-bs-target="#editModal{{$expInscripcion->cod_ex_insc}}"><i class="bx bx-edit bx-sm bx-burst-hover"></i></a>

                                            {{-- Modal Show --}}
                                            <div wire:ignore.self class="modal fade" id="editModal{{$expInscripcion->cod_ex_insc}}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="editModal" aria-hidden="true">
                                                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="showModalLabel">Actualizar  Documentos - {{$nombre}}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        
                                                        <form novalidate>
                                                            <div class="modal-body">
                                                                <div>
                                                                    <span class=""><strong>Previsualización del documento existente</strong></span>
                                                                    <table class="table table-striped">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>DOCUMENTO</th>
                                                                                <th></th>
                                                                            </tr>
                                                                        </thead>
                                                                            
                                                                        <tbody>
                                                                            <tr>
                                                                                <td>
                                                                                    <label class="form-label">{{ $expInscripcion->Expediente->tipo_doc }}</label>
                                                                                </td>
                                                                                <td class="col-md-2">
                                                                                    <a target="_blank" href="{{asset('Admision 2022 - I/'.$expInscripcion->id_inscripcion.'/'.$expInscripcion->nom_exped)}}" class="ms-2 d-flex align-items-center bx-burst-hover"><i style="color:rgb(78, 78, 78)" class="bx bxs-file-pdf bx-sm bx-burst-hover"></i> <strong class="ms-2 text-dark">Descargar</strong></a>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <span class=""><strong>Formulario para ingresar nuevo documento</strong></span>
                                                                <table class="table table-striped">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>DOCUMENTO</th>
                                                                            <th>SELECCIONAR</th>
                                                                            <th class="col-1">FORMATO</th>
                                                                        </tr>
                                                                    </thead>
                                                                        
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>
                                                                                <label class="form-label mt-3">{{ $expInscripcion->Expediente->tipo_doc }}</label>
                                                                            </td>
                                                                            <td class="col-md-6">
                                                                                <input type="file" class="mt-2 mb-2 form-control form-control-sm btn btn-primary" style="color:azure" wire:model="expediente_update" accept=".pdf">
                                                                            </td>
                                                                            <td align="center">
                                                                                <label class="form-label mt-3">PDF</label>
                                                                            </td> 
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" wire:click="limpiar()" class="btn btn-danger text-decoration-none btn-label" data-bs-dismiss="modal"><i class="ri-close-line me-1 ri-lg label-icon align-middle fs-16 me-2"></i>Cancelar</button>
                                                                <button type="button" wire:click="guardar({{$expInscripcion->cod_ex_insc}})" class="btn btn-primary btn-label right"><i class="ri-arrow-up-line label-icon align-middle fs-16 ms-2"></i>Guardar</button>  
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- Modal Show --}}
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
                                    <td>{{$exp->tipo_doc}}</td>
                                    <td><p class="ms-4">-</p></td>
                                    <td><p class="ms-5">-</p></td>
                                    <td class="text-danger"><i class="ri-close-circle-line fs-17 align-middle"></i> No enviado</td>
                                    <td><p class="ms-3">-</p></td>
                                    <td>
                                        <a href="#addModal" type="button" class="link-success fs-15" data-bs-toggle="modal" data-bs-target="#addModal{{ $exp->cod_exp }}"><i class='bx bx-add-to-queue bx-sm bx-burst-hover text-info'></i></a>
                                        {{-- Modal Show --}}
                                        <div wire:ignore.self class="modal fade" id="addModal{{ $exp->cod_exp }}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="addModal" aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="showModalLabel">Ingresar Documentos - {{$nombre}}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    
                                                    <form>
                                                        <div class="modal-body">
                                                            
                                                            <span class="mb-5 mt-3"><strong>Formulario para ingresar documento</strong></span>
                                                            <table class="table table-striped">
                                                                <thead>
                                                                    <tr>
                                                                        <th>DOCUMENTO</th>
                                                                        <th>SELECCIONAR</th>
                                                                        <th class="col-1">FORMATO</th>
                                                                    </tr>
                                                                </thead>
                                                                    
                                                                <tbody>
                                                                    <tr>
                                                                        <td>
                                                                            <label class="form-label mt-3">{{$exp->tipo_doc}}</label>
                                                                        </td>
                                                                        <td class="col-md-6" >
                                                                            <input type="file" class="mt-2 mb-2 form-control form-control-sm btn btn-primary" style="color:azure" wire:model="expediente_add" accept=".pdf">
                                                                        </td>
                                                                        <td align="center">
                                                                            <label class="form-label mt-3">PDF</label>
                                                                        </td> 
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" wire:click="limpiar()" class="btn btn-danger text-decoration-none btn-label" data-bs-dismiss="modal"><i class="ri-close-line me-1 ri-lg label-icon align-middle fs-16 me-2"></i>Cancelar</button>
                                                            <button type="button" wire:click="agregar({{ $exp->cod_exp }})" class="btn btn-primary btn-label right"><i class="ri-arrow-up-line label-icon align-middle fs-16 ms-2"></i>Guardar</button>  
                                                        </div>
                                                    </form>

                                                    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous">
                                                        $(function(){
                                                            $('addModal{{ $exp->cod_exp }}').on('hidden.bs.modal', function (event){
                                                                const $formulario = $('addModal{{ $exp->cod_exp }}').find('form');
                                                                console.log($formulario);
                                                                $formulario[0].reset();
                                                            });
                                                        });
                                                    </script>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Modal Show --}}
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
        <!-- end tab pane -->
    </div>
    <!-- end tab content -->
</div>