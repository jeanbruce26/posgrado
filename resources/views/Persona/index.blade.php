@extends('admin')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger alert-border-left alert-dismissible fade shadow show" role="alert">
            <i class="ri-error-warning-line me-3 align-middle fs-16"></i> <strong>Errror al editar Estudiante</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1 fw-bold">ESTUDIANTE</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="live-preview">
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="col-1">ID</th>
                                        <th class="col-1">Documento</th>
                                        <th>Nombre Completo</th>
                                        <th class="col-2">Fecha de Nacimiento</th>
                                        <th class="col-2">Sexo</th>
                                        <th class="col-1">Celular</th>
                                        <th class="col-1">Acciones</th>
                                    </tr>
                                </thead>

                                {{-- <tbody> --}}
                                <tbody>
                                    @foreach ($perso as $item)
                                        <tr>
                                            <td>{{$item->idpersona}}</td>
                                            <td>{{$item->num_doc}}</td>
                                            <td>{{$item->nombres}} {{$item->apell_pater}} {{$item->apell_mater}}</td>
                                            <td>{{date('d-m-Y', strtotime($item->fecha_naci))}}</td>
                                            <td>{{$item->sexo}}</td>
                                            <td>{{$item->celular1}}</td>
                                            <td class="d-flex justify-content-star">
                                                <a href="#detalleModal" type="button" class="link-info fs-15" data-bs-toggle="modal" data-bs-target="#showModal{{$item->idpersona}}"><i class="bx bx-info-circle bx-sm bx-burst-hover me-3"></i></a>

                                                {{-- Modal Show --}}
                                                <div class="modal fade" id="showModal{{$item->idpersona}}" tabindex="-1" aria-labelledby="showModal" aria-hidden="true">
                                                    <div class="modal-dialog  modal-lg modal-dialog-scrollable">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="showModalLabel">Detalles de Alumno</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <div class="col-sm-12 row g-3">
                                                                        <div class="mb-2 col-md-4">
                                                                            <label>
                                                                                @if($item->num_doc == 8)
                                                                                    DNI
                                                                                @else
                                                                                    Carnet de Extranjería
                                                                                @endif
                                                                            </label>
                                                                            <input class="form-control" type="text" value="{{ $item->num_doc }}" disabled>
                                                                        </div>
                                                                        <div class="mb-2 col-md-4">
                                                                            <label>Nombres</label>
                                                                            <input class="form-control" type="text" value="{{ $item->nombres }} {{ $item->apell_pater }} {{ $item->apell_mater }}" disabled>
                                                                        </div>
                                                                        <div class="mb-2 col-md-4">
                                                                            <label>Apellido Paterno</label>
                                                                            <input class="form-control" type="text" value="{{ $item->apell_pater }}" disabled>
                                                                        </div>
                                                                        <div class="mb-2 col-md-4">
                                                                            <label>Apellido Materno</label>
                                                                            <input class="form-control" type="text" value="{{ $item->apell_mater }}" disabled>
                                                                        </div>
                                                                        <div class="mb-2 col-md-4">
                                                                            <label>Fecha de Nacimiento</label>
                                                                            <input class="form-control" type="text" value="{{ date('d-m-Y', strtotime($item->fecha_naci)) }}" disabled>
                                                                        </div>
                                                                        <div class="mb-2 col-md-4">
                                                                            <label>Sexo</label>
                                                                            @if($item->sexo == "M")
                                                                                <input class="form-control" type="text" value="Masculino" disabled>
                                                                            @else
                                                                                <input class="form-control" type="text" value="Femenino" disabled> 
                                                                            @endif 
                                                                        </div>
                                                                        <div class="mb-2 col-md-4">
                                                                            <label>Estado Civil</label>
                                                                            <input class="form-control" type="text" value="{{ $item->EstadoCivil->est_civil }}" disabled>
                                                                        </div>
                                                                        <div class="mb-2 col-md-4">
                                                                            <label>Dirección</label>
                                                                            <input class="form-control" type="text" value="{{ $item->direccion }}" disabled>
                                                                        </div>
                                                                        @if($item->discapacidad_cod_disc != null)
                                                                            <div class="mb-2 col-md-4">
                                                                                <label>Discapacidad</label>
                                                                                <input class="form-control" type="text" value="{{$item->Discapacidad->discapacidad}}"disabled> 
                                                                            </div>
                                                                        @endif
                                                                        <div class="mb-2 col-md-4">
                                                                            <label>Celular</label>
                                                                            <input class="form-control" type="text" value="{{ $item->celular1 }}" disabled>
                                                                        </div>
                                                                        @if($item->celular2 != null)
                                                                            <div class="mb-2 col-md-4">
                                                                                <label>Celular Opcional</label>
                                                                                <input class="form-control" type="text" value="{{$item->celular2}}"disabled> 
                                                                            </div>
                                                                        @endif 
                                                                        <div class="mb-2 col-md-4">
                                                                            <label>Email</label>
                                                                            <input class="form-control" type="text" value="{{ $item->email }}" disabled>
                                                                        </div>
                                                                        @if($item->email2 != null)
                                                                            <div class="mb-2 col-md-4">
                                                                                <label>Email Opcional</label>
                                                                                <input class="form-control" type="text" value="{{$item->email2}}"disabled> 
                                                                            </div>
                                                                        @endif
                                                                        <div class="mb-2 col-md-4">
                                                                            <label>Centro de Trabajo</label>
                                                                            <input class="form-control" type="text" value="{{ $item->centro_trab }}" disabled>
                                                                        </div>
                                                                        <div class="mb-2 col-md-4">
                                                                            <label>Universidad</label>
                                                                            <input class="form-control" type="text" value="{{ $item->Universidad->universidad }}" disabled>
                                                                        </div>
                                                                        <div class="mb-2 col-md-4">
                                                                            <label>Año de Egreso</label>
                                                                            <input class="form-control" type="text" value="{{ $item->año_egreso }}" disabled>
                                                                        </div>
                                                                        <div class="mb-2 col-md-4">
                                                                            <label>Grado Académico</label>
                                                                            <input class="form-control" type="text" value="{{ $item->GradoAcademico->nom_grado }}" disabled>
                                                                        </div>
                                                                        @if($item->especialidad != null)
                                                                            <div class="mb-2 col-md-4">
                                                                                <label>Especialidad</label>
                                                                                <input class="form-control" type="text" value="{{$item->especialidad}}"disabled> 
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <a type="button" class="btn btn-secondary d-flex justify-content-center align-items-center btn-x1" data-bs-dismiss="modal"> <i class=" ri-close-line me-1 ri-lg"></i>Cerrar</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- Modal Show --}}

                                                <a href="#editModal" type="button" class="link-success fs-15" data-bs-toggle="modal" data-bs-target="#editModal{{$item->idpersona}}"><i class="bx bx-edit bx-sm bx-burst-hover"></i></a>

                                                {{-- Modal Editar --}}
                                                <div class="modal fade" id="editModal{{$item->idpersona}}" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Editar Estudiante</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('Persona.update',$item->idpersona) }}" method="POST">
                                                                    @csrf @method('PUT')
                                                                    <div class="col-sm-12 row g-3">
                                                                        <div class="mb-3 col-md-4">
                                                                            <label for="inputNumDoc" class="form-label">Documento <span class="text-danger">*</span></label>
                                                                            <input type="text" class="form-control" id="inputNumDoc" name="num_doc" maxlength="9" value="{{ $item->num_doc }}" onkeypress="return soloNumeros(event)" pattern="[0-9]{8,9}" required>
                                                                        </div>
                                                                        <div class="mb-3 col-md-4">
                                                                            <label for="inputNombres" class="form-label">Nombres <span class="text-danger">*</span></label>
                                                                            <input type="text" class="form-control" id="inputNombres" name="nombres" maxlength="45" value="{{ $item->nombres }}" onkeypress="return soloLetras(event)" pattern="[a-zA-ZÀ-ÿ ]{2,45}" required>
                                                                        </div>
                                                                        <div class="mb-3 col-md-4">
                                                                            <label for="inputApePater" class="form-label">Apellido Paterno <span class="text-danger">*</span></label>
                                                                            <input type="text" class="form-control" id="inputApePater" name="apell_pater" maxlength="45" value="{{ $item->apell_pater }}" onkeypress="return soloLetras(event)" pattern="[a-zA-ZÀ-ÿ ]{2,45}" required>
                                                                        </div>
                                                                        <div class="mb-3 col-md-4">
                                                                            <label for="inputApeMater" class="form-label">Apellido Materno <span class="text-danger">*</span></label>
                                                                            <input type="text" class="form-control" id="inputApeMater" name="apell_mater" maxlength="45" value="{{ $item->apell_mater }}" onkeypress="return soloLetras(event)" pattern="[a-zA-ZÀ-ÿ ]{2,45}" required>
                                                                        </div>
                                                                        <div class="mb-3 col-md-4">
                                                                            <label for="inputFechaNaci" class="form-label">Fecha de Nacimiento <span class="text-danger">*</span></label>
                                                                            <input type="date" class="form-control" id="inputFechaNaci" name="fecha_naci" value="{{ $item->fecha_naci }}" required>
                                                                        </div>
                                                                        <div class="mb-3 col-md-4">
                                                                            <label for="inputSexo" class="form-label">Sexo <span class="text-danger">*</span></label>
                                                                            <select id="inputSexo" class="form-select" name="sexo" required>
                                                                                <option value="" selected>Seleccione</option>
                                                                                <option value="MASCULINO" {{ $item->sexo == 'MASCULINO' ? 'selected' : '' }}>MASCULINO</option>
                                                                                <option value="FEMENINO" {{ $item->sexo == 'FEMENINO' ? 'selected' : '' }}>FEMENINO</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="mb-3 col-md-4">
                                                                            <label for="inputEstCivil" class="form-label">Estado Civil <span class="text-danger">*</span></label>
                                                                            <select class="form-select" name="est_civil_cod_est" required>
                                                                                <option value="" selected>Seleccione</option>
                                                                                @foreach ($estCivil as $itemestd)
                                                                                    <option value="{{$itemestd->cod_est }}" {{ $itemestd->cod_est == $item->est_civil_cod_est ? 'selected' : '' }}>{{$itemestd->est_civil}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="mb-3 col-md-4">
                                                                            <label for="inputDireccion" class="form-label">Dirección <span class="text-danger">*</span></label>
                                                                            <input type="text" class="form-control" id="inputDireccion" name="direccion" maxlength="45" value="{{ $item->direccion }}" required>
                                                                        </div>
                                                                        @if($item->discapacidad_cod_disc != null)
                                                                            <div class="mb-3 col-md-4">
                                                                                <label for="inputDiscapacidad" class="form-label">Discapacidad</label>
                                                                                <select class="form-select" name="discapacidad_cod_disc">
                                                                                    <option value="" selected>Seleccione</option>
                                                                                    @foreach ($disca as $itemdisca)
                                                                                        <option value="{{$itemdisca->cod_disc }}" {{ $itemdisca->cod_disc == $item->discapacidad_cod_disc ? 'selected' : '' }}>{{$itemdisca->discapacidad}}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        @endif
                                                                        <div class="mb-3 col-md-4">
                                                                            <label for="inputCelular" class="form-label">Celular <span class="text-danger">*</span></label>
                                                                            <input type="text" class="form-control" id="inputCelular" name="celular1" maxlength="9" value="{{ $item->celular1 }}" onkeypress="return soloNumeros(event)" pattern="[0-9]{9}" required>
                                                                        </div>
                                                                        @if ($item->celular2 != null)
                                                                            <div class="mb-3 col-md-4">
                                                                                <label for="inputCelular2" class="form-label">Celular Opcional</label>
                                                                                <input type="text" class="form-control" id="inputCelular2" name="celular2" maxlength="9" value="{{ $item->celular2 }}" onkeypress="return soloNumeros(event)" pattern="[0-9]{9}">
                                                                            </div>
                                                                        @endif
                                                                        <div class="mb-3 col-md-4">
                                                                            <label for="inputEmail" class="form-label">Email <span class="text-danger">*</span></label>
                                                                            <input type="email" class="form-control" id="inputEmail" name="email" value="{{ $item->email }}" required>
                                                                        </div>
                                                                        @if($item->email2 != null)
                                                                            <div class="mb-3 col-md-4">
                                                                                <label for="inputEmail2" class="form-label">Email Opcional</label>
                                                                                <input type="email" class="form-control" id="inputEmail2" name="email2" value="{{ $item->email2 }}">
                                                                            </div>
                                                                        @endif
                                                                        <div class="mb-3 col-md-4">
                                                                            <label for="inputCenTrabajo" class="form-label">Centro de Trabajo <span class="text-danger">*</span></label>
                                                                            <input type="text" class="form-control" id="inputCenTrabajo" name="centro_trab" maxlength="45" value="{{ $item->centro_trab }}" required>
                                                                        </div>
                                                                        <div class="mb-3 col-md-4">
                                                                            <label for="inputUniver" class="form-label">Universidad <span class="text-danger">*</span></label>
                                                                            <select class="form-select" name="univer_cod_uni" required>
                                                                                <option value="" selected>Seleccione</option>
                                                                                @foreach ($uni as $itemuni)
                                                                                    <option value="{{$itemuni->cod_uni }}" {{ $itemuni->cod_uni == $item->univer_cod_uni ? 'selected' : '' }}>{{$itemuni->universidad}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="mb-3 col-md-4">
                                                                            <label for="inputAnioEgreso" class="form-label">Año de Egreso <span class="text-danger">*</span></label>
                                                                            <input type="text" class="form-control" id="inputAnioEgreso" name="año_egreso" maxlength="4" value="{{ $item->año_egreso }}" onkeypress="return soloNumeros(event)" pattern="[0-9]{4}" required>
                                                                        </div>
                                                                        <div class="mb-3 col-md-4">
                                                                            <label for="inputGradoAca" class="form-label">Grado Académico <span class="text-danger">*</span></label>
                                                                            <select class="form-select" name="id_grado_academico" required>
                                                                                <option value="" selected>Seleccione</option>
                                                                                @foreach ($gradoAca as $itemgra)
                                                                                    <option value="{{$itemgra->id_grado_academico }}" {{ $itemgra->id_grado_academico == $item->id_grado_academico ? 'selected' : '' }}>{{$itemgra->nom_grado}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        @if($item->especialidad != null)
                                                                            <div class="mb-3 col-md-4">
                                                                                <label for="inputEspecialidad" class="form-label">Especialidad</label>
                                                                                <input type="text" class="form-control" id="inputEspecialidad" name="especialidad" maxlength="4" value="{{ $item->especialidad }}" onkeypress="return soloLetras(event)" pattern="[a-zA-ZÀ-ÿ ]{2,45}">
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer col-12 d-flex justify-content-between">
                                                                    <a type="button" class="btn btn-secondary d-flex justify-content-center align-items-center btn-x1" data-bs-dismiss="modal"><i class="bx bx-chevron-left me-1 bx-1x"></i>Cancelar</a>
                                                                    <button type="submit" class="btn btn-primary d-flex justify-content-center align-items-center btn-x1">Guardar <i class="bx bx-edit ms-1 ri-1x"></i></button>
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
                        </div>
                    </div>

                    <div class="d-none code-view">
                        <pre class="language-markup" style="height: 275px;"><code>&lt;table class=&quot;table table-nowrap&quot;&gt;
                    </div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        {!! $perso->render() !!}
    </div>
    <!-- end row -->

@endsection