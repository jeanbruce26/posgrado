@extends('admin')

@section('css')
@endsection

@section('content')
<div class="page-title-box d-sm-flex align-items-center justify-content-between">
    <h4 class="mb-sm-0">Sede</h4>
    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Gestion Curricular</a></li>       
            <li class="breadcrumb-item active">Sede </li>
        </ol>
    </div>
</div>

@livewire('modulo-administrador.gestion-curricular.sede.index')

@endsection

@section('javascript')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.38/dist/sweetalert2.all.min.js"></script>
<script>
    window.addEventListener('modalSede', event => {
        $('#modalSede').modal('hide');
    })

    window.addEventListener('alertaEstadoSede', event => {
        Swal.fire({
            title: event.detail.message,
            text: "",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Modificar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emitTo('modulo-administrador.gestion-curricular.sede.index', 'cambiarEstado', event.detail.sede_id);
            }
        })
    })

    window.addEventListener('notificacionSede', event => {
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
</script>
@endsection