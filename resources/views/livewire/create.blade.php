<div class="p-2">

    <form class="row" method="POST" wire:submit.prevent='inscripcion' enctype="multipart/form-data">

        @csrf

        {{-- paso 1 --}}
        @if ($pasoactual == 1)
        <div>
            <h4 class="text-center text-white p-2 rounded-pill" style="background: #142e52;">Paso 1 / 2</h4>
            <h5 class="card-header fw-bold mt-3">Información personal</h5>
            <div class="card-body w-100">
                <div class="row g-3 col-12 m-auto">
                    <div class="col-4">
                        <label class="form-label">Primer Apellido *</label>
                        <input type="text" wire:model="apellido_paterno" onkeyup="mayus(this);" class="form-control @error('apellido_paterno') is-invalid  @enderror" placeholder="Ingrese su apellido paterno">
                    </div>
                    
                    <div class="col-4">
                        <label class="form-label">Segundo Apellido *</label>
                        <input type="text" wire:model="apellido_materno" onkeyup="mayus(this);" class="form-control @error('apellido_materno') is-invalid  @enderror" placeholder="Ingrese su apellido materno">
                    </div>
                    
                    <div class="col-4">
                        <label class="form-label">Nombres *</label>
                        <input type="text" wire:model="nombres" onkeyup="mayus(this);" class="form-control @error('nombres') is-invalid  @enderror" placeholder="Ingrese sus nombres">
                    </div>

                    <div class="col-4">
                        <label class="form-label">Fecha de nacimiento *</label>
                        <input type="date" wire:model="fecha_nacimiento" class="form-control @error('fecha_nacimiento') is-invalid  @enderror">
                    </div>

                    <div class="col-4">
                        <label class="form-label">Genero *</label>
                        <select class="form-select @error('genero') is-invalid  @enderror" aria-label="Default select example" wire:model="genero">
                            <option value="" selected>Seleccione</option>
                            <option value="MASCULINO">MASCULINO</option>
                            <option value="FEMENINO">FEMENINO</option>
                        </select>
                    </div>

                    <div class="col-4">
                        <label class="form-label">Estado Civil *</label>
                        <select class="form-select @error('estado_civil') is-invalid  @enderror" aria-label="Default select example" wire:model="estado_civil">
                            <option value="" selected>Seleccione</option>
                            @foreach ($est as $item)
                            <option value="{{$item->cod_est}}" {{ $item->cod_est == old('estado_civil') ? 'selected' : '' }}>{{$item->est_civil}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-4">
                        <label class="form-label">Grado Academico *</label>
                        <select class="form-select @error('grado_academico') is-invalid  @enderror" aria-label="Default select example" wire:model="grado_academico">
                            <option value="" selected>Seleccione</option>
                            @foreach ($grad as $item)
                            <option value="{{$item->id_grado_academico}}" {{ $item->id_grado_academico == old('grado_academico') ? 'selected' : '' }}>{{$item->nom_grado}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-4">
                        <label class="form-label">Especialidad</label>
                        <input type="text" wire:model="especialidad" onkeyup="mayus(this);" class="form-control @error('especialidad') is-invalid  @enderror" placeholder="Ingrese su especialidad">
                    </div>

                    <div class="col-4">
                        <label class="form-label">Discapacidad</label>
                        <select class="form-select @error('discapacidad') is-invalid  @enderror" aria-label="Default select example" wire:model="discapacidad">
                            <option value="" selected>Seleccione</option>
                            @foreach ($tipo_dis as $item)
                            <option value="{{$item->cod_disc}}" {{ $item->cod_disc == old('discapacidad') ? 'selected' : '' }}>{{$item->discapacidad}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-4">
                        <label class="form-label">Celular *</label>
                        <input type="text" wire:model="celular" onkeyup="mayus(this);" class="form-control @error('celular') is-invalid  @enderror" placeholder="Ingrese su número de celular">
                    </div>

                    <div class="col-4">
                        <label class="form-label">Celular 2 opcional</label>
                        <input type="text" wire:model="celular_opcional" onkeyup="mayus(this);" class="form-control @error('celular_opcional') is-invalid  @enderror" placeholder="Ingrese su número de celular opcional">
                    </div>

                    <div class="col-4">
                        <label class="form-label">Año de Egreso *</label>
                        <input type="text" wire:model="año_egreso" onkeyup="mayus(this);" class="form-control @error('año_egreso') is-invalid  @enderror" placeholder="Ingrese su año egreso">
                    </div>

                    <div class="col-4">
                        <label class="form-label">Correo Electronico *</label>
                        <input type="text" wire:model="correo" class="form-control @error('correo') is-invalid  @enderror" placeholder="Ingrese su correo electronico">
                    </div>

                    <div class="col-4">
                        <label class="form-label">Correo Electronico 2 opcional</label>
                        <input type="text" wire:model="correo_opcional" class="form-control @error('correo_opcional') is-invalid  @enderror" placeholder="Ingrese su correo electronico opcional">
                    </div>

                    <h5 class="mt-4 fw-bold">Datos de dirección.</h5>

                    <div class="col-4">
                        <label class="form-label">Departamento *</label>
                        <select class="form-select @error('departamento_direccion') is-invalid  @enderror" aria-label="Default select example" wire:model="departamento_direccion">
                            <option value="" selected>Seleccione</option>
                            @foreach ($departamento_direccion_array as $item)
                            <option value="{{$item->id}}">{{$item->departamento}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-4">
                        <label class="form-label">Provincia *</label>
                        <select class="form-select @error('provincia_direccion') is-invalid  @enderror" aria-label="Default select example" wire:model="provincia_direccion">
                            <option value="" selected>Seleccione</option>
                            @if ($departamento_direccion)
                            @foreach ($provincia_direccion_array as $item)
                            <option value="{{$item->id}}">{{$item->provincia}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="col-4">
                        <label class="form-label">Distrito *</label>
                        <select class="form-select @error('distrito_direccion') is-invalid  @enderror" aria-label="Default select example" wire:model="distrito_direccion">
                            <option value="" selected>Seleccione</option>
                            @if ($provincia_direccion)
                            @foreach ($distrito_direccion_array as $item)
                            <option value="{{$item->id}}">{{$item->distrito}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Direccion *</label>
                        <input type="text" wire:model="direccion" onkeyup="mayus(this);" class="form-control @error('direccion') is-invalid  @enderror" placeholder="Ingrese su direccion">
                    </div>

                    <h5 class="mt-4 fw-bold">Lugar de nacimiento.</h5>

                    <div class="col-4">
                        <label class="form-label">Departamento *</label>
                        <select class="form-select @error('departamento_nacimiento') is-invalid  @enderror" aria-label="Default select example" wire:model="departamento_nacimiento">
                            <option value="" selected>Seleccione</option>
                            @foreach ($departamento_nacimiento_array as $item)
                            <option value="{{$item->id}}" {{ $item->id == old('departamento_nacimiento') ? 'selected' : '' }}>{{$item->departamento}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-4">
                        <label class="form-label">Provincia *</label>
                        <select class="form-select @error('provincia_nacimiento') is-invalid  @enderror" aria-label="Default select example" wire:model="provincia_nacimiento">
                            <option value="" selected>Seleccione</option>
                            @if ($departamento_nacimiento)
                            @foreach ($provincia_nacimiento_array as $item)
                            <option value="{{$item->id}}" {{ $item->id == old('provincia_nacimiento') ? 'selected' : '' }}>{{$item->provincia}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="col-4">
                        <label class="form-label">Distrito *</label>
                        <select class="form-select @error('distrito_nacimiento') is-invalid  @enderror" aria-label="Default select example" wire:model="distrito_nacimiento">
                            <option value="" selected>Seleccione</option>
                            @if ($provincia_nacimiento)
                            @foreach ($distrito_nacimiento_array as $item)
                            <option value="{{$item->id}}" {{ $item->id == old('distrito_nacimiento') ? 'selected' : '' }}>{{$item->distrito}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="col-8">
                        <label class="form-label">Universidad *</label>
                        <select class="form-select @error('universidad') is-invalid  @enderror" aria-label="Default select example" wire:model="universidad">
                            <option value="" selected>Seleccione</option>
                            @foreach ($uni as $item)
                            <option value="{{$item->cod_uni}}" {{ $item->cod_uni == old('universidad') ? 'selected' : '' }}>{{$item->universidad}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-4">
                        <label class="form-label">Centro de trabajo *</label>
                        <input type="text" wire:model="trabajo" onkeyup="mayus(this);" class="form-control @error('trabajo') is-invalid  @enderror" placeholder="Ingrese su centro de trabajo">
                    </div>
                </div>
            </div>

            <div class="d-flex align-items-start justify-content-between gap-3 mt-4">
                <div></div>
                <button type="button" class="btn btn-success btn-label right" wire:click="aumentarPaso()"><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Siguiente</button>
            </div>
        </div>
        @endif
        

        {{-- paso 2 --}}
        @if ($pasoactual == 2)
        <div class="">
            <h4 class="text-center text-white p-2 rounded-pill" style="background: #142e52;">Paso 2 / 2</h4>
            <h5 class="card-header fw-bold mt-3">Seleccione su Programa</h5>
            <div class="card-body w-100">
                <div class="row g-3 col-12 m-auto">
                    <div class="col-12">
                        <label class="form-label">Sede *</label>
                        <select class="form-select @error('sede_combo') is-invalid  @enderror" aria-label="Default select example" wire:model="sede_combo">
                            <option value="" selected>Seleccione</option>
                            @foreach ($sede_combo_array as $item)
                            <option value="{{$item->cod_sede}}">{{$item->sede}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-4">
                        <label class="form-label">Programa *</label>
                        <select class="form-select @error('programa_combo') is-invalid  @enderror" aria-label="Default select example" wire:model="programa_combo">
                            <option value="" selected>Seleccione</option>
                            @if ($sede_combo)
                            @foreach ($programa_combo_array as $item)
                            <option value="{{$item->id_programa}}">{{$item->descripcion_programa}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="col-4">
                        @if ($programa_combo)
                        <label class="form-label">{{ucfirst($programa_nombre->descripcion_programa)}} *</label>
                        @else
                        <label class="form-label">- *</label>
                        @endif
                        <select class="form-select @error('subprograma_combo') is-invalid  @enderror" aria-label="Default select example" wire:model="subprograma_combo">
                            <option value="" selected>Seleccione</option>
                            @if ($programa_combo)
                            @foreach ($subprograma_combo_array as $item)
                            <option value="{{$item->id_subprograma}}">{{$item->subprograma}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>

                    @if ($subprograma_combo)

                    @php
                        foreach ($mencion_combo_array as $item){
                            $valor = $item->mencion;
                        }
                    @endphp

                    @if ($valor)    
                    <div class="col-4">
                        <label class="form-label">Mención *</label>
                        <select class="form-select @error('mencion_combo') is-invalid  @enderror" aria-label="Default select example" wire:model="mencion_combo">
                            <option value="" selected>Seleccione</option>
                            @foreach ($mencion_combo_array as $item)
                                <option value="{{$item->id_mencion}}">{{$item->mencion}}</option>
                            @endforeach
                        </select>
                    </div>
                    @else
                    <div class="col-md-4">
                        <input type="hidden" class="form-control" wire:model="mencion_combo" value="">
                    </div>
                    @endif
                        
                    @endif

                    <h5 class="mt-4 fw-bold">Documentos requeridos.</h5>

                    @if ($errors->any())
                    <div class="alert alert-danger mt-2 mb-2 text-center">Ingrese sus documentos.</div>
                    @endif

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>DOCUMENTOS</th>
                                <th>SELECCIONAR</th>
                                <th></th>
                                <th class="col-1">FORMATO</th>
                            </tr>
                        </thead>
                            
                        <tbody>
                            @foreach ($expe as $item)
                            <tr>
                                <td>
                                    <label class="form-label mt-2 mb-2">{{ $item->tipo_doc }} @if ($item->requerido == 1) (*) @endif</label>
                                </td>
                                <td class="col-md-4">
                                    {{-- <input class="mt-2 mb-2 form-control form-control-sm btn btn-outline-secondary text-dark btn-sm colorsito nomExp{{ $item->cod_exp }}" type="file" wire:model="expediente" @if($item->requerido == 1)required pattern="[a-z]{1,15}" title="El expediente es requerido"@endif> --}}
                                    <input class="mt-2 mb-2 form-control form-control-sm btn btn-primary @error('expediente{{$item->cod_exp}}') is-invalid  @enderror" type="file" style="color:azure" wire:model="expediente{{$item->cod_exp}}" @if ($item->requerido == 1) required @endif accept=".pdf">
                                </td>
                                <td class="col-md-1">
                                </td> 
                                <td align="center">
                                    <label class="form-label mt-3">PDF</label>
                                </td> 
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <p class="card-text d-flex justify-content-star align-items-center mb-3"><input type="checkbox" wire:model="check" class="me-2"><span>DECLARO BAJO JURAMENTO QUE LOS DOCUMENTOS PRESENTADOS Y LOS DATOS CONSIGNADOS EN EL PRESENTE PROCESO DE ADMISIÓN SON FIDEDIGNOS</span></p> 
            @error('check')
                    <div class="alert alert-danger m2-1 mb-2">{{ $message }}</div>
            @enderror
            <div class="d-flex align-items-start justify-content-between gap-3 mt-4">
                <button type="button" class="btn btn-secondary text-decoration-none btn-label" wire:click="disminuirPaso()"><i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i>Anterior</button>
                <button type="button" class="btn btn-primary btn-label right" @if($check == false) disabled @endif wire:click="validarUltimoPaso()" ><i class="ri-arrow-up-line label-icon align-middle fs-16 ms-2"></i>Inscribirse</button>  
                <script>
                    window.addEventListener('abrir-modal', event => {
                        $('#staticBackdrop').modal('show');
                    })
                </script>
                <!-- staticBackdrop Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-body text-center p-5">
                                <lord-icon
                                    src="https://assets10.lottiefiles.com/packages/lf20_Vs49OV.json"
                                    trigger="loop"
                                    colors="primary:#121331,secondary:#08a88a"
                                    style="width:120px;height:120px">
                                </lord-icon>
                                <div class="mt-4">
                                    <h4 class="mb-3">¿Realizar inscripción?</h4>
                                    <p class="text-muted mb-4">Declaro bajo juramento que los documentos presentados y los datos consignados en el presente proceso de admisión son fidedignos.</p>
                                    <div class="hstack gap-2 justify-content-around">
                                        <a href="javascript:void(0);" class="btn btn-danger shadow-none fw-medium" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</a>
                                        <button type="submit" class="btn btn-primary">Inscribirse</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </form>
</div>

@push('js')
    <script>
        function mayus(e) {
            e.value = e.value.toUpperCase();
        }
    </script>
@endpush