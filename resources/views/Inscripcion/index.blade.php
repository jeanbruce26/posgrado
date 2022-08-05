@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Inscripcion</h2>

		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th>ID</th>
					<th>Persona</th>
					<th>Estado</th>
					<th>Admision</th>
					<th>Programa</th>
					<th>Expedientes</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($insc as $inscrip)

				<tr>
					<td>{{$inscrip->id_inscripcion}}</td>
					<td>{{$inscrip->persona->nombres}} {{$inscrip->persona->apell_pater}} {{$inscrip->persona->apell_mater}}</td>
					<td>{{$inscrip->estado}}</td>
					<td>{{$inscrip->admision->admision}}</td>
					<td>{{$inscrip->mencion->subprograma->subprograma}} - {{$inscrip->mencion->mencion}}</td>
					<td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detalleModal" data-bs-whatever="@mdo">Mostrar</button>
                    </td>
				</tr>

				@endforeach
			</tbody>
		</table>
		{!! $insc->render() !!}
	</div>


	{{-- MODAL DETALLE --}}
	<div class="modal fade" id="detalleModal" tabindex="-1" aria-labelledby="detalleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Documentos</h5>
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
