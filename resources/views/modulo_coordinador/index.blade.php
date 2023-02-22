@extends('coordinador')

@section('content')
<div class="page-title-box d-sm-flex align-items-center justify-content-between">
    <h4 class="mb-sm-0">Dashboard</h4>
    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
        </ol>
    </div>
</div>
@livewire('modulo-coordinador.index')

@endsection

@section('javascript')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.38/dist/sweetalert2.all.min.js"></script>
<script>   
    window.addEventListener('errorInscripcion', event => {
        Swal.fire(
        'No cuenta con inscritos',
        '',
        'error'
        )
    });
</script>
@endsection