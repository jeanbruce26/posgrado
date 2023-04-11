<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex align-items-center gap-4">
                        <select class="form-select w-75" wire:model="filtro_programa">
                            <option value="0">TODOS LOS PROGRAMAS</option>
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
                        <button type="button" wire:click="limpiar_filtro" class="btn btn-secondary">
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
                                <th scope="col">ID</th>
                                <th scope="col">Documento</th>
                                <th scope="col">Persona</th>
                                <th scope="col">Celular</th>
                                <th scope="col">Codigo Estudiante</th>
                                <th scope="col">Constancia</th>
                                <th scope="col">Ficha Matricula</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($admitidos->count() > 0)
                                @foreach ($admitidos as $item)
                                    <tr>
                                        <td align="center" class="fw-bold">
                                            {{ $item->admitidos_id }}
                                        </td>
                                        <td align="center">
                                            {{ $item->Persona->num_doc }}
                                        </td>
                                        <td>
                                            {{ $item->Persona->nombre_completo }}
                                        </td>
                                        <td align="center">
                                            +51 {{ $item->Persona->celular1 }}
                                        </td>
                                        <td align="center">
                                            {{ $item->admitidos_codigo }}
                                        </td>
                                        <td align="center">
                                            @if ($item->constancia)
                                                <i class="ri-checkbox-circle-line align-middle text-danger fs-3"></i>
                                            @else
                                                ---
                                            @endif
                                        </td>
                                        <td align="center">
                                            @php $matricula = App\Models\MatriculaPago::where('admitidos_id', $item->admitidos_id)->where('ciclo_id',1)->first(); @endphp
                                            @if ($matricula)
                                                @if ($matricula->ficha_matricula)
                                                    <i class="ri-checkbox-circle-line align-middle text-success fs-4"></i>
                                                @else
                                                    ---
                                                @endif
                                            @else
                                                ---
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" align="center">
                                        <span class="text-muted">
                                            No se encontraron resultados
                                        </span>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>