@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Agregar Mencion</h2>

		<form action="{{ route('Mencion.store') }}" method="POST" class="row g-3">
			@csrf
			<div class="col-md-4">
				<label class="form-label">Codigo Mencion *</label>
				<input type="text" class="form-control" name="cod_mencion" maxlength="10" value="{{ old('cod_mencion') }}">
				@error('cod_mencion')
						<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
			</div>
			<div class="col-md-8">
				<label class="form-label">Mencion *</label>
				<input type="text" class="form-control" name="mencion" value="{{ old('mencion') }}">
				@error('mencion')
						<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
			</div>
			<div class="col-md-12">
                    <label class="form-label">Sub Programa *</label>
                    <select class="form-select" name="id_subprograma">
                         <option selected>Seleccione</option>
                         @foreach ($sub as $item)
                         <option value="{{$item->id_subprograma}}">{{$item->programa->descripcion_programa}} - {{$item->subprograma}}</option>
                         @endforeach
                    </select>
                    @error('id_subprograma')
                         <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
               </div>
			<div class="col-12">
				<button type="submit" class="btn btn-primary">Agregar</button>
			</div>
		</form>

	</div>

@endsection
