@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Editar Programa</h2>

		<form action="{{ route('Programa.update',$pro->id_programa) }}" method="POST" class="row g-3">
               {{ method_field('PUT') }}
               @csrf
			<div class="col-md-6">
				<label for="inputPrograma" class="form-label">Programa</label>
				<input type="text" class="form-control" id="inputPrograma" name="descripcion_programa" value="{{ $pro->descripcion_programa }}">
                    @error('descripcion_programa')
                         <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
			</div>
			<div class="col-12">
				<button type="submit" class="btn btn-primary">Actualizar</button>
			</div>
		</form>

	</div>

@endsection
