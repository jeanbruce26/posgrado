<div>
    <div class="row">
        @foreach ($programas as $item)
        @php
            $inscritos = App\Models\Inscripcion::where('id_mencion', $item->id_mencion)->count();
        @endphp
        <div class="col-xxl-4 col-lg-6">
            <div style="height: 160px" class="card bg-light mb-4">
                <div class="h-100 p-4 d-flex flex-column justify-content-center aling-items-between">
                    <h4 class="card-title fs-5 text-uppercase text-center fw-bold mb-2">
                        @if ($item->mencion === null)
                            {{ $item->descripcion_programa }} EN {{ $item->subprograma }}
                        @else
                            MENCION EN {{ $item->mencion }}
                        @endif
                    </h4>
                    <span class="text-center fs-4 fw-bold mb-3" style="color: #3b3b3b">
                        {{ $inscritos }}
                    </span>
                    <a href="{{ route('coordinador.modulo-inscripcion.index', $item->id_mencion) }}" class="btn btn-secondary fw-bold text-uppercase">
                        Ingresar
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
