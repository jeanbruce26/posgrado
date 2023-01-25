@extends ('vista_inscripcion')

@section('content')

@livewire('modulo_inscripcion.inscripcion.pagos')

@endsection

@section('javascript')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.38/dist/sweetalert2.all.min.js"></script>
<script>
    window.addEventListener('confirmacion-pago', event => {
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
                Livewire.emitTo('modulo_inscripcion.inscripcion.pagos', 'guardarPago');
                Swal.fire(
                    'Pago guardado!',
                    'Su pago fue guardado satisfactoriamente.',
                    'success'
                )
            }
        })
    })

    window.addEventListener('alerta-error-pago', event => {
        Swal.fire(
        event.detail.mensaje,
        '',
        'error'
        )
    });
</script>
@endsection