@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Editar Plan</h2>

		<form action="{{ route('Plan.update',$plan->id_plan) }}" method="POST" class="row g-3">
			{{ method_field('PUT') }}
			@csrf
			<div class="col-md-6">
				<label for="inputPlan" class="form-label">Plan</label>
				<input type="text" class="form-control" id="inputPlan" name="plan" value="{{ $plan->plan }}">
                    @error('plan')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
			</div>
			<div class="col-12">
				<button type="submit" class="btn btn-primary">Actualizar</button>
			</div>
		</form>

	</div>

@endsection
