@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Tipo de Documento</h2>

		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th width="20px">Código</th>
					<th width="20px">Tipo de Documento</th>
					
				</tr>
			</thead>

			<tbody>
				@foreach ($tipo as $ti)

				<tr>
					<td>{{$ti->id_tipo_doc}}</td>
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
