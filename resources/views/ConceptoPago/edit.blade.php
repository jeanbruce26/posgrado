@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Editar Concepto de Pago</h2>

		<form action="{{ route('ConceptoPago.update',$concepPago->concepto_id) }}" method="POST" class="row g-3">
			{{ method_field('PUT') }}
            @csrf

            <div class="col-md-4">
                <label for="inputConcepto" class="form-label">Concepto *</label>
				<input type="text" class="form-control" id="inputConcepto" name="concepto" maxlength="45" value="{{ $concepPago->concepto }}" onkeypress="return soloLetras(event)">
                    @error('concepto')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
            </div>

            <div class="col-4">
                <label for="inputMonto" class="form-label">Monto *</label>
                <input type="text" class="form-control" id="inputMonto" name="monto" maxlength="13" value="{{ $concepPago->monto }}" onkeypress="return soloNumeros(event)">
                @error('monto')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-4">
                <label for="inputEstado" class="form-label">Estado *</label>
                <select id="inputEstado" class="form-select" name="estado">
                    <option value="" selected>Seleccione</option>
                    <option value="1" {{ $concepPago->estado == 1 ? 'selected' : '' }}> Activo</option>
                    <option value="2" {{ $concepPago->estado == 2 ? 'selected' : '' }}> Inactivo</option>
                </select>
                @error('estado')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>

			<div class="col-12 d-flex justify-content-between">
				<a href="{{ route('ConceptoPago.index') }}" class="btn btn-secondary d-flex justify-content-center align-items-center"><i class="fas fa-angle-left me-1"></i> Regresar</a>
				<button type="submit" class="btn btn-primary d-flex justify-content-center align-items-center">Guardar <i class="fas fa-edit ms-1"></i></button>
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
