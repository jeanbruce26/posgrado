@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Expediente de Inscripcion
		<a href="" class="btn btn-primary pull-right">Nuevo</a>
		</h2>

		<table class="table table-hover table-striped">
			<thead>
				<tr class="col-sm-12">
					<th>Codigo</th>
					<th class="col-md-4">Nombre</th>
					<th>Estado</th>
					<th class="col-md-4">Observación</th>
					<th>Fecha</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($expInsc as $expInscripcion)

				<tr>
					<td>{{$expInscripcion->cod_ex_insc}}</td>
					<td>{{$expInscripcion->nom_exped}}</td>
					<td>{{$expInscripcion->estado}}</td>
					@if($expInscripcion->observacion == null)
						<td>Sin Observación</td>
					@else
						<td>{{$expInscripcion->observacion}}</td>
					@endif
					<td>{{$expInscripcion->fecha_entre->format('d/m/Y')}}</td>
				</tr>

				@endforeach
			</tbody>
		</table>
		{!! $expInsc->render() !!}

	</div>

	<div class="col-sm-4">
		
	</div>

@endsection
