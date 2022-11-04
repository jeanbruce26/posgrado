@extends ('vista_usuario')

@section('content')

<div class="row">
    <div class="col-8 m-auto">
        @if (session('success'))
            <div class="alert alert-success my-3 alert-dismissible fade show" role="alert">
                <strong>{{ session('success') }}.</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <livewire:modulo_inscripcion.usuario.usuario/>
    </div>
    <!-- end col -->
</div>

@endsection