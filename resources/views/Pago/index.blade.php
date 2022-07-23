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
					<th>Tipo de Pago</th>
					<th>Concepto</th>
					<th>Monto</th>
					<th>Fecha</th>
					<th>DNI</th>
					<th>Acciones</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($pag as $pago)

				<tr>
					<td>{{$pago->cod_pago}}</td>
					<td>{{$pago->tipo_pago->tipo_pago}}</td>
					<td>{{$pago->concep_pago->concepto}}</td>
					<td>{{$pago->monto}}</td>
					<td>{{$pago->fecha_pago}}</td>
					<td>{{$pago->dni}}</td>
					<td>
                        <a	href="{{ route('Pago.edit',$pago->cod_pago) }}" type="button" class="btn btn-success">Editar</a>
                        <button type="button" class="btn btn-danger">Eliminar</button>
                    </td>
				</tr>

				@endforeach
			</tbody>
		</table>
		{!! $pag->render() !!}

	</div>

	<div class="col-sm-4">
		
	</div>

@endsection
