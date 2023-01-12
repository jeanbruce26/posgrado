<div>
    {{-- <div class="card">
        <div class="p-2">
            <a href="{{route('admin.inscripcion.index')}}" type="button" class="btn btn-label w-md waves-effect waves-light fw-bold" style="background: rgb(151, 151, 151); color: white"><i class="ri-arrow-left-s-line label-icon align-middle fs-16 me-2"></i> Regresar</a>
        </div>
    </div> --}}
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex justify-content-between align-items-center gap-4">
                    <a href="{{route('admin.inscripcion.index')}}" type="button" class="btn btn-label w-md waves-effect waves-light fw-bold" style="background: rgb(151, 151, 151); color: white"><i class="ri-arrow-left-s-line label-icon align-middle fs-16 me-2"></i> Regresar</a>
                </div>
                <div class="w-25">
                    <input class="form-control text-muted" type="search" wire:model="search"
                        placeholder="Buscar...">
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-nowrap mb-0">
                    <thead>
                        <tr align="center" style="background-color: rgb(179, 197, 245)">
                            <th scope="col" class="col-md-1">Nro</th>
                            <th scope="col">Documento</th>
                            <th scope="col">Apellidos y Nombres</th>
                            <th scope="col" class="col-md-2">Usuario</th>
                            <th scope="col" class="col-md-2">Contraseña</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($inscripciones as $item)
                            <tr>
                                <td align="center" class="fw-bold">{{$item->id_inscripcion}}</td>
                                <td align="center">{{$item->persona->num_doc}}</td>
                                <td>{{$item->persona->apell_pater}} {{$item->persona->apell_mater}}, {{$item->persona->nombres}}</td>
                                <td align="center">{{$item->persona->num_doc}}</td>
                                <td align="center">{{$item->inscripcion_codigo}}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">No hay registros</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                @if ($inscripciones->count())
                    <div class="mt-2 d-flex justify-content-end text-muted">
                        {{ $inscripciones->links() }}
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
