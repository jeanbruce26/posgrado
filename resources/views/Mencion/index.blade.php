@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Mención
		<a href="{{ url('/Mencion/create') }}" class="btn btn-primary pull-right d-flex justify-content-center align-items-center text-center">Nuevo <i class="fas fa-plus-circle ms-1"></i></a>
		</h2>

		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th>Programa</th>
					<th>Sub Programa</th>
					<th>Código</th>
					<th>Mención</th>
					<th class="col-1">Acciones</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($mencion as $item)

				<tr>
					<td>{{$item->subprograma->programa->descripcion_programa}}</td>
					<td>{{$item->subprograma->subprograma}}</td>
						@if (is_null($item->cod_mencion) && is_null($item->mencion))
							<td class="text-danger">Sin Mención</td>
							<td class="text-danger">Sin Mención</td>
						@else
							<td>{{$item->cod_mencion}}</td>
							<td>{{$item->mencion}}</td>
						@endif
					<td class="d-flex justify-content-star">
						<a href="{{ route('Mencion.edit',$item->id_mencion) }}" type="button" class="btn btn-success d-flex justify-content-center align-items-center text-center">Editar <i class="fas fa-edit ms-1"></i></a>
					</td>
				</tr>

				@endforeach
			</tbody>
		</table>
		{!! $mencion->render() !!}

	</div>

@endsection