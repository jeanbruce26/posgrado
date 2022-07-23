@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Agregar Tipo de Pago</h2>

		<form action="{{ route('TipoPago.store') }}" method="POST" class="row g-3">
			@csrf
			<div class="col-md-6">
				<label for="inputTipoPago" class="form-label">Tipo de Pago *</label>
				<input type="text" class="form-control" id="inputTipoPago" name="tipo_pago" maxlength="45" value="{{ old('tipo_pago') }}">
				@error('tipo_pago')
					<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
				@enderror
			</div>
			<div class="col-12">
				<button type="submit" class="btn btn-primary">Agregar</button>
			</div>
		</form>

	</div>

@endsection
