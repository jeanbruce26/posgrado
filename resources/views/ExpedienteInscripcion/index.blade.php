@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">ExpedienteInscripcion
		<a href="" class="btn btn-primary pull-right">Nuevo</a>
		</h2>

		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th>Codigo</th>
					<th>Nombre</th>
					<th>Estado</th>
					<th>Observación</th>
					<th>Fecha de Entrega</th>
					<th>Expediente</th>
					<th>Inscripción</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($expInsc as $expInscripcion)

				<tr>
					<td>{{$expInscripcion->cod_ex_insc}}</td>
					<td>{{$expInscripcion->nom_exped}}</td>
					<td>{{$expInscripcion->estado}}</td>
					<td>{{$expInscripcion->observacion}}</td>
					<td>{{$expInscripcion->fecha_entre}}</td>
					<td>{{$expInscripcion->expediente_cod_exp}}</td>
					<td>{{$expInscripcion->id_inscripcion }}</td>
					<td>
                        <button type="button" class="btn btn-success">Editar</button>
                        <button type="button" class="btn btn-danger">Eliminar</button>
                    </td>
				</tr>

				@endforeach
			</tbody>
		</table>
		{!! $expInsc->render() !!}

	</div>

	<div class="col-sm-4">
		
	</div>

@endsection
