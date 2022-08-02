@extends ('user')

@section('content')

	<div class="col-sm-12">
		
		<h3 class="d-flex justify-content-between text-secondary">Ficha de Inscripcion</h3>

		<form action="{{ route('inscripcion.store2') }}" method="POST" class="row g-3">
			@csrf
               <h5 class="text-secondary">Programa</h5>
               @livewire('select-programa')
               
               <h5 class="text-secondary mt-3">Pagos</h5>

               <div class="col-md-4">
                    <label class="form-label">Numero Operacion  (*)</label>
                    <input type="text" class="form-control" name="num_opera">
               </div>
               <div class="col-md-4">
                    <label class="form-label">Monto (*)</label>
                    <input type="text" class="form-control" name="monto">
               </div>
               <div class="col-md-4">
                    <label class="form-label">Fecha (*)</label>
                    <input type="date" class="form-control"  name="fecha">
               </div>
               <div class="col-md-12">
                    <label class="form-label">Vaucher (*)</label>
                    <input type="file" class="form-control"  name="vaucher">
               </div>
               <div class="col-md-6">
                    <label class="form-label">idpersona</label>
                    <input type="text" class="form-control"  name="persona_idpersona" value="{{$persona->idpersona}}">
               </div>
			<div class="col-md-12">
				<button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Guardar y continuar</button>
			</div>
		</form>

	</div>

@endsection
