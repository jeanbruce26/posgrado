@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Detalles de Persona</h2>

		<form action="{{ route('Persona.index') }}" method="GET" class="row g-3">
            <div class="col-md-4">
                <label>{{ $persona->TipoDocumento->doc  }}</label>
                <input class="form-control" type="text" value="{{ $persona->num_doc }}" disabled>
            </div>
            <div class="col-md-4">
                <label>Nombres</label>
                <input class="form-control" type="text" value="{{ $persona->nombres }} {{ $persona->apell_pater }} {{ $persona->apell_mater }}" disabled>
            </div>
            <div class="col-md-4">
                <label>Fecha de Nacimiento</label>
                <input class="form-control" type="text" value="{{ $persona->fecha_naci->format("d/m/Y") }}" disabled>
            </div>
            <div class="col-md-4">
                <label>Sexo</label>
                @if($persona->sexo == "M")
                    <input class="form-control" type="text" value="Masculino" disabled>
                @else
                    <input class="form-control" type="text" value="Femenino" disabled> 
                @endif 
            </div>
            <div class="col-md-4">
                <label>Estado Civil</label>
                <input class="form-control" type="text" value="{{ $persona->EstadoCivil->est_civil }}" disabled>
            </div>
            <div class="col-md-4">
                <label>Dirección</label>
                <input class="form-control" type="text" value="{{ $persona->direccion }}" disabled>
            </div>
            @if($persona->discapacidad_cod_disc != null)
                <div class="col-md-4">
                    <label>Discapacidad</label>
                    <input class="form-control" type="text" value="{{$persona->Discapacidad->discapacidad}}"disabled> 
                </div>
            @endif
            <div class="col-md-4">
                <label>Celular</label>
                <input class="form-control" type="text" value="{{ $persona->celular1 }}" disabled>
            </div>
            @if($persona->celular2 != null)
                <div class="col-md-4">
                    <label>Celular Opcional</label>
                    <input class="form-control" type="text" value="{{$persona->celular2}}"disabled> 
                </div>
            @endif 
            <div class="col-md-4">
                <label>Email</label>
                <input class="form-control" type="text" value="{{ $persona->email }}" disabled>
            </div>
            @if($persona->email2 != null)
                <div class="col-md-4">
                    <label>Email Opcional</label>
                    <input class="form-control" type="text" value="{{$persona->email2}}"disabled> 
                </div>
            @endif
            <div class="col-md-4">
                <label>Centro de Trabajo</label>
                <input class="form-control" type="text" value="{{ $persona->centro_trab }}" disabled>
            </div>
            <div class="col-md-4">
                <label>Universidad</label>
                <input class="form-control" type="text" value="{{ $persona->Universidad->universidad }}" disabled>
            </div>
            <div class="col-md-4">
                <label>Año de Egreso</label>
                <input class="form-control" type="text" value="{{ $persona->año_egreso }}" disabled>
            </div>
            <div class="col-md-4">
                <label>Grado Académico</label>
                <input class="form-control" type="text" value="{{ $persona->GradoAcademico->nom_grado }}" disabled>
            </div>
            @if($persona->especialidad != null)
                <div class="col-md-4">
                    <label>Especialidad</label>
                    <input class="form-control" type="text" value="{{$persona->especialidad}}"disabled> 
                </div>
            @endif
            <div class="col-12 mt-4">
                <button type="submit" class="btn btn-secondary"><i class="fas fa-angle-left"></i> Regresar</button>
            </div>
		</form>
	</div>

@endsection
