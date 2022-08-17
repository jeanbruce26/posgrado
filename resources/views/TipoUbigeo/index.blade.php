@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Tipo de Ubigeo</h2>

		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th width="20px">Código</th>
					<th width="20px">Tipo de Ubigeo</th>
					
				</tr>
			</thead>

			<tbody>
				@foreach ($ti as $tis)

				<tr>
					<td>{{$tis->cod_tipo}}</td>
					<td>{{$tis->tipo_ubigeo}}</td>
				</tr>

				@endforeach
			</tbody>
		</table>
		{!! $ti->render() !!}

	</div>

	<div class="col-sm-4">
		
	</div>

@endsection
