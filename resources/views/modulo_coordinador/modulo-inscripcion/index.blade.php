@extends('coordinador')

@section('content')
<div class="page-title-box d-sm-flex align-items-center justify-content-between">
  <h4 class="mb-sm-0">Inscripciones</h4>
  <div class="page-title-right">
      <ol class="breadcrumb m-0">
          <li class="breadcrumb-item"><a href="javascript: void(0);">Inscripciones</a></li>
      </ol>
  </div>
</div>

@livewire('modulo-coordinador.modulo-inscripcion.index')

@endsection

@section('javascript')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.38/dist/sweetalert2.all.min.js"></script>
<script>   
    window.addEventListener('alerta-modulo-inscripcion', event => {
        Swal.fire(
        event.detail.title,
        event.detail.message,
        event.detail.icon
        )
    });
</script>
@endsection