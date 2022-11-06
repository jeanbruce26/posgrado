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
                    <div class="table-responsive">
                        <table class="table table-hover table-nowrap mb-0">
                            <thead>
                                <tr align="center" style="background-color: rgb(179, 197, 245)">
                                    <th scope="col" class="col-md-1">Código</th>
                                    <th scope="col">Inscripción</th>
                                    <th scope="col" class="col-md-2">Pago</th>
                                    <th scope="col" class="col-md-3">Concepto Pago</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inscripcion_pagos as $item)
                                    <tr>
                                        <td align="center" class="fw-bold">{{$item->inscripcion_pago_id}}</td>
                                        @if($item->persona_idpersona==null)
                                            <td>Documento: {{$item->Pago->dni}} - Alumno No Inscrito</td>
                                        @else
                                            <td>{{ $item->Inscripcion->Persona->apell_pater }} {{ $item->Inscripcion->Persona->apell_mater }}, {{ $item->Inscripcion->Persona->nombres }}</td>
                                        @endif
                                        <td align="center">S/. {{$item->pago->monto}}</td>
                                        <td align="center">{{$item->ConceptoPago->concepto}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if ($inscripcion_pagos->count())
                            <div class="mt-2 d-flex justify-content-end text-muted">
                                {{ $inscripcion_pagos->links() }}
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
