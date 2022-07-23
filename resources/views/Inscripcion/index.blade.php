@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Inscripcion</h2>

		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th>ID</th>
					<th>Codigo</th>
					<th>Persona</th>
					<th>Estado</th>
					<th>Admision</th>
					<th>Detalle Programa</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($insc as $inscrip)

				<tr>
					<td>{{$inscrip->id_inscripcion}}</td>
					<td>{{$inscrip->cod_inscripcion}}</td>
					<td>{{$inscrip->persona->nombres}} {{$inscrip->persona->apell_pater}} {{$inscrip->persona->apell_mater}}</td>
					<td>{{$inscrip->estado}}</td>
					<td>{{$inscrip->admision->admision}}</td>
					<td>{{$inscrip->detallePrograma->des_detalle_programa}}</td>
				</tr>

				@endforeach
			</tbody>
		</table>
		{!! $insc->render() !!}

	</div>

	<div class="col-sm-4">
		
	</div>

@endsection
