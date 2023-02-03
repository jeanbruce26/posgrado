@extends('coordinador')

@section('content')

@livewire('modulo-coordinador.expediente', ['evaluacion_id' => $id, 'tipo_evaluacion_id' => $tipo])

@endsection

@section('javascript')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.38/dist/sweetalert2.all.min.js"></script>
<script>
    window.addEventListener('cerrar-modal', event => {
        $('#modalNota').modal('hide');
    })

    window.addEventListener('alertaConfirmacionExpediente', event => {
        // alert('Name updated to: ' + event.detail.id);
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Una vez evaluado no se podrá modificar los puntajes.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Evaluar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emitTo('modulo-coordinador.expediente', 'evaluarExpediente');
            }
        })
    })

    window.addEventListener('alertaConfirmacionExpedientePuntaje', event => {
        Swal.fire({
            title: '¿Estás seguro?',
            text: 'El puntaje minimo para aprobar las evaluaciones es tener una sumatoria de ' + event.detail.puntaje + ' puntos.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Continuar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emitTo('modulo-coordinador.expediente', 'evaluarPaso2');
            }
        })
    })

    window.addEventListener('alertaExpediente', event => {
        Swal.fire(
        event.detail.mensaje,
        event.detail.extra,
        event.detail.tipo
        )
    });

    window.addEventListener('notificacionNota', event => {
        // alert('Name updated to: ' + event.detail.message);
        Toastify({
            text: event.detail.message,
            close: true,
            duration: 4000,
            stopOnFocus: true,
            newWindow: true,
            style: {
                background: "#2eb867",
            }
        }).showToast();
    })
</script>
@endsection