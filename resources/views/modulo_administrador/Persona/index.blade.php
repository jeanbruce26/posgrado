@extends('admin')

@section('content')

    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
        <h4 class="mb-sm-0">Estudiante</h4>
        <div class="page-title-right">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);">CRUD</a></li>
                <li class="breadcrumb-item active">Estudiante</li>
            </ol>
        </div>
    </div>

    @livewire('modulo-administrador.persona.index')

@endsection

@section('javascript')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.38/dist/sweetalert2.all.min.js"></script>
    <script>

    window.addEventListener('modalPersona', event => {
        $('#modalPersona').modal('hide');
    })

    window.addEventListener('notificacionEstudiante', event => {
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
    </script>
@endsection