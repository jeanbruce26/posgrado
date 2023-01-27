@extends ('vista_usuario')

@section('content')

<div class="row">
    <div class="col-xxl-10 col-xl-10 col-lg-12 col-md-12 m-auto">
        
        <livewire:modulo-inscripcion.usuario.pagos/>
    
    </div>
    <!-- end col -->
</div>

@endsection

@section('javascript')
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        window.addEventListener('confirmacion-pago-usuario', event => {
            Swal.fire({
                title: '¿Confirmación de pago?',
                text: "Una vez realizado el pago, ya no podrá utilizarlo ni solicitar reembolso.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Registrar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Pago guardado!',
                        'Su pago fue guardado satisfactoriamente.',
                        'success'
                    )
                    Livewire.emitTo('modulo-inscripcion.usuario.pagos', 'guardarPago');
                }
            })
        })

        window.addEventListener('alerta-error-pago', event => {
            Swal.fire(
            event.detail.mensaje,
            '',
            event.detail.tipo
            )
        });
    </script>
@endsection