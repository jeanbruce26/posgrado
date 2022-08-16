@extends ('admin')

@section('content')

<div class="col-sm-12">
	
	<h2 class="d-flex justify-content-between">Grado Académico
	<a href="{{ route('GradoAcademico.create') }}" class="btn btn-primary pull-right d-flex justify-content-center align-items-center text-center">Nuevo <i class="fas fa-plus-circle ms-1"></i></a>
	</h2>

	<table class="table table-hover table-striped">
		<thead>
			<tr>
				<th class="col-1">Código</th>
				<th>Grado Académico</th>
				<th class="col-1">Acciones</th>

			</tr>
		</thead>

		<tbody>
			@foreach ($gra as $g)

			<tr>
				<td>{{$g->id_grado_academico}}</td>
				<td>{{$g->nom_grado}}</td>
				<td class="d-flex justify-content-star">
					<a href="{{ route('GradoAcademico.edit', $g->id_grado_academico) }}" type="button" class="btn btn-success d-flex justify-content-center align-items-center text-center">Editar <i class="fas fa-edit ms-1"></i></a>
				</td>
			</tr>

			@endforeach
		</tbody>
	</table>
	{!! $gra->render() !!}

</div>

<div class="col-sm-4">
	
</div>

@endsection
