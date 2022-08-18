@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Editar Programa</h2>

		<form action="{{ route('Programa.update',$pro->id_programa) }}" method="POST" class="row g-3">
               {{ method_field('PUT') }}
               @csrf
			<div class="col-md-6">
				<label for="inputPrograma" class="form-label">Programa *</label>
				<input type="text" class="form-control" id="inputPrograma" name="descripcion_programa" value="{{ $pro->descripcion_programa }}" onkeypress="return soloLetras(event)">
                    @error('descripcion_programa')
                         <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
			</div>
               <div class="col-md-6">
                    <label for="inputPlan" class="form-label">Sede *</label>
                    <select id="inputPlan" class="form-select" name="id_sede">
                         <option value="" selected>Seleccione</option>
                         @foreach ($sede as $item)
                         <option value="{{$item->id_sede}}" {{ $item->cod_sede == $pro->id_sede ? 'selected' : '' }}>{{$item->sede}}</option>
                         @endforeach
                    </select>
                    @error('id_sede')
                         <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
               </div>
			<div class="col-12 d-flex justify-content-between">
				<a href="{{ route('Programa.index') }}" class="btn btn-secondary d-flex justify-content-center align-items-center"><i class="fas fa-angle-left me-1"></i> Regresar</a>
				<button type="submit" class="btn btn-primary d-flex justify-content-center align-items-center">Guardar <i class="fas fa-edit ms-1"></i></button>
			</div>
		</form>

	</div>

     <script>
		function soloLetras(e) {
			var key = e.keyCode || e.which,
				tecla = String.fromCharCode(key).toLowerCase(),
				letras = " áéíóúabcdefghijklmnñopqrstuvwxyz",
				especiales = [8, 37, 39, 46],
				tecla_especial = false;
		
			for (var i in especiales) {
				if (key == especiales[i]) {
				tecla_especial = true;
				break;
				}
			}
		
			if (letras.indexOf(tecla) == -1 && !tecla_especial) {
				return false;
			}
		}
	</script>

@endsection
