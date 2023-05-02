@extends('admin')

@section('content')
    
<div class="page-title-box d-sm-flex align-items-center justify-content-between">
    <h4 class="mb-sm-0">Admitidos</h4>
    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Admitidos</a></li>
            {{-- <li class="breadcrumb-item active">Usuario</li> --}}
        </ol>
    </div>
</div>

@livewire('modulo-administrador.evaluacion.admitidos.index')

@endsection

@section('javascript')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.38/dist/sweetalert2.all.min.js"></script>
<script>
    window.addEventListener('notificacionExcel', event => {
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

    window.addEventListener('alertaCrearConstancia', event => {
        // alert('Name updated to: ' + event.detail.id);
        Swal.fire({
            title: '¿Estás seguro de generar la constancia?',
            text: "",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Generar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emitTo('modulo-administrador.evaluacion.admitidos.index', 'crearConstancia', event.detail.id);
                Swal.fire(
                    'Constancia guardado!',
                    'La constancia de ingreso se generó satisfactoriamente.',
                    'success'
                )
            }
        })
    })

    window.addEventListener('cargarAlertaCodigo', event => {
        // alert('Name updated to: ' + event.detail.id);
        Swal.fire({
            title: '¿Estás seguro de generar los codigos?',
            text: "",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Generar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emitTo('modulo-administrador.evaluacion.admitidos.index', 'generar_codigo');
            }
        })
    })

    window.addEventListener('errorFechaAdmitidos', event => {
        Swal.fire(
            event.detail.mensaje,
            '',
            'error'
        )
    });
    window.addEventListener('notificacion_delete', event => {
        Swal.fire(
            event.detail.message,
            '',
            event.detail.icon
        )
    });
    window.addEventListener('alerta_delete_pago_constancia', event => {
        // alert('Name updated to: ' + event.detail.id);
        Swal.fire({
            title: '¿Estás seguro de eliminar el pago de Constancia de Ingreso?',
            text: "Una vez eliminado no se podrá recuperar la información del pago de la constancia de ingreso y se eliminará la constancia de ingreso generada.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emitTo('modulo-administrador.evaluacion.admitidos.index', 'delete_pago_constancia', event.detail.admitidos_id);
            }
        })
    })
    window.addEventListener('alerta_delete_pago_matricula', event => {
        // alert('Name updated to: ' + event.detail.id);
        Swal.fire({
            title: '¿Estás seguro de eliminar el pago de Matricula?',
            text: "Una vez eliminado no se podrá recuperar la información del pago de la matricula y se eliminará la matricula generada.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emitTo('modulo-administrador.evaluacion.admitidos.index', 'delete_pago_matricula', event.detail.admitidos_id);
            }
        })
    })
</script>
@endsection