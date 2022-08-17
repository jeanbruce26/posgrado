@extends ('user')

@section('content')

<div class="row">
     <div class="col-lg-12">
          <div class="card">
               <div class="card-body f1">
                    <div class="card">
                         <div class="card-body">
                              <form role="form" action="{{ route('inscripcion.store') }}" method="post" class="f1 row g-3 formulario-guardar" enctype="multipart/form-data">
                                   @csrf
               
                                   <div class="f1-steps col-sm-12">
                                        <div class="f1-progress">
                                             <div class="f1-progress-line" data-now-value="24" data-number-of-steps="2" style="width: 24%;"></div>
                                        </div>
                                        <div class="f1-step active">
                                             <div class="f1-step-icon"><i class="fa fa-user"></i></div>
                                             <p>Paso 1</p>
                                        </div>
                                        <div class="f1-step">
                                             <div class="f1-step-icon"><i class="fa fa-book"></i></div>
                                             <p>Paso 2</p>
                                        </div>
                                   </div>     
                                        
                                   <!--paso 1 -->
                                   <div class="fieldset col-sm-12">
                                        <div class="d-flex row g-3">
                                             <div class="col-md-4">
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
                                             </div>
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
                                             <div class="col-md-4">
                                                  <label class="form-label">Estado Civil (*)</label>
                                                  <select class="form-select" name="est_civil_cod_est">
                                                       <option value="" selected>Seleccione...</option>
                                                       @foreach ($estado_civil as $item)
                                                       <option value="{{$item->cod_est}}">{{$item->est_civil}}</option>
                                                       @endforeach
                                                  </select>
                                             </div>
                                             <div class="col-md-4">
                                                  <label class="form-label">Grado Academico (*)</label>
                                                  <select class="form-select" name="id_grado_academico">
                                                       <option value="" selected>Seleccione...</option>
                                                       @foreach ($grado as $item)
                                                       <option value="{{$item->id_grado_academico}}">{{$item->nom_grado}}</option>
                                                       @endforeach
                                                  </select>
                                             </div>
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
                                             <div class="col-md-4">
                                                  <label class="form-label">Discapacidad</label>
                                                  <select class="form-select" name="discapacidad_cod_disc">
                                                       <option value="" selected>Seleccione...</option>
                                                       @foreach ($tipo_dis as $item)
                                                       <option value="{{$item->cod_disc}}">{{$item->discapacidad}}</option>
                                                       @endforeach
                                                  </select>
                                             </div>
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
                                             <div class="col-md-4">
                                                  <label class="form-label">Universidad (*)</label>
                                                  <select class="form-select" name="univer_cod_uni">
                                                       <option value="" selected>Seleccione...</option>
                                                       @foreach ($universidad as $item)
                                                       <option value="{{$item->cod_uni}}">{{$item->universidad}}</option>
                                                       @endforeach
                                                  </select>
                                             </div>
                                             <div class="col-md-4">
                                                  <label class="form-label">Centro de Trabajo (*)</label>
                                                  <input type="text" class="form-control"  name="centro_trab">
                                                  @error('centro_trab')
                                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                                  @enderror
                                             </div>
                                        </div>
                                        
                                        <div class="f1-buttons mt-4 d-flex justify-content-end align-items-center">
                                             <button type="button" class="btn btn-next align-center"><span class="ms-2">Siguiente</span><i class="uil uil-angle-right"></i></button>
                                        </div>
                                   </div>
                                   <!--fin del paso 1 -->
               
                                   <!---paso 2 -->
                                   <div class="fieldset">
                                        <div class="d-flex row g-3">
                                             <h5 class="text-secondary">Programa</h5>
                                             <livewire:select-programa/>
                                             
                                             <h5 class="text-secondary mt-3">Pagos</h5>
               
                                             <table class="table table-striped">
                                                  <thead>
                                                       <tr>
                                                            <th>Tipo de Documento</th>
                                                            <th>Acción</th>
                                                            <th class="col-1">FORMATO</th>
                                                       </tr>
                                                  </thead>
                                                  
                                                  <tbody>
                                                       @foreach ($expediente as $item)
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
                                                       @endforeach
                                                  </tbody>
                                             </table>
                                             <div class="col-md-6">
                                                  <input type="hidden" class="form-control"  name="id_inscripcion" value="{{$id_inscripcion}}">
                                             </div>
                                        </div>
                                        <p class="card-text d-flex justify-content-star align-items-center mb-3"><input type="checkbox" name="check" class="me-2" onclick="boton.disabled = !this.checked"><span>DECLARO BAJO JURAMENTO QUE LOS DOCUMENTOS PRESENTADOS Y LOS DATOS CONSIGNADOS EN EL PRESENTE PROCESO DE ADMISIÓN SON FIDEDIGNOS</span></p> 
                                        @error('check')
                                             <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                        <div class="f1-buttons d-flex justify-content-between align-items-center">
                                             <button type="button" class="btn btn-previous mt-2 align-center"><i class="uil uil-angle-left"></i><span class="me-2">Atrás</span></button>
                                             <button type="submit" name="boton" class="btn btn-submit mt-2 align-center" disabled><span class="mx-2">Guardar Información</span><i class="uil uil-save"></i></button>
                                        </div>
                                   </div>
                                   <!--fin del paso 2 -->
                              </form>
                         </div>
                    </div>
               </div>
               <!-- end card body -->
          </div>
          <!-- end card -->
     </div>
     <!-- end col -->
</div>
<!-- end row -->
     
@endsection