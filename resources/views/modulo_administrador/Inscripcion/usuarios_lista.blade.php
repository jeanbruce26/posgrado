@extends('admin')

@section('css')

@endsection

@section('content')

<div class="page-title-box d-sm-flex align-items-center justify-content-between">
    <h4 class="mb-sm-0">Lista de Usuarios</h4>
    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.inscripcion.index') }}">Inscripción</a></li>
            <li class="breadcrumb-item active">Lista de usuarios</li>
        </ol>
    </div>
</div>

@livewire('modulo-administrador.inscripcion.lista')

@endsection

@section('javascript')

@endsection