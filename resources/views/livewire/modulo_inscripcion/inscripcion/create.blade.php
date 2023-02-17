<div class="py-2">
    <form class="row" enctype="multipart/form-data">
        {{-- paso 1 --}}
        @if ($pasoactual == 1)
        <div>
            <h4 class="text-center text-white p-2 rounded" style="background: #142e52;">Paso 1 / 2</h4>
            <div class="card mt-3">
                <div class="card-header">
                    <span class="fw-bold ms-2 fs-5 text-uppercase" style="color: #142e52">
                        Información personal
                    </span>
                </div>
                <div class="px-3 pb-4">
                    <div class="row g-3 col-12 m-auto">
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12">
                            <label class="form-label">Primer Apellido <span class="text-danger" style="font-size: 0.7rem">(Obligatorio)</span></label>
                            <input type="text" wire:model="apellido_paterno" onkeyup="mayus(this);" class="form-control @error('apellido_paterno') is-invalid  @enderror" placeholder="Ingrese su apellido paterno">
                        </div>
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12">
                            <label class="form-label">Segundo Apellido <span class="text-danger" style="font-size: 0.7rem">(Obligatorio)</span></label>
                            <input type="text" wire:model="apellido_materno" onkeyup="mayus(this);" class="form-control @error('apellido_materno') is-invalid  @enderror" placeholder="Ingrese su apellido materno">
                        </div>
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12">
                            <label class="form-label">Nombres <span class="text-danger" style="font-size: 0.7rem">(Obligatorio)</span></label>
                            <input type="text" wire:model="nombres" onkeyup="mayus(this);" class="form-control @error('nombres') is-invalid  @enderror" placeholder="Ingrese sus nombres">
                        </div>
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12">
                            <label class="form-label">Fecha de nacimiento <span class="text-danger" style="font-size: 0.7rem">(Obligatorio)</span></label>
                            <input type="date" wire:model="fecha_nacimiento" class="form-control @error('fecha_nacimiento') is-invalid  @enderror">
                        </div>
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12">
                            <label class="form-label">Genero <span class="text-danger" style="font-size: 0.7rem">(Obligatorio)</span></label>
                            <select class="form-select @error('genero') is-invalid  @enderror" aria-label="Default select example" wire:model="genero">
                                <option value="" selected>Seleccione</option>
                                <option value="MASCULINO">MASCULINO</option>
                                <option value="FEMENINO">FEMENINO</option>
                            </select>
                        </div>
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12">
                            <label class="form-label">Estado Civil <span class="text-danger" style="font-size: 0.7rem">(Obligatorio)</span></label>
                            <select class="form-select @error('estado_civil') is-invalid  @enderror" aria-label="Default select example" wire:model="estado_civil">
                                <option value="" selected>Seleccione</option>
                                @foreach ($est as $item)
                                <option value="{{$item->cod_est}}" {{ $item->cod_est == old('estado_civil') ? 'selected' : '' }}>{{$item->est_civil}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12">
                            <label class="form-label">Discapacidad</label>
                            <select class="form-select @error('discapacidad') is-invalid  @enderror" aria-label="Default select example" wire:model="discapacidad">
                                <option value="" selected>Seleccione</option>
                                @foreach ($tipo_dis as $item)
                                <option value="{{$item->cod_disc}}" {{ $item->cod_disc == old('discapacidad') ? 'selected' : '' }}>{{$item->discapacidad}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12">
                            <label class="form-label">Celular <span class="text-danger" style="font-size: 0.7rem">(Obligatorio)</span></label>
                            <input type="text" wire:model="celular" onkeyup="mayus(this);" class="form-control @error('celular') is-invalid  @enderror" placeholder="Ingrese su número de celular">
                        </div>
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12">
                            <label class="form-label">Celular 2 opcional</label>
                            <input type="text" wire:model="celular_opcional" onkeyup="mayus(this);" class="form-control @error('celular_opcional') is-invalid  @enderror" placeholder="Ingrese su número de celular opcional">
                        </div>
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12">
                            <label class="form-label">Correo Electronico <span class="text-danger" style="font-size: 0.7rem">(Obligatorio)</span></label>
                            <input type="text" wire:model="correo" class="form-control @error('correo') is-invalid  @enderror" placeholder="Ingrese su correo electronico">
                        </div>
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12">
                            <label class="form-label">Correo Electronico 2 opcional</label>
                            <input type="text" wire:model="correo_opcional" class="form-control @error('correo_opcional') is-invalid  @enderror" placeholder="Ingrese su correo electronico opcional">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header">
                    <span class="fw-bold ms-2 fs-5 text-uppercase" style="color: #142e52">
                        Información de dirección y lugar de nacimiento.
                    </span>
                </div>
                <div class="px-3 pb-4">
                    <div class="row g-3 col-12 m-auto">
                        <h5 class="mt-4 fw-bold">Datos de dirección</h5>
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12">
                            <label class="form-label">Departamento <span class="text-danger" style="font-size: 0.7rem">(Obligatorio)</span></label>
                            <select class="form-select @error('departamento_direccion') is-invalid  @enderror" aria-label="Default select example" wire:model="departamento_direccion">
                                <option value="" selected>Seleccione</option>
                                @foreach ($departamento_direccion_array as $item)
                                <option value="{{$item->id}}">{{$item->departamento}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12">
                            <label class="form-label">Provincia <span class="text-danger" style="font-size: 0.7rem">(Obligatorio)</span></label>
                            <select class="form-select @error('provincia_direccion') is-invalid  @enderror" aria-label="Default select example" wire:model="provincia_direccion">
                                <option value="" selected>Seleccione</option>
                                @if ($departamento_direccion)
                                @foreach ($provincia_direccion_array as $item)
                                <option value="{{$item->id}}">{{$item->provincia}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12">
                            <label class="form-label">Distrito <span class="text-danger" style="font-size: 0.7rem">(Obligatorio)</span></label>
                            <select class="form-select @error('distrito_direccion') is-invalid  @enderror" aria-label="Default select example" wire:model="distrito_direccion">
                                <option value="" selected>Seleccione</option>
                                @if ($provincia_direccion)
                                @foreach ($distrito_direccion_array as $item)
                                <option value="{{$item->id}}">{{$item->distrito}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12">
                            <label class="form-label">Direccion <span class="text-danger" style="font-size: 0.7rem">(Obligatorio)</span></label>
                            <input type="text" wire:model="direccion" onkeyup="mayus(this);" class="form-control @error('direccion') is-invalid  @enderror" placeholder="Ingrese su direccion">
                        </div>
                        <h5 class="mt-4 fw-bold">Lugar de nacimiento</h5>
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12">
                            <label class="form-label">Departamento <span class="text-danger" style="font-size: 0.7rem">(Obligatorio)</span></label>
                            <select class="form-select @error('departamento_nacimiento') is-invalid  @enderror" aria-label="Default select example" wire:model="departamento_nacimiento">
                                <option value="" selected>Seleccione</option>
                                @foreach ($departamento_nacimiento_array as $item)
                                <option value="{{$item->id}}" {{ $item->id == old('departamento_nacimiento') ? 'selected' : '' }}>{{$item->departamento}}</option>
                                @endforeach
                            </select>
                        </div>
    
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12">
                            <label class="form-label">Provincia <span class="text-danger" style="font-size: 0.7rem">(Obligatorio)</span></label>
                            <select class="form-select @error('provincia_nacimiento') is-invalid  @enderror" aria-label="Default select example" wire:model="provincia_nacimiento">
                                <option value="" selected>Seleccione</option>
                                @if ($departamento_nacimiento)
                                @foreach ($provincia_nacimiento_array as $item)
                                <option value="{{$item->id}}" {{ $item->id == old('provincia_nacimiento') ? 'selected' : '' }}>{{$item->provincia}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
    
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12">
                            <label class="form-label">Distrito <span class="text-danger" style="font-size: 0.7rem">(Obligatorio)</span></label>
                            <select class="form-select @error('distrito_nacimiento') is-invalid  @enderror" aria-label="Default select example" wire:model="distrito_nacimiento">
                                <option value="" selected>Seleccione</option>
                                @if ($provincia_nacimiento)
                                @foreach ($distrito_nacimiento_array as $item)
                                <option value="{{$item->id}}" {{ $item->id == old('distrito_nacimiento') ? 'selected' : '' }}>{{$item->distrito}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
    
                        @if ($distrito_nacimiento)
                            @if ($distrito_nacimiento == 1893)
                            <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12">
                                <label class="form-label">Pais</label>
                                <input type="text" wire:model="pais" class="form-control @error('pais') is-invalid  @enderror" placeholder="Ingrese su pais">
                            </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header">
                    <span class="fw-bold ms-2 fs-5 text-uppercase" style="color: #142e52">
                        Información de grado académico, universidad y experiencia laboral
                    </span>
                </div>
                <div class="px-3 pb-4">
                    <div class="row g-3 col-12 m-auto">
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12">
                            <label class="form-label">Grado Academico o Título <span class="text-danger" style="font-size: 0.7rem">(Obligatorio)</span></label>
                            <select class="form-select @error('grado_academico') is-invalid  @enderror" aria-label="Default select example" wire:model="grado_academico">
                                <option value="" selected>Seleccione</option>
                                @foreach ($grad as $item)
                                <option value="{{$item->id_grado_academico}}" {{ $item->id_grado_academico == old('grado_academico') ? 'selected' : '' }}>{{$item->nom_grado}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12">
                            <label class="form-label">Especialidad de Carrera</label>
                            <input type="text" wire:model="especialidad" onkeyup="mayus(this);" class="form-control @error('especialidad') is-invalid  @enderror" placeholder="Ingrese su especialidad">
                        </div>
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12">
                            <label class="form-label">Año de Egreso de Universidad o Maestria <span class="text-danger" style="font-size: 0.7rem">(Obligatorio)</span></label>
                            <input type="text" wire:model="año_egreso" onkeyup="mayus(this);" class="form-control @error('año_egreso') is-invalid  @enderror" placeholder="Ingrese su año egreso">
                        </div>
                        <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-12">
                            <div wire:ignore>
                                <label class="form-label">Universidad de egreso <span class="text-danger" style="font-size: 0.7rem">(Obligatorio)</span></label>
                                <select class="form-select select2-universidad @error('universidad') is-invalid  @enderror" aria-label="Default select example" wire:model="universidad">
                                    <option value="" selected>Seleccione</option>
                                    @foreach ($uni as $item)
                                    <option value="{{$item->cod_uni}}" {{ $item->cod_uni == old('universidad') ? 'selected' : '' }}>{{$item->universidad}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12">
                            <label class="form-label">Centro de trabajo <span class="text-danger" style="font-size: 0.7rem">(Obligatorio)</span></label>
                            <input type="text" wire:model="trabajo" onkeyup="mayus(this);" class="form-control @error('trabajo') is-invalid  @enderror" placeholder="Ingrese su centro de trabajo">
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex align-items-start justify-content-between gap-3 my-3">
                <div></div>
                <button type="button" class="btn btn-success btn-label right" wire:click="aumentarPaso()"><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Siguiente</button>
            </div>
        </div>
        @endif
        
        {{-- paso 2 --}}
        @if ($pasoactual == 2)
        <div class="">
            <h4 class="text-center text-white p-2 rounded" style="background: #142e52;">Paso 2 / 2</h4>
            <div class="card mt-3">
                <div class="card-header">
                    <span class="fw-bold ms-2 fs-5 text-uppercase" style="color: #142e52">
                        Selección de Programa
                    </span>
                </div>
                <div class="px-3 pb-4">
                    <div class="row g-3 col-12 m-auto">
                        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12">
                            <label class="form-label">Sede <span class="text-danger" style="font-size: 0.7rem">(Obligatorio)</span></label>
                            <select class="form-select @error('sede_combo') is-invalid  @enderror" aria-label="Default select example" wire:model="sede_combo">
                                <option value="" selected>Seleccione</option>
                                @foreach ($sede_combo_array as $item)
                                <option value="{{$item->cod_sede}}">{{$item->sede}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12">
                            <label class="form-label">Programa <span class="text-danger" style="font-size: 0.7rem">(Obligatorio)</span></label>
                            <select class="form-select @error('programa_combo') is-invalid  @enderror" aria-label="Default select example" wire:model="programa_combo">
                                <option value="" selected>Seleccione</option>
                                @if ($sede_combo)
                                @foreach ($programa_combo_array as $item)
                                <option value="{{$item->id_programa}}">{{$item->descripcion_programa}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12">
                            @if ($programa_combo)
                            <label class="form-label">{{ucfirst(strtolower($programa_nombre->descripcion_programa))}} <span class="text-danger" style="font-size: 0.7rem">(Obligatorio)</span></label>
                            @else
                            <label class="form-label">- <span class="text-danger" style="font-size: 0.7rem">(Obligatorio)</span></label>
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
                            $valor = null;
                            foreach ($mencion_combo_array as $item){
                                $valor = $item->mencion;
                            }
                        @endphp
                            @if ($valor)    
                            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12">
                                <label class="form-label">Mención <span class="text-danger" style="font-size: 0.7rem">(Obligatorio)</span></label>
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
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header">
                    <span class="fw-bold ms-2 fs-5 text-uppercase" style="color: #142e52">
                        Ingreso de Expedientes
                    </span>
                </div>
                <div class="px-3 pb-4">
                    <div class="row g-3 col-12 m-auto">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle table-nowrap mb-0">
                                <thead>
                                    <tr align="center" style="background-color: rgb(231, 237, 255)">
                                        <th class="col-md-7">DOCUMENTOS</th>
                                        <th class="col-md-2"></th>
                                        <th class="col-md-2"></th>
                                        <th class="col-md-1">FORMATO</th>
                                    </tr>
                                </thead>
                                    
                                <tbody>
                                    @if ($expe)
                                        @foreach ($expe as $item)
                                        @php
                                            $exped_inscripcion = App\Models\ExpedienteInscripcion::where('expediente_cod_exp', $item->cod_exp)->where('id_inscripcion', $id_inscripcion)->first();
                                        @endphp
                                        <tr>
                                            <td style="white-space: initial;">
                                                {{ $item->tipo_doc }} @if ($item->requerido == 1) <span class="text-danger" style="font-size: 0.7rem">(Obligatorio)</span> @endif
                                            </td>
                                            <td align="center">
                                                @if ($exped_inscripcion)
                                                <span class="badge bg-info">Enviado</span>
                                                @else
                                                <span class="badge bg-danger">No enviado</span>
                                                @endif
                                            </td>
                                            <td align="center">
                                                <a href="#modalExpediente" class="btn btn-info btn-sm w-sm" data-bs-toggle="modal" data-bs-target="#modalExpediente" wire:click="cargarExpediente({{ $item->cod_exp }})">Subir</a>
                                            </td> 
                                            <td align="center">
                                                <label class="form-label mt-3">(.pdf)</label>
                                            </td> 
                                        </tr>
                                        @endforeach
                                    @else
                                    <tr>
                                        <td colspan="4">
                                            <div class="alert alert-info mt-2 mb-2 text-center fw-bold">Seleccione su programa para ver sus expedientes requeridos.</div>
                                        </td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <p class="card-text d-flex justify-content-star align-items-center mt-2 mb-3 fw-bold"><input type="checkbox" wire:model="check" class="me-2"><span style="cursor: pointer;" wire:click="aceptarTerminos()">DECLARO BAJO JURAMENTO QUE LOS DOCUMENTOS PRESENTADOS Y LOS DATOS CONSIGNADOS EN EL PRESENTE PROCESO DE ADMISIÓN SON FIDEDIGNOS</span></p> 
            @error('check')
                    <div class="alert alert-danger m2-1 mb-2">{{ $message }}</div>
            @enderror
            <div class="d-flex align-items-start justify-content-between gap-3 mt-4 mb-3">
                <button type="button" class="btn btn-secondary text-decoration-none btn-label" wire:click="disminuirPaso()"><i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i>Anterior</button>
                <button type="button" class="btn btn-primary btn-label right" @if($check == false) disabled @endif wire:click="validarUltimoPaso()" ><i class="ri-arrow-up-line label-icon align-middle fs-16 ms-2"></i>Inscribirse</button>  
            </div>
        </div>
        @endif
    </form>
    {{-- Modal --}}
    <div wire:ignore.self class="modal fade" id="modalExpediente" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalExpediente" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showModalLabel">Subir Expediente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <form novalidate>
                    <div class="modal-body">
                        <div>
                            <div class="d-flex justify-content-between align-item-center">
                                <label class="form-label">{{ $expediente_nombre }}@if ($expediente_requerido == 1) <span class="text-danger" style="font-size: 0.7rem">(Obligatorio, máximo 10 megabyte)</span> @endif</label>
                                <span class="text-danger">(pdf)</span>
                            </div>
                            <input type="file" class="form-control @error('expediente') is-invalid  @enderror" wire:model="expediente" accept=".pdf" id="upload{{ $iteration }}">
                            @error('expediente')                        
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </form>
                <div class="modal-footer text-end">
                    <button type="button" wire:click="limpiar()"
                        class="btn btn-outline-danger btn-label waves-effect waves-light w-md" data-bs-dismiss="modal"><i
                            class="ri-arrow-left-s-line label-icon align-middle fs-16 me-2"></i> Cancelar</button>
                    <button type="button" wire:click="guardarExpediente()"
                        class="btn btn-primary btn-label waves-effect right waves-light w-md ms-2" @if($expediente == null) disabled @endif><i
                            class="ri-check-double-fill label-icon align-middle fs-16 ms-2"></i> Guardar</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal --}}
</div>

@push('js')
    <script>
        function mayus(e) {
            e.value = e.value.toUpperCase();
        }
    </script>

    <script>
        $(document).ready(function () {
            $('.select2-universidad').select2({
                placeholder: 'Seleccione universidad',
                allowClear: true,
                width: '100%',
                selectOnClose: true,
                language: {
                    noResults: function () {
                        return "No se encontraron resultados";
                    },
                    searching: function () {
                        return "Buscando..";
                    }
                }
            });
            $('.select2-universidad').on('change', function(){
                @this.set('universidad', this.value);
            });
            Livewire.hook('message.processed', (message, component) => {
                $('.select2-universidad').select2({
                    placeholder: 'Seleccione universidad',
                    allowClear: true,
                    width: '100%',
                    selectOnClose: true,
                    language: {
                        noResults: function () {
                            return "No se encontraron resultados";
                        },
                        searching: function () {
                            return "Buscando..";
                        }
                    }
                });
                $('.select2-universidad').on('change', function(){
                    @this.set('universidad', this.value);
                });
            });
        });
        
    </script>
@endpush