@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Agregar Sub Programa</h2>

		<form action="{{ route('SubPrograma.store') }}" method="POST" class="row g-3">
			@csrf
			<div class="col-md-4">
				<label class="form-label">Codigo Sub Programa *</label>
				<input type="text" class="form-control" name="cod_subprograma" maxlength="10" value="{{ old('cod_subprograma') }}">
				@error('cod_subprograma')
						<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
			</div>
			<div class="col-md-8">
				<label class="form-label">Sub Programa *</label>
				<input type="text" class="form-control" name="subprograma" value="{{ old('subprograma') }}">
				@error('subprograma')
						<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
			</div>
			<div class="col-md-12">
                    <label class="form-label">Programa *</label>
                    <select class="form-select" name="id_programa">
						<option selected>Seleccione</option>
						@foreach ($pro as $item)
						<option value="{{$item->id_programa}}">{{$item->descripcion_programa}}</option>
						@endforeach
                    </select>
                    @error('id_programa')
						<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
			</div>
			<div class="col-12">
				<button type="submit" class="btn btn-primary">Agregar</button>
			</div>
		</form>

	</div>

@endsection
