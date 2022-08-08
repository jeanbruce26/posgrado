@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Inscripcion</h2>

		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th>ID</th>
					<th>Persona</th>
					<th>Estado</th>
					<th>Admision</th>
					<th>Programa</th>
					<th>Expedientes</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($insc as $inscrip)

				<tr>
					<td>{{$inscrip->id_inscripcion}}</td>
					<td>{{$inscrip->persona->nombres}} {{$inscrip->persona->apell_pater}} {{$inscrip->persona->apell_mater}}</td>
					<td>{{$inscrip->estado}}</td>
					<td>{{$inscrip->admision->admision}}</td>
					<td>{{$inscrip->mencion->subprograma->subprograma}} - {{$inscrip->mencion->mencion}}</td>
					<td>
                        <a href="{{ route('Inscripcion.show', $inscrip->id_inscripcion) }}" type="button" class="btn btn-secondary">Mostrar</a>
                    </td>
				</tr>

				@endforeach
			</tbody>
		</table>
		{!! $insc->render() !!}
	</div>

@endsection
