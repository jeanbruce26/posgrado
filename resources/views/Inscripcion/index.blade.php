@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Inscripción</h2>

		@if(\Session::has('edit'))
			<div class="alert alert-success d-flex align-items-center" role="alert">
				<div>
					{{ \Session::get('edit') }}
				</div>
			</div>
		@endif

		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th class="col-1">Código</th>
					<th>Persona</th>
					<th class="col-2">Estado</th>
					<th>Admisión</th>
					<th>Programa</th>
					<th class="col-1">Expedientes</th>
					<th class="col-1">Acciones</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($insc as $inscrip)

				<tr>
					<td>{{$inscrip->id_inscripcion}}</td>
					<td>{{$inscrip->persona->nombres}} {{$inscrip->persona->apell_pater}} {{$inscrip->persona->apell_mater}}</td>
					<td>
						@if ( $inscrip->estado == "Activo")
							<div class="p-1 bg-info text-white rounded-pill d-flex justify-content-center align-items-center text-center w-75">{{$inscrip->estado}}</div></td>
						@else
							<div class="p-1 bg-danger text-white rounded-pill d-flex justify-content-center align-items-center text-center w-75">{{$inscrip->estado}}</div></td>
						@endif
					<td>{{$inscrip->admision->admision}}</td>
					<td>{{$inscrip->mencion->subprograma->subprograma}} - {{$inscrip->mencion->mencion}}</td>
					<td class="d-flex justify-content-star">
                        <a href="#showModal" type="button" class="btn btn-info d-flex justify-content-center align-items-center text-center" data-bs-toggle="modal" data-bs-target="#showModal{{$inscrip->id_inscripcion}}">Detalle <i class="fas fa-info-circle ms-1"></i></a>

						{{-- Modal Editar --}}
						<div class="modal fade" id="showModal{{$inscrip->id_inscripcion}}" tabindex="-1" aria-labelledby="showModal" aria-hidden="true">
							<div class="modal-dialog  modal-lg modal-dialog-scrollable">
								<div class="modal-content">
									@php
										$expInsc = App\Models\ExpedienteInscripcion::where('id_inscripcion', $inscrip->id_inscripcion)->get();
										$value = 0;
									@endphp
									<div class="modal-header">
										<h5 class="modal-title" id="showModalLabel">Expedientes de Inscripción - {{ $inscrip->persona->nombres }} {{$inscrip->persona->apell_pater}} {{$inscrip->persona->apell_mater}}</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<div class="modal-body">
										<div class="mb-3">
											<table class="table table-hover table-striped">
												<thead>
													<tr class="col-sm-12">
														<th class="col-md-4">Documento</th>
														<th class="col-md-2">Estado</th>
														<th class="col-md-2">Fecha</th>
														<th class="col-md-3">Observación</th>
														<th class="col-md-1">Archivo</th>
													</tr>
												</thead>
									
												<tbody>
													@foreach ($expediente as $exp)
														@foreach ($expInsc as $expInscripcion)
															@if($exp->cod_exp == $expInscripcion->expediente_cod_exp)
																<tr>
																	<td>{{$expInscripcion->nom_exped}}</td>
																	<td>
																		<div class="p-1 bg-info text-white rounded-pill d-flex justify-content-center align-items-center text-center">{{$expInscripcion->estado}}</div></td>
																	</td>
																	<td>{{$expInscripcion->fecha_entre->format('d/m/Y')}}</td>
																	@if($expInscripcion->observacion == null)
																		<td>Sin Observación</td>
																	@else
																		<td>{{$expInscripcion->observacion}}</td>
																	@endif
																	<td>
																		<a target="_blank" href="{{asset('Admision 2022 - I/'.$expInscripcion->id_inscripcion.'/'.$expInscripcion->nom_exped)}}" class="btn btn-with">
																			<i class="fas fa-file-pdf"></i>
																		</a>
																	</td>
																</tr>
																@php
																	$value=1;
																@endphp
															@endif
														@endforeach
														@if($value != 1)
															<tr>
																<td>{{$exp->tipo_doc}}</td>
																<td>
																	<div class="p-1 bg-danger text-white rounded-pill d-flex justify-content-center align-items-center text-center">No enviado</div></td>
																</td>
																<td>-</td>
																<td>-</td>
																<td>-</td>
															</tr>
														@endif
														@php
															$value=0;
														@endphp
													@endforeach
												</tbody>
											</table>
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
					<td>
                        <a href="#editModal" type="button" class="btn btn-success d-flex justify-content-center align-items-center text-center w-100" data-bs-toggle="modal" data-bs-target="#editModal{{$inscrip->id_inscripcion}}">Editar <i class="fas fa-edit ms-1"></i></a>

						{{-- Modal Editar --}}
						<div class="modal fade" id="editModal{{$inscrip->id_inscripcion}}" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Editar Estado de Inscripción</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<form action="{{ route('Inscripcion.update',$inscrip->id_inscripcion) }}" method="POST">
									@csrf @method('PUT')
										<div class="modal-body">
											<div class="mb-3">
												<label for="recipient-name" class="col-form-label">Estado:</label>
												<select id="inputEstado" class="form-select" name="estado">
													<option value="" selected>Seleccione</option>
													<option value="Activo" {{ $inscrip->estado == "Activo" ? 'selected' : '' }}> Activo</option>
													<option value="Inactivo" {{ $inscrip->estado == "Inactivo" ? 'selected' : '' }}> Inactivo</option>
												</select>
											</div>
										</div>
										<div class="modal-footer">
											<a type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times me-1"></i>Cancelar</a>
											<button type="submit" class="btn btn-primary d-flex justify-content-center align-items-center">Guardar <i class="fas fa-edit ms-1"></i></button>
										</div>
									</form>
								</div>
							</div>
						</div>
						{{-- Modal Editar --}}
                    </td>
				</tr>

				@endforeach
			</tbody>
		</table>
		{!! $insc->render() !!}
	</div>


	
@endsection
