@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Sub Programa
		<a href="{{ url('/SubPrograma/create') }}" class="btn btn-primary pull-right d-flex justify-content-center align-items-center text-center">Nuevo <i class="fas fa-plus-circle ms-1"></i></a>
		</h2>

		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th class="col-1">Código</th>
					<th>Programa</th>
					<th>Codigo</th>
					<th>Sub Programa</th>
					<th class="col-1">Acciones</thcl>
				</tr>
			</thead>

			<tbody>
				@foreach ($sub as $item)

				<tr>
					<td>{{$item->id_subprograma}}</td>
					<td>{{$item->programa->descripcion_programa}}</td>
					<td>{{$item->cod_subprograma}}</td>
					<td>{{$item->subprograma}}</td>
					<td class="d-flex justify-content-star">
                        <a	href="{{ route('SubPrograma.edit',$item->id_subprograma) }}" type="button" class="btn btn-success d-flex justify-content-center align-items-center text-center">Editar <i class="fas fa-edit ms-1"></i></a>
					</td>
				</tr>

				@endforeach
			</tbody>
		</table>
		{!! $sub->render() !!}

	</div>

@endsection