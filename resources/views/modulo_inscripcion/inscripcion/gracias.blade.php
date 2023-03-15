@extends ('vista_inscripcion')

@section('content')

@livewire('modulo-inscripcion.inscripcion.gracias', ['inscripcion' => $inscripcion])
@endsection

@section('javascript')

@endsection