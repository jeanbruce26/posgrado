@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Concepto de Pago
		<a href="{{ url('/ConceptoPago/create') }}" class="btn btn-primary pull-right d-flex justify-content-center align-items-center">Nuevo <i class="fas fa-plus-circle ms-1"></i></a>
		</h2>

		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th class="col-1">Código</th>
					<th>Concepto</th>
					<th >Monto</thc>
					<th >Estado</th>
					<th class="col-1">Acciones</th>
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
					<td class="d-flex justify-content-star">
                        <a href="{{ route('ConceptoPago.edit', $conceptoPago->concepto_id) }}" type="button" class="btn btn-success d-flex justify-content-center align-items-center text-center">Editar <i class="fas fa-edit ms-1"></i></a>
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
