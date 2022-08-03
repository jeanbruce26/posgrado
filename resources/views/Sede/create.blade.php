@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Agregar Sede</h2>

		<form action="{{ route('Sede.store') }}" method="POST" class="row g-3">
			@csrf
			<div class="col-md-6">
				<label for="inputSede" class="form-label">Sede *</label>
				<input type="text" class="form-control" id="inputSede" name="sede"  value="{{ old('sede') }}">
                    @error('sede')
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
