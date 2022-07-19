@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Plan
		<a href="{{ url('/Plan/create') }}" class="btn btn-primary ">Nuevo</a>
		</h2>

		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th>Codigo</th>
					<th>Plan</th>
					<th>Acciones</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($plan as $p)

				<tr>
					<td>{{$p->id_plan}}</td>
					<td>{{$p->plan}}</td>
					<td>
                            <button type="button" class="btn btn-success">Editar</button>
                            <button type="button" class="btn btn-danger">Eliminar</button>
                        </td>
				</tr>

				@endforeach
			</tbody>
		</table>
		{!! $plan->render() !!}

	</div>

	<div class="col-sm-4">
		
	</div>

@endsection
