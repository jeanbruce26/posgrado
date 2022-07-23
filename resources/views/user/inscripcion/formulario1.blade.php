@extends ('user')

@section('content')

	<div class="col-sm-12">
		
		<h3 class="d-flex justify-content-between text-secondary">Ficha de Inscripcion</h3>

		<form action="" method="POST" class="row g-3">
			@csrf
               <div class="col-md-4">
                    <label class="form-label">Tipo de Documento (*)</label>
                    <select class="form-select" name="tipo_doc">
                         <option selected>Seleccione</option>
                         @foreach ($tipo_doc as $item)
                         <option value="{{$item->id_tipo_doc}}">{{$item->doc}}</option>
                         @endforeach
                    </select>
               </div>
               <div class="col-md-4">
                    <label class="form-label">Numero Documento (*)</label>
                    <input type="text" class="form-control" name="num_doc">
               </div>
               <div class="col-md-4">
                    <label class="form-label">Apellido Paterno (*)</label>
                    <input type="text" class="form-control" name="ape_pat">
               </div>
               <div class="col-md-4">
                    <label class="form-label">Apellido Materno (*)</label>
                    <input type="text" class="form-control"  name="ape_pat">
               </div>
               <div class="col-md-4">
                    <label class="form-label">Nombre (*)</label>
                    <input type="text" class="form-control" name="nombre">
               </div>
               <div class="col-md-4">
                    <label class="form-label">Sexo (*)</label>
                    <select class="form-select" name="sexo">
                         <option selected>Seleccione</option>
                         <option value="F">FEMENINO</option>
                         <option value="M">MASCULINO</option>
                    </select>
               </div>
               <div class="col-md-4">
                    <label class="form-label">Fecha de Naciminto (*)</label>
                    <input type="date" class="form-control" name="fecha_nacimiento">
               </div>
               <div class="col-md-4">
                    <label class="form-label">Estado Civil (*)</label>
                    <select class="form-select" name="estado_civil">
                         <option selected>Seleccione...</option>
                         @foreach ($estado_civil as $item)
                         <option value="{{$item->cod_est}}">{{$item->est_civil}}</option>
                         @endforeach
                    </select>
               </div>
               <div class="col-md-4">
                    <label class="form-label">Grado Academico (*)</label>
                    <select class="form-select" name="grado_academico">
                         <option selected>Seleccione...</option>
                         @foreach ($grado as $item)
                         <option value="{{$item->id_grado_academico}}">{{$item->nom_grado}}</option>
                         @endforeach
                    </select>
               </div>
               <div class="col-md-4">
                    <label class="form-label">Especialidad (*)</label>
                    <input type="text" class="form-control" name="especialidad">
               </div>
               <div class="col-md-4">
                    <label class="form-label">Celular (*)</label>
                    <input type="text" class="form-control" name="celular1">
               </div>
               <div class="col-md-4">
                    <label class="form-label">Celular opcional</label>
                    <input type="text" class="form-control" name="celular2">
               </div>
               <div class="col-md-4">
                    <label class="form-label">Direccion (*)</label>
                    <input type="text" class="form-control" name="direccion">
               </div>
               <div class="col-md-4">
                    <label class="form-label">Email (*)</label>
                    <input type="email" class="form-control" name="email1">
               </div>
               <div class="col-md-4">
                    <label class="form-label">Email opcional</label>
                    <input type="email" class="form-control" name="email2">
               </div>
               <h5 class="text-secondary">Ubigeo de direccion</h5>
               @livewire('select-ubigeo')
               <div class="col-md-4">
                    <label class="form-label">Año de Egreso (*)</label>
                    <input type="int" class="form-control" name="año_egreso">
               </div>
               <div class="col-md-4">
                    <label class="form-label">Universidad (*)</label>
                    <select class="form-select" name="universidad">
                         <option selected>Seleccione...</option>
                         @foreach ($universidad as $item)
                         <option value="{{$item->cod_uni}}">{{$item->universidad}}</option>
                         @endforeach
                    </select>
               </div>
               <div class="col-md-4">
                    <label class="form-label">Centro de Trabajo (*)</label>
                    <input type="text" class="form-control"  name="centro_trabajo">
               </div>
               <div class="col-md-4">
                    <label class="form-label">Discapacidad</label>
                    <select class="form-select" name="discapacidad">
                         <option value="" selected>Seleccione...</option>
                         @foreach ($tipo_dis as $item)
                         <option value="{{$item->cod_disc}}">{{$item->discapacidad}}</option>
                         @endforeach
                    </select>
               </div>
			<div class="col-md-12">
				<button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Guardar y continuar</button>
			</div>
		</form>

	</div>

@endsection
