@extends('coordinador')

@section('content')

@livewire('modulo-coordinador.inscripciones', ['id_mencion' => $id])

@endsection

