@extends ('admin')

@section('content')

<div class="col-sm-12">
		
    <h2 class="d-flex justify-content-between">Agregar Pago</h2>

    <form action="{{ route('Pago.store') }}" method="POST" class="row g-3">
        @csrf

        <div class="col-6">
            <label class="form-label">Documento *</label>
            <input type="text" class="form-control" name="dni" maxlength="9" value="{{ old('dni') }}" onkeypress="return soloNumeros(event)">
            @error('dni')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-6">
            <label class="form-label">Número Operación *</label>
            <input type="text" class="form-control" name="nro_operacion" maxlength="10" value="{{ old('nro_operacion') }}" onkeypress="return soloNumeros(event)">
            @error('nro_operacion')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="col-md-6">
            <label for="inputMonto" class="form-label">Monto *</label>
            <input type="text" class="form-control" id="inputMonto" name="monto" maxlength="13" value="{{ old('monto') }}" onkeypress="return soloNumeros(event)">
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
                <option value="1">Pagado</option>
                <option value="2">Verificado</option>
                <option value="3">Inscripto</option>
            </select>
            @error('estado')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-12 d-flex justify-content-between">
            <a href="{{ route('Pago.index') }}" class="btn btn-secondary d-flex justify-content-center align-items-center"><i class="fas fa-angle-left me-1"></i> Regresar</a>
            <button  class="btn btn-primary d-flex justify-content-center align-items-center">Guardar <i class="fas fa-plus-circle ms-1"></i></button>
        </div>
    </form>
</div>

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
</script>

@endsection
