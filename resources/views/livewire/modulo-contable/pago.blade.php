<div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex justify-content-between align-items-center gap-4"></div>
                        <div class="w-25">
                            <input class="form-control text-muted" type="search" wire:model="search"
                                placeholder="Buscar...">
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-nowrap mb-0">
                            <thead>
                                <tr align="center" style="background-color: rgb(179, 197, 245)">
                                    <th scope="col" class="col-md-1">ID</th>
                                    <th scope="col">Documento</th>
                                    <th scope="col">Número de Operación</th>
                                    <th scope="col">Monto</th>
                                    <th scope="col">Fecha de Pago</th>
                                    <th scope="col">Canal Pago</th>
                                    <th scope="col" class="col-md-1">Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pago as $item)
                                    <tr>
                                        <td align="center" class="fw-bold">{{$item->pago_id}}</td>
                                        <td align="center">{{$item->dni}}</td>
                                        <td align="center">{{$item->nro_operacion}}</td>
                                        <td align="center">S/. {{$item->monto}}</td>
                                        <td align="center">{{date('d/m/Y', strtotime($item->fecha_pago))}}</td>
                                        <td align="center">{{$item->CanalPago->descripcion}}</td>
                                        <td align="center">
                                            @if($item->estado == 1)
                                                <span class="badge bg-warning">Pagado</span>
                                            @elseif ($item->estado == 2)
                                                <span class="badge bg-secondary">Verificado</span>
                                            @elseif ($item->estado == 3)
                                                <span class="badge bg-success">Inscripto</span>
                                            @elseif ($item->estado == 4)
                                                <span class="badge bg-success">Constancia Ingreso</span>
                                            @elseif ($item->estado == 5)
                                                <span class="badge bg-success">Matricula</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if ($pago->count())
                            <div class="mt-2 d-flex justify-content-end text-muted">
                                {{ $pago->links() }}
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