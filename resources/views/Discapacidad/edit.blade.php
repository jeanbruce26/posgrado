@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Editar Discapacidad</h2>

		<form action="{{ route('Discapacidad.update',$disca->cod_disc) }}" method="POST" class="row g-3">
			{{ method_field('PUT') }}
			@csrf

			<div class="col-md-6">
				<label for="inputDisca" class="form-label">Discapacidad *</label>
				<input type="text" class="form-control" id="inputDisca" name="discapacidad" value="{{ $disca->discapacidad }}">
                    @error('discapacidad')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
			</div>
			<div class="col-12">
				<button type="submit" class="btn btn-primary">Actualizar</button>
			</div>
		</form>

	</div>

@endsection
