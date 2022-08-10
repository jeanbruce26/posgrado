@extends ('user')

@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Inscripcion</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active">Inscripcion</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body f1">
                <h4 class="card-title mb-4">Basic Wizard</h4>

                {{-- <form role="form" action="" method="post" class="f1 row g-3">
                    @csrf --}}
                    <div class="f1-steps col-sm-12">
                        <div class="f1-progress">
                            <div class="f1-progress-line" data-now-value="12" data-number-of-steps="4" style="width: 12%;"></div>
                        </div>
                        <div class="f1-step active">
                            <div class="f1-step-icon"><i class="fa fa-check"></i></div>
                            <p>Paso 1</p>
                        </div>
                        <div class="f1-step">
                            <div class="f1-step-icon"><i class="fa fa-user"></i></div>
                            <p>Paso 2</p>
                        </div>
                        <div class="f1-step">
                            <div class="f1-step-icon"><i class="fa fa-book"></i></div>
                            <p>Paso 3</p>
                        </div>
                        <div class="f1-step">
                            <div class="f1-step-icon"><i class="fa fa-file"></i></div>
                            <p>Fin</p>
                        </div>
                    </div>
                        
                    <!--paso 1 -->
                    <div class="fieldset col-sm-12">
                        <form action="{{ route('check') }}" method="post" novalidate>
                            @csrf
                            <div class="card">
                                @error('check')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                                <h5 class="card-header">A tener en cuenta:</h5>
                                <div class="card-body">
                                    <h5 class="card-title mb-3">Por favor, lee determinadamente los siguientes puntos antes de comenzar con tu inscripción.</h5>
                                    <p class="card-text"><i class="fas fa-comment-dollar me-2 m-auto"></i>Puedes realizar tu inscripción al día siguiente de haber realizado tu pago.</p>
                                    <p class="card-text"><i class="fas fa-address-card me-2 m-auto"></i>Ten a mano tu Documento de Identidad.</p>
                                    <p class="card-text"><i class="fas fa-info-circle me-2 m-auto"></i>Proporciona datos fidedignos (auténticos).</p>
                                    <p class="card-text"><i class="fas fa-info-circle me-2 m-auto"></i>Se muy cuidadoso al completar cada información solicidad por el Sistema de Inscripción.</p>
                                    <p class="card-text d-flex justify-content-star align-items-center"><input type="checkbox" name="check" class="me-2"><span>Acepto Terminos y condiciones.</span></p> 
                                </div>
                            </div>
                            <div class="f1-buttons mt-3 d-flex justify-content-end">
                                <button type="submit" class="btn btn-next">Siguiente</button>
                            </div>
                        </form>
                    </div>
                    <!--fin del paso 1 -->
                
                
                    <!--paso 2 -->
                    <div class="fieldset col-sm-12">
                        <div class="card">
                            <h5 class="card-header">Featured</h5>
                            <div class="card-body">
                                <h5 class="card-title">Special title treatment</h5>
                                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                        <div class="d-flex row g-3">
                            {{-- <div class="col-md-4">
                                <label class="form-label">Tipo de Documento (*)</label>
                                <select class="form-select" name="tipo_doc_cod_tipo">
                                        <option value="" selected>Seleccione</option>
                                        @foreach ($tipo_doc as $item)
                                        <option value="{{$item->id_tipo_doc}}">{{$item->doc}}</option>
                                        @endforeach
                                </select>
                                @error('tipo_doc_cod_tipo')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div> --}}
                            <div class="col-md-4">
                                <label class="form-label">Numero Documento (*)</label>
                                <input type="text" class="form-control" name="num_doc">
                                @error('num_doc')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Apellido Paterno (*)</label>
                                <input type="text" class="form-control" name="apell_pater">
                                @error('apell_pater')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Apellido Materno (*)</label>
                                <input type="text" class="form-control"  name="apell_mater">
                                @error('apell_mater')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Nombre (*)</label>
                                <input type="text" class="form-control" name="nombres">
                                @error('nombres')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Sexo (*)</label>
                                <select class="form-select" name="sexo">
                                        <option value="" selected>Seleccione</option>
                                        <option value="F">FEMENINO</option>
                                        <option value="M">MASCULINO</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Fecha de Naciminto (*)</label>
                                <input type="date" class="form-control" name="fecha_naci">
                                @error('fecha_naci')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- <div class="col-md-4">
                                <label class="form-label">Estado Civil (*)</label>
                                <select class="form-select" name="est_civil_cod_est">
                                        <option value="" selected>Seleccione...</option>
                                        @foreach ($estado_civil as $item)
                                        <option value="{{$item->cod_est}}">{{$item->est_civil}}</option>
                                        @endforeach
                                </select>
                            </div> --}}
                            {{-- <div class="col-md-4">
                                <label class="form-label">Grado Academico (*)</label>
                                <select class="form-select" name="id_grado_academico">
                                        <option value="" selected>Seleccione...</option>
                                        @foreach ($grado as $item)
                                        <option value="{{$item->id_grado_academico}}">{{$item->nom_grado}}</option>
                                        @endforeach
                                </select>
                            </div> --}}
                            <div class="col-md-4">
                                <label class="form-label">Especialidad (*)</label>
                                <input type="text" class="form-control" name="especialidad">
                                @error('especialidad')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Celular (*)</label>
                                <input type="text" class="form-control" name="celular1">
                                @error('celular1')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Celular opcional</label>
                                <input type="text" class="form-control" name="celular2">
                            </div>
                            {{-- <div class="col-md-4">
                                <label class="form-label">Discapacidad</label>
                                <select class="form-select" name="discapacidad_cod_disc">
                                        <option value="" selected>Seleccione...</option>
                                        @foreach ($tipo_dis as $item)
                                        <option value="{{$item->cod_disc}}">{{$item->discapacidad}}</option>
                                        @endforeach
                                </select>
                            </div> --}}
                            <div class="col-md-4">
                                <label class="form-label">Email (*)</label>
                                <input type="email" class="form-control" name="email">
                                @error('email')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Email opcional</label>
                                <input type="email" class="form-control" name="email2">
                            </div>
                            <h5 class="text-secondary">Ubigeo de direccion</h5>
                            <livewire:select-ubigeo/>
                            <div class="col-md-12">
                                <label class="form-label">Direccion (*)</label>
                                <input type="text" class="form-control" name="direccion">
                                @error('direccion')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <h5 class="text-secondary">Ubigeo de Nacimiento</h5>
                            <livewire:select-ubigeo-nacimiento/>
                            <div class="col-md-4">
                                <label class="form-label">Año de Egreso (*)</label>
                                <input type="int" class="form-control" name="año_egreso">
                                @error('año_egreso')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- <div class="col-md-4">
                                <label class="form-label">Universidad (*)</label>
                                <select class="form-select" name="univer_cod_uni">
                                        <option value="" selected>Seleccione...</option>
                                        @foreach ($universidad as $item)
                                        <option value="{{$item->cod_uni}}">{{$item->universidad}}</option>
                                        @endforeach
                                </select>
                            </div> --}}
                            <div class="col-md-4">
                                <label class="form-label">Centro de Trabajo (*)</label>
                                <input type="text" class="form-control"  name="centro_trab">
                                @error('centro_trab')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="f1-buttons mt-3 d-flex justify-content-between">
                            <button type="button" class="btn btn-previous mt-3">Atrás</button>
                            <button type="button" class="btn btn-next">Siguiente</button>
                        </div>
                    </div>
                    <!--fin del paso 1 -->

                    <!---paso 2 -->
                    <div class="fieldset">
                        <div class="d-flex row g-3">
                            <h5 class="text-secondary">Programa</h5>
                            <livewire:select-programa/>
                            
                            <h5 class="text-secondary mt-3">Pagos</h5>

                            <div class="col-md-4">
                                <label class="form-label">Numero Operacion  (*)</label>
                                <input type="text" class="form-control" name="num_opera">
                                @error('num_opera')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Monto (*)</label>
                                <input type="text" class="form-control" name="monto">
                                @error('monto')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Fecha (*)</label>
                                <input type="date" class="form-control"  name="fecha">
                                @error('fecha')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Vaucher (*)</label>
                                <input type="file" class="form-control"  name="vaucher">
                                @error('vaucher')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="f1-buttons d-flex justify-content-between">
                            <button type="button" class="btn btn-previous mt-3">Atrás</button>
                            <button type="button" class="btn btn-next mt-3">Siguiente</button>
                        </div>
                    </div>
                    <!--fin del paso 2 -->

                    <!--paso fin -->
                    <div class="fieldset">
                        <div class="d-flex row g-3">
                            <table class="table table-striped">
                                <thead>
                                        <tr>
                                            <th>Tipo de Documento</th>
                                            <th>Acción</th>
                                            <th>FORMATO</th>
                                        </tr>
                                </thead>
                                
                                <tbody>
                                        {{-- @foreach ($expediente as $item)
                                        <tr>
                                            <td>
                                                <label class="form-label mt-2 mb-2">{{ $item->tipo_doc }} (*)</label>
                                            </td>
                    
                                            <td>
                                                <input class="mt-2 mb-2 form-control form-control-sm btn btn-outline-secondary text-secondary btn-sm colorsito" 
                                                    type="file" 
                                                    name="nom_exped{{ $item->cod_exp }}"
                                                >
                                            </td>
                                            <td>
                                                <label class="form-label mt-2 mb-2">PDF</label>
                                            </td> 
                                        </tr>
                                        @endforeach --}}
                                </tbody>
                            </table>
                        </div>
                        <div class="f1-buttons d-flex justify-content-between">
                            <button type="button" class="btn btn-previous mt-">Atrás</button>
                            <button type="submit" class="btn btn-submit mt-">Guardar Información</button>
                        </div>
                    </div>
                    <!--fin -->
                
                {{-- </form> --}}

            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>
<!-- end row -->

@endsection