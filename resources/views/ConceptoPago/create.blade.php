@extends ('admin')

@section('content')

<div class="col-sm-12">
		
    <h2 class="d-flex justify-content-between">Agregar Concepto de Pago</h2>

    <form action="{{ route('ConceptoPago.store') }}" method="POST" class="row g-3">
        @csrf

        <div class="col-md-4">
            <label for="inputConcepto" class="form-label">Concepto *</label>
            <input type="text" class="form-control" id="inputConcepto" name="concepto" maxlength="45" value="{{ old('concepto') }}">
            @error('concepto')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="inputMonto" class="form-label">Monto *</label>
            <input type="text" class="form-control" id="inputMonto" name="monto" maxlength="13" value="{{ old('monto') }}">
            @error('monto')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-4">
            <label for="inputEstado" class="form-label">Estado *</label>
            <select id="inputEstado" class="form-select" name="estado">
                <option selected>Seleccione</option>
                <option value="1"> ACTIVO</option>
                <option value="2"> DESACTIVO</option>
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
