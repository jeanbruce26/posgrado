@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Estado Civil
		<a href="" class="btn btn-primary pull-right">Nuevo</a>
		</h2>

		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th>Codigo</th>
					<th>Estado Civil</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($esta as $es)

				<tr>
					<td>{{$es->cod_est}}</td>
					<td>{{$es->est_civil}}</td>
				</tr>

				@endforeach
			</tbody>
		</table>
		{!! $esta->render() !!}

	</div>

	<div class="col-sm-4">
		
	</div>

@endsection