@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Editar Canal de Pago</h2>

		<form action="{{ route('CanalPago.update', $canal->canal_pago_id) }}" method="POST" class="row g-3">
            {{ method_field('PUT') }}
			@csrf
			<div class="col-md-12">
				<label class="form-label">Canal de Pago *</label>
				<input type="text" class="form-control" name="descripcion" value="{{ $canal->descripcion }}">
                    @error('descripcion')
						<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
			</div>
			<div class="col-12 d-flex justify-content-between">
				<a href="{{ route('CanalPago.index') }}" class="btn btn-secondary d-flex justify-content-center align-items-center"><i class="fas fa-angle-left me-1"></i> Regresar</a>
				<button type="submit" class="btn btn-primary d-flex justify-content-center align-items-center">Guardar <i class="fas fa-edit ms-1"></i></button>
			</div>
		</form>

	</div>

@endsection
