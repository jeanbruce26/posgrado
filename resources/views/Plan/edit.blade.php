@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Editar Plan</h2>

		<form action="{{ route('Plan.update',$plan->id_plan) }}" method="POST" class="row g-3">
			{{ method_field('PUT') }}
			@csrf
			<div class="col-md-12">
				<label for="inputPlan" class="form-label">Plan</label>
				<input type="text" class="form-control" id="inputPlan" name="plan" value="{{ $plan->plan }}">
                    @error('plan')
						<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
			</div>
			<div class="col-12 d-flex justify-content-between">
				<a href="{{ route('Plan.index') }}" class="btn btn-secondary me-md-2"><i class="fas fa-angle-left"></i> Regresar</a>
				<button type="submit" class="btn btn-primary">Guardar <i class="fas fa-edit"></i></button>
			</div>
		</form>

	</div>

@endsection
