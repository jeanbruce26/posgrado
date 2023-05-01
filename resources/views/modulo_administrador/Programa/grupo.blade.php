@extends('admin')

@section('css')
@endsection

@section('content')
<div class="page-title-box d-sm-flex align-items-center justify-content-between">
    <h4 class="mb-sm-0">Grupos - {{ $titulo }}</h4>
    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.programa.index') }}">Programa</a></li>       
            <li class="breadcrumb-item active">Grupos </li>
        </ol>
    </div>
</div>

@livewire('modulo-administrador.gestion-curricular.programa.grupo', ['mencion_id' => $mencion_id])

@endsection

@section('javascript')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.38/dist/sweetalert2.all.min.js"></script>
<script>
    window.addEventListener('modalGrupo', event => {
        $('#modalGrupo').modal('hide');
    })

    window.addEventListener('notificacionGrupo', event => {
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

    window.addEventListener('alertaConfirmacionCurso', event => {
        // alert('Name updated to: ' + event.detail.id);
        Swal.fire({
            title: '¿Estás seguro de modificar el estado del curso?',
            text: "",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Modificar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emitTo('modulo-administrador.gestion-curricular.programa.curso', 'cambiarEstado', event.detail.id);
            }
        })
    })
</script>
@endsection