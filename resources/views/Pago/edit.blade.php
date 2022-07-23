@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Editar Pago</h2>

		<form action="{{ route('Pago.update',$pago->cod_pago) }}" method="POST" class="row g-3">
			{{ method_field('PUT') }}
            @csrf

            <div class="col-md-6">
                <label for="inputTipoPago" class="form-label">Tipo Pago *</label>
				<select id="inputTipoPago" class="form-select" name="tipo_pago_cod_tipo_pago">
                    <option selected>Seleccione</option>
                    @foreach ($tipoPago as $item)
                    <option value="{{$item->cod_tipo_pago  }}" {{ $item->cod_tipo_pago == $pago->tipo_pago_cod_tipo_pago ? 'selected' : '' }}>{{$item->tipo_pago}}</option>
                    @endforeach
                </select>
                    @error('tipo_pago_cod_tipo_pago')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
            </div>
            
            <div class="col-md-6">
                <label for="inputConcepPago" class="form-label">Concepto de Pago *</label>
				<select id="inputConcepPago" class="form-select" name="concep_pago_cod_concep">
                    <option selected>Seleccione</option>
                    @foreach ($concepPago as $item)
                    <option value="{{$item->cod_concep  }}" {{ $item->cod_concep   == $pago->concep_pago_cod_concep ? 'selected' : '' }}>{{$item->concepto}}</option>
                    @endforeach
                </select>
                    @error('concep_pago_cod_concep')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
            </div>

            <div class="col-md-6">
                <label for="inputMonto" class="form-label">Monto *</label>
                <input type="text" class="form-control" id="inputMonto" name="monto"  value="{{ $pago->monto }}">
                @error('monto')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
    
            <div class="col-6">
                <label for="inputFechaPago" class="form-label">Fecha de Pago *</label>
                <input type="date" class="form-control" id="inputFechaPago" name="fecha_pago" value="{{ $pago->fecha_pago }}">
                @error('fecha_pago')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="col-6">
                <label for="inputDNI" class="form-label">DNI *</label>
                <input type="text" class="form-control" id="inputDNI" name="dni" maxlength="9" value="{{ $pago->dni }}">
                @error('dni')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>

			<div class="col-12">
				<button type="submit" class="btn btn-primary">Actualizar</button>
			</div>
		</form>

	</div>

@endsection
