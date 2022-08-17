@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Agregar Expediente</h2>

		<form action="{{ route('Expediente.store') }}" method="POST" class="row g-3">
			@csrf

            <div class="col-md-6">
				<label for="inputExp" class="form-label">Expediente *</label>
				<input type="text" class="form-control" id="inputExp" name="tipo_doc" maxlength="45" value="{{ old('tipo_doc') }}">
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

@endsection
