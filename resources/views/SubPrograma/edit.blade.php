@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Editar Sub Programa</h2>

		<form action="{{ route('SubPrograma.update',$sub->id_subprograma) }}" method="POST" class="row g-3">
			{{ method_field('PUT') }}
			@csrf
			<div class="col-md-4">
				<label class="form-label">Codigo Mencion *</label>
				<input type="text" class="form-control"  name="cod_subprograma" value="{{ $sub->cod_subprograma }}">
                    @error('cod_subprograma')
						<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
			</div>
			<div class="col-md-8">
				<label class="form-label">Mencion *</label>
				<input type="text" class="form-control" name="subprograma" value="{{ $sub->subprograma }}">
				@error('subprograma')
						<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
			</div>
			<div class="col-md-12">
                    <label class="form-label">Programa *</label>
                    <select class="form-select" name="id_programa">
						<option selected>Seleccione</option>
						@foreach ($pro as $item)
						<option value="{{$item->id_programa}}" {{ $item->id_programa == $sub->id_programa ? 'selected' : '' }}>{{$item->descripcion_programa}}</option>
						@endforeach
                    </select>
                    @error('id_programa')
						<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
			</div>
			<div class="col-12">
				<button type="submit" class="btn btn-primary">Actualizar</button>
			</div>
		</form>

	</div>

@endsection
