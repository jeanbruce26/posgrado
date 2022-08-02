@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Detalle Programa
		<a href="{{ url('DetallePrograma/create') }}" class="btn btn-primary pull-right">Nuevo</a>
		</h2>

		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th>Id</th>
					<th>Programa</th>
					<th>Sub Programa</th>
					<th>Mencion</th>
					<th>Plan</th>
					<th>Sede</th>
					<th>Acciones</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($detpro as $detalle)

				<tr>
					<td>{{$detalle->id_detalle_programa}}</td>
					<td>{{$detalle->mencion->subprograma->programa->descripcion_programa}}</td>
					<td>{{$detalle->mencion->subprograma->subprograma}}</td>
					<td>{{$detalle->mencion->mencion}}</td>
					<td>{{$detalle->plan->plan}}</td>
					<td>{{$detalle->mencion->subprograma->programa->sede->sede}}</td> 
					<td>
						<a href="{{ route('DetallePrograma.edit',$detalle->id_detalle_programa) }}" type="button" class="btn btn-success">Editar</a>
						<button type="button" class="btn btn-danger">Eliminar</button>
					</td>
				</tr>

				@endforeach
			</tbody>
		</table>
		{!! $detpro->render() !!}

	</div>

	<div class="col-sm-4">
		
	</div>

@endsection
