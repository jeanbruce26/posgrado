<div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-end align-items-center mb-3">
                        <div class="d-flex justify-content-between align-items-center gap-4">
                            <button type="button" wire:click="export_excel()" class="btn btn-success btn-label waves-effect right waves-light w-md me-3">
                                <i class="ri-file-excel-2-line label-icon align-middle fs-16 ms-2"></i> Excel
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
                                    <th scope="col">ID</th>
                                    <th scope="col" class="col-md-3">Apellidos y Nombres</th>
                                    <th scope="col">Documento</th>
                                    <th scope="col">Fecha de Inscripción</th>
                                    <th scope="col">Celular</th>
                                    <th scope="col">Correo Electrónico</th>
                                    <th scope="col">Nro. Operacion</th>
                                    <th scope="col">Monto</th>
                                    <th scope="col">Fecha de Pago</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inscripciones_pagos as $item)
                                    @if($item->persona_idpersona!=null)
                                        <tr>
                                            <td align="center" class="fw-bold">
                                                {{ $item->id_inscripcion }}
                                            </td>
                                            <td style="white-space: initial">
                                                {{ $item->nombre_completo }}
                                            </td>
                                            <td align="center">
                                                {{ $item->num_doc }}
                                            </td>
                                            <td align="center">
                                                {{ date('d/m/Y', strtotime($item->fecha_inscripcion)) }}
                                            </td>
                                            <td align="center">
                                                +51 {{ $item->celular1 }}
                                                @if ($item->celular2)
                                                    <br>
                                                    +51 {{ $item->celular2 }}
                                                @endif
                                            </td>
                                            <td>
                                                {{ $item->email }}
                                                @if ($item->email2)
                                                    <br>
                                                    {{ $item->email2 }}
                                                @endif
                                            </td>
                                            <td align="center">
                                                {{ $item->nro_operacion }}
                                            </td>
                                            <td align="center">
                                                S/. {{ $item->monto }}
                                            </td>
                                            <td align="center">
                                                {{ date('d/m/Y', strtotime($item->fecha_pago)) }}
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                        @if ($inscripciones_pagos->count() == 0 && $search != null)
                            <div class="text-center p-3 text-muted">
                                <span>No hay resultados para la busqueda "<strong>{{ $search }}</strong>"</span>
                            </div>
                        @elseif ($inscripciones_pagos->count() == 0 && $search == null)
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
