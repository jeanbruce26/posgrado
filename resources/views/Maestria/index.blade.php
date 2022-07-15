@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Maestria
		<a href="" class="btn btn-primary pull-right">Nuevo</a>
		</h2>

		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th>Id</th>
					<th>Codigo Mestria</th>
					<th>Maestria</th>
					<th>Codigo Mencion</th>
					<th>Mencion</th>
					<th>Plan</th>
					<th>Acciones</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($ma as $maestria)

				<tr>
					<td>{{$maestria->id_maestria}}</td>
					<td>{{$maestria->cod_maestria}}</td>
					<td>{{$maestria->maestria}}</td>
					<td>{{$maestria->cod_mencion}}</td>
					<td>{{$maestria->mencion}}</td>
					<td>{{$maestria->id_plan}}</td>
					<td>
                              <button type="button" class="btn btn-success">Editar</button>
                              <button type="button" class="btn btn-danger">Eliminar</button>
                         </td>
				</tr>

				@endforeach
			</tbody>
		</table>
		{!! $ma->render() !!}

	</div>

	<div class="col-sm-4">
		
	</div>

@endsection
