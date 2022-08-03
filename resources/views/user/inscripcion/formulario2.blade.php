@extends ('user')

@section('content')

	<div class="col-sm-12">
		
		<h3 class="d-flex justify-content-between text-secondary">Ficha de Inscripcion</h3>

		<form action="{{ route('inscripcion.store2') }}" method="POST" class="row g-3" enctype="multipart/form-data">
			@csrf
               <h5 class="text-secondary">Programa</h5>
               <livewire:select-programa/>
               
               <h5 class="text-secondary mt-3">Pagos</h5>

               <div class="col-md-4">
                    <label class="form-label">Numero Operacion  (*)</label>
                    <input type="text" class="form-control" name="num_opera">
                    @error('num_opera')
						<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
               </div>
               <div class="col-md-4">
                    <label class="form-label">Monto (*)</label>
                    <input type="text" class="form-control" name="monto">
                    @error('monto')
						<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
               </div>
               <div class="col-md-4">
                    <label class="form-label">Fecha (*)</label>
                    <input type="date" class="form-control"  name="fecha">
                    @error('fecha')
						<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
               </div>
               <div class="col-md-12">
                    <label class="form-label">Vaucher (*)</label>
                    <input type="file" class="form-control"  name="vaucher">
                    @error('vaucher')
						<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
               </div>
               <div class="col-md-6">
                    <input type="hidden" class="form-control"  name="persona_idpersona" value="{{$idpersona}}">
               </div>
			<div class="col-md-12">
				<button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Guardar y continuar</button>
			</div>
		</form>

	</div>

@endsection
