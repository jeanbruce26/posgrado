@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Editar Pago</h2>

		<form action="{{ route('Pago.update',$pago->pago_id) }}" method="POST" class="row g-3">
			{{ method_field('PUT') }}
            @csrf
            
            <div class="col-6">
                <label for="inputDNI" class="form-label">DNI *</label>
                <input type="text" class="form-control" id="inputDNI" name="dni" maxlength="10" value="{{ $pago->dni }}">
                @error('dni')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-6">
                <label for="inputDNI" class="form-label">Número Operación *</label>
                <input type="text" class="form-control" id="inputDNI" name="nro_operacion" maxlength="10" value="{{ $pago->nro_operacion }}">
                @error('nro_operacion')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="inputMonto" class="form-label">Monto *</label>
                <input type="text" class="form-control" id="inputMonto" name="monto"  value="{{ $pago->monto }}">
                @error('monto')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
    
            <div class="col-6">
                <label for="inputFechaPago" class="form-label">Fecha de Pago *</label>
                <input type="date" class="form-control" id="inputFechaPago" name="fecha_pago" value="{{ $pago->fecha_pago }}">
                @error('fecha_pago')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Canal Pago *</label>
				<select class="form-select" name="canal_pago_id">
                    <option value="" selected>Seleccione</option>
                    @foreach ($canal as $item)
                    <option value="{{$item->canal_pago_id  }}" {{ $item->canal_pago_id == $pago->canal_pago_id ? 'selected' : '' }}>{{$item->descripcion}}</option>
                    @endforeach
                </select>
                    @error('canal_pago_id')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Estado *</label>
				<select class="form-select" name="estado">
                    <option selected>Seleccione</option>
                    <option value="1" {{ '1' == $pago->estado ? 'selected' : '' }}>Pagado</option>
                    <option value="2" {{ '2' == $pago->estado ? 'selected' : '' }}>Verificado</option>
                    <option value="3" {{ '3' == $pago->estado ? 'selected' : '' }}>Inscripto</option>
                </select>
                    @error('estado')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
            </div>
            
			<div class="col-12 d-flex justify-content-between">
				<a href="{{ route('Pago.index') }}" class="btn btn-secondary d-flex justify-content-center align-items-center"><i class="fas fa-angle-left me-1"></i> Regresar</a>
				<button type="submit" class="btn btn-primary d-flex justify-content-center align-items-center">Guardar <i class="fas fa-edit ms-1"></i></button>
			</div>
		</form>

	</div>

@endsection
