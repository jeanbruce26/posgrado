<div>
    @if ($lista_admitidos == 0)
        <div class="alert alert-info alert-dismissible alert-label-icon rounded-label shadow fade show" role="alert">
            <i class="ri-information-line label-icon"></i><strong>Los resultados de admitidos se presentarán cuando culmine el proceso de evaluación de inscripciones.</strong>
        </div>
    @else
        @if ($admitido)
        <div class="alert alert-success alert-solid shadow" role="alert">
            <strong>¡Admitido!</strong>
        </div>
        @else
        <div class="alert alert-danger alert-solid shadow" role="alert">
            <strong>¡No admitido!</strong>
        </div>
        @endif
    @endif
    @if (date('Y/m/d', strtotime($fecha_admision_normal)) >= date('Y/m/d', strtotime(today())))
        @if ($contador != 6)
        <div class="alert alert-warning alert-dismissible alert-label-icon rounded-label shadow fade show" role="alert">
            <i class="ri-alert-line label-icon"></i><strong>Usted tiene expedientes pendientes por subir a la plataforma, por favor complete el formulario debido.</strong>
        </div>
        @endif
        <div class="alert alert-info alert-dismissible alert-label-icon rounded-label shadow fade show" role="alert">
            <i class="ri-information-line label-icon"></i><strong>Recuerde que la fecha limite para actualizar sus expedientes es el {{ $fecha_admision }}.</strong>
        </div>
    @endif

    <div class="mt-4">
        <div class="card">
            <h4 class="card-header d-flex fw-bold justify-content-star align-items-center">Bienvenido {{$nombre}}.</h4>
            
            <div class="card-text px-5 my-2 d-flex justify-content-around row g-3">
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                    <div class="card card-body text-center" style="background-color: #ebf7ff">
                        <div class="avatar-sm mx-auto mb-3">
                            <div class="avatar-title bg-soft-primary text-primary fs-17 rounded">
                                <i class="ri-newspaper-line fs-1"></i>
                            </div>
                        </div>
                        <h4 class="card-title mb-3"><strong>Ficha de Inscripción</strong></h4>
                        <a target="_blank" href="{{asset(auth('usuarios')->user()->inscripcion)}}" class="btn btn-success">Descargar</a>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                    <div class="card card-body" style="background-color: #ebf7ff">
                        <div class="avatar-sm mx-auto mb-3">
                            <div class="avatar-title bg-soft-primary text-primary fs-17 rounded">
                                <i class="ri-folder-5-line fs-1"></i>
                            </div>
                        </div>
                        <h4 class="card-title mb-3 text-center"><strong>Expedientes</strong></h4>
                        <a href="{{route('usuarios.edit')}}" type="button" class="btn btn-success">Ver detalle</a>
                    </div>
                </div>
                @if ($lista_admitidos > 0)
                    @if ($admitido)
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                        <div class="card card-body text-center" style="background-color: #ebf7ff">
                            <div class="avatar-sm mx-auto mb-3">
                                <div class="avatar-title bg-soft-primary text-primary fs-17 rounded">
                                    <i class="ri-newspaper-line fs-1"></i>
                                </div>
                            </div>
                            <h4 class="card-title mb-3"><strong>Constancia de Ingreso</strong></h4>
                            <a target="_blank" href="{{asset($admitido->constancia)}}" class="btn btn-success">Descargar</a>
                        </div>
                    </div>
                    @endif
                @endif  
            </div>
        </div>
        <!-- end tab pane -->
    </div>
    <!-- end tab content -->
</div>