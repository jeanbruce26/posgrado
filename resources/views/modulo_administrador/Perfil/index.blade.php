@extends($tipo)

@section('content')

    @livewire('modulo-administrador.perfil.index')

@endsection

@section('javascript')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.38/dist/sweetalert2.all.min.js"></script>
    <script>
        window.addEventListener('modalPerfil', event => {
            $('#modalPerfil').modal('hide');
        })

        window.addEventListener('notificacionPerfil', event => {
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
