<div>
    <div class="row">
        <div class="col-sm-12">

            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex justify-content-between align-items-center gap-4">
                            
                        </div>
                        <div class="w-25">
                            <input class="form-control form-control-sm text-muted" type="search" wire:model="search"
                                placeholder="Buscar...">
                        </div>
                    </div>
                    <div class="live-preview">
                        <div class="table-responsive">
                            <table class="table table-hover table-nowrap mb-0">
                                <thead>
                                    <tr align="center" style="background-color: rgb(179, 197, 245)">
                                        <th scope="col" class="col-md-1">ID</th>
                                        <th scope="col" class="col-md-1">Documento</th>
                                        <th scope="col">Nombre Completo</th>
                                        <th scope="col">Fecha de Nacimiento</th>
                                        <th scope="col">Sexo</th>
                                        <th scope="col">Celular</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>

                                {{-- <tbody> --}}
                                <tbody>
                                    @foreach ($personaModel as $item)
                                        <tr>
                                            <td align="center" class="fw-bold">{{$item->idpersona}}</td>
                                            <td align="center">{{$item->num_doc}}</td>
                                            <td>{{$item->nombres}} {{$item->apell_pater}} {{$item->apell_mater}}</td>
                                            <td align="center">{{date('d/m/Y', strtotime($item->fecha_naci))}}</td>
                                            <td align="center">{{$item->sexo}}</td>
                                            <td align="center">{{$item->celular1}}</td>
                                            <td align="center">
                                                <div class="hstack gap-3 flex-wrap justify-content-center">
                                                    <a href="#modalPersona" wire:click="cargarPersona({{ $item->idpersona }})" class="link-info fs-16" data-bs-toggle="modal" data-bs-target="#modalPersona"><i class="ri-eye-2-line"></i></a>
                                                    
                                                    <a href="#modalPersona" wire:click="cargarPersonaUpdate({{ $item->idpersona }})" class="link-success fs-16" data-bs-toggle="modal" data-bs-target="#modalPersona"><i class="ri-edit-2-line"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if ($personaModel->count() == 0)
                                <div class="text-center p-3 text-muted">
                                    <span>No hay resultados para la busqueda "<strong>{{ $search }}</strong>"</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
    </div>

    {{-- Modal Persona --}}
    <div wire:ignore.self class="modal fade" id="modalPersona" tabindex="-1" aria-labelledby="modalPersona" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ $titulo }}</h5>
                    <button type="button" class="btn-close" wire:click="limpiar()" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form novalidate>
                        <div class="col-sm-12 row g-3">
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Documento <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('documento') is-invalid  @enderror" wire:model="documento" readonly>
                                @error('documento')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Nombres <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nombres') is-invalid  @enderror" wire:model="nombres"
                                @if($modo == 1)
                                    readonly
                                @endif>
                                @error('nombres')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Apellido Paterno <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('apellidoPate') is-invalid  @enderror" wire:model="apellidoPate"
                                @if($modo == 1)
                                    readonly
                                @endif>
                                @error('apellidoPate')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Apellido Materno <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('apellidoMate') is-invalid  @enderror" wire:model="apellidoMate" 
                                @if($modo == 1)
                                    readonly
                                @endif>
                                @error('apellidoMate')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Fecha de Nacimiento <span class="text-danger">*</span></label>
                                @if($modo == 1)
                                    <input type="text" class="form-control @error('fechaNacimineto') is-invalid  @enderror" wire:model="fechaNacimineto" readonly>
                                @else
                                    <input type="date" class="form-control @error('fechaNacimineto') is-invalid  @enderror" wire:model="fechaNacimineto">
                                @endif
                                @error('fechaNacimineto')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Sexo <span class="text-danger">*</span></label>
                                @if($modo == 1)
                                    <input type="text" class="form-control @error('sexo') is-invalid  @enderror" wire:model="sexo" readonly>
                                @else
                                    <select class="form-select @error('sexo') is-invalid  @enderror" wire:model="sexo">
                                        <option value="" selected>Seleccione</option>
                                        <option value="MASCULINO">MASCULINO</option>
                                        <option value="FEMENINO">FEMENINO</option>
                                    </select>
                                @endif
                                @error('sexo')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Estado Civil <span class="text-danger">*</span></label>
                                @if($modo == 1)
                                    <input type="text" class="form-control @error('estadoCivil') is-invalid  @enderror" wire:model="estadoCivil" readonly>
                                @else
                                    <select class="form-select @error('estadoCivil') is-invalid  @enderror" wire:model="estadoCivil">
                                        <option value="" selected>Seleccione</option>
                                        @foreach ($estadoCivilModel as $item)
                                            <option value="{{$item->cod_est}}">{{$item->est_civil}}</option>
                                        @endforeach
                                    </select>
                                @endif
                                @error('estadoCivil')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Dirección <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('direccion') is-invalid  @enderror" wire:model="direccion"
                                @if($modo == 1)
                                    readonly
                                @endif>
                                @error('direccion')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            @if ($modo == 1 && $discapacidad != null)
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Discapacidad</label>
                                    <input type="text" class="form-control @error('discapacidad') is-invalid  @enderror" wire:model="discapacidad" readonly>
                                    @error('discapacidad')
                                    <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            @else
                                @if(($modo == 2 && $discapacidad != null))
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">Discapacidad</label>
                                        <select class="form-select @error('discapacidad') is-invalid  @enderror" wire:model="discapacidad">
                                            <option value="" selected>Seleccione</option>
                                            @foreach ($discapacidadModel as $item)
                                                <option value="{{$item->cod_est}}">{{$item->est_civil}}</option>
                                            @endforeach
                                        </select>
                                        @error('discapacidad')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endif
                            @endif
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Celular <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('celular1') is-invalid  @enderror" wire:model="celular1"
                                @if($modo == 1)
                                    readonly
                                @endif>
                                @error('celular1')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            @if (($modo == 1 && $celular2 != null) ||($modo == 2 && $celular2!=null))
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Celular Opcional</label>
                                    <input type="text" class="form-control @error('celular2') is-invalid  @enderror" wire:model="celular2"
                                    @if($modo == 1)
                                        readonly
                                    @endif>
                                    @error('celular2')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endif
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email1') is-invalid  @enderror" wire:model="email1"
                                @if($modo == 1)
                                    readonly
                                @endif>
                                @error('email1')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            @if(($modo == 1 && $email2 != null) || ($modo == 2 && $email2 != null))
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Email Opcional</label>
                                    <input type="email" class="form-control @error('email2') is-invalid  @enderror" wire:model="email2"
                                    @if($modo == 1)
                                        readonly
                                    @endif>
                                    @error('email2')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endif
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Centro de Trabajo <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('centroTrabajo') is-invalid  @enderror" wire:model="centroTrabajo"
                                @if($modo == 1)
                                    readonly
                                @endif>
                                @error('centroTrabajo')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Universidad <span class="text-danger">*</span></label>
                                @if($modo == 1)
                                    <input type="text" class="form-control @error('universidad') is-invalid  @enderror" wire:model="universidad" readonly>
                                @else
                                    <select class="form-select @error('universidad') is-invalid  @enderror" wire:model="universidad">
                                        <option value="" selected>Seleccione</option>
                                        @foreach ($universidadModel as $item)
                                            <option value="{{$item->cod_uni}}">{{$item->universidad}}</option>
                                        @endforeach
                                    </select>
                                @endif
                                @error('universidad')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Año de Egreso <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('anioEgreso') is-invalid  @enderror" wire:model="anioEgreso"
                                @if($modo == 1)
                                    readonly
                                @endif>
                                @error('anioEgreso')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Grado Académico <span class="text-danger">*</span></label>
                                @if($modo == 1)
                                    <input type="text" class="form-control @error('gradoAcademico') is-invalid  @enderror" wire:model="gradoAcademico" readonly>
                                @else
                                    <select class="form-select @error('gradoAcademico') is-invalid  @enderror" wire:model="gradoAcademico">
                                        <option value="" selected>Seleccione</option>
                                        @foreach ($gradoAcademicoModel as $item)
                                            <option value="{{$item->id_grado_academico}}">{{$item->nom_grado}}</option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                            @if(($modo == 1 && $especialidad != null) || ($modo == 2 && $especialidad != null))
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Especialidad</label>
                                    <input type="text" class="form-control @error('especialidad') is-invalid @enderror" wire:model="especialidad"
                                    @if ($modo == 1)
                                        readonly
                                    @endif>
                                </div>
                            @endif
                        </div>
                    </div>
                    @if ($modo != 1)
                        <div class="modal-footer col-12 d-flex justify-content-between">
                            <button type="button" wire:click="limpiar()" class="btn btn-secondary btn-label waves-effect waves-light w-md" data-bs-dismiss="modal"><i class="ri-arrow-left-s-line label-icon align-middle fs-16 me-2"></i> Cancelar</button>

                            <button type="button" wire:click="guardarPersona()" class="btn btn-primary btn-label waves-effect right waves-light w-md"><i class="ri-check-double-fill label-icon align-middle fs-16 ms-2"></i> Actualizar</button>
                        </div>
                    @endif
                </form>
                
            </div>
        </div>
    </div>
    {{-- Modal Persona --}}
</div>
