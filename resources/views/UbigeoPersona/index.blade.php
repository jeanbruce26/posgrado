@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Ubigeo Persona
		<a href="" class="btn btn-primary pull-right">Nuevo</a>
		</h2>

		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th>Codigo</th>
					<th>Ubigeo Codigo</th>
					<th>Tipo de Ubigeo</th>
					<th>Id Persona</th>
					<th>Acciones</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($ubip as $ub)

				<tr>
					<td>{{$ub->cod_ubi_pers}}</td>
					<td>{{$ub->ubigeo_cod_ubi}}</td>
					<td>{{$ub->tipo_ubigeo_cod_tipo}}</td>
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