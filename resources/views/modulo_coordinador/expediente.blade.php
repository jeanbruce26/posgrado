@extends('coordinador')

@section('content')

@livewire('modulo-coordinador.expediente', ['evaluacion_id' => $id])

@endsection

@section('javascript')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.38/dist/sweetalert2.all.min.js"></script>
<script>
    window.addEventListener('cerrar-modal', event => {
        $('#modalNota').modal('hide');
    })

    window.addEventListener('alertaConfirmacionExpediente', event => {
        // alert('Name updated to: ' + event.detail.id);
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Una vez evaluado no se podrá modificar las notas.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Evaluar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emitTo('modulo-coordinador.expediente', 'evaluarExpediente');
            }
        })
    })
</script>
@endsection