<div>
    <div class="mb-4">
        <span class="fs-2" style="font-weight: 700">
            Buscar Ficha de Inscripción
        </span>
    </div>
    <hr>
    <div class="my-4">
        <form novalidate autocomplete="off" class="px-5" wire:submit.prevent="buscar_ficha">
            <!-- Input with Placeholder -->
            <div>
                <label for="documento_identidad" class="form-label">
                    Número de DNI
                </label>
                <input type="number" class="form-control" id="documento_identidad" placeholder="Ingrese su número de DNI" wire:model="documento_identidad">
            </div>
            <div class="mt-3">
                <!-- Animation Buttons -->
                <button type="submit" class="btn btn-info btn-animation waves-effect waves-light w-100" data-text="Buscar">
                    <span>
                        Buscar
                    </span>
                </button>
            </div>
        </form>
    </div>
    @if ($mostrar_ficha == true)
    <hr>
    <div class="my-4">
        <div class="d-flex justify-content-between align-items-center">
            <span class="fs-2" style="font-weight: 700">
                Ficha de Inscripción
            </span>
            <div>
                <button class="btn btn-danger" wire:click="limpiar">
                    Limpiar
                </button>
            </div>
        </div>
        <div class="mt-3">
            <span class="fw-bold fs-5">Nombres y Apellidos:</span>
            <span class="fs-5">{{ $nombre_completo }}</span>
        </div>
        <div class="mt-3">
            <span class="fw-bold fs-5">Documento de Identidad:</span>
            <span class="fs-5">{{ $documento_identidad }}</span>
        </div>
        <div class="mt-3">
            <span class="fw-bold fs-5">Ficha de Inscripion:</span>
            <embed src="{{ asset($ficha_inscripcion) }}" class="mt-3" type="application/pdf" width="100%" height="800px" />
        </div>
    </div>
    @endif
</div>
