@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Editar Ingreso de Pago</h2>

		<form action="{{ route('IngresoPago.update',$ingPago->cod_ingre) }}" method="POST" class="row g-3">
			{{ method_field('PUT') }}
            @csrf

			<div class="col-md-6">
                <label for="inputNumOpe" class="form-label">Número de Operación *</label>
				<input type="text" class="form-control" id="inputNumOpe" name="num_opera"  value="{{ $ingPago->num_opera }}">
                    @error('num_opera')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
            </div>

            <div class="col-md-6">
            <label for="inputMonto" class="form-label">Monto *</label>
            <input type="text" class="form-control" id="inputMonto" name="monto"  value="{{ $ingPago->monto }}">
                @error('monto')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="inputFecha" class="form-label">Fecha *</label>
                <input type="date" class="form-control" id="inputFecha" name="fecha"  value="{{ $ingPago->fecha }}">
                    @error('fecha')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>

            <div class="col-md-6">
                <label for="inputInscripcion" class="form-label">Inscripción *</label>
                <select id="inputInscripcion" class="form-select" name="id_inscripcion">
                        <option selected>Seleccione</option>
                        @foreach ($insc as $item)
                        <option value="{{$item->id_inscripcion}}" {{ $item->id_inscripcion == $ingPago->id_inscripcion ? 'selected' : '' }}>{{$item->cod_inscripcion}}</option>
                        @endforeach
                </select>
                @error('id_inscripcion')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>

			<div class="col-12">
				<button type="submit" class="btn btn-primary">Actualizar</button>
			</div>
		</form>

	</div>

@endsection
