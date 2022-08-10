@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Agregar Grado Académico</h2>

		<form action="{{ route('GradoAcademico.store') }}" method="POST" class="row g-3">
			@csrf

            <div class="col-md-6">
				<label for="inputGradoAca" class="form-label">Grado Académico *</label>
				<input type="text" class="form-control" id="inputGradoAca" name="nom_grado" maxlength="45" value="{{ old('nom_grado') }}">
                @error('nom_grado')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
				@enderror
			</div>

            <div class="col-12 d-flex justify-content-between">
				<a href="{{ route('GradoAcademico.index') }}" class="btn btn-secondary d-flex justify-content-center align-items-center"><i class="fas fa-angle-left me-1"></i> Regresar</a>
				<button type="submit" class="btn btn-primary d-flex justify-content-center align-items-center">Guardar <i class="fas fa-plus-circle ms-1"></i></button>
            </div>
		</form>

	</div>

@endsection
