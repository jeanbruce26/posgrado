@extends('admin')

@section('content')
    
<div class="page-title-box d-sm-flex align-items-center justify-content-between">
    <h4 class="mb-sm-0">Usuario</h4>
    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Usuarios</a></li>
            <li class="breadcrumb-item active">Usuario</li>
        </ol>
    </div>
</div>

@livewire('modulo-administrador.usuario.usuario')

@endsection

@section('javascript')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.38/dist/sweetalert2.all.min.js"></script>
<script>
    window.addEventListener('modalUsuario', event => {
        $('#modalUsuario').modal('hide');
    })

    window.addEventListener('notificacionUsuario', event => {
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

    window.addEventListener('alertaConfirmacionUsuario', event => {
        // alert('Name updated to: ' + event.detail.id);
        Swal.fire({
            title: '¿Estás seguro de modificar el estado del usuario?',
            text: "",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Modificar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emitTo('modulo-administrador.usuario.usuario', 'cambiarEstado', event.detail.id);
            }
        })
    })
</script>
@endsection