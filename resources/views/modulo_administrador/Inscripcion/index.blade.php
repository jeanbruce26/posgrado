@extends('admin')

@section('css')

@endsection

@section('content')

<div class="page-title-box d-sm-flex align-items-center justify-content-between">
    <h4 class="mb-sm-0">Inscripción</h4>
    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Inscripción</a></li>
            <li class="breadcrumb-item active">Inscripción</li>
        </ol>
    </div>
</div>

@livewire('modulo-administrador.inscripcion.index')

@endsection

@section('javascript')

@endsection