@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Programa
		<a href="" class="btn btn-primary pull-right">Nuevo</a>
		</h2>

		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th>Codigo</th>
					<th>Programa</th>
					<th>Acciones</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($pro as $programa)

				<tr>
					<td>{{$programa->id_programa}}</td>
					<td>{{$programa->descripcion_programa}}</td>
					<td>
						<button type="button" class="btn btn-primary">Detalle</button>
                              <button type="button" class="btn btn-success">Editar</button>
                              <button type="button" class="btn btn-danger">Eliminar</button>
                         </td>
				</tr>

				@endforeach
			</tbody>
		</table>
		{!! $pro->render() !!}

	</div>

	<div class="col-sm-4">
		
	</div>

@endsection
