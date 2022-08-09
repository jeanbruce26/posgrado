@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Canal Pago
			<a href="{{ route('CanalPago.create') }}" class="btn btn-primary ">Nuevo</a>
		</h2>

		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th>Codigo</th>
					<th>Canal Pago</th>
					<th>Acciones</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($canal as $item)

				<tr>
					<td>{{$item->canal_pago_id}}</td>
					<td>{{$item->descripcion}}</td>
					<td>
                            <a href="{{ route('CanalPago.edit',$item->canal_pago_id) }}" type="button" class="btn btn-success">Editar</a>
                            <button type="button" class="btn btn-danger">Eliminar</button>
                        </td>
				</tr>

				@endforeach
			</tbody>
		</table>
		{!! $canal->render() !!}

	</div>

	<div class="col-sm-4">
		
	</div>

@endsection
