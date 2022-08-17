@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Pago
		<a href="{{ url('/Pago/create') }}" class="btn btn-primary pull-right d-flex justify-content-center align-items-center">Nuevo <i class="fas fa-plus-circle ms-1"></i></a>
		</h2>

		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th class="col-1">Código</th>
					<th>Documento</th>
					<th>Número Operación</th>
					<th>Monto</th>
					<th>Fecha</th>
					<th>Canal Pago</th>
					<th class="col-2">Estado</th>
					<th class="col-1">Acciones</th>
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
					<td>{{$item->CanalPago->descripcion}}</td>
					@if($item->estado == 1)
						<td class="d-flex justify-content-star">
							<div class="p-1 bg-secondary text-white rounded-pill d-flex justify-content-center align-items-center text-center w-75">Pagado</div>
						</td>
					@else
						@if($item->estado == 2)
							<td class="d-flex justify-content-star">
								<div class="p-1 bg-info text-white rounded-pill d-flex justify-content-center align-items-center text-center w-75">Verificado</div> 
							</td>
						@else
							@if($item->estado == 3)
								<td class="d-flex justify-content-star">
									<div class="p-1 bg-success text-white rounded-pill d-flex justify-content-center align-items-center text-center w-75">Inscripto</div>
								</td>
							@endif
						@endif
					@endif
					<td>
                        <a	href="{{ route('Pago.edit',$item->pago_id) }}" type="button" class="btn btn-success d-flex justify-content-center align-items-center text-center">Editar <i class="fas fa-edit ms-1"></i></a>
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
