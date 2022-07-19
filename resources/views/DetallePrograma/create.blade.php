@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Agregar Detalle Programa</h2>

		<form action="{{ route('DetallePrograma.store') }}" method="POST" class="row g-3">
			@csrf
               <div class="col-md-12">
                    <label for="inputPrograma" class="form-label">Programa *</label>
                    <select id="inputPrograma" class="form-select" name="id_programa">
                         <option selected>Seleccione</option>
                         @foreach ($pro as $item)
                         <option value="{{$item->id_programa}}">{{$item->descripcion_programa}}</option>
                         @endforeach
                    </select>
                    @error('id_programa')
                         <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
               </div>
			<div class="col-md-6">
				<label for="inputCodDetPro" class="form-label">Codigo de Detalle Programa *</label>
				<input type="text" class="form-control" id="inputCodDetPro" name="cod_detalle_programa"  value="{{ old('cod_detalle_programa') }}">
                    @error('cod_detalle_programa')
                         <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
               </div>
               <div class="col-md-6">
				<label for="inputDesDetPro" class="form-label">Detalle Programa *</label>
				<input type="text" class="form-control" id="inputDesDetPro" name="des_detalle_programa"  value="{{ old('des_detalle_programa') }}">
                    @error('des_detalle_programa')
                         <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
               </div>
               <div class="col-md-6">
				<label for="inputCodMen" class="form-label">Codigo Mencion</label>
				<input type="text" class="form-control" id="inputCodMen" name="cod_mencion"  value="{{ old('cod_mencion') }}">
                    @error('cod_mencion')
                         <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
               </div>
               <div class="col-md-6">
				<label for="inputMen" class="form-label">Mencion</label>
				<input type="text" class="form-control" id="inputMen" name="des_mencion"  value="{{ old('des_mencion') }}">
                    @error('des_mencion')
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
               <div class="col-md-6">
                    <label for="inputSede" class="form-label">Sede *</label>
                    <select id="inputSede" class="form-select" name="id_sede">
                         <option selected>Seleccione</option>
                         @foreach ($sede as $item)
                         <option value="{{$item->cod_sede}}">{{$item->sede}}</option>
                         @endforeach
                    </select>
                    @error('id_sede')
                         <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
               </div>
			<div class="col-12">
				<button type="submit" class="btn btn-primary">Agregar</button>
			</div>
		</form>

	</div>

@endsection
