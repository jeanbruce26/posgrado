@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Agregar Plan</h2>

		<form action="{{ route('Plan.store') }}" method="POST" class="row g-3">
			@csrf
			<div class="col-md-12">
				<label for="inputPlan" class="form-label">Plan *</label>
				<input type="text" class="form-control" id="inputPlan" name="plan" maxlength="10" value="{{ old('plan') }}">
				@error('plan')
						<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
				@enderror
			</div>
			<div class="col-12 d-flex justify-content-between">
				<a href="{{ route('Plan.index') }}" class="btn btn-secondary d-flex justify-content-center align-items-center text-center"><i class="fas fa-angle-left me-1"></i> Regresar</a>
				<button type="submit" class="btn btn-primary d-flex justify-content-center align-items-center text-center">Guardar <i class="fas fa-plus-circle ms-1"></i></button>
			</div>
		</form>

	</div>

@endsection
