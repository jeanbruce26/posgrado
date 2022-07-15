@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Discapacidad
		<a href="" class="btn btn-primary pull-right">Nuevo</a>
		</h2>

		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th>Codigo</th>
					<th>Discapacidad</th>
					<th>Acciones</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($disc as $di)

				<tr>
					<td>{{$di->cod_disc}}</td>
					<td>{{$di->discapacidad}}</td>

					<td>
                              <button type="button" class="btn btn-success">Editar</button>
                              <button type="button" class="btn btn-danger">Eliminar</button>
                         </td>
				</tr>

				@endforeach
			</tbody>
		</table>
		{!! $disc->render() !!}

	</div>

	<div class="col-sm-4">
		
	</div>

@endsection