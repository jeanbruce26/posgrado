@extends('coordinador')

@section('content')
<div class="page-title-box d-sm-flex align-items-center justify-content-between">
  <h4 class="mb-sm-0">
    {{ $programa }}
  </h4>
  <div class="page-title-right">
      <ol class="breadcrumb m-0">
          <li class="breadcrumb-item">
            <a href="{{ route('coordinador.modulo-inscripcion-index.index') }}">
              Inscripciones
            </a>
          </li>
          <li class="breadcrumb-item active">
            {{ $programa }}
          </li>
      </ol>
  </div>
</div>

@livewire('modulo-coordinador.modulo-inscripcion.inscripcion', ['id_mencion' => $id_mencion], key($id_mencion))

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

    window.addEventListener('notificacionExcel', event => {
        Toastify({
            text: event.detail.message,
            close: true,
            duration: 5000,
            stopOnFocus: true,
            newWindow: true,
            style: {
                background:  event.detail.color,
            }
        }).showToast();
    })
</script>
@endsection