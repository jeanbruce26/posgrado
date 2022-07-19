@extends ('admin')

@section('content')

<form class="row g-3">
    <div class="col-md-6">
        <label for="inputNumOpe" class="form-label">Número de Operación</label>
        <input type="text" class="form-control" id="inputNumOpe" name="num_ope" maxlength="45" value="{{ old('num_ope') }}">
    </div>
    <div class="col-md-6">
        <label for="inputMonto" class="form-label">Monto</label>
        <input type="text" class="form-control" id="inputMonto" name="monto" maxlength="13" value="{{ old('monto') }}">
    </div>
    <div class="col-6">
        <label for="inputFecha" class="form-label">Fecha</label>
        <input type="date" class="form-control" id="inputFecha" name="fecha">
    </div>
    
    <div class="col-12">
        <button type="submit" class="btn btn-primary">Agregar</button>
    </div>
</form>

@endsection
