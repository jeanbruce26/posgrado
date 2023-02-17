@extends ('vista_inscripcion')

@section('content')
<div class="row">
     <div class="col-xxl-10 col-xl-12 col-lg-12 col-md-12 col-sm-12 m-auto">
          <!-- Danger Alert -->
          <div class="alert alert-info alert-top-border alert-dismissible shadow fade show" role="alert">
               <i class="ri-error-warning-line me-3 align-middle fs-18 text-info"></i>
               <strong>Nota</strong> - Al terminar con el registro de sus datos, espere un momento ya que se estará generando su ficha de inscripción.
               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          
          @livewire('modulo_inscripcion.inscripcion.create', ['id' => $id])
     </div>
</div>
@endsection

@section('javascript')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.38/dist/sweetalert2.all.min.js"></script>
<script>
     window.addEventListener('alertaInscripcion', event => {
          Swal.fire(
               event.detail.titulo,
               event.detail.subtitulo,
               event.detail.icon
          )
     });

     window.addEventListener('alertaFicha', event => {
          let timerInterval;
          Swal.fire({
               title: 'Espere un momento, estamos generando su ficha de inscripción.',
               showConfirmButton: false,
               timer: 20000,
               timerProgressBar: true,
               allowOutsideClick: false,
               allowEscapeKey: false,
               allowEnterKey: false,
               padding: '2em 2em 3em 2em',
               didOpen: () => {
               Swal.showLoading()
               const b = Swal.getHtmlContainer().querySelector('b')
               timerInterval = setInterval(() => {
                    b.textContent = Swal.getTimerLeft()
               }, 100)
               },
               willClose: () => {
               clearInterval(timerInterval)
               }
          })
     });

     window.addEventListener('modalExpediente', event => {
          $('#modalExpediente').modal('hide');
     });
</script>
@endsection