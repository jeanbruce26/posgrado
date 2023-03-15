<div class="row">
    <div class="col-lg-10 m-auto">
        <div class="mt-5 mb-3">
            <span class="fw-bold" style="font-size: 2.5rem">
                Gracias por su inscripción
            </span>
        </div>
        <div class="mt-2 mb-3">
            <span class="fs-3 text-muted">
                Sus datos han sido registrados correctamente, aqui le mostramos su ficha de inscripción.
            </span>
        </div>
        <hr>
    </div>
    <div class="col-lg-10 m-auto">
        <div class="d-flex justify-content-end alig-items-center mt-2 mb-3">
            <a href="{{ asset($inscripcion->inscripcion) }}" download class="btn btn-info d-flex alig-items-center">
                <i class="ri ri-download-line me-2"></i>
                Descargar ficha de inscripción
            </a>
        </div>
    </div>
    <div class="col-lg-10 m-auto">
        <embed src="{{ asset($inscripcion->inscripcion) }}" type="application/pdf" width="100%" height="700px" />
    </div>
</div>