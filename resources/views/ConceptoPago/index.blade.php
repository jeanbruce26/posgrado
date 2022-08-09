@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Concepto de Pago
		<a href="{{ url('/ConceptoPago/create') }}" class="btn btn-primary pull-right">Nuevo</a>
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
					<td>{{$conceptoPago->concepto_id}}</td>
					<td>{{$conceptoPago->concepto}}</td>
					<td>{{$conceptoPago->monto}}</td>
					<td>@if ( $conceptoPago->estado == 1)
							ACTIVO
						@else
							DESACTIVO
						@endif
					</td>
					<td>
                        <a href="{{ route('ConceptoPago.edit', $conceptoPago->concepto_id) }}" type="button" class="btn btn-success">Editar</a>
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
