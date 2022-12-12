@extends ('vista_inscripcion')

@section('content')
<div class="row">
    <div class="col-10 m-auto">
        <div class="card">
            <div class="card-body form-steps">
                <div class="tab-content">
                    <div class="tab-pane fade show active">
                        <h5 class="card-header fw-bold">Mis pagos realizados</h5>

                        @livewire('modulo_inscripcion.inscripcion.pagos')
                        
                    </div>
                    <!-- end tab pane -->
                </div>
                <!-- end tab content -->
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>
@endsection

@section('javascript')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.38/dist/sweetalert2.all.min.js"></script>
<script>
    window.addEventListener('confirmacion-pago', event => {
        Swal.fire({
            title: '¿Confirmación de pago?',
            text: "Una vez realizado el pago, no habrá vuelta atras.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Pagar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emitTo('modulo_inscripcion.inscripcion.pagos', 'guardarPago');
                Swal.fire(
                    'Pago guardado!',
                    'Su pago fue guardado satisfactoriamente.',
                    'success'
                )
            }
        })
    })
</script>
@endsection