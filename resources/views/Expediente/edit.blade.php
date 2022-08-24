@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Editar Expediente</h2>

		<form action="{{ route('Expediente.update',$exp->cod_exp) }}" method="POST" class="row g-3">
			{{ method_field('PUT') }}
            @csrf
            
			<div class="col-md-6">
                <label for="inputExp" class="form-label">Tipo de Documento *</label>
				<input type="text" class="form-control" id="inputExp" name="tipo_doc"  value="{{ $exp->tipo_doc }}" onkeypress="return soloLetras(event)">
                    @error('tipo_doc')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
            </div>

			<div class="col-md-6">
				<label class="form-label">Texto complemento del documento</label>
				<input type="text" class="form-control" name="complemento" value="{{ $exp->complemento }}">
				@error('complemento')
					<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
				@enderror
			</div>

			<div class="col-6">
                <label for="inputRequerido" class="form-label">Requerido *</label>
                <select id="inputRequerido" class="form-select" name="requerido">
                    <option value="" selected>Seleccione</option>
                    <option value="1" {{ $exp->requerido == 1 ? 'selected' : '' }}> Si</option>
                    <option value="2" {{ $exp->requerido == 2 ? 'selected' : '' }}> No</option>
                </select>
                @error('requerido')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-6">
                <label for="inputEstado" class="form-label">Estado *</label>
                <select id="inputEstado" class="form-select" name="estado">
                    <option value="" selected>Seleccione</option>
                    <option value="1" {{ $exp->estado == 1 ? 'selected' : '' }}> Activo</option>
                    <option value="2" {{ $exp->estado == 2 ? 'selected' : '' }}> Inactivo</option>
                </select>
                @error('estado')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>

			<div class="col-12 d-flex justify-content-between">
				<a href="{{ route('Expediente.index') }}" class="btn btn-secondary d-flex justify-content-center align-items-center"><i class="fas fa-angle-left me-1"></i> Regresar</a>
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

@endsection
