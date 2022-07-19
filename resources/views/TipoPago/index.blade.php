@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Tipo Pago
			<a href="{{ url('/TipoPago/create') }}" class="btn btn-primary ">Nuevo</a>
		</h2>

		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th>Codigo</th>
					<th>Tipo Pago</th>
					<th>Acciones</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($tipago as $tipopago)

				<tr>
					<td>{{$tipopago->cod_tipo_pago}}</td>
					<td>{{$tipopago->tipo_pago}}</td>
					<td>
                            <button type="button" class="btn btn-success">Editar</button>
                            <button type="button" class="btn btn-danger">Eliminar</button>
                        </td>
				</tr>

				@endforeach
			</tbody>
		</table>
		{!! $tipago->render() !!}

	</div>

	<div class="col-sm-4">
		
	</div>

@endsection
