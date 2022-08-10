@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Admision
		<a href="{{ url('/Admision/create') }}" class="btn btn-primary pull-right d-flex justify-content-center align-items-center">Nuevo <i class="fas fa-plus-circle ms-1"></i></a>
		</h2>

		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th class="col-1">Codigo</th>
					<th>Admision</th>
					<th class="col-2">Acciones</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($admi as $admision)

				<tr>
					<td>{{$admision->cod_admi}}</td>
					<td>{{$admision->admision}}</td>
					<td class="d-flex justify-content-star">
                        <a href="{{ route('Admision.edit', $admision->cod_admi) }}" type="button" class="btn btn-success d-flex justify-content-center align-items-center text-center">Editar <i class="fas fa-edit ms-1"></i></a>
                    </td>
				</tr>

				@endforeach
			</tbody>
		</table>
		{!! $admi->render() !!}

	</div>

	<div class="col-sm-4">
		
	</div>

@endsection
