@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Ingreso de Pago
		<a href="{{ url('/IngresoPago/create') }}" class="btn btn-primary pull-right">Nuevo</a>
		</h2>

		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th>Codigo</th>
					<th>Número de Operación</th>
					<th>Monto</th>
					<th>Fecha</th>
					<th>Inscripcion</th>
					<th>Acciones</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($ingrePago as $ingresoPago)

				<tr>
					<td>{{$ingresoPago->cod_ingre}}</td>
					<td>{{$ingresoPago->num_opera}}</td>
					<td>{{$ingresoPago->monto}}</td>
					<td>{{$ingresoPago->fecha}}</td>
					<td>{{$ingresoPago->inscripcion->cod_inscripcion}}</td>
					<td>
                        <a href="{{ route('IngresoPago.edit',$ingresoPago->cod_ingre) }}" type="button" class="btn btn-success">Editar</a>
                        <button type="button" class="btn btn-danger">Eliminar</button>
                    </td>
				</tr>

				@endforeach
			</tbody>
		</table>
		{!! $ingrePago->render() !!}

	</div>

	<div class="col-sm-4">
		
	</div>

@endsection
