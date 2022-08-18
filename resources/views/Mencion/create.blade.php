@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Agregar Mención</h2>

		<form action="{{ route('Mencion.store') }}" method="POST" class="row g-3">
			@csrf
			<div class="col-md-4">
				<label class="form-label">Código Mención</label>
				<input type="text" class="form-control" name="cod_mencion" maxlength="10" value="{{ old('cod_mencion') }}">
				@error('cod_mencion')
					<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
				@enderror
			</div>
			<div class="col-md-8">
				<label class="form-label">Mención</label>
				<input type="text" class="form-control" name="mencion" value="{{ old('mencion') }}" onkeypress="return soloLetras(event)">
				@error('mencion')
					<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
				@enderror
			</div>
			<div class="col-md-12">
                    <label class="form-label">Sub Programa *</label>
                    <select class="form-select" name="id_subprograma">
						<option value="" selected>Seleccione</option>
						@foreach ($sub as $item)
						<option value="{{$item->id_subprograma}}">{{$item->programa->descripcion_programa}} - {{$item->subprograma}}</option>
						@endforeach
                    </select>
                    @error('id_subprograma')
						<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
			</div>
			<div class="col-12 d-flex justify-content-between">
				<a href="{{ route('Mencion.index') }}" class="btn btn-secondary d-flex justify-content-center align-items-center"><i class="fas fa-angle-left me-1"></i> Regresar</a>
				<button type="submit" class="btn btn-primary d-flex justify-content-center align-items-center text-center">Guardar <i class="fas fa-plus-circle ms-1"></i></button>
            </div>
		</form>

	</div>

	<script>
		function soloLetras(e) {
			var key = e.keyCode || e.which,
				tecla = String.fromCharCode(key).toLowerCase(),
				letras = " áéíóúabcdefghijklmnñopqrstuvwxyz",
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
