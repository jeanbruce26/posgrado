<div>
    <div class="row">
        <div class="col-sm-12">
            @if ($mostrar_alerta == 1)
                <div class="alert alert-warning alert-dismissible alert-label-icon rounded-label shadow fade show" role="alert">
                    <i class="ri-alert-line label-icon"></i><strong>Hay personas admitidas por generar su codigo</strong>
                </div>
            @endif
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <div wire:loading>
                        <div class="spinner-border text-success" role="status">
                            <span class="sr-only">Loading...</span>
                        </div> 
                    </div>
                </div>
                <div>
                    <button type="button" wire:click="export()" class="btn btn-success btn-label waves-effect right waves-light w-md me-3"><i class="ri-file-excel-2-line label-icon align-middle fs-16 ms-2"></i> Excel</button>
                    <button type="button" wire:click="cargarAlertaCodigo()" class="btn btn-primary btn-label waves-effect right waves-light w-md" @if ($mostrar_alerta == 0) disabled @endif><i class="ri-add-line label-icon align-middle fs-16 ms-2"></i> Generar codigo de admitidos</button>
                </div>
            </div>
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
                                    <th scope="col" class="">ID</th>
                                    <th scope="col" class="col-md-2">Codigo</th>
                                    <th scope="col" class="col-md-3">Apellidos y Nombres</th>
                                    <th scope="col" class="col-md-2">Documento</th>
                                    <th scope="col" class="col-md-1">Estado</th>
                                    <th scope="col" class="col-md-2">Codigo Constancia</th>
                                    <th scope="col" class="col-md-1">Constancia</th>
                                    <th scope="col" class="col-md-1">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($admitidos_model->count() == 0)
                                    <tr>
                                        <td colspan="8" align="center" class="text-muted">No hay registros, por favor genere los codigos de admitidos.</td>
                                    </tr>
                                @else
                                    @foreach ($admitidos_model as $item)
                                    <tr>
                                        <td align="center" class="fw-bold">{{$item->admitidos_id}}</td>
                                        <td align="center">{{ $item->admitidos_codigo }}</td>
                                        <td align="">{{ $item->apell_pater }} {{ $item->apell_mater }}, {{ $item->nombres }}</td>
                                        <td align="center">{{ $item->num_doc }}</td>
                                        <td align="center"><span class="badge text-bg-primary">Admitido</span></td>
                                        <td align="center">
                                            @if ($item->constancia_codigo == null)
                                                -                                                
                                            @else
                                                {{ $item->constancia_codigo }}
                                            @endif
                                        </td>
                                        <td align="center">
                                            @if ($item->constancia == null)
                                                -
                                            @else
                                                <a href="{{ asset($item->constancia) }}" target="_blank" class="link-success fs-16"><i class="ri-file-text-line"></i></a>
                                            @endif
                                        </td>
                                        <td align="center">
                                            @if ($item->constancia)
                                                -
                                            @else
                                                <a wire:click="cargarAlertaCrearConstancia({{ $item->admitidos_id }})"  class="link-secondary fs-16" style="cursor: pointer" ><i class="ri-file-add-line"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>