@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Estudiantes</h2>

		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th class="col-1">Código</th>
					<th>Documento</th>
					<th>Apellido Paterno</th>
					<th>Apellido Materno</th>
					<th>Nombres</th>
					<th>Celular</th>
					<th class="col-1">Acciones</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($perso as $per)

				<tr>
					<td>{{$per->idpersona}}</td>
					<td>{{$per->num_doc}}</td>
					<td>{{$per->apell_pater}}</td>
					<td>{{$per->apell_mater}}</td>
					<td>{{$per->nombres}}</td>
					<td>{{$per->celular1}}</td>
					<td class="d-flex justify-content-star">
						<a href="{{ route('Persona.show',$per->idpersona) }}" type="button" class="btn btn-secondary d-flex justify-content-center align-items-center text-center">Detalle <i class="fas fa-info-circle ms-1"></i></a>
					</td>
				</tr>

				@endforeach
			</tbody>
		</table>
		{!! $perso->render() !!}
	</div>

@endsection