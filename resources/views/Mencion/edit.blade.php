@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Editar Mención</h2>

		<form action="{{ route('Mencion.update',$mencion->id_mencion) }}" method="POST" class="row g-3">
			{{ method_field('PUT') }}
			@csrf
			<div class="col-md-4">
				<label class="form-label">Codigo Mencion *</label>
				<input type="text" class="form-control"  name="cod_mencion" value="{{ $mencion->cod_mencion }}">
                    @error('cod_mencion')
						<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
			</div>
			<div class="col-md-8">
				<label class="form-label">Mencion *</label>
				<input type="text" class="form-control" name="mencion" value="{{ $mencion->mencion }}">
				@error('mencion')
						<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
			</div>
			<div class="col-md-12">
                    <label class="form-label">Sub Programa *</label>
                    <select class="form-select" name="id_subprograma">
						<option selected>Seleccione</option>
						@foreach ($sub as $item)
						<option value="{{$item->id_subprograma}}" {{ $item->id_subprograma == $mencion->id_subprograma ? 'selected' : '' }}>{{$item->subprograma}}</option>
						@endforeach
                    </select>
                    @error('id_subprograma')
						<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
			</div>
			<div class="col-12">
				<button type="submit" class="btn btn-primary">Actualizar</button>
			</div>
		</form>

	</div>

@endsection
