@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2>Tipo Documento
		<a href="" class="btn btn-primary pull-right">Nuevo</a>
		</h2>

		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th width="20px">Codigo</th>
					<th width="20px">Tipo de Documento</th>
					
				</tr>
			</thead>

			<tbody>
				@foreach ($tipo as $ti)

				<tr>
					<td>{{$ti->cod_tipo}}</td>
					<td>{{$ti->doc}}</td>
									</tr>

				@endforeach
			</tbody>
		</table>
		{!! $tipo->render() !!}

	</div>

	<div class="col-sm-4">
		
	</div>

@endsection
