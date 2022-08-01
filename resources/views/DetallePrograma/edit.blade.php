@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Editar Detalle Programa</h2>

		<form action="{{ route('DetallePrograma.update',$det->id_detalle_programa) }}" method="POST" class="row g-3">
			{{ method_field('PUT') }}
               @csrf
               <div class="col-md-12">
                    <label for="inputPrograma" class="form-label">Mencion *</label>
                    <select id="inputPrograma" class="form-select" name="id_programa">
                         <option selected>Seleccione</option>
                         @foreach ($men as $item)
                         <option value="{{ $item->id_mencion }}" {{ $item->id_mencion == $det->id_mencion ? 'selected' : '' }}>{{$item->mencion}}</option>
                         @endforeach
                    </select>
                    @error('id_programa')
                         <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
               </div>
               <div class="col-md-6">
                    <label for="inputPlan" class="form-label">Plan *</label>
                    <select id="inputPlan" class="form-select" name="id_plan">
                         <option selected>Seleccione</option>
                         @foreach ($plan as $item)
                         <option value="{{$item->id_plan}}" {{ $item->id_plan == $det->id_plan ? 'selected' : '' }}>{{$item->plan}}</option>
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
                         <option value="{{$item->cod_sede}}" {{ $item->cod_sede == $det->id_sede ? 'selected' : '' }}>{{$item->sede}}</option>
                         @endforeach
                    </select>
                    @error('id_sede')
                         <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
               </div>
			<div class="col-12">
				<button type="submit" class="btn btn-primary">Actualizar</button>
			</div>
		</form>

	</div>

@endsection
