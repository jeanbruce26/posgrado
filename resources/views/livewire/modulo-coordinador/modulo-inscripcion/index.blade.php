<div>
    <div class="row">
        @foreach ($programas as $item)
        <div class="col-xxl-4 col-lg-6">
            <div style="height: 150px" class="card bg-light mb-4">
                <div class="h-100 p-4 d-flex flex-column justify-content-center aling-items-between">
                    <h4 class="card-title fs-5 text-uppercase text-center fw-bold mb-4">
                        @if ($item->mencion === null)
                            {{ $item->descripcion_programa }} EN {{ $item->subprograma }}
                        @else
                            MENCION EN {{ $item->mencion }}
                        @endif
                    </h4>
                    <a href="{{ route('coordinador.modulo-inscripcion.index', $item->id_mencion) }}" class="btn btn-secondary fw-bold text-uppercase">
                        Ingresar
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
