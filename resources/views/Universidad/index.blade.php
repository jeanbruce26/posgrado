@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Universidad
		<a href="" class="btn btn-primary pull-right">Nuevo</a>
		</h2>

		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th>Codigo</th>
					<th>Universidad</th>
					<th>Departamento</th>
					<th>Tipo Gestion</th>
					<th>Acciones</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($uni as $n)

				<tr>
					<td>{{$n->cod_uni}}</td>
					<td>{{$n->universidad}}</td>
					<td>{{$n->depart}}</td>
					<td>{{$n->tipo_gesti}}</td>
					<td>
                              <button type="button" class="btn btn-success">Editar</button>
                              <button type="button" class="btn btn-danger">Eliminar</button>
                         </td>
				</tr>

				@endforeach
			</tbody>
		</table>
		{!! $uni->render() !!}

	</div>

	<div class="col-sm-4">
		
	</div>

@endsection