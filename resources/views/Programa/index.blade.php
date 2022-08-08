@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Programa
		<a href="{{ route('Programa.create') }}" class="btn btn-primary pull-right">Nuevo</a>
		</h2>

		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th>Codigo</th>
					<th>Programa</th>
					<th>Sede</th>
					<th>Acciones</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($pro as $programa)

				<tr>
					<td>{{$programa->id_programa}}</td>
					<td>{{$programa->descripcion_programa}}</td>
					<td>{{$programa->sede->sede}}</td>
					<td>
						<button type="button" class="btn btn-primary">Detalle</button>
							<a href="{{ route('Programa.edit',$programa->id_programa) }}" type="button" class="btn btn-success">Editar</a>
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
