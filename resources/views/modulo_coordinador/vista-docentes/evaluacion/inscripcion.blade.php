@extends('coordinador-docente')

@section('content')

@livewire('modulo-coordinador.vista-docente.evaluacion.inscripcion', ['id_mencion' => $id_mencion])

@endsection
@section('javascript')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.38/dist/sweetalert2.all.min.js"></script>
<script>   
    window.addEventListener('errorEntrevista', event => {
        Swal.fire(
        'Le falta completar la Evaluacion de Expediente',
        '',
        'error'
        )
    });

    window.addEventListener('errorEvaluacion', event => {
        Swal.fire(
        event.detail.mensaje,
        '',
        'error'
        )
    });
</script>
@endsection