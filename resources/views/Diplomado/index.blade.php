@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Diplomado
		<a href="" class="btn btn-primary pull-right">Nuevo</a>
		</h2>

		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th>Id</th>
					<th>Codigo</th>
					<th>Diplomado</th>
					<th>Plan</th>
					<th>Acciones</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($di as $diplo)

				<tr>
					<td>{{$diplo->id_diplo}}</td>
					<td>{{$diplo->cod_diplo}}</td>
					<td>{{$diplo->diplomado}}</td>
					<td>{{$diplo->id_plan}}</td>
					<td>
                              <button type="button" class="btn btn-success">Editar</button>
                              <button type="button" class="btn btn-danger">Eliminar</button>
                         </td>
				</tr>

				@endforeach
			</tbody>
		</table>
		{!! $di->render() !!}

	</div>

	<div class="col-sm-4">
		
	</div>

@endsection
