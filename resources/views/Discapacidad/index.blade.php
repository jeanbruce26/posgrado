@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Discapacidad
		<a href="{{ route('Discapacidad.create') }}" class="btn btn-primary pull-right d-flex justify-content-center align-items-center">Nuevo <i class="fas fa-plus-circle ms-1"></i></a>
		</h2>

		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th class="col-1">Codigo</th>
					<th>Discapacidad</th>
					<th class="col-2">Acciones</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($disc as $di)

				<tr>
					<td>{{$di->cod_disc}}</td>
					<td>{{$di->discapacidad}}</td>

					<td class="d-flex justify-content-star">
						<a href="{{ route('Discapacidad.edit', $di->cod_disc) }}" type="button" class="btn btn-success d-flex justify-content-center align-items-center text-center">Editar <i class="fas fa-edit ms-1"></i></a>
					</td>
				</tr>

				@endforeach
			</tbody>
		</table>
		{!! $disc->render() !!}

	</div>

	<div class="col-sm-4">
		
	</div>

@endsection