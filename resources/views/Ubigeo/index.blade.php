@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Ubigeo
		<a href="" class="btn btn-primary pull-right">Nuevo</a>
		</h2>

		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th width="20px">Codigo</th>
					<th width="20px">Cod Departamento</th>
					<th width="20px">Cod Provincia</th>
					<th width="20px">Cod Distrito</th>
					<th width="20px">Departamento</th>
					<th width="20px">Provincia</th>
					<th width="20px">Distrito</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($ubi as $ubis)

				<tr>
					<td>{{$ubis->cod_ubi}}</td>
					<td>{{$ubis->cod_depart}}</td>
					<td>{{$ubis->cod_provin}}</td>
					<td>{{$ubis->cod_distri}}</td>
					<td>{{$ubis->departamento}}</td>
					<td>{{$ubis->provincia}}</td>
					<td>{{$ubis->distrito}}</td>
				</tr>

				@endforeach
			</tbody>
		</table>
		{!! $ubi->render() !!}

	</div>

	<div class="col-sm-4">
		
	</div>

@endsection
