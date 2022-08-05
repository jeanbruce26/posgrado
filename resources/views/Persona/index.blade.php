@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Personas
		<a href="{{ url('/user/inscripcion') }}" class="btn btn-primary pull-right">Nuevo</a>
		</h2>

		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th>ID</th>
					<th>Numero de DNI</th>
					<th>Apellido Paterno</th>
					<th>Apellido Materno</th>
					<th>Nombres</th>
					<th>Celular</th>
					<th>Acciones</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($perso as $per)

				<tr>
					<td>{{$per->idpersona}}</td>
					<td>{{$per->num_doc}}</td>
					<td>{{$per->apell_pater}}</td>
					<td>{{$per->apell_mater}}</td>
					<td>{{$per->nombres}}</td>
					<td>{{$per->celular1}}</td>

					<td>
						<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detalleModal" data-bs-whatever="@mdo">Detalle</button>
							<button type="button" class="btn btn-success">Editar</button>
						</td>
				</tr>

				@endforeach
			</tbody>
		</table>
		{!! $perso->render() !!}

	</div>


	{{-- MODAL DETALLE --}}
	<div class="modal fade" id="detalleModal" tabindex="-1" aria-labelledby="detalleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Detalles - {{ $per->nombres }} {{ $per->apell_pater }} {{ $per->apell_mater }}</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form>
						<div>
							..
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	{{-- MODAL DETALLE --}}

@endsection