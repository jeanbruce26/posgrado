<div class="row">
    <div class="col-10 m-auto">
        {{-- <div class="card">
            <h4 class="card-body fw-bold mt-2">Mis pagos realizados</h4>
        </div> --}}
        <div class="card">
            <div class="card-body form-steps">
                <div class="tab-content">
                    <div class="tab-pane fade show active">
                        <div class="">
                            <div class="card-body w-100">
                                <h4 class="fw-bold mb-4">Buscar mis pagos</h4>
                                <h6 class="mb-3">A continuación, selecciona tu concepto de pago y proporciona tu N° de documento de identidad para buscar su pago correspondiente: </h6>
                        
                                <form class="row" method="POST" wire:submit.prevent='buscarPago' novalidate>
                                    @csrf
                                    <div class="col-4">
                                        <label class="form-label">Concepto de pago <span class="text-danger" style="font-size: 0.7rem">(Obligatorio)</span></label>
                                        <select class="form-select @error('concepto_pago2') is-invalid @enderror" wire:model="concepto_pago2" aria-label="Default select example">
                                            <option value="" selected>Seleccione</option>
                                            @foreach ($concepto_pago as $item)
                                            <option value="{{$item->concepto_id}}" {{ old('concepto_pago2') == $item->concepto_id ? 'selected' : '' }}>{{$item->concepto}} - S/. {{$item->monto}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <label class="form-label">Tipo de documento <span class="text-danger" style="font-size: 0.7rem">(Obligatorio)</span></label>
                                        <select class="form-select @error('tipo_documento2') is-invalid @enderror" wire:model="tipo_documento2" aria-label="Default select example">
                                            <option value="" selected>Seleccione</option>
                                            @foreach ($tipo_documento as $item)
                                            <option value="{{$item->id_tipo_doc}}" {{ old('tipo_documento') == $item->id_tipo_doc ? 'selected' : '' }}>{{$item->doc}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <label class="form-label">Documento <span class="text-danger" style="font-size: 0.7rem">(Obligatorio)</span></label>
                                        <input type="text" id="documento" wire:model="documento" class="form-control @error('documento') is-invalid  @enderror" placeholder="Ingrese su documento">
                                    </div>
                                    <div class="col-2 d-flex align-items-end">
                                        <button type="submit" class="btn btn-success w-100">Buscar</button>
                                    </div>
                                </form>
                                @if (session('mensaje-dni'))
                                    <div class="alert alert-danger mt-3 mb-1 fw-bold">{{ session('mensaje-dni') }}</div>
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

        <div class="card">
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
                                                @php
                                                    $num = 1;
                                                @endphp
                                                @if (isset($pago))
                                                @foreach ($pago as $item)
                                                <tr wire:loading.class.delay="opacity-50" wire:key="{{$item->pago_id}}" style="cursor: pointer" wire:click="seleccionarPago({{$item->pago_id}})">
                                                    <td align="center" class="fw-bold">{{$num++}}</td>
                                                    <td align="center">{{date('d/m/Y', strtotime($item->fecha_pago))}}</td>
                                                    <td align="center">{{$item->nro_operacion}}</td>
                                                    <td align="center">S/. {{number_format($item->monto,2)}}</td>
                                                    <td align="center">
                                                        <input type="checkbox" wire:model="seleccionar" value="{{$item->pago_id}}" wire:click="contarMonto({{$item->pago_id}})">
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @else
                                                <tr>
                                                    <td colspan="5" align="center" class="text-muted">No hay datos</td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                        <div class="d-flex justify-content-end me-4 mt-3">
                                            <strong>Total: S/. {{number_format($total,2)}}</strong>
                                            <input type="hidden" wire:model="total" value="{{$total}}">
                                        </div>
                                        @if (session('mensaje-seleccionar'))
                                            <div class="alert alert-danger my-3 fw-bold">{{ session('mensaje-seleccionar') }}</div>
                                        @endif
                                    </div>

                                    <div class="d-flex align-items-start gap-3 mt-4">
                                        <button type="button"  wire:click="guardarPagoAlerta()" class="btn btn-primary btn-label right ms-auto"><i class="ri-arrow-up-line label-icon align-middle fs-16 ms-2"></i>Guardar</button>
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