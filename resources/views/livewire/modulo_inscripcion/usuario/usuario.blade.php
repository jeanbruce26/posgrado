<div>
    @if (date('Y/m/d', strtotime($fecha_admision)) >= date('Y/m/d', strtotime(today())))
        {{-- <h5 class="d-flex justify-content-star align-items-center mt-2">Usted tiene expedientes pendientes por subir a la plataforma, por favor<a href="{{route('usuarios.create')}}" class="mx-2 fw-bold" hover="text-decor"> presione aquí </a>para ingresar.</h5> --}}
        @if ($contador != 6)
        <div class="alert alert-warning mb-3 fw-bold">Usted tiene expedientes pendientes por subir a la plataforma, por favor complete el formulario debido.</div>
        @endif
        <div class="alert alert-info mb-3 fw-bold">Recuerde que la fecha limite para actualizar sus expedientes es el ({{date('d/m/Y', strtotime($fecha_admision))}}).</div>
    @endif
    <div class="tab-content">
        <div class="tab-pane fade show active">
            <div class="card">
                <h4 class="card-header d-flex fw-bold justify-content-star align-items-center">Bienvenido {{$nombre}}.</h4>
                
                <div class="card-text px-5 my-2 d-flex justify-content-around row g-3">
                    <div class="col-1"></div>
                    <div class="col-4">
                        <div class="card card-body text-center" style="background-color: #ebf7ff">
                            <div class="avatar-sm mx-auto mb-3">
                                <div class="avatar-title bg-soft-primary text-primary fs-17 rounded">
                                    <i class="ri-newspaper-line fs-1"></i>
                                </div>
                            </div>
                            <h4 class="card-title mb-3"><strong>Ficha de Inscripción</strong></h4>
                            <a target="_blank" href="{{asset('Admision 2022 - I/'.auth('usuarios')->user()->id_inscripcion.'/'.auth('usuarios')->user()->inscripcion)}}" class="btn btn-success">Descargar</a>
                        </div>
                    </div>
                    <div class="col-4">
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
                    <div class="col-1"></div>
                </div> 
            </div>
        </div>
        <!-- end tab pane -->
    </div>
    <!-- end tab content -->
</div>