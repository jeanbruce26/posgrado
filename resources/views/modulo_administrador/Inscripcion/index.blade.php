@extends('admin')

@section('css')

@endsection

@section('content')

<div class="page-title-box d-sm-flex align-items-center justify-content-between">
    <h4 class="mb-sm-0">Inscripción</h4>
    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Inscripción</a></li>
            <li class="breadcrumb-item active">Inscripción</li>
        </ol>
    </div>
</div>

@livewire('modulo-administrador.inscripcion.index')

@endsection

@section('javascript')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.38/dist/sweetalert2.all.min.js"></script>
<script>
    window.addEventListener('modalCambiarPrograma', event => {
        $('#modalCambiarPrograma').modal('hide');
    })
    window.addEventListener('alertaCambioPrograma', event => {
        // alert('Name updated to: ' + event.detail.id);
        Swal.fire({
            title: '¿Estás seguro de cambiar el programa del inscrito?',
            text: "",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Modificar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emitTo('modulo-administrador.inscripcion.index', 'cambiarPrograma');
            }
        })
    })
    window.addEventListener('alertaSeguimiento', event => {
        // alert('Name updated to: ' + event.detail.id);
        Swal.fire({
            title: '¿Estás seguro de asignar/quitar el seguimiento de expediente de esta inscripción?',
            text: "",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Modificar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emitTo('modulo-administrador.inscripcion.index', 'cambiarSeguimiento');
            }
        })
    })
    window.addEventListener('alertaSuccess', event => {
        Swal.fire(
            event.detail.titulo,
            event.detail.mensaje,
            'success'
        )
    });
    window.addEventListener('alertaError', event => {
        Swal.fire(
            event.detail.titulo,
            event.detail.mensaje,
            'error'
        )
    });
    window.addEventListener('notificacionInscripcion', event => {
        Toastify({
            text: event.detail.message,
            close: true,
            duration: 5000,
            stopOnFocus: true,
            newWindow: true,
            style: {
                background:  event.detail.color,
            }
        }).showToast();
    })
    window.addEventListener('alertaReserva', event => {
        // alert('Name updated to: ' + event.detail.id);
        Swal.fire({
            title: event.detail.titulo,
            text: event.detail.mensaje,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Reservar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emitTo('modulo-administrador.inscripcion.index', 'reservarPago', event.detail.id_inscripcion);
            }
        })
    })
    window.addEventListener('alertaDelete', event => {
        // alert('Name updated to: ' + event.detail.id);
        Swal.fire({
            title: event.detail.titulo,
            text: event.detail.mensaje,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emitTo('modulo-administrador.inscripcion.index', 'delete_inscripcion', event.detail.id_inscripcion);
            }
        })
    })
</script>
@endsection