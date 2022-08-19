@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Agregar Sub Programa</h2>

		<form action="{{ route('SubPrograma.store') }}" method="POST" class="row g-3">
			@csrf
			<div class="col-md-4">
				<label class="form-label">Código Sub Programa *</label>
				<input type="text" class="form-control" name="cod_subprograma" maxlength="10" value="{{ old('cod_subprograma') }}">
				@error('cod_subprograma')
					<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
				@enderror
			</div>
			<div class="col-md-8">
				<label class="form-label">Sub Programa *</label>
				<input type="text" class="form-control" name="subprograma" value="{{ old('subprograma') }}" onkeypress="return soloLetras(event)">
				@error('subprograma')
					<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
				@enderror
			</div>
			<div class="col-md-12">
                    <label class="form-label">Programa *</label>
                    <select class="form-select" name="id_programa">
						<option value="" selected>Seleccione</option>
						@foreach ($pro as $item)
						<option value="{{$item->id_programa}}">{{$item->sede->sede}} - {{$item->descripcion_programa}}</option>
						@endforeach
                    </select>
                    @error('id_programa')
						<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
			</div>
			<div class="col-12 d-flex justify-content-between">
				<a href="{{ route('SubPrograma.index') }}" class="btn btn-secondary d-flex justify-content-center align-items-center text-center"><i class="fas fa-angle-left me-1"></i> Regresar</a>
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
