<div>
    <div class="row">
        <div class="col-xxl-4 col-xl-6 col-lg-6 col-md-12 col-sm-12">
            <div class="card px-4 py-3" style="height: 140px">
                <div class="pt-2 pb-2">
                    <span class="card-title mb-1 fs-3 fw-bold" style="color: rgb(54, 54, 54)">Ingreso Total</span>
                </div>
                <div class="pt-2 pb-2">
                    <span class="fs-2 fw-semibold">S/. {{ number_format($ingreso_total, 2, ',', ' ') }} </span>
                </div>
            </div>
        </div>
        <div class="col-xxl-4 col-xl-6 col-lg-6 col-md-12 col-sm-12">
            <div class="card px-4 py-3" style="height: 140px">
                <div class="pt-2 pb-2">
                    <span class="card-title mb-1 fs-3 fw-bold" style="color: rgb(54, 54, 54)">Ingreso por Inscripciones</span>
                </div>
                <div class="pt-2 pb-2">
                    <span class="fs-2 fw-semibold">S/. {{ number_format($ingreso_inscripcion, 2, ',', ' ') }}</span>
                </div>
            </div>
        </div>
        <div class="col-xxl-4 col-xl-6 col-lg-6 col-md-12 col-sm-12">
            <div class="card px-4 py-3" style="height: 140px">
                <div class="pt-2 pb-2">
                    <span class="card-title mb-1 fs-3 fw-bold" style="color: rgb(54, 54, 54)">Ingreso por Constancia</span>
                </div>
                <div class="pt-2 pb-2">
                    <span class="fs-2 fw-semibold">S/. {{ number_format($ingreso_constancia, 2, ',', ' ') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>