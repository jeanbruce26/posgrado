@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Agregar Admisión</h2>

		<form action="{{ route('Admision.store') }}" method="POST" class="row g-3">
			@csrf

            <div class="col-md-6">
				<label for="inputAdmision" class="form-label">Admisión *</label>
				<input type="text" class="form-control" id="inputAdmision" name="admision" maxlength="45" value="{{ old('admision') }}">
				@error('admision')
					<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
				@enderror
			</div>
			<div class="col-md-6">
				<label class="form-label">Estado *</label>
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
				<a href="{{ route('Admision.index') }}" class="btn btn-secondary d-flex justify-content-center align-items-center"><i class="fas fa-angle-left me-1"></i> Regresar</a>
                <button  class="btn btn-primary d-flex justify-content-center align-items-center">Guardar <i class="fas fa-plus-circle ms-1"></i></button>
            </div>
		</form>

	</div>

@endsection
