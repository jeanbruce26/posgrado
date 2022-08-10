@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Estado Civil
		</h2>

		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th class="col-1">Codigo</th>
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