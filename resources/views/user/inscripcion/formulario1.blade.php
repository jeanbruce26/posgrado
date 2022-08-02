@extends ('user')

@section('content')

	<div class="col-sm-12">
		
		<h3 class="d-flex justify-content-between text-secondary">Ficha de Inscripcion</h3>

		<form action="{{ route('inscripcion.store') }}" method="POST" class="row g-3">
			@csrf
               <div class="col-md-4">
                    <label class="form-label">Tipo de Documento (*)</label>
                    <select class="form-select" name="tipo_doc_cod_tipo">
                         <option value="" selected>Seleccione</option>
                         @foreach ($tipo_doc as $item)
                         <option value="{{$item->id_tipo_doc}}">{{$item->doc}}</option>
                         @endforeach
                    </select>
               </div>
               <div class="col-md-4">
                    <label class="form-label">Numero Documento (*)</label>
                    <input type="text" class="form-control" name="num_doc">
                    @error('num_doc')
						<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
               </div>
               <div class="col-md-4">
                    <label class="form-label">Apellido Paterno (*)</label>
                    <input type="text" class="form-control" name="apell_pater">
                    @error('apell_pater')
						<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
               </div>
               <div class="col-md-4">
                    <label class="form-label">Apellido Materno (*)</label>
                    <input type="text" class="form-control"  name="apell_mater">
                    @error('apell_mater')
						<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
               </div>
               <div class="col-md-4">
                    <label class="form-label">Nombre (*)</label>
                    <input type="text" class="form-control" name="nombres">
                    @error('nombres')
						<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
               </div>
               <div class="col-md-4">
                    <label class="form-label">Sexo (*)</label>
                    <select class="form-select" name="sexo">
                         <option value="" selected>Seleccione</option>
                         <option value="F">FEMENINO</option>
                         <option value="M">MASCULINO</option>
                    </select>
               </div>
               <div class="col-md-4">
                    <label class="form-label">Fecha de Naciminto (*)</label>
                    <input type="date" class="form-control" name="fecha_naci">
                    @error('fecha_naci')
						<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
               </div>
               <div class="col-md-4">
                    <label class="form-label">Estado Civil (*)</label>
                    <select class="form-select" name="est_civil_cod_est">
                         <option value="" selected>Seleccione...</option>
                         @foreach ($estado_civil as $item)
                         <option value="{{$item->cod_est}}">{{$item->est_civil}}</option>
                         @endforeach
                    </select>
               </div>
               <div class="col-md-4">
                    <label class="form-label">Grado Academico (*)</label>
                    <select class="form-select" name="id_grado_academico">
                         <option value="" selected>Seleccione...</option>
                         @foreach ($grado as $item)
                         <option value="{{$item->id_grado_academico}}">{{$item->nom_grado}}</option>
                         @endforeach
                    </select>
               </div>
               <div class="col-md-4">
                    <label class="form-label">Especialidad (*)</label>
                    <input type="text" class="form-control" name="especialidad">
                    @error('especialidad')
						<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
               </div>
               <div class="col-md-4">
                    <label class="form-label">Celular (*)</label>
                    <input type="text" class="form-control" name="celular1">
                    @error('celular1')
						<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
               </div>
               <div class="col-md-4">
                    <label class="form-label">Celular opcional</label>
                    <input type="text" class="form-control" name="celular2">
               </div>
               <div class="col-md-4">
                    <label class="form-label">Discapacidad</label>
                    <select class="form-select" name="discapacidad_cod_disc">
                         <option value="" selected>Seleccione...</option>
                         @foreach ($tipo_dis as $item)
                         <option value="{{$item->cod_disc}}">{{$item->discapacidad}}</option>
                         @endforeach
                    </select>
               </div>
               <div class="col-md-4">
                    <label class="form-label">Email (*)</label>
                    <input type="email" class="form-control" name="email">
                    @error('email')
						<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
               </div>
               <div class="col-md-4">
                    <label class="form-label">Email opcional</label>
                    <input type="email" class="form-control" name="email2">
               </div>
               <h5 class="text-secondary">Ubigeo de direccion</h5>
               @livewire('select-ubigeo')
               {{-- <div class="col-md-4">
                    <label class="form-label">Departamento</label>
                    <select class="form-select" name="id" id="_departamentos">
                         <option value="" selected>Seleccione...</option>
                         @foreach ($departamento as $item)
                         <option value="{{$item->id}}">{{$item->departamento}}</option>
                         @endforeach
                    </select>
               </div>
               <div class="col-md-4">
                    <label class="form-label">Provincia</label>
                    <select class="form-select" name="id_provincia" id="_provincias">
                         <option value="" selected>Seleccione...</option>
                    </select>
               </div> 
               <div class="col-md-4">
                    <label class="form-label">Distrito</label>
                    <select class="form-select" name="id_distrito" id="_distritos">
                         <option value="" selected>Seleccione...</option>
                    </select>
               </div> --}}
               <div class="col-md-12">
                    <label class="form-label">Direccion (*)</label>
                    <input type="text" class="form-control" name="direccion">
                    @error('direccion')
						<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
               </div>
               <h5 class="text-secondary">Ubigeo de Nacimiento</h5>
               @livewire('select-ubigeo-nacimiento')
               <div class="col-md-4">
                    <label class="form-label">Año de Egreso (*)</label>
                    <input type="int" class="form-control" name="año_egreso">
                    @error('año_egreso')
						<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
               </div>
               <div class="col-md-4">
                    <label class="form-label">Universidad (*)</label>
                    <select class="form-select" name="univer_cod_uni">
                         <option value="" selected>Seleccione...</option>
                         @foreach ($universidad as $item)
                         <option value="{{$item->cod_uni}}">{{$item->universidad}}</option>
                         @endforeach
                    </select>
               </div>
               <div class="col-md-4">
                    <label class="form-label">Centro de Trabajo (*)</label>
                    <input type="text" class="form-control"  name="centro_trab">
                    @error('centro_trab')
                              <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
               </div>
			<div class="col-md-12">
				<button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Guardar y continuar</button>
			</div>
		</form>

	</div>

@endsection
{{-- 
@section('scritp')
     <script>
          document.getElementById('_departamentos').addEventListener('change',(e)=>{
               fetch('provincias',{
                    method : 'POST',
                    body: JSON.stringify({texto : e.target.value}),
                    headers:{
                         'Content-Type': 'application/json'
                    }
               }).then(response =>{
                    return response.json()
               }).then( data =>{
                    var opciones ="<option value=''>Elegir</option>";
                    for (let i in data.lista) {
                         opciones+= '<option value="'+data.lista[i].id+'">'+data.lista[i].provincias+'</option>';
                    }
                    document.getElementById("_provincias").innerHTML = opciones;
               }).catch(error =>console.error(error));
          })
     </script>
@endsection --}}
