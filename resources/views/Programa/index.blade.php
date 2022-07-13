@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Programa
		<a href="" class="btn btn-primary pull-right">Nuevo</a>
		</h2>

		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th>Codigo</th>
					<th>Diplomado</th>
					<th>Maestria</th>
					<th>Doctorado</th>
					<th>Sede</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($pro as $programa)

				<tr>
					<td>{{$programa->cod_programa}}</td>
					<td>{{$programa->id_diplo}}</td>
					<td>{{$programa->id_maestria}}</td>
					<td>{{$programa->id_doc}}</td>
					<td>{{$programa->sede_cod_sede}}</td>
				</tr>

				@endforeach
			</tbody>
		</table>
		{!! $pro->render() !!}

	</div>

	<div class="col-sm-4">
		
	</div>

@endsection
