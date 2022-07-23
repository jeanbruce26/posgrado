@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">InscripcionPago
		<a href="" class="btn btn-primary pull-right">Nuevo</a>
		</h2>

		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th>Codigo</th>
					<th>Pago</th>
					<th>Ingreso de Pago</th>
					<th>Estado</th>
					<th>Acciones</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($inscPago as $inscripcionPago)

				<tr>
					<td>{{$inscripcionPago->cod_insc_pago}}</td>
					<td>{{$inscripcionPago->pago->monto}}</td>
					<td>{{$inscripcionPago->ingresoPago->monto}}</td>
					<td>@if ( $inscripcionPago->estado_ins == 1)
						ACTIVO
					@else
						DESACTIVO
					@endif
					</td>
					<td>
                        <button type="button" class="btn btn-success">Editar</button>
                        <button type="button" class="btn btn-danger">Eliminar</button>
                    </td>
				</tr>

				@endforeach
			</tbody>
		</table>
		{!! $inscPago->render() !!}

	</div>

	<div class="col-sm-4">
		
	</div>

@endsection
