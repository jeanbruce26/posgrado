@extends('contable')

@section('content')
    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
        <h4 class="mb-sm-0">Pago</h4>
        <div class="page-title-right">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                <li class="breadcrumb-item active">Pago</li>
            </ol>
        </div>
    </div>

    @livewire('modulo-contable.pago')

@endsection

@section('javascript')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.38/dist/sweetalert2.all.min.js"></script>
<script>
    window.addEventListener('modalPago', event => {
        $('#modalPago').modal('hide');
    })

    window.addEventListener('alertaPago', event => {
        Swal.fire(
        event.detail.titulo,
        event.detail.subtitulo,
        event.detail.icon
        )
    });

    window.addEventListener('notificacionPago', event => {
        Toastify({
            text: event.detail.message,
            close: true,
            duration: 5000,
            stopOnFocus: true,
            newWindow: true,
            style: {
                background: event.detail.color,
            }
        }).showToast();
    })

    window.addEventListener('deletePago', event => {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡Una vez eliminado no habrá vuelta atras!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, eliminar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emitTo('modulo-administrador.pago.index', 'deletePago', event.detail.id);
                Swal.fire(
                    'Eliminado!',
                    'El coordinador ha sido eliminado.',
                    'success'
                )
            }
        })
    })
</script>
@endsection