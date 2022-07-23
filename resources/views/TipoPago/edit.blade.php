@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Editar Tipo de Pago</h2>

		<form action="{{ route('TipoPago.update', $tipoPago->cod_tipo_pago) }}" method="POST" class="row g-3">
            {{ method_field('PUT') }}
			@csrf
			<div class="col-md-6">
				<label for="inputTipoPago" class="form-label">Tipo de Pago *</label>
				<input type="text" class="form-control" id="inputTipoPago" name="tipo_pago"  value="{{ $tipoPago->tipo_pago }}">
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
