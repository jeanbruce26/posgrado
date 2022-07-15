@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Tipo Ubigeo
		<a href="" class="btn btn-primary pull-right">Nuevo</a>
		</h2>

		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th width="20px">Codigo</th>
					<th width="20px">Tipo de Ubigeo</th>
					
				</tr>
			</thead>

			<tbody>
				@foreach ($ti as $tis)

				<tr>
					<td>{{$tis->cod_tipo}}</td>
					<td>{{$tis->tipo_ubigeot}}</td>
				</tr>

				@endforeach
			</tbody>
		</table>
		{!! $ti->render() !!}

	</div>

	<div class="col-sm-4">
		
	</div>

@endsection
