@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Programa
		<a href="{{ route('Programa.create') }}" class="btn btn-primary pull-right d-flex justify-content-center align-items-center text-center">Nuevo <i class="fas fa-plus-circle ms-1"></i></a>
		</h2>

		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th class="col-1">Código</th>
					<th>Programa</th>
					<th>Sede</th>
					<th class="col-2">Acciones</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($pro as $programa)

				<tr>
					<td>{{$programa->id_programa}}</td>
					<td>{{$programa->descripcion_programa}}</td>
					<td>{{$programa->sede->sede}}</td>
					<td class="d-flex justify-content-star">
						<a type="button" class="btn btn-secondary d-flex justify-content-center align-items-center text-center me-2">Detalle <i class="fas fa-info-circle ms-1"></i></a>
						<a href="{{ route('Programa.edit',$programa->id_programa) }}" type="button" class="btn btn-success d-flex justify-content-center align-items-center text-center">Editar <i class="fas fa-edit ms-1"></i></a>
					</td>
				</tr>

				@endforeach
			</tbody>
		</table>
		{!! $pro->render() !!}

	</div>

	<div class="col-sm-4">
		
	</div>

@endsection
