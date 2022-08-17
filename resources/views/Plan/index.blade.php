@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Plan
		<a href="{{ url('/Plan/create') }}" class="btn btn-primary d-flex justify-content-center align-items-center text-center">Nuevo <i class="fas fa-plus-circle ms-1"></i></a>
		</h2>

		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th class="col-md-1">Código</th>
					<th>Plan</th>
					<th class="col-md-1">Acciones</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($plan as $p)

				<tr>
					<td>{{$p->id_plan}}</td>
					<td>{{$p->plan}}</td>
					<td class="d-flex justify-content-star">
                        <a	href="{{ route('Plan.edit',$p->id_plan) }}" type="button" class="btn btn-success d-flex justify-content-center align-items-center text-center">Editar <i class="fas fa-edit ms-1"></i></a>
					</td>
				</tr>

				@endforeach
			</tbody>
		</table>
		{!! $plan->render() !!}

	</div>

@endsection