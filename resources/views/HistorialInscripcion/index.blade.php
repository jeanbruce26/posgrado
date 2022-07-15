@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">HistorialInscripcion
		<a href="" class="btn btn-primary pull-right">Nuevo</a>
		</h2>

		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th>Codigo</th>
					<th>Inscripcion</th>
					<th>Admision</th>
					<th>Acciones</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($histoIns as $historialIns)

				<tr>
					<td>{{$historialIns->cod_histo}}</td>
					<td>{{$historialIns->id_inscripcion}}</td>
					<td>{{$historialIns->admision}}</td>
					<td>
                        <button type="button" class="btn btn-success">Editar</button>
                        <button type="button" class="btn btn-danger">Eliminar</button>
                    </td>
				</tr>

				@endforeach
			</tbody>
		</table>
		{!! $histoIns->render() !!}

	</div>

	<div class="col-sm-4">
		
	</div>

@endsection
