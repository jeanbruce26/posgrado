@extends ('admin')

@section('content')

	<div class="col-sm-12">

		<h2 class="d-flex justify-content-between">Inscripción Pago</h2>

		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th class="col-1">Código</th>
					<th>Inscripción</th>
					<th>Pago</th>
					<th>Concepto Pago</th>
					{{-- <th>Acciones</th> --}}
				</tr>
			</thead>

			<tbody>
				@foreach ($inscPago as $inscripcionPago)

				<tr>
					<td>{{$inscripcionPago->inscripcion_pago_id}}</td>
					<td>{{$inscripcionPago->inscripcion->inscripcion_id}}</td>
					<td>{{$inscripcionPago->pago->monto}}</td>
					<td>{{$inscripcionPago->ConceptoPago->concepto}}</td>
					{{-- <td>
                        <button type="button" class="btn btn-success">Editar</button>
                        <button type="button" class="btn btn-danger">Eliminar</button>
                    </td> --}}
				</tr>

				@endforeach
			</tbody>
		</table>
		{!! $inscPago->render() !!}

	</div>

	<div class="col-sm-4">
		
	</div>

@endsection
