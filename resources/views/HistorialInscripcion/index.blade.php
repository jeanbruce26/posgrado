@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">HistorialInscripcion</h2>

		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th>Codigo</th>
					<th>Inscripcion</th>
					<th>Admision</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($histoIns as $historialIns)

				<tr>
					<td>{{$historialIns->cod_histo}}</td>
					<td>{{$historialIns->inscripcion->cod_inscripcion}}</td>
					<td>{{$historialIns->admision}}</td>
				</tr>

				@endforeach
			</tbody>
		</table>
		{!! $histoIns->render() !!}

	</div>

	<div class="col-sm-4">
		
	</div>

@endsection
