@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Plan
		<a href="{{ url('/Plan/create') }}" class="btn btn-primary">Nuevo <i class="fas fa-plus-circle"></i></a>
		</h2>

		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th class="col-md-2">Codigo</th>
					<th>Plan</th>
					<th class="col-md-2">Acciones</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($plan as $p)

				<tr>
					<td>{{$p->id_plan}}</td>
					<td>{{$p->plan}}</td>
					<td>
						<a href="{{ route('Plan.edit',$p->id_plan) }}" type="button" class="btn btn-success">Editar <i class="fas fa-edit"></i></a>
						
					</td>
				</tr>

				@endforeach
			</tbody>
		</table>
		{!! $plan->render() !!}

	</div>

@endsection