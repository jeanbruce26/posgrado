@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Estudiantes</h2>

		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th class="col-1">Código</th>
					<th>Documento</th>
					<th>Apellido Paterno</th>
					<th>Apellido Materno</th>
					<th>Nombres</th>
					<th>Celular</th>
					<th class="col-1">Acciones</th>
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
					<td class="d-flex justify-content-star">
						<a href="#showModal" type="button" class="btn btn-info  d-flex justify-content-center align-items-center text-center" data-bs-toggle="modal" data-bs-target="#showModal{{$per->idpersona}}">Detalle <i class="fas fa-info-circle ms-1"></i></a>

						{{-- Modal Editar --}}
						<div class="modal fade" id="showModal{{$per->idpersona}}" tabindex="-1" aria-labelledby="showModal" aria-hidden="true">
							<div class="modal-dialog  modal-lg modal-dialog-scrollable">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="showModalLabel">Detalles de Persona</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<div class="modal-body">
										<div class="mb-3">
											<div class="col-sm-12 row g-3">
												<div class="col-md-4">
													<label>{{ $per->TipoDocumento->doc  }}</label>
													<input class="form-control" type="text" value="{{ $per->num_doc }}" disabled>
												</div>
												<div class="col-md-4">
													<label>Nombres</label>
													<input class="form-control" type="text" value="{{ $per->nombres }} {{ $per->apell_pater }} {{ $per->apell_mater }}" disabled>
												</div>
												<div class="col-md-4">
													<label>Fecha de Nacimiento</label>
													<input class="form-control" type="text" value="{{ $per->fecha_naci->format("d/m/Y") }}" disabled>
												</div>
												<div class="col-md-4">
													<label>Sexo</label>
													@if($per->sexo == "M")
														<input class="form-control" type="text" value="Masculino" disabled>
													@else
														<input class="form-control" type="text" value="Femenino" disabled> 
													@endif 
												</div>
												<div class="col-md-4">
													<label>Estado Civil</label>
													<input class="form-control" type="text" value="{{ $per->EstadoCivil->est_civil }}" disabled>
												</div>
												<div class="col-md-4">
													<label>Dirección</label>
													<input class="form-control" type="text" value="{{ $per->direccion }}" disabled>
												</div>
												@if($per->discapacidad_cod_disc != null)
													<div class="col-md-4">
														<label>Discapacidad</label>
														<input class="form-control" type="text" value="{{$per->Discapacidad->discapacidad}}"disabled> 
													</div>
												@endif
												<div class="col-md-4">
													<label>Celular</label>
													<input class="form-control" type="text" value="{{ $per->celular1 }}" disabled>
												</div>
												@if($per->celular2 != null)
													<div class="col-md-4">
														<label>Celular Opcional</label>
														<input class="form-control" type="text" value="{{$per->celular2}}"disabled> 
													</div>
												@endif 
												<div class="col-md-4">
													<label>Email</label>
													<input class="form-control" type="text" value="{{ $per->email }}" disabled>
												</div>
												@if($per->email2 != null)
													<div class="col-md-4">
														<label>Email Opcional</label>
														<input class="form-control" type="text" value="{{$per->email2}}"disabled> 
													</div>
												@endif
												<div class="col-md-4">
													<label>Centro de Trabajo</label>
													<input class="form-control" type="text" value="{{ $per->centro_trab }}" disabled>
												</div>
												<div class="col-md-4">
													<label>Universidad</label>
													<input class="form-control" type="text" value="{{ $per->Universidad->universidad }}" disabled>
												</div>
												<div class="col-md-4">
													<label>Año de Egreso</label>
													<input class="form-control" type="text" value="{{ $per->año_egreso }}" disabled>
												</div>
												<div class="col-md-4">
													<label>Grado Académico</label>
													<input class="form-control" type="text" value="{{ $per->GradoAcademico->nom_grado }}" disabled>
												</div>
												@if($per->especialidad != null)
													<div class="col-md-4">
														<label>Especialidad</label>
														<input class="form-control" type="text" value="{{$per->especialidad}}"disabled> 
													</div>
												@endif
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<a type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times me-1"></i>Cerrar</a>
									</div>
								</div>
							</div>
						</div>
						{{-- Modal Editar --}}
					</td>
				</tr>

				@endforeach
			</tbody>
		</table>
		{!! $perso->render() !!}
	</div>

@endsection