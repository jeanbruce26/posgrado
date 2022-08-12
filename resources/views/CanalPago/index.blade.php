@extends ('admin')

@section('content')

	<div class="col-sm-12">

		<h2 class="d-flex justify-content-between">Canal Pago
			<a href="{{ route('CanalPago.create') }}" class="btn btn-primary pull-right d-flex justify-content-center align-items-center">Nuevo <i class="fas fa-plus-circle ms-1"></i></a>
		</h2>

		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th class="col-1">Código</th>
					<th>Canal Pago</th>
					<th class="col-1">Acciones</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($canal as $item)

				<tr>
					<td>{{$item->canal_pago_id}}</td>
					<td>{{$item->descripcion}}</td>
					<td class="d-flex justify-content-star">
						<a href="{{ route('CanalPago.edit',$item->canal_pago_id) }}" type="button" class="btn btn-success d-flex justify-content-center align-items-center text-center">Editar <i class="fas fa-edit ms-1"></i></a>
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
