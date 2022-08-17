@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Ubigeo de Persona</h2>

		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th>Código</th>
					<th>Código Ubigeo</th>
					<th>Tipo de Ubigeo</th>
					<th>Código Persona</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($ubip as $ub)

				<tr>
					<td>{{$ub->cod_ubi_pers}}</td>
					<td>{{$ub->ubigeo}}</td>
					<td>{{$ub->TipoUbigeo->tipo_ubigeo}}</td>
					<td>{{$ub->persona_idpersona}}</td>
				
				</tr>

				@endforeach
			</tbody>
		</table>
		{!! $ubip->render() !!}

	</div>

	<div class="col-sm-4">
		
	</div>

@endsection