@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Inscripcion
		<a href="" class="btn btn-primary pull-right">Nuevo</a>
		</h2>

		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th>ID</th>
					<th>Codigo</th>
					<th>Persona</th>
					<th>Estado</th>
					<th>Admision</th>
					<th>Programa</th>
					<th>Acciones</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($insc as $inscrip)

				<tr>
					<td>{{$inscrip->id_inscrip}}</td>
					<td>{{$inscrip->cod_inscrip}}</td>
					<td>{{$inscrip->persona_idpersona}}</td>
					<td>{{$inscrip->estado}}</td>
					<td>{{$inscrip->admision_cod_admi}}</td>
					<td>{{$inscrip->id_detalle_programa}}</td>
					<td>
                        <button type="button" class="btn btn-success">Editar</button>
                        <button type="button" class="btn btn-danger">Eliminar</button>
                    </td>
				</tr>

				@endforeach
			</tbody>
		</table>
		{!! $insc->render() !!}

	</div>

	<div class="col-sm-4">
		
	</div>

@endsection
