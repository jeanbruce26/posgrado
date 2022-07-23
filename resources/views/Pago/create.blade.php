@extends ('admin')

@section('content')

<div class="col-sm-12">
		
    <h2 class="d-flex justify-content-between">Agregar Pago</h2>

    <form action="{{ route('Pago.store') }}" method="POST" class="row g-3">
        @csrf

        <div class="col-md-6">
            <label for="inputTipoPago" class="form-label">Tipo de Pago *</label>
            <select id="inputTipoPago" class="form-select" name="tipo_pago_cod_tipo_pago" value="{{ old('tipo_pago_cod_tipo_pago') }}"> 
                <option selected>Seleccione</option>
                @foreach ($tipoPago as $item)
                <option value="{{$item->cod_tipo_pago}}">{{$item->tipo_pago}}</option>
                @endforeach
            </select>
            @error('tipo_pago_cod_tipo_pago')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="inputConcepPago" class="form-label">Concepto de Pago *</label>
            <select id="inputConcepPago" class="form-select" name="concep_pago_cod_concep" value="{{ old('concep_pago_cod_concep') }}">
                <option selected>Seleccione</option>
                @foreach ($concepPago as $item)
                <option value="{{$item->cod_concep}}">{{$item->concepto}}</option>
                @endforeach
            </select>
            @error('concep_pago_cod_concep')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="inputMonto" class="form-label">Monto *</label>
            <input type="text" class="form-control" id="inputMonto" name="monto" maxlength="13" value="{{ old('monto') }}">
            @error('monto')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-6">
            <label for="inputFechaPago" class="form-label">Fecha de Pago *</label>
            <input type="date" class="form-control" id="inputFechaPago" name="fecha_pago" value="{{ old('fecha_pago') }}">
            @error('fecha_pago')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="col-6">
            <label for="inputDNI" class="form-label">DNI *</label>
            <input type="text" class="form-control" id="inputDNI" name="dni" maxlength="9" value="{{ old('dni') }}">
            @error('dni')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        
        
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Agregar</button>
        </div>
    </form>
</div>

@endsection
