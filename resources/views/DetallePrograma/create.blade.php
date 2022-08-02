@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Agregar Detalle Programa</h2>

		<form action="{{ route('DetallePrograma.store') }}" method="POST" class="row g-3">
			@csrf
               <div class="col-md-12">
                    <label for="inputPrograma" class="form-label">Mencion *</label>
                    <select id="inputPrograma" class="form-select" name="id_mencion">
                         <option selected>Seleccione</option>
                         @foreach ($men as $item)
                         <option value="{{$item->id_mencion}}">{{$item->subprograma->programa->descripcion_programa}} - {{$item->subprograma->subprograma}} - {{$item->mencion}}</option>
                         @endforeach
                    </select>
                    @error('id_mencion')
                         <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
               </div>
               <div class="col-md-6">
                    <label for="inputPlan" class="form-label">Plan *</label>
                    <select id="inputPlan" class="form-select" name="id_plan">
                         <option selected>Seleccione</option>
                         @foreach ($plan as $item)
                         <option value="{{$item->id_plan}}">{{$item->plan}}</option>
                         @endforeach
                    </select>
                    @error('id_plan')
                         <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
               </div>
			<div class="col-12">
				<button type="submit" class="btn btn-primary">Agregar</button>
			</div>
		</form>

	</div>

@endsection
