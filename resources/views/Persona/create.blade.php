@extends ('admin')

@section('content')
<div class="col-sm-12 ">
		
     <h2 class="d-flex justify-content-between mb-4">Agregar Personas</h2>

     <form action="{{ url('/Persona') }}" method="POST" class="row g-3">
          @csrf
          <div class="col-md-12">
               <label for="inputNombre" class="form-label">Nombre *</label>
               <input type="text" class="form-control" id="inputNombre" name="nombre">
               
          </div>
          <div class="col-md-6">
               <label for="inputApellidoPaterno" class="form-label">Apellido Paterno *</label>
               <input type="text" class="form-control" id="inputApellidoPaterno" name="ape_pat">
          </div>
          <div class="col-md-6">
               <label for="inputApellidoMaterno" class="form-label">Apellido Materno *</label>
               <input type="text" class="form-control" id="inputApellidoMaterno" name="ape_pat">
          </div>

          @foreach ($tipodo as $per)

          <div class="col-md-6">
               <label for="inputTipoDocumento" class="form-label">Tipo de Documento *</label>
               <select id="inputTipoDocumento" class="form-select" name="tipo_doc">
                    <option selected>Seleccione</option>
                    <option value="{{$per->id_tipo_doc}}">{{$per->doc}}</option>
               </select>
          </div>
                 
           @endforeach

         

          <div class="col-md-6">
               <label for="inputNumeroDocumento" class="form-label">Numero Documento *</label>
               <input type="text" class="form-control" id="inputNumeroDocumento" name="num_doc">
          </div>
          <div class="col-12">
               <label for="inputDireccion" class="form-label">Direccion *</label>
               <input type="text" class="form-control" id="inputDireccion" name="direccion">
          </div>
          <div class="col-md-6">
               <label for="inputCelular1" class="form-label">Celular 1 *</label>
               <input type="text" class="form-control" id="inputCelular1" name="celular1">
          </div>
          <div class="col-md-6">
               <label for="inputCelular2" class="form-label">Celular 2</label>
               <input type="text" class="form-control" id="inputCelular2" name="celular2">
          </div>
          <div class="col-md-6">
               <label for="inputSexo" class="form-label">Sexo *</label>
               <select id="inputSexo" class="form-select" name="sexo">
                    <option selected>Seleccione</option>
                    <option value="F">FEMENINO</option>
                    <option value="M">MASCULINO</option>
               </select>
          </div>
          <div class="col-md-6">
               <label for="inputFechaNacimiento" class="form-label">Fecha de Naciminto</label>
               <input type="date" class="form-control" id="inputFechaNacimiento" name="fecha_nacimiento">
          </div>
          <div class="col-md-6">
               <label for="inputEmail1" class="form-label">Email 1 *</label>
               <input type="email" class="form-control" id="inputEmail1" name="email1">
          </div>
          <div class="col-md-6">
               <label for="inputEmail2" class="form-label">Email 2</label>
               <input type="email" class="form-control" id="inputEmail2" name="email2">
          </div>
          <div class="col-md-6">
               <label for="inputAñoEgreso" class="form-label">Año de Egreso *</label>
               <input type="int" class="form-control" id="inputAñoEgreso" name="año_egreso">
          </div>
          <div class="col-md-6">
               <label for="inputCentroTranajo" class="form-label">Centro de Trabajo *</label>
               <input type="text" class="form-control" id="inputCentroTranajo" name="centro_trabajo">
          </div>


           @foreach ($esta as $es)

          <div class="col-md-3">
               <label for="inputEstadoCivil" class="form-label">Estado Civil *</label>
               <select id="inputEstadoCivil" class="form-select" name="estado_civil">
                    <option selected>Seleccione...</option>
                    <option value="{{$es->cod_est}}">{{$es->est_civil}}</option>
               </select>
          </div>

           @endforeach


          @foreach ($tipodis as $dis)
          <div class="col-md-3">
               <label for="inputEstadoCivil" class="form-label">Discapacidad *</label>
               <select id="inputEstadoCivil" class="form-select" name="discapacidad">
                    <option selected>Seleccione...</option>
                   <option value="{{$dis->cod_disc}}">{{$dis->discapacidad}}</option>
               </select>
          </div>
          @endforeach

          @foreach ($uni as $u)
          <div class="col-md-6">
               <label for="inputUniversidad" class="form-label">Universidad *</label>
               <select id="inputUniversidad" class="form-select" name="universidad">
                    <option selected>Choose...</option>
                    <option value="{{$u->cod_uni}}">{{$u->universidad}}</option>
               </select>
          </div>
          @endforeach

           @foreach ($gra as $g)

          <div class="col-md-6">
               <label for="inputGradoAcademico" class="form-label">Grado Academico *</label>
               <select id="inputGradoAcademico" class="form-select" name="grado_academico">
                    <option selected>Choose...</option>
                    <option value="{{$g->id_grado_academico}}">{{$g->nom_grado}}</option>
               </select>
          </div>

          @endforeach

          <div class="col-md-6">
               <label for="inputEspecialidad" class="form-label">Especialidad *</label>
               <input type="text" class="form-control" id="inputEspecialidad" name="especialidad">
          </div>
          <div class="col-md-12">
               <button type="submit" class="btn btn-primary">Agregar</button>
          </div>
     </form>

</div>

@endsection