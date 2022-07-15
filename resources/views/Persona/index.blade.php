@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">PERSONAS
		<a href="" class="btn btn-primary pull-right">Nuevo</a>
		</h2>

		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th>ID</th>
					<th>Numero de DNI</th>
					<th>Apellido Paterno</th>
					<th>Apellido Materno</th>
					<th>Nombres</th>
					<th>Celular</th>
					<th>Acciones</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($perso as $per)

				<tr>
					<td>{{$per->idpersona}}</td>
					<td>{{$per->num_doc}}</td>
					<td>{{$per->apell_pater}}</td>
					<td>{{$per->apell_mater}}</td>
					<td>{{$per->nombres}}</td>
					<td>{{$per->celular1}}</td>

					<td>
							  <button type="button" class="btn btn-success">Mostrar</button>
                              <button type="button" class="btn btn-success">Editar</button>
                              <button type="button" class="btn btn-danger">Eliminar</button>
                         </td>
				</tr>

				@endforeach
			</tbody>
		</table>
		{!! $perso->render() !!}

	</div>

	<div class="col-sm-4">
		
	</div>

@endsection