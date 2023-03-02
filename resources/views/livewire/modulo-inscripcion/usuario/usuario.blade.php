<div>
    @if ($lista_admitidos == 0)
        <div class="alert alert-info alert-dismissible alert-label-icon rounded-label shadow fade show" role="alert">
            <i class="ri-information-line label-icon"></i><strong>Los resultados de admitidos se presentará el {{ $admision_fecha_admitidos }}.</strong>
        </div>
    @else
        @if ($admitido)
        <div class="alert alert-success alert-solid shadow" role="alert">
            <strong>¡Admitido!</strong>
        </div>
        @else
        <div class="alert alert-danger alert-solid shadow" role="alert">
            <strong>¡No admitido!</strong>
        </div>
        @endif
    @endif
    @if (date('Y/m/d', strtotime($fecha_admision_normal)) >= date('Y/m/d', strtotime(today())))
        <div class="alert alert-info alert-dismissible alert-label-icon rounded-label shadow fade show" role="alert">
            <i class="ri-information-line label-icon"></i><strong>Recuerde que la fecha limite para actualizar sus expedientes es el {{ $fecha_admision }}.</strong>
        </div>
        @if ($contador != $expediente_count)
        <div class="alert alert-warning alert-dismissible alert-label-icon rounded-label shadow fade show" role="alert">
            <i class="ri-alert-line label-icon"></i><strong>Usted tiene expedientes pendientes por subir a la plataforma, por favor complete el formulario debido.</strong>
        </div>
        @endif
    @endif
    @if ($expediente_seguimiento_count > 0)
        <div class="alert alert-warning alert-dismissible alert-label-icon rounded-label shadow fade show" role="alert">
            <i class="ri-information-line label-icon"></i>
            <strong>
                Recuerde que tiene por regularizar su Constancia de Registro ante la SUNEDU, por favor ingrese a la sección de expedientes y suba su documento.
            </strong>
        </div>
    @endif

    <div class="mt-4">
        <div class="card">
            <h4 class="card-header d-flex fw-bold justify-content-between align-items-center">
                <span>
                    Bienvenido {{$nombre}}.
                </span>
                @if ($admision_fecha_constancia <= today())
                <a href="#modalRegistrarPago" wire:click="modal_registrar_pago" class="btn btn-info bg-gradient waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#modalRegistrarPago">
                    Registrar Pago
                </a>
                @endif
            </h4>    
            <div class="card-text px-5 my-2 d-flex justify-content-around row g-3">
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                    <div class="card card-body text-center" style="background-color: #ebf7ff">
                        <div class="avatar-sm mx-auto mb-3">
                            <div class="avatar-title bg-soft-primary text-primary fs-17 rounded">
                                <i class="ri-newspaper-line fs-1"></i>
                            </div>
                        </div>
                        <h4 class="card-title mb-3"><strong>Ficha de Inscripción</strong></h4>
                        <a target="_blank" href="{{asset(auth('usuarios')->user()->inscripcion)}}" class="btn btn-success">Descargar</a>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                    <div class="card card-body text-center" style="background-color: #ebf7ff">
                        <div class="avatar-sm mx-auto mb-3">
                            <div class="avatar-title bg-soft-primary text-primary fs-17 rounded">
                                <i class="ri-newspaper-line fs-1"></i>
                            </div> 
                        </div>
                        <h4 class="card-title mb-3"><strong>Prospecto de Admisión</strong></h4>
                        <a target="_blank" href="{{ asset('Manual/prospecto-admision-posgrado.pdf') }}" class="btn btn-success">Descargar</a>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                    <div class="card card-body" style="background-color: #ebf7ff">
                        <div class="avatar-sm mx-auto mb-3">
                            <div class="avatar-title bg-soft-primary text-primary fs-17 rounded">
                                <i class="ri-folder-5-line fs-1"></i>
                            </div>
                        </div>
                        <h4 class="card-title mb-3 text-center"><strong>Expedientes</strong></h4>
                        <a href="{{route('usuarios.edit')}}" type="button" class="btn btn-success">Ver detalle</a>
                    </div>
                </div>
                @if ($pago_constancia_ingreso == 1)
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                    <div class="card card-body text-center" style="background-color: #ebf7ff">
                        <div class="avatar-sm mx-auto mb-3">
                            <div class="avatar-title bg-soft-primary text-primary fs-17 rounded">
                                <i class="ri-newspaper-line fs-1"></i>
                            </div>
                        </div>
                        <h4 class="card-title mb-3"><strong>Constancia de Ingreso</strong></h4>

                        @if ($admitido->constancia == null)
                        <button type="button" wire:click="generarConstancia({{ $admitido->admitidos_id }})" class="btn btn-success">Generar PDF</button>
                        @else
                        <a target="_blank" href="{{ asset($admitido->constancia) }}" class="btn btn-success">Descargar</a>
                        @endif
                    </div>
                </div>
                @endif
                @if ($pago_matricula == 1)
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                    <div class="card card-body text-center" style="background-color: #ebf7ff">
                        <div class="avatar-sm mx-auto mb-3">
                            <div class="avatar-title bg-soft-primary text-primary fs-17 rounded">
                                <i class="ri-newspaper-line fs-1"></i>
                            </div>
                        </div>
                        <h4 class="card-title mb-3"><strong>Ficha de Matricula</strong></h4>

                        @if ($matricula_pago)
                            @if ($matricula_pago->ficha_matricula == null)
                            <button type="button" wire:click="generarFichaMatricula({{ $admitido->admitidos_id }})" class="btn btn-success">Generar PDF</button>
                            @else
                            <a target="_blank" href="{{ asset($matricula_pago->ficha_matricula) }}" class="btn btn-success">Descargar</a>
                            @endif
                        @endif
                    </div>
                </div>
                @endif
                {{-- @if ($admision_fecha_constancia <= today())
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                    <div class="card card-body" style="background-color: #ebf7ff">
                        <div class="avatar-sm mx-auto mb-3">
                            <div class="avatar-title bg-soft-primary text-primary fs-17 rounded">
                                <i class="ri-money-dollar-circle-line fs-1"></i>
                            </div>
                        </div>
                        <h4 class="card-title mb-3 text-center"><strong>Registrar Pago</strong></h4>
                        <a href="#modalRegistrarPago" wire:click="modal_registrar_pago" type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalRegistrarPago">Ingresar</a>
                    </div>
                </div>
                @endif --}}
            </div>
        </div>
        <!-- end tab pane -->
    </div>
    <!-- end tab content -->
    {{-- Modal Usuario --}}
    <div wire:ignore.self class="modal fade" id="modalRegistrarPago" tabindex="-1" aria-labelledby="modalRegistrarPago"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-uppercase" id="exampleModalLabel">{{ $titulo_modal }}</h5>
                    <button type="button" wire:click="limpiar_modal()" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form novalidate>
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Documento de Identidad <span
                                        class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('documento') is-invalid  @enderror" wire:model="documento" placeholder="Ingrese su número de documento de identidad">
                                @error('documento') <span class="error text-danger" >{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3 col-md-12">
                                <label class="form-label"> Número de Operación
                                    <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('numero_operacion') is-invalid  @enderror" wire:model="numero_operacion" placeholder="Ingrese su número de operacion">
                                <span class="fs-7 mt-2" style="color: #626262">
                                    Nota: Omitir los ceros iniciales. Ejemplo: 00001234, debe ingresar 1234 <br>
                                </span>
                                @error('numero_operacion') <span class="error text-danger" >{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3 col-md-12">
                                <label class="form-label"> Monto de Operación
                                    <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('monto_operacion') is-invalid  @enderror" wire:model="monto_operacion" placeholder="Ingrese el monto de la operacion">
                                @error('monto_operacion') <span class="error text-danger" >{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3 col-md-12">
                                <label class="form-label"> Fecha de Operación
                                    <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('fecha_operacion') is-invalid  @enderror" wire:model="fecha_operacion">
                                @error('fecha_operacion') <span class="error text-danger" >{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3 col-md-12">
                                <label class="form-label"> Canal de Pago
                                    <span class="text-danger">*</span></label>
                                <select type="text" class="form-select @error('canal_pago') is-invalid @enderror" wire:model="canal_pago">
                                    <option value="">Seleccione su concepto de pago</option>
                                    @foreach ($canal_pago_model as $item)
                                        <option value="{{ $item->canal_pago_id }}">Pagado en el {{ $item->descripcion }}</option>
                                    @endforeach
                                </select>
                                @error('canal_pago') <span class="error text-danger" >{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3 col-md-12">
                                <label class="form-label"> Concepto de Pago
                                    <span class="text-danger">*</span></label>
                                <select type="text" class="form-select @error('concepto_pago') is-invalid  @enderror" wire:model="concepto_pago">
                                    <option value="">Seleccione su concepto de pago</option>
                                    @foreach ($concepto_pago_model as $item)
                                        <option value="{{ $item->concepto_id }}">{{ $item->concepto }} - S/. {{ $item->monto }}</option>
                                    @endforeach
                                </select>
                                @error('concepto_pago') <span class="error text-danger" >{{ $message }}</span> @enderror
                            </div>
                            @if ($concepto_pago == 3 || $concepto_pago == 4)
                            <div class="mb-3 col-md-12">
                                <label class="form-label"> Ciclo Académico
                                    <span class="text-danger">*</span></label>
                                <select type="text" class="form-select @error('ciclo') is-invalid  @enderror" wire:model="ciclo">
                                    <option value="">Seleccione un ciclo</option>
                                    @foreach ($ciclo_model as $ciclo)
                                        <option value="{{ $ciclo->ciclo_id }}">{{ $ciclo->ciclo }}</option>
                                    @endforeach
                                </select>
                                @error('ciclo') <span class="error text-danger" >{{ $message }}</span> @enderror
                            </div>
                            @endif
                            <div class="mb-3 col-md-12">
                                <label class="form-label"> Voucher de Pago
                                    <span class="text-danger">*</span></label>
                                <input type="file" class="form-control @error('voucher') is-invalid  @enderror" wire:model="voucher" accept="image/*,application/pdf" id="upload{{ $iteration }}">
                                <span  class="fs-7 mt-2" style="color: #626262">
                                    Nota: El voucher debe ser en formato PDF o imagen JPG, JPEG, PNG <br>
                                </span>
                                @error('voucher') <span class="error text-danger" >{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer col-12 d-flex justify-content-between">
                    <button type="button" wire:click="limpiar_modal()" class="btn btn-secondary btn-label waves-effect waves-light w-md" data-bs-dismiss="modal"><i class="ri-arrow-left-s-line label-icon align-middle fs-16 me-2"></i> Cancelar</button>
                    <button type="button" wire:click="cargar_alerta_registrarPago()" class="btn btn-primary btn-label waves-effect right waves-light w-md"><i class="ri-check-double-fill label-icon align-middle fs-16 ms-2"></i> Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>