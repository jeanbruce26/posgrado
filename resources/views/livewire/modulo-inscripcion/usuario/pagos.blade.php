<div class="row">
    <div class="m-auto">
        <div class="card">
            <h4 class="fw-bold mt-2 py-2 px-4">Validación de pago de constancia de ingreso y/o matricula</h4>
        </div>
        <div class="card">
            <div class="card-body form-steps">
                <div class="tab-content">
                    <div class="tab-pane fade show active">
                        <div class="">
                            <div class="card-body w-100">
                                <h4 class="fw-bold mb-4">Buscar mis pagos</h4>
                                <h6 class="mb-3">A continuación, selecciona tu concepto de pago y proporciona tu N° de documento de identidad para buscar su pago correspondiente: </h6>
                        
                                <form class="row" autocomplete="off" novalidate>
                                    @csrf
                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                        <label class="form-label">Concepto de pago <span class="text-danger" style="font-size: 0.7rem">(Obligatorio)</span></label>
                                        <select class="form-select @error('concepto_pago') is-invalid @enderror" wire:model="concepto_pago" aria-label="Default select example">
                                            <option value="" selected>Seleccione</option>
                                            @foreach ($concepto_pago_model as $item)
                                            <option value="{{$item->concepto_id}}">{{$item->concepto}} - S/. {{$item->monto}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-3 ol-md-12 col-sm-12">
                                        <label class="form-label">Tipo de documento <span class="text-danger" style="font-size: 0.7rem">(Obligatorio)</span></label>
                                        <select class="form-select @error('tipo_documento') is-invalid @enderror" wire:model="tipo_documento" aria-label="Default select example">
                                            <option value="" selected>Seleccione</option>
                                            @foreach ($tipo_documento_model as $item)
                                            <option value="{{$item->id_tipo_doc}}">{{$item->doc}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-3 col-md-12 col-sm-12">
                                        <label class="form-label">Documento <span class="text-danger" style="font-size: 0.7rem">(Obligatorio)</span></label>
                                        <input type="text" wire:model="documento" class="form-control @error('documento') is-invalid  @enderror" placeholder="Ingrese su documento">
                                    </div>
                                    <div class="col-lg-2 col-md-12 col-sm-12 d-flex align-items-end">
                                        <button type="button" wire:click="buscarPago()" class="btn btn-success w-100">Buscar</button>
                                    </div>
                                </form>
                                @if (session('mensaje-buscar'))
                                    <div class="alert alert-danger mt-3 mb-1 fw-bold">{{ session('mensaje-buscar') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- end tab pane -->
                </div>
                <!-- end tab content -->
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
        <div class="alert alert-info alert-dismissible alert-label-icon label-arrow shadow fade show" role="alert">
            <i class="ri-information-line label-icon"></i><strong>Recuerda</strong> - Si usted realizó el pago de la constancia de ingreso y/o matrícula, debe esperar 24 horas para que se actualice su estado de pago.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @if ($concepto_pago)
            @if ($concepto_pago == 4)
                <!-- Warning Alert -->
                <div class="alert alert-info alert-dismissible alert-label-icon label-arrow shadow fade show" role="alert">
                    <i class="ri-information-line label-icon"></i><strong>Recuerda</strong> - Para validar el pago de la constancia de ingreso y matricula, tiene que ser en un solo pago de S/. 180.00, no en pagos separados.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        @endif

        <div class="card mt-4">
            <div class="card-body form-steps">
                <div class="tab-content">
                    <div class="tab-pane fade show active">
                        <div class="mt-2">
                            <form novalidate>
                                <div class="card-body w-100">
                                    <h4 class="fw-bold mb-4">Selección de mis pagos</h4>
                                    <div class="">
                                        <!-- Striped Rows -->
                                        <table class="table table-hover align-middle table-nowrap mb-0">
                                            <thead>
                                                <tr align="center" style="background-color: rgb(232, 238, 255)">
                                                    <th scope="col" class="col-1">Nro</th>
                                                    <th scope="col" class="col-3">Fecha</th>
                                                    <th scope="col" class="col-4">Número Operación</th>
                                                    <th scope="col" class="col-3">Importe</th>
                                                    <th scope="col" class="col-1">Seleccionar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($pago_model)
                                                @foreach ($pago_model as $item)
                                                <tr>
                                                    <td align="center" class="fw-bold">{{$num++}}</td>
                                                    <td align="center">{{date('d/m/Y', strtotime($item->fecha_pago))}}</td>
                                                    <td align="center">{{$item->nro_operacion}}</td>
                                                    <td align="center">S/. {{number_format($item->monto,2)}}</td>
                                                    <td align="center">
                                                        <input type="checkbox" wire:model="seleccionar" value="{{ $item->pago_id }}" wire:click="contarMonto({{ $item->pago_id }})">
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @if ($pago_model->count() == 0)
                                                <tr>
                                                    <td colspan="5" align="center" class="text-muted">No hay datos</td>
                                                </tr>
                                                @endif
                                                @else
                                                <tr>
                                                    <td colspan="5" align="center" class="text-muted">No hay datos</td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                        <div class="d-flex justify-content-end me-4 mt-3">
                                            <strong>Total: S/. {{number_format($total,2)}}</strong>
                                        </div>
                                        @if (session('mensaje-seleccionar'))
                                            <div class="alert alert-danger my-3 fw-bold">{{ session('mensaje-seleccionar') }}</div>
                                        @endif
                                    </div>

                                    <div class="d-flex align-items-center justify-content-between mt-4">
                                        <a href="{{route('usuarios.index')}}" class="btn btn-secondary text-decoration-none btn-label"><i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i>Regresar</a>                
                                        <button type="button" wire:click="guardarPagoAlerta()" class="btn btn-primary btn-label right ms-auto"><i class="ri-arrow-up-line label-icon align-middle fs-16 ms-2"></i>Registrar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- end tab pane -->
                </div>
                <!-- end tab content -->
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>