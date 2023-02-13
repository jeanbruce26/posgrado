@extends('coordinador')

@section('content')

@livewire('modulo-coordinador.investigacion', ['evaluacion_id' => $id, 'tipo_evaluacion_id' => $tipo])

@endsection

@section('javascript')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.38/dist/sweetalert2.all.min.js"></script>
<script>
    window.addEventListener('cerrarModal', event => {
        var modal = event.detail.modal;
        $(modal).modal('hide');
    })

    window.addEventListener('alertaConfirmacionInvestigacion', event => {
        // alert('Name updated to: ' + event.detail.id);
        Swal.fire({
            title: event.detail.titulo,
            text: event.detail.mensaje,
            icon: event.detail.icon,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: event.detail.button,
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emitTo('modulo-coordinador.investigacion', event.detail.metodo);
            }
        })
    })

    window.addEventListener('alertaInvestigacion', event => {
        Swal.fire(
        event.detail.mensaje,
        event.detail.extra,
        event.detail.tipo
        )
    });
    
    window.addEventListener('notificacionPuntaje', event => {
        // alert('Name updated to: ' + event.detail.message);
        // color success = #2eb867
        Toastify({
            text: event.detail.message,
            close: true,
            duration: 4000,
            stopOnFocus: true,
            newWindow: true,
            style: {
                background: event.detail.color,
            }
        }).showToast();
    })
</script>
@endsection