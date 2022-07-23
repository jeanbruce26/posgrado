@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Grado Academico
		<a href="" class="btn btn-primary pull-right">Nuevo</a>
		</h2>

		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th width="20px">Codigo</th>
					<th width="20px">Grado Academico</th>
				

				</tr>
			</thead>

			<tbody>
				@foreach ($gra as $g)

				<tr>
					<td>{{$g->id_grado_academico}}</td>
					<td>{{$g->nom_grado}}</td>
			
				</tr>

				@endforeach
			</tbody>
		</table>
		{!! $gra->render() !!}

	</div>

	<div class="col-sm-4">
		
	</div>

@endsection
