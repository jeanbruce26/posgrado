@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Agregar Programa</h2>

		<form action="{{ route('Programa.store') }}" method="POST" class="row g-3">
			@csrf
			<div class="col-md-6">
				<label for="inputPrograma" class="form-label">Programa</label>
				<input type="text" class="form-control" id="inputPrograma" name="descripcion_programa"  value="{{ old('descripcion_programa') }}">
                    @error('descripcion_programa')
                         <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
               </div>
			<div class="col-12">
				<button type="submit" class="btn btn-primary">Agregar</button>
			</div>
		</form>

	</div>

@endsection
