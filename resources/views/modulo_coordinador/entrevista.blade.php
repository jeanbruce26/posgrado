@extends('coordinador')

@section('content')

@livewire('modulo-coordinador.entrevista', ['evaluacion_id' => $id, 'tipo_evaluacion_id' => $tipo])

@endsection

@section('javascript')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.38/dist/sweetalert2.all.min.js"></script>
<script>
    window.addEventListener('cerrar-modal', event => {
        $('#modalNota').modal('hide');
    })

    window.addEventListener('alertaConfirmacionEntrevista', event => {
        // alert('Name updated to: ' + event.detail.id);
        Swal.fire({
            title: event.detail.titulo,
            // text: "Una vez evaluado no se podrá modificar las notas.",
            text: event.detail.mensaje,
            icon: event.detail.icon,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: event.detail.button,
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emitTo('modulo-coordinador.entrevista', event.detail.metodo);
            }
        })
    })

    window.addEventListener('alertaEntrevista', event => {
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