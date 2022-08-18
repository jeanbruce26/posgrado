@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Agregar Universidad</h2>

		<form action="{{ route('Universidad.store') }}" method="POST" class="row g-3">
			@csrf
               <div class="col-md-12">
                    <label class="form-label">Universidad *</label>
                    <input type="text" class="form-control" name="universidad"  value="{{ old('universidad') }}" onkeypress="return soloLetras(event)">
                    @error('universidad')
                         <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
               </div>
			<div class="col-md-6">
				<label class="form-label">Departamento *</label>
				<input type="text" class="form-control" name="depart"  value="{{ old('depart') }}" onkeypress="return soloLetras(event)">
                    @error('depart')
                         <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
               </div>
               <div class="col-md-6">
				<label class="form-label">Tipo de Gestión *</label>
				<input type="text" class="form-control" name="tipo_gesti"  value="{{ old('tipo_gesti') }}" onkeypress="return soloLetras(event)">
                    @error('tipo_gesti')
                         <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
               </div>
			<div class="col-12 d-flex justify-content-between">
				<a href="{{ route('Universidad.index') }}" class="btn btn-secondary d-flex justify-content-center align-items-center text-center"><i class="fas fa-angle-left me-1"></i> Regresar</a>
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
