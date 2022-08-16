@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Inscripción</h2>

		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th class="col-1">Código</th>
					<th>Persona</th>
					<th>Estado</th>
					<th>Admisión</th>
					<th>Programa</th>
					<th class="col-1">Expedientes</th>
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
					<td class="d-flex justify-content-star">
                        <a href="{{ route('Inscripcion.show', $inscrip->id_inscripcion) }}" type="button" class="btn btn-secondary d-flex justify-content-center align-items-center text-center">Detalle <i class="fas fa-info-circle ms-1"></i></a>
                    </td>
				</tr>

				@endforeach
			</tbody>
		</table>
		{!! $insc->render() !!}
	</div>

@endsection
