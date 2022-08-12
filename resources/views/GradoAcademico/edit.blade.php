@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Editar Grado Académico</h2>

		<form action="{{ route('GradoAcademico.update',$gradoAca->id_grado_academico) }}" method="POST" class="row g-3">
			{{ method_field('PUT') }}
			@csrf

			<div class="col-md-12">
				<label for="inputGradoAca" class="form-label">Plan</label>
				<input type="text" class="form-control" id="inputGradoAca" name="nom_grado" value="{{ $gradoAca->nom_grado }}">
                    @error('nom_grado')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
			</div>
			<div class="col-12 d-flex justify-content-between">
				<a href="{{ route('GradoAcademico.index') }}" class="btn btn-secondary d-flex justify-content-center align-items-center"><i class="fas fa-angle-left me-1"></i> Regresar</a>
				<button type="submit" class="btn btn-primary d-flex justify-content-center align-items-center">Guardar <i class="fas fa-edit ms-1"></i></button>
			</div>
		</form>

	</div>

@endsection
