@extends ('admin')

@section('content')

<div class="col-sm-12">
	
	<h2 class="d-flex justify-content-between">Grado Academico
	<a href="{{ route('GradoAcademico.create') }}" class="btn btn-primary pull-right">Nuevo</a>
	</h2>

	<table class="table table-hover table-striped">
		<thead>
			<tr>
				<th>Codigo</th>
				<th>Grado Academico</th>
				<th>Acciones</th>

			</tr>
		</thead>

		<tbody>
			@foreach ($gra as $g)

			<tr>
				<td>{{$g->id_grado_academico}}</td>
				<td>{{$g->nom_grado}}</td>
				<td>
				<a href="{{ route('GradoAcademico.edit', $g->id_grado_academico) }}" type="button" class="btn btn-success">Editar</a>
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
