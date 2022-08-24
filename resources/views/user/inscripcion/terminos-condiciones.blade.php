@extends ('user')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body f1">
                @if (session('mensaje'))
                    <div class="alert alert-danger mt-1 mb-2">{{ session('mensaje') }}</div>
                @endif
                <form action="{{ route('check') }}" method="post" novalidate>
                    @csrf
                    <div class="card color-fondo">
                        <h5 class="card-header d-flex justify-content-star align-items-center">Recomendación antes de comenzar su inscripción:</h5>
                        <div class="card-body">
                            <h5 class="card-title mb-3 d-flex justify-content-star align-items-center">Por favor, lee determinadamente los siguientes puntos antes de comenzar con tu inscripción.</h5>
                            <p class="card-text d-flex justify-content-star align-items-center text-black-80"><i class="fas fa-comment-dollar me-2"></i>Puedes realizar tu inscripción al día siguiente de haber realizado tu pago.</p>
                            <p class="card-text d-flex justify-content-star align-items-center text-black-80"><i class="fas fa-address-card me-2"></i>Ten a mano tu Documento de Identidad.</p>
                            <p class="card-text d-flex justify-content-star align-items-center text-black-80"><i class="fas fa-info-circle me-2"></i>Proporciona datos fidedignos (auténticos).</p>
                            <p class="card-text d-flex justify-content-star align-items-center text-black-80"><i class="fas fa-info-circle me-2"></i>Se muy cuidadoso al completar cada información solicidad por el Sistema de Inscripción.</p>
                        </div>
                    </div>
                    <div class="card color-fondo2">
                        <h5 class="card-header d-flex justify-content-star align-items-center">Requisitos para realizar su inscripción:</h5>
                        <div class="card-body">
                            <h5 class="card-title mb-3 d-flex justify-content-star align-items-center">Pido a usted, se sirva considerarme como tal, para el cual abjunto los requisitos que se solicitan:</h5>
                            <p class="card-text d-flex justify-content-star align-items-center text-black-80" style="text-align: justify;">- Fotocopia AMPLIADA del Documento de Identidad. En casos de postulantes extranjeros fotocopia legalizada del Carnet de Extranjeria; o fotocopia legalizada con traducción oficial del pasaporte, en caso esté en otro idioma del español.</p>
                            <p class="card-text d-flex justify-content-star align-items-center text-black-80">- Fotocopia de la partida de nacimiento.</p>
                            <p class="card-text d-flex justify-content-star align-items-center text-black-80">- Copia del Grado Académico de Bachiller..</p>
                            <p class="card-text d-flex justify-content-star align-items-center text-black-80" style="text-align: justify;">- Copia del Certificado de Estudios. Para el caso de los graduadosen el extranjero presentar los certificados de estudios debidamente legalizados y traducidos oficialmente al castellano y visados por el Consulado del Perú en dicho país y por el Ministro de Relaciones Exteriores Peruano.</p>
                            <p class="card-text d-flex justify-content-star align-items-center text-black-80">- Recibo de pago por derecho de inscripción (S/. 200.00).</p>
                            <p class="card-text d-flex justify-content-star align-items-center text-black-80">- Tres (03) fotografías recientes de frente, en fondo blanco, tamaño carnet, sin anteojos de luna oscura..</p>
                            <p class="card-text d-flex justify-content-star align-items-center text-black-80">- Certificados de 01 idiomas extranjero nivel básico certificado por el Centro de Idiomas de la UNU.</p>
                            <p class="card-text d-flex justify-content-star align-items-center text-black-80">- Currículum Vitae documentado (de los ultimos 5 años).</p>
                            
                        </div>
                    </div>
                    <p class="card-text d-flex justify-content-star align-items-center"><input type="checkbox" name="check" class="me-2"><span class="fw-bold text-dark">Acepto Terminos y condiciones.</span></p> 

                    <div class="mt-3 d-flex justify-content-end">
                        <button type="submit" class="btn btn-next">Siguiente</button>
                    </div>
                </form>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>
<!-- end row -->

@endsection