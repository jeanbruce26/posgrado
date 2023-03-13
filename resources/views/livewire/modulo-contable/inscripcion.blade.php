<div>
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="d-flex align-items-center justify-content-end gap-4">
                    <button type="button" wire:click="export_excel()" class="btn btn-success btn-label waves-effect right waves-light w-md me-3">
                        <i class="ri-file-excel-2-line label-icon align-middle fs-16"></i> Excel
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
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle table-nowrap mb-0">
                            <thead>
                                <tr align="center" style="background-color: rgb(179, 197, 245)">
                                    <th scope="col">ID</th>
                                    <th scope="col" class="col-md-3">Apellidos y Nombres</th>
                                    <th scope="col">Documento</th>
                                    <th scope="col">Nro. Operacion</th>
                                    <th scope="col">Monto</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Programa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inscripcion as $item)
                                    @if($item->persona_idpersona!=null)
                                        <tr>
                                            <td align="center" class="fw-bold">
                                                {{ $item->id_inscripcion }}
                                            </td>
                                            <td>
                                                {{ $item->nombre_completo }}
                                            </td>
                                            <td align="center">
                                                {{ $item->num_doc }}
                                            </td>
                                            <td align="center">
                                                {{ $item->nro_operacion }}
                                            </td>
                                            <td align="center">
                                                {{ $item->monto }}
                                            </td>
                                            <td align="center">
                                                {{ date('d/m/Y', strtotime($item->fecha_pago)) }}
                                            </td>
                                            <td style="white-space: initial">
                                                @if ($item->mencion == null)
                                                    {{$item->descripcion_programa}} EN {{$item->subprograma}}
                                                @else
                                                    MENCION EN {{$item->mencion}}
                                                @endif
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
                        @elseif ($inscripcion->count() && $search != '')
                            <div class="text-center p-3 text-muted">
                                <span>No hay resultados para la busqueda "<strong>{{ $search }}</strong>"</span>
                            </div>
                        @elseif ($inscripcion->count() == 0)
                            <div class="text-center p-3 text-muted">
                                <span>No hay registros</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
