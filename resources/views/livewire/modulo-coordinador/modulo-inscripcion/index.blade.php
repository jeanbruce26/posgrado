<div>
    <div class="row">
        @foreach ($programas as $item)
        <div class="col-xxl-4 col-lg-6">
            <div class="card card-body text-center p-4">
                <h4 class="card-title fs-4 text-uppercase fw-bold mb-4">
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
        @endforeach
    </div>
</div>
