@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Sub Porgrama
		<a href="{{ url('/SubPrograma/create') }}" class="btn btn-primary ">Nuevo</a>
		</h2>

		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th>Id</th>
					<th>Programa</th>
					<th>Codigo</th>
					<th>Sub Porgrama</th>
					<th>Acciones</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($sub as $item)

				<tr>
					<td>{{$item->id_subprograma}}</td>
					<td>{{$item->programa->descripcion_programa}}</td>
					<td>{{$item->cod_subprograma}}</td>
					<td>{{$item->subprograma}}</td>
					<td>
						<a href="{{ route('SubPrograma.edit',$item->id_subprograma) }}" type="button" class="btn btn-success">Editar</a>
						<button type="button" class="btn btn-danger">Eliminar</button>
					</td>
				</tr>

				@endforeach
			</tbody>
		</table>
		{!! $sub->render() !!}

	</div>

@endsection