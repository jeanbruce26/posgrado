@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Universidad
		<a href="{{ route('Universidad.create') }}" class="btn btn-primary pull-right d-flex justify-content-center align-items-center text-center">Nuevo <i class="fas fa-plus-circle ms-1"></i></a>
		</h2>

		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th class="col-1">Código</th>
					<th>Universidad</th>
					<th>Departamento</th>
					<th>Tipo Gestion</th>
					<th class="col-1">Acciones</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($uni as $n)

				<tr>
					<td>{{$n->cod_uni}}</td>
					<td>{{$n->universidad}}</td>
					<td>{{$n->depart}}</td>
					<td>{{$n->tipo_gesti}}</td>
					<td class="d-flex justify-content-star">
                        <a	href="{{ route('Universidad.edit',$n->cod_uni) }}"  type="button" class="btn btn-success d-flex justify-content-center align-items-center text-center">Editar <i class="fas fa-edit ms-1"></i></a>
					</td>
				</tr>

				@endforeach
			</tbody>
		</table>
		{!! $uni->render() !!}

	</div>

	<div class="col-sm-4">
		
	</div>

@endsection