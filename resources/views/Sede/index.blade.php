@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Sede
		<a href="{{ url('Sede/create') }}" class="btn btn-primary pull-right d-flex justify-content-center align-items-center text-center">Nuevo <i class="fas fa-plus-circle ms-1"></i></a>
		</h2>

		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th class="col-1">Código</th>
					<th>Sede</th>
					<th>Plan</th>
					<th class="col-1">Acciones</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($se as $sede)

				<tr>
					<td>{{$sede->cod_sede}}</td>
					<td>{{$sede->sede}}</td>
					<td>{{$sede->plan->plan}}</td>
					<td class="d-flex justify-content-star">
                        <a	href="/Sede/{{ $sede->cod_sede }}/edit" type="button" class="btn btn-success d-flex justify-content-center align-items-center text-center">Editar <i class="fas fa-edit ms-1"></i></a>
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
