@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Sede
		<a href="{{ url('Sede/create') }}" class="btn btn-primary ">Nuevo</a>
		</h2>

		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th>Codigo</th>
					<th>Sede</th>
					<th>Acciones</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($se as $sede)

				<tr>
					<td>{{$sede->cod_sede}}</td>
					<td>{{$sede->sede}}</td>
					<td>
                              <a href="/Sede/{{ $sede->cod_sede }}/edit" class="btn btn-success">Editar</a>
                              <a type="button" class="btn btn-danger">Eliminar</a>
                         </td>
				</tr>

				@endforeach
			</tbody>
		</table>
		{!! $se->render() !!}

	</div>

	<div class="col-sm-4">
		
	</div>

@endsection
