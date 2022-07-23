@extends ('admin')

@section('content')

<div class="col-sm-12">
		
    <h2 class="d-flex justify-content-between">Agregar Ingreso de Pago</h2>

    <form action="{{ route('IngresoPago.store') }}" method="POST" class="row g-3">
        @csrf

        <div class="col-md-6">
            <label for="inputNumOpe" class="form-label">Número de Operación *</label>
            <input type="text" class="form-control" id="inputNumOpe" name="num_opera" maxlength="45" value="{{ old('num_opera') }}">
            @error('num_opera')
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
            <label for="inputFecha" class="form-label">Fecha *</label>
            <input type="date" class="form-control" id="inputFecha" name="fecha">
            
        </div>

        <div class="col-md-6">
            <label for="inputInscripcion" class="form-label">Inscripción *</label>
            <select id="inputInscripcion" class="form-select" name="id_inscripcion">
                <option selected>Seleccione</option>
                @foreach ($insc as $item)
                <option value="{{$item->id_inscripcion}}">{{$item->cod_inscripcion}}</option>
                @endforeach
            </select>
            @error('id_inscripcion')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-primary">Agregar</button>
        </div>
    </form>
</div>

@endsection
