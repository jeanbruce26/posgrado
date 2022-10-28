@extends('coordinador')

@section('content')

@livewire('modulo-coordinador.entrevista', ['evaluacion_id' => $id])

@endsection

@section('javascript')
{{-- <script>
    window.addEventListener('cerrar-modal', event => {
        $('#modalNota').modal('hide');
    })
</script> --}}
@endsection