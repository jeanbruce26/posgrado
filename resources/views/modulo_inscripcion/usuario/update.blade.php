@extends ('vista_usuario')

@section('content')

<div class="row">
    <div class="col-10 m-auto">
        
        <livewire:modulo_inscripcion.usuario.usuario-update/>
    
    </div>
    <!-- end col -->
</div>

@endsection

@section('javascript')
    <script>
        window.addEventListener('userStore', event => {
            $('#addModal').modal('hide');
        })

        window.addEventListener('userEdit', event => {
            $('#editModal').modal('hide');
        })

        window.addEventListener('notificacionExpe', event => {
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