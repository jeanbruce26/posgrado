@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Mención
		<a href="{{ url('/Mencion/create') }}" class="btn btn-primary ">Nuevo</a>
		</h2>

		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th>Programa</th>
					<th>SubPrograma</th>
					<th>Codigo</th>
					<th>Mencion</th>
					<th>Acciones</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($mencion as $item)

				<tr>
					<td>{{$item->subprograma->programa->descripcion_programa}}</td>
					<td>{{$item->subprograma->subprograma}}</td>
					@if (is_null($item->cod_mencion) && is_null($item->mencion))
					<td>Sin Mencion</td>
					<td>Sin Mencion</td>
					@else
					<td>{{$item->cod_mencion}}</td>
					<td>{{$item->mencion}}</td>
					@endif
					<td>
						<a href="{{ route('Mencion.edit',$item->id_mencion) }}" type="button" class="btn btn-success">Editar</a>
						<button type="button" class="btn btn-danger">Eliminar</button>
					</td>
				</tr>

				@endforeach
			</tbody>
		</table>
		{!! $mencion->render() !!}

	</div>

@endsection