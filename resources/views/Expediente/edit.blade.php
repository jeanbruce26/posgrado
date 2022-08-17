@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Editar Expediente</h2>

		<form action="{{ route('Expediente.update',$exp->cod_exp) }}" method="POST" class="row g-3">
			{{ method_field('PUT') }}
            @csrf
            
			<div class="col-md-6">
                <label for="inputExp" class="form-label">Expediente *</label>
				<input type="text" class="form-control" id="inputExp" name="tipo_doc"  value="{{ $exp->tipo_doc }}">
                    @error('tipo_doc')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
            </div>

            <div class="col-6">
                <label for="inputMonto" class="form-label">Estado *</label>
                <select id="inputEstado" class="form-select" name="estado">
                    <option selected>Seleccione</option>
                    <option value="1" {{ $exp->estado == 1 ? 'selected' : '' }}> Activo</option>
                    <option value="2" {{ $exp->estado == 2 ? 'selected' : '' }}> Inactivo</option>
                </select>
                @error('estado')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>

			<div class="col-12 d-flex justify-content-between">
				<a href="{{ route('Expediente.index') }}" class="btn btn-secondary d-flex justify-content-center align-items-center"><i class="fas fa-angle-left me-1"></i> Regresar</a>
				<button type="submit" class="btn btn-primary d-flex justify-content-center align-items-center">Guardar <i class="fas fa-edit ms-1"></i></button>
			</div>
		</form>

	</div> 

@endsection
