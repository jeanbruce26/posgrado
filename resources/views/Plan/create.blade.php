@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Agregar Plan</h2>

		<form action="{{ route('Plan.store') }}" method="POST" class="row g-3">
			@csrf
			<div class="col-md-6">
				<label for="inputPlan" class="form-label">Plan</label>
				<input type="text" class="form-control" id="inputPlan" name="plan" maxlength="10" value="{{ old('plan') }}">
			</div>
			<div class="col-12">
				<button type="submit" class="btn btn-primary">Agregar</button>
			</div>
		</form>

	</div>

@endsection
