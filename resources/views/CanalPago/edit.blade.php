@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Editar Canal de Pago</h2>

		<form action="{{ route('CanalPago.update', $canal->canal_pago_id) }}" method="POST" class="row g-3">
            {{ method_field('PUT') }}
			@csrf
			<div class="col-md-6">
				<label class="form-label">Canal de Pago *</label>
				<input type="text" class="form-control" name="descripcion" value="{{ $canal->descripcion }}">
                    @error('descripcion')
						<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
			</div>
			<div class="col-12">
				<button type="submit" class="btn btn-primary">Actualizar</button>
			</div>
		</form>

	</div>

@endsection
