@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Doctorado
		<a href="" class="btn btn-primary pull-right">Nuevo</a>
		</h2>

		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th>id</th>
					<th>Codigo</th>
					<th>Doctorado</th>
					<th>Plan</th>
					<th>Acciones</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($doc as $doctorado)

				<tr>
					<td>{{$doctorado->id_doc}}</td>
					<td>{{$doctorado->cod_doc}}</td>
					<td>{{$doctorado->doctorado}}</td>
					<td>{{$doctorado->id_plan}}</td>
					<td>
                              <button type="button" class="btn btn-success">Editar</button>
                              <button type="button" class="btn btn-danger">Eliminar</button>
                         </td>
				</tr>

				@endforeach
			</tbody>
		</table>
		{!! $doc->render() !!}

	</div>

	<div class="col-sm-4">
		
	</div>

@endsection
