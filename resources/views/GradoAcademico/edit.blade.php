@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Editar Grado Académico</h2>

		<form action="{{ route('GradoAcademico.update',$gradoAca->id_grado_academico) }}" method="POST" class="row g-3">
			{{ method_field('PUT') }}
			@csrf

			<div class="col-md-6">
				<label for="inputGradoAca" class="form-label">Plan</label>
				<input type="text" class="form-control" id="inputGradoAca" name="nom_grado" value="{{ $gradoAca->nom_grado }}">
                    @error('nom_grado')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
			</div>
			<div class="col-12">
				<button type="submit" class="btn btn-primary">Actualizar</button>
			</div>
		</form>

	</div>

@endsection
