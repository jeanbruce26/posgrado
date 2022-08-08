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
                    
                </tbody>
            </table>
            <div class="col-12 mt-4">
                <button type="submit" class="btn btn-danger">Regresar</button>
            </div>
		</form>
	</div>

@endsection
