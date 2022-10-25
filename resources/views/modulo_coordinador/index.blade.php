@extends('coordinador')

@section('content')

@livewire('modulo-coordinador.index')

@endsection

@section('javascript')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.38/dist/sweetalert2.all.min.js"></script>
<script>   
    window.addEventListener('errorInscripcion', event => {
        Swal.fire(
        'No cuenta con inscripciones para esta Mención',
        '',
        'error'
        )
    });
</script>
@endsection