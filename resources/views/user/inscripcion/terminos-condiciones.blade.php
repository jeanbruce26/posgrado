@extends ('user')

@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Inscripcion</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active">Inscripcion</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body f1">
                <h4 class="card-title mb-4">Inscripcion Escuela de Posgrado</h4>

                @if (session('mensaje'))
                    <div class="alert alert-danger mt-1 mb-1">{{ session('mensaje') }}</div>
                @endif

                <form action="{{ route('check') }}" method="post" novalidate>
                    @csrf
                    <div class="card">
                        <h5 class="card-header d-flex justify-content-star align-items-center">A tener en cuenta:</h5>
                        <div class="card-body">
                            <h5 class="card-title mb-3  d-flex justify-content-star align-items-center">Por favor, lee determinadamente los siguientes puntos antes de comenzar con tu inscripción.</h5>
                            <p class="card-text d-flex justify-content-star align-items-center"><i class="fas fa-comment-dollar me-2"></i>Puedes realizar tu inscripción al día siguiente de haber realizado tu pago.</p>
                            <p class="card-text d-flex justify-content-star align-items-center"><i class="fas fa-address-card me-2"></i>Ten a mano tu Documento de Identidad.</p>
                            <p class="card-text d-flex justify-content-star align-items-center"><i class="fas fa-info-circle me-2"></i>Proporciona datos fidedignos (auténticos).</p>
                            <p class="card-text d-flex justify-content-star align-items-center"><i class="fas fa-info-circle me-2"></i>Se muy cuidadoso al completar cada información solicidad por el Sistema de Inscripción.</p>
                            <p class="card-text d-flex justify-content-star align-items-center"><input type="checkbox" name="check" class="me-2"><span>Acepto Terminos y condiciones.</span></p> 
                        </div>
                    </div>
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