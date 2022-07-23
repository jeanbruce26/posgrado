@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Agregar Discapacidad</h2>

		<form action="{{ route('Discapacidad.store') }}" method="POST" class="row g-3">
			@csrf

            <div class="col-md-6">
				<label for="inputDiscap" class="form-label">Discapacidad *</label>
				<input type="text" class="form-control" id="inputDiscap" name="discapacidad" maxlength="45" value="{{ old('discapacidad') }}">
                @error('discapacidad')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            	@enderror
			</div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">Agregar</button>
            </div>
		</form>

	</div>

@endsection
