<div>
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="d-flex align-items-center justify-content-end gap-4">
                    <a class="btn btn-primary" href="{{ route('admin.inscripcion.lista') }}">
                        Lista de usuarios
                    </a>
                    <button type="button" wire:click="export()" class="btn btn-success btn-label waves-effect right waves-light w-md"><i class="ri-file-excel-2-line label-icon align-middle fs-16 ms-2"></i>
                        Excel
                    </button>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center gap-4">
                            <select class="form-select w-75" wire:model="filtro_programa">
                                <option value="">Seleccione el programa</option>
                                @foreach ($programas as $item)
                                    <option value="{{ $item->id_mencion }}">
                                        @if ($item->mencion == null)
                                            {{$item->SubPrograma->Programa->descripcion_programa}} EN {{$item->SubPrograma->subprograma}}
                                        @else
                                            MENCION EN {{$item->mencion}}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            <button type="button" wire:click="limpiar_filtro()" class="btn btn-secondary">
                                Limpiar
                            </button>
                        </div>
                        <div class="w-25">
                            <input class="form-control text-muted" type="search" wire:model="search"
                                placeholder="Buscar...">
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle table-nowrap mb-0">
                            <thead>
                                <tr align="center" style="background-color: rgb(179, 197, 245)">
                                    <th scope="col" class="col-md-1">ID</th>
                                    <th scope="col">Documento</th>
                                    <th scope="col">Persona</th>
                                    <th scope="col">Programa</th>
                                    <th scope="col" class="col-md-2">Fecha</th>
                                    <th scope="col" class="col-md-1">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inscripcion as $item)
                                @php
                                    $expediente_seguimiento_count = App\Models\ExpedienteInscripcionSeguimiento::join('ex_insc', 'expediente_inscripcion_seguimiento.cod_ex_insc', '=', 'ex_insc.cod_ex_insc')
                                                ->where('id_inscripcion', $item->id_inscripcion)
                                                ->where('expediente_inscripcion_seguimiento.tipo_seguimiento', 1)
                                                ->where('expediente_inscripcion_seguimiento.expediente_inscripcion_seguimiento_estado', 1)
                                                ->count();
                                @endphp
                                    @if($item->persona_idpersona!=null)
                                        <tr>
                                            <td align="center" class="fw-bold">{{ $item->id_inscripcion }}</td>
                                            <td align="center">{{ $item->persona->num_doc }}</td>
                                            <td>
                                                <div class="d-flex align-items-center gap-3">
                                                    {{ $item->persona->nombre_completo }}
                                                    @if ($expediente_seguimiento_count > 0)
                                                        <i class="ri-information-line text-danger fs-5"></i>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                @if ($item->Mencion->mencion == null)
                                                    {{$item->Mencion->SubPrograma->Programa->descripcion_programa}} EN {{$item->Mencion->SubPrograma->subprograma}}
                                                @else
                                                    MENCION EN {{$item->Mencion->mencion}}
                                                @endif
                                            </td>
                                            <td align="center">
                                                {{date('d/m/Y', strtotime($item->fecha_inscripcion))}}
                                            </td>
                                            <td align="center">
                                                <div class="d-flex justify-content-center align-items-center gap-2">
                                                    <a href="#showModal" class="link-info fs-16" data-bs-toggle="modal" data-bs-target="#showModal{{$item->id_inscripcion}}"><i class="ri-file-text-line"></i></a>
                                                    {{-- Modal Show --}}
                                                    <div wire:ignore.self class="modal fade" id="showModal{{$item->id_inscripcion}}" tabindex="-1" aria-labelledby="showModal" aria-hidden="true">
                                                        <div class="modal-dialog  modal-lg modal-dialog-scrollable">
                                                            <div class="modal-content">
                                                                @php
                                                                    $expediente = App\Models\Expediente::where('estado', 1)
                                                                                    ->where(function($query) use ($item) {
                                                                                        $query->where('expediente_tipo', 0)
                                                                                            ->orWhere('expediente_tipo', $item->tipo_programa);
                                                                                    })
                                                                                    ->get();
                                                                    $expInsc = App\Models\ExpedienteInscripcion::where('id_inscripcion', $item->id_inscripcion)->get();
                                                                    $inscrip = App\Models\Inscripcion::where('id_inscripcion', $item->id_inscripcion)->first();
                                                                    $value = 0;
                                                                @endphp
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="showModalLabel">Expedientes de Inscripción - {{ $item->persona->nombres }} {{$item->persona->apell_pater}} {{$item->persona->apell_mater}}</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="mb-3">
                                                                        <table class="table align-middle table-nowrap mb-0">
                                                                            <thead>
                                                                                <tr class="col-sm-12" style="background-color: rgb(179, 197, 245)" align="center">
                                                                                    <th class="col-md-4">Documento</th>
                                                                                    <th class="col-md-1">Fecha</th>
                                                                                    <th class="col-md-1">Estado</th>
                                                                                    <th class="col-md-1">Archivo</th>
                                                                                </tr>
                                                                            </thead>
                                                                
                                                                            <tbody>
                                                                                @foreach ($expediente as $exp)
                                                                                    @foreach ($expInsc as $expInscripcion)
                                                                                        @if($exp->cod_exp == $expInscripcion->expediente_cod_exp)
                                                                                            <tr>
                                                                                                <td style="white-space: initial">{{$exp->tipo_doc}}</td>
                                                                                                <td align="center">{{date('d/m/Y', strtotime($expInscripcion->fecha_entre))}}</td>
                                                                                                <td align="center" class="text-success"><i class="ri-checkbox-circle-line fs-17 align-middle"></i> {{$expInscripcion->estado}}</td>
                                                                                                <td align="center">
                                                                                                    @php
                                                                                                        $admision = App\Models\Admision::where('estado',1)->first()->admision;
                                                                                                    @endphp
                                                                                                    <a target="_blank" href="{{asset($expInscripcion->nom_exped)}}" class="ms-2"><i style="color:rgb(78, 78, 78)" class="ri-file-download-line bx-sm bx-burst-hover"></i></a>
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
                                                                                            <td align="center"><p class="ms-4">-</p></td>
                                                                                            <td align="center" class="text-danger"><i class="ri-close-circle-line fs-17 align-middle"></i> No enviado</td>
                                                                                            <td align="center"><p class="ms-3">-</p></td>
                                                                                        </tr>
                                                                                    @endif
                                                                                    @php
                                                                                        $value=0;
                                                                                    @endphp
                                                                                @endforeach
                                                                                <tr>
                                                                                    <td>Ficha de inscripción</td>
                                                                                    <td align="center">{{date('d/m/Y', strtotime($inscrip->fecha_inscripcion))}}</td>
                                                                                    <td align="center" class="text-success"><i class="ri-checkbox-circle-line fs-17 align-middle"></i> Generado</td>
                                                                                    <td align="center">
                                                                                        <a target="_blank" href="{{asset($inscrip->inscripcion)}}" class="ms-2"><i style="color:rgb(78, 78, 78)" class="ri-file-download-line bx-sm bx-burst-hover"></i></a>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @php
                                                        $evaluacion = App\Models\Evaluacion::where('inscripcion_id', $item->id_inscripcion)->first();
                                                    @endphp
                                                    <a href="#modalCambiarPrograma" wire:click="cargarInscripcion({{ $item->id_inscripcion }})" class="link-primary fs-16" data-bs-toggle="modal" data-bs-target="#modalCambiarPrograma"><i class="ri-pencil-line"></i></a>
                                                    <a wire:click="cargarAlertaSeguimiento({{ $item->id_inscripcion }})" class="link-danger fs-16" style="cursor: pointer;"><i class="ri-close-circle-line"></i></a>
                                                    @if ($evaluacion == null)
                                                    <a wire:click="reservar_inscripcion({{ $item->id_inscripcion }})" class="link-danger fs-16" style="cursor: pointer;"><i class="ri-file-reduce-line"></i></a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                        @if ($inscripcion->count())
                            <div class="mt-2 d-flex justify-content-end text-muted">
                                {{ $inscripcion->links() }}
                            </div>
                        @elseif ($search != null)
                            <div class="text-center p-3 text-muted">
                                <span>No hay resultados para la busqueda "<strong>{{ $search }}</strong>"</span>
                            </div>
                        @else
                            <div class="text-center p-3 text-muted">
                                <span>No hay resultados</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- modal cambiar programa --}}
    <div wire:ignore.self class="modal fade" id="modalCambiarPrograma" tabindex="-1" aria-labelledby="modalCambiarPrograma" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showModalLabel">Cambiar Programa</h5>
                    <button type="button" wire:click="limpiar()" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form novalidate>
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Programa <span class="text-danger">*</span></label>
                                <select class="form-select @error('programa') is-invalid  @enderror"
                                    wire:model="programa">
                                    <option value="" selected>Seleccione</option>
                                    @if ($programa_model)
                                    @foreach ($programa_model as $item)
                                        <option value="{{ $item->id_programa }}">{{ $item->descripcion_programa }}
                                        </option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="mb-3 col-md-12">
                                <label class="form-label">@if($programa_nombre) {{ $programa_nombre }} @else Esperando Programa... @endif <span class="text-danger">*</span></label>
                                <select class="form-select @error('subprograma') is-invalid  @enderror"
                                    wire:model="subprograma">
                                    <option value="" selected>Seleccione</option>
                                    @if ($subprograma_model)
                                    @foreach ($subprograma_model as $item)
                                        <option value="{{ $item->id_subprograma }}">{{ $item->subprograma }}
                                        </option>
                                    @endforeach
                                    @endif
                                </select>
                                @error('subprograma')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            @if ($subprograma_model)

                            @php
                                $valor = null;
                                if ($mencion_model) {
                                    foreach ($mencion_model as $item){
                                        $valor = $item->mencion;
                                    } 
                                }
                                @endphp

                            @if ($valor)  
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Mención <span class="text-danger">*</span></label>
                                <select class="form-select @error('mencion') is-invalid  @enderror"
                                    wire:model="mencion">
                                    <option value="" selected>Seleccione</option>
                                    @foreach ($mencion_model as $item)
                                        <option value="{{ $item->id_mencion }}">{{ $item->mencion }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('mencion')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>  
                            @endif
                                
                            @endif
                        </div>
                    </form>
                </div>
                <div class="modal-footer col-12 d-flex justify-content-between">
                    <button type="button" wire:click="limpiar()"
                        class="btn btn-secondary btn-label waves-effect waves-light w-md" data-bs-dismiss="modal"><i
                            class="ri-arrow-left-s-line label-icon align-middle fs-16 me-2"></i> Cancelar</button>
                    <button type="button" wire:click="guardarCambioPrograma()"
                        class="btn btn-primary btn-label waves-effect right waves-light w-md"><i
                            class="ri-check-double-fill label-icon align-middle fs-16 ms-2"></i> Guardar</button>
                </div>
            </div>
        </div>
    </div>
    {{-- modal cambiar seguimiento --}}
    {{-- <div wire:ignore.self class="modal fade" id="modalSeguimiento" tabindex="-1" aria-labelledby="modalSeguimiento" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showModalLabel">Cambiar Seguimiento de Expediente</h5>
                    <button type="button" wire:click="limpiar()" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form novalidate>
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Programa <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('programa') is-invalid  @enderror"
                                    wire:model="programa" readonly>
                            </div>
                            
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Programa <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('programa') is-invalid  @enderror"
                                    wire:model="programa" readonly>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer col-12 d-flex justify-content-between">
                    <button type="button" wire:click="limpiar()"
                        class="btn btn-secondary btn-label waves-effect waves-light w-md" data-bs-dismiss="modal"><i
                            class="ri-arrow-left-s-line label-icon align-middle fs-16 me-2"></i> Cancelar</button>
                    <button type="button" wire:click="guardarCambioPrograma()"
                        class="btn btn-primary btn-label waves-effect right waves-light w-md"><i
                            class="ri-check-double-fill label-icon align-middle fs-16 ms-2"></i> Guardar</button>
                </div>
            </div>
        </div>
    </div> --}}
</div>