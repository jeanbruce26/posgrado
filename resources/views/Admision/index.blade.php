@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Admision
		<a href="{{ url('/Admision/create') }}" class="btn btn-primary pull-right">Nuevo</a>
		</h2>

		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th>Codigo</th>
					<th>Admision</th>
					<th>Acciones</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($admi as $admision)

				<tr>
					<td>{{$admision->cod_admi}}</td>
					<td>{{$admision->admision}}</td>
					<td>
                        <a href="{{ route('Admision.edit', $admision->cod_admi) }}" type="button" class="btn btn-success">Editar</a>
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
