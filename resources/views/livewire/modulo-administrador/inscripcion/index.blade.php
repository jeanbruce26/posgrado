<div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex justify-content-between align-items-center gap-4">
                            <a class="btn btn-primary" href="{{ route('admin.inscripcion.lista') }}">
                                Lista de usuarios
                            </a>
                        </div>
                        <div class="w-25">
                            <input class="form-control form-control-sm text-muted" type="search" wire:model="search"
                                placeholder="Buscar...">
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-nowrap mb-0">
                            <thead>
                                <tr align="center" style="background-color: rgb(179, 197, 245)">
                                    <th scope="col" class="col-md-1">ID</th>
                                    <th scope="col">Documento</th>
                                    <th scope="col">Persona</th>
                                    <th scope="col">Programa</th>
                                    <th scope="col" class="col-md-1">Expedientes</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inscripcion as $item)
                                    @if($item->persona_idpersona!=null)
                                        <tr>
                                            <td align="center" class="fw-bold">{{$item->id_inscripcion}}</td>
                                            <td align="center">{{$item->persona->num_doc}}</td>
                                            <td>{{$item->persona->apell_pater}} {{$item->persona->apell_mater}}, {{$item->persona->nombres}}</td>
                                            <td>
                                                @if ($item->Mencion->mencion == null)
                                                    {{$item->Mencion->SubPrograma->Programa->descripcion_programa}} EN {{$item->Mencion->SubPrograma->subprograma}}
                                                @else
                                                    {{$item->Mencion->SubPrograma->Programa->descripcion_programa}} EN {{$item->Mencion->SubPrograma->subprograma}} <br>
                                                    CON MENCION EN {{$item->Mencion->mencion}}
                                                @endif
                                            </td>
                                            <td align="center">
                                                <a href="#showModal" class="link-info fs-16" data-bs-toggle="modal" data-bs-target="#showModal{{$item->id_inscripcion}}"><i class="ri-file-text-line"></i></a>

                                                {{-- Modal Show --}}
                                                <div wire:ignore.self class="modal fade" id="showModal{{$item->id_inscripcion}}" tabindex="-1" aria-labelledby="showModal" aria-hidden="true">
                                                    <div class="modal-dialog  modal-lg modal-dialog-scrollable">
                                                        <div class="modal-content">
                                                            @php
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
                                                                                            <td>{{$exp->tipo_doc}}</td>
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
                        @else
                            <div class="text-center p-3 text-muted">
                                <span>No hay resultados para la busqueda "<strong>{{ $search }}</strong>"</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
