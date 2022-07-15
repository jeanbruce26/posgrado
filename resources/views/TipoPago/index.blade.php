@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">TipoPago
		<a href="" class="btn btn-primary pull-right">Nuevo</a>
		</h2>

		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th>Codigo</th>
					<th>Tipo de Pago</th>
					<th>Acciones</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($tipoPag as $tipoPago)

				<tr>
					<td>{{$tipoPago->cod_tipo_pago}}</td>
					<td>{{$tipoPago->tipo_pago}}</td>
					<td>
                        <button type="button" class="btn btn-success">Editar</button>
                        <button type="button" class="btn btn-danger">Eliminar</button>
                    </td>
				</tr>

				@endforeach
			</tbody>
		</table>
		{!! $tipoPag->render() !!}

	</div>

	<div class="col-sm-4">
		
	</div>

@endsection
