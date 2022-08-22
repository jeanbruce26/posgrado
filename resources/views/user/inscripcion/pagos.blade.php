@extends ('user')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body f1">
                <h4 class="card-title mb-4">Inscripcion Escuela de Posgrado</h4>
                <div class="card">
                    <h5 class="card-header d-flex justify-content-star align-items-center">Mis pagos realizados:</h5>
                    <div class="card-body">
                        <h5 class="card-title mb-3 d-flex justify-content-star align-items-center">A continuación, selecciona tu Concepto de Pago y proporciona tu N° de Documento de Identidad:</h5>
                        <form action="{{ route('inscripcion.pagos') }}" method="post" class="row g-3" name="formularioBuscar" novalidate>
                            @csrf
                            <div class="col-md-4 d-flex flex-column justify-content-end align-items-star">
                                <label class="d-flex justify-content-star align-items-center">Concepto de Pago *</label>
                                <select class="form-select" name="concepto_pago" >
                                    <option value="" selected>Seleccione</option>
                                    @foreach ($concepto as $item)
                                    <option value="{{$item->concepto_id}}" {{ $item->concepto_id == old('concepto_pago') ? 'selected' : '' }} {{ $item->concepto_id == $concepto_id ? 'selected' : '' }} @if (session('concepto_pago')){{ session('concepto_pago') == $item->concepto_id ? 'selected' : '' }}@endif>{{$item->concepto}} - S/.{{$item->monto}}</option>
                                    @endforeach
                                </select>   
                            </div>
                            <div class="col-md-4 d-flex flex-column justify-content-end align-items-star">
                                <label class="d-flex justify-content-star align-items-center">Tipo Documento *</label>
                                <select class="form-select" name="tipo_documento">
                                    <option value="" selected>Seleccione</option>
                                    @foreach ($tipo_doc as $item)
                                    <option value="{{$item->id_tipo_doc}}" {{ $item->id_tipo_doc == old('tipo_documento') ? 'selected' : '' }} {{ $item->id_tipo_doc == $tipodoc_id ? 'selected' : '' }} @if (session('tipo_documento')){{ session('tipo_documento') == $item->id_tipo_doc ? 'selected' : '' }}@endif>{{$item->doc}}</option>
                                    @endforeach
                                </select>
                                {{-- @error('tipo_documento')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror --}}
                            </div>
                            <div class="col-md-3 d-flex flex-column justify-content-end align-items-star">
                                <label class="d-flex justify-content-star align-items-center">Numero Documento *</label>
                                <input type="text" class="form-control" name="numero_documento" value="{{ old('numero_documento', $doc) }}@if (session('numero_documento')){{ session('numero_documento') }}@endif" onkeypress="return soloNumeros(event)">
                                {{-- @error('numero_documento')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror --}}
                            </div>
                            <div class="col-md-1 d-flex justify-content-center align-items-end">
                                <button type="submit" class="btn btn-success">Buscar</button>
                            </div>
                            @if ($errors->any())
                                <div class="alert alert-danger text-start">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (session('mensaje-dni'))
                                <div class="alert alert-danger mt-1 mb-1">{{ session('mensaje-dni') }}</div>
                            @endif
                        </form>
                        <form action="{{ route('inscripcion.guardar-pagos') }}" method="post" onsubmit="formularioGuardar(event)">
                            @csrf
                            <div class="table-responsive">
                                <table class="table table-editable table-nowrap align-middle table-edits">
                                    <thead>
                                        <tr>
                                            <th>Nro.</th>
                                            <th>Fecha</th>
                                            <th>Nro. Operacion</th>
                                            <th>Importe</th>
                                            <th>Seleccione</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $n = 1;
                                        @endphp
                                        @if ($pago != null)
                                            @foreach ($pago as $item)
                                            <tr>
                                                <td style="width: 50px">{{ $n}}</td>
                                                <td>{{ $item->fecha_pago }}</td>
                                                <td>{{ $item->nro_operacion }}</td>
                                                <td>{{ $item->monto }}</td>
                                                <td style="width: 50px">
                                                    <input type="checkbox" name="seleccionar[]" id="seleccionar" value="{{ $item->pago_id }}">
                                                </td>
                                            </tr>
                                            @php
                                                $n++;
                                            @endphp
                                            @endforeach
                                        @else
                                        <tr>
                                            <td colspan="5">Ingrese los datos correspondientes para mostrar sus pagos.</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <input type="hidden" name="concepto_id" value="{{ $concepto_id }}">
                            <input type="hidden" name="tipodoc_id" value="{{ $tipodoc_id }}">
                            <input type="hidden" name="doc" value="{{ $doc }}">
                            @if (session('mensaje-seleccionar'))
                                <div class="alert alert-danger mt-1 mb-1">{{ session('mensaje-seleccionar') }}</div>
                            @endif
                            <div id="mostrar">

                            </div>
                            {{-- @if (session('enviar'))
                                <script>
                                    document.formularioBuscar.submit()
                                </script>
                            @endif --}}
                            <div class="mt-3 d-flex justify-content-end">
                                <button type="submit" class="btn btn-next">Guardar</button>
                            </div>
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

{{-- Validacion de campos numericos --}}
<script>
    function soloNumeros(e) {
        var key = e.keyCode || e.which,
            tecla = String.fromCharCode(key).toLowerCase(),
            letras = "1234567890.",
            especiales = [8, 37, 39, 46],
            tecla_especial = false;
    
        for (var i in especiales) {
            if (key == especiales[i]) {
            tecla_especial = true;
            break;
            }
        }
    
        if (letras.indexOf(tecla) == -1 && !tecla_especial) {
            return false;
        }
    }

    function formularioGuardar(event){

        const check = document.querySelector('#seleccionar');
        console.log(check.checked)

        if(check.checked == false){
            // alert('seleccione su pago');
            document.querySelector('#mostrar').innerHTML = "<div class='"+"alert alert-danger mt-1 mb-1'"+">Debe seleccionar su pago, para continuar con su inscripcion.</div>"
            event.preventDefault();
        }else{
            this.submit();
        }
    }
</script>

@endsection