@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Pago
		<a href="{{ url('/Pago/create') }}" class="btn btn-primary pull-right">Nuevo</a>
		</h2>

		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th>Codigo</th>
					<th>DNI</th>
					<th>Nro Operacion</th>
					<th>Monto</th>
					<th>Fecha</th>
					<th>Estado</th>
					<th>Canal Pago</th>
					<th>Acciones</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($pago as $item)

				<tr>
					<td>{{$item->pago_id}}</td>
					<td>{{$item->dni}}</td>
					<td>{{$item->nro_operacion}}</td>
					<td>{{$item->monto}}</td>
					<td>{{$item->fecha_pago}}</td>
					<td>{{$item->estado}}</td>
					<td>{{$item->CanalPago->descripcion}}</td>
					<td>
                        <a	href="{{ route('Pago.edit',$item->pago_id) }}" type="button" class="btn btn-success">Editar</a>
                        <button type="button" class="btn btn-danger">Eliminar</button>
                    </td>
				</tr>

				@endforeach
			</tbody>
		</table>
		{!! $pago->render() !!}

	</div>

	<div class="col-sm-4">
		
	</div>

@endsection
