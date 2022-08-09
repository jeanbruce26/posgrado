@extends ('admin')

@section('content')

<div class="col-sm-12">
		
    <h2 class="d-flex justify-content-between">Agregar Pago</h2>

    <form action="{{ route('Pago.store') }}" method="POST" class="row g-3">
        @csrf

        <div class="col-6">
            <label class="form-label">DNI *</label>
            <input type="text" class="form-control" name="dni" maxlength="10" value="{{ old('dni') }}">
            @error('dni')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-6">
            <label class="form-label">Nro Operacion *</label>
            <input type="text" class="form-control" name="nro_operacion" maxlength="10" value="{{ old('nro_operacion') }}">
            @error('nro_operacion')
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

        <div class="col-md-6">
            <label class="form-label">Canal de Pago *</label>
            <select class="form-select" name="canal_pago_id" value="{{ old('canal_pago_id') }}"> 
                <option value="" selected>Seleccione</option>
                @foreach ($canal as $item)
                <option value="{{$item->canal_pago_id}}">{{$item->descripcion}}</option>
                @endforeach
            </select>
            @error('canal_pago_id')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label class="form-label">Estado *</label>
            <select class="form-select" name="estado" value="{{ old('estado') }}"> 
                <option value="" selected>Seleccione</option>
                <option value="1">Activo</option>
            </select>
            @error('estado')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Agregar</button>
        </div>
    </form>
</div>

@endsection
