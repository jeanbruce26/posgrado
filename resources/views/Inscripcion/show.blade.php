@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Expedientes de Inscripción</h2>

		<form action="{{ route('Inscripcion.index') }}" method="GET" class="row g-3">
            
            <table class="table table-hover table-striped">
                <thead>
                    <tr class="col-sm-12">
                        <th class="col-md-4">Documento</th>
                        <th>Estado</th>
                        <th>Fecha</th>
                        <th class="col-md-4">Observación</th>
                        <th>Archivo</th>
                    </tr>
                </thead>
    
                <tbody>
                    @foreach ($expInsc as $expInscripcion)
                    <tr>
                        <td>{{$expInscripcion->nom_exped}}</td>
                        <td>{{$expInscripcion->estado}}</td>
                        <td>{{$expInscripcion->fecha_entre->format('d/m/Y')}}</td>
                        @if($expInscripcion->observacion == null)
                            <td>Sin Observación</td>
                        @else
                            <td>{{$expInscripcion->observacion}}</td>
                        @endif
                        <td>
                            <a target="_blank" href="{{asset('Admision 2022 - I/'.$expInscripcion->id_inscripcion.'/'.$expInscripcion->nom_exped)}}" class="btn btn-with">
                                <i class="fas fa-file-pdf"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="col-12 mt-4">
                <button type="submit" class="btn btn-danger">Regresar</button>
            </div>
		</form>
	</div>

@endsection
