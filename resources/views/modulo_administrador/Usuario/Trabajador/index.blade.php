@extends('admin')

@section('content')
    
    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
        <h4 class="mb-sm-0">Trabajador</h4>
        <div class="page-title-right">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);">Usuarios</a></li>
                <li class="breadcrumb-item active">Trabajador</li>
            </ol>
        </div>
    </div>

    @livewire('modulo-administrador.usuario.trabajador')

@endsection

@section('javascript')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.38/dist/sweetalert2.all.min.js"></script>
<script>
    //TRABAJADOR
    window.addEventListener('modalTrabajador', event => {
        $('#modalTra').modal('hide');
    })

    window.addEventListener('notificacionTrabajador', event => {
        Toastify({
            text: event.detail.message,
            close: true,
            duration: 5000,
            stopOnFocus: true,
            newWindow: true,
            style: {
                background: "#2eb867",
            }
        }).showToast();
    })

    //ASIGANAR TRABAJADOR
    window.addEventListener('modalAsignar', event => {
        $('#modalAsignar').modal('hide');
    })

    window.addEventListener('notificacionAsignar', event => {
        Toastify({
            text: event.detail.message,
            close: true,
            duration: 5000,
            stopOnFocus: true,
            newWindow: true,
            style: {
                background: "#2eb867",
            }
        }).showToast();
    })

    // window.addEventListener('delete', event => {
    //     // alert('Name updated to: ' + event.detail.id);
    //     Swal.fire({
    //         title: 'Estas seguro?',
    //         text: "Una vez eliminado no habrá vuelta atras!",
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         confirmButtonText: 'Si, eliminar!',
    //         cancelButtonText: 'Cancelar'
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             Livewire.emitTo('modulo-administrador.usuario.coordinador', 'deleteCoordinador', event.detail.id);
    //             Swal.fire(
    //                 'Eliminado!',
    //                 'El coordinador ha sido eliminado.',
    //                 'success'
    //             )
    //         }
    //     })
    // })
</script>
@endsection