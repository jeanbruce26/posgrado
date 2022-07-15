@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">ConceptoPago
		<a href="" class="btn btn-primary pull-right">Nuevo</a>
		</h2>

		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th>Codigo</th>
					<th>Concepto</th>
					<th>Monto</th>
					<th>Estado</th>
					<th>Acciones</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($conPago as $conceptoPago)

				<tr>
					<td>{{$conceptoPago->cod_concep}}</td>
					<td>{{$conceptoPago->concepto}}</td>
					<td>{{$conceptoPago->monto}}</td>
					<td>{{$conceptoPago->estado}}</td>
					<td>
                        <button type="button" class="btn btn-success">Editar</button>
                        <button type="button" class="btn btn-danger">Eliminar</button>
                    </td>
				</tr>

				@endforeach
			</tbody>
		</table>
		{!! $conPago->render() !!}

	</div>

	<div class="col-sm-4">
		
	</div>

@endsection
