@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Agregar Expediente</h2>

		<form action="{{ route('Expediente.store') }}" method="POST" class="row g-3">
			@csrf

            <div class="col-md-6">
				<label for="inputExp" class="form-label">Tipo de Documento *</label>
				<input type="text" class="form-control" id="inputExp" name="tipo_doc" maxlength="45" value="{{ old('tipo_doc') }}" onkeypress="return soloLetras(event)">
				@error('tipo_doc')
					<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
				@enderror
			</div>

            <div class="col-md-6">
				<label for="inputEstado" class="form-label">Estado *</label>
                <select class="form-select" name="estado">
                    <option value="" selected>Seleccione</option>
                    <option value="1">Activo</option>
                    <option value="2">Inactivo</option>
                </select>
                @error('estado')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
			</div>

            <div class="col-12 d-flex justify-content-between">
				<a href="{{ route('Expediente.index') }}" class="btn btn-secondary d-flex justify-content-center align-items-center"><i class="fas fa-angle-left me-1"></i> Regresar</a>
                <button  class="btn btn-primary d-flex justify-content-center align-items-center">Guardar <i class="fas fa-plus-circle ms-1"></i></button>
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
