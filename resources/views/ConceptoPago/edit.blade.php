@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Editar Concepto de Pago</h2>

		<form action="{{ route('ConceptoPago.update',$concepPago->cod_concep) }}" method="POST" class="row g-3">
			{{ method_field('PUT') }}
            @csrf

            <div class="col-md-6">
                <label for="inputConcepto" class="form-label">Concepto *</label>
				<input type="text" class="form-control" id="inputConcepto" name="concepto" maxlength="45" value="{{ $concepPago->concepto }}">
                    @error('concepto')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
            </div>

            <div class="col-6">
                <label for="inputMonto" class="form-label">Monto *</label>
                <input type="text" class="form-control" id="inputMonto" name="monto" maxlength="13" value="{{ $concepPago->monto }}">
                @error('monto')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-6">
                <label for="inputMonto" class="form-label">Estado *</label>
                <select id="inputEstado" class="form-select" name="estado">
                    <option selected>Seleccione</option>
                    <option value="1" {{ $concepPago->estado == 1 ? 'selected' : '' }}> ACTIVO</option>
                    <option value="2" {{ $concepPago->estado == 2 ? 'selected' : '' }}> DESACTIVO</option>
                </select>
                @error('monto')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>

			<div class="col-12 d-flex justify-content-between">
				<a href="{{ route('ConceptoPago.index') }}" class="btn btn-secondary d-flex justify-content-center align-items-center"><i class="fas fa-angle-left me-1"></i> Regresar</a>
				<button type="submit" class="btn btn-primary d-flex justify-content-center align-items-center">Guardar <i class="fas fa-edit ms-1"></i></button>
			</div>
		</form>

	</div>

@endsection
