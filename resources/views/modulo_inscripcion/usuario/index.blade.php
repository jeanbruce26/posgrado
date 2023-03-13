@extends ('vista_usuario')

@section('content')

<div class="row">
    <div class="col-lg-10 col-md-12 col-xl-8 m-auto">
        @livewire('modulo-inscripcion.usuario.usuario')
    </div>
</div>

@endsection

@section('javascript')
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        window.addEventListener('cerrarModalRegistroPago', event => {
            $('#modalRegistrarPago').modal('hide');
        });

        window.addEventListener('modal_encuesta', event => {
            $('#modal_encuesta').modal(event.detail.modal);
        });

        window.addEventListener('confirmacion-registro_pago', event => {
            Swal.fire({
                title: '¿Confirmación de registro de pago?',
                text: "Una vez registrado y validado el pago, ya no podrá utilizarlo ni solicitar reembolso.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Registrar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emitTo('modulo-inscripcion.usuario.usuario', 'registrar_pago');
                }
            })
        })

        window.addEventListener('alertaConstancia', event => {
            let timerInterval
            Swal.fire({
                title: 'Espere un momento, estamos generando su constancia de ingreso...',
                timer: 4000,
                timerProgressBar: true,
                padding: '0 0 2.2em',
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
            }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                    Swal.fire(
                        event.detail.mensaje,
                        '',
                        'success'
                    )
                    Livewire.emitTo('modulo-inscripcion.usuario.usuario', 'crearConstancia', event.detail.id);
                }
            })
        });

        window.addEventListener('alertaFichaMatricula', event => {
            let timerInterval
            Swal.fire({
                title: 'Espere un momento, estamos generando su ficha de matrícula...',
                timer: 2000,
                timerProgressBar: true,
                padding: '0 0 2.2em',
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
            }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                    Swal.fire(
                        event.detail.mensaje,
                        '',
                        'success'
                    )
                    Livewire.emitTo('modulo-inscripcion.usuario.usuario', 'crearFichaMatricula', event.detail.id);
                }
            })
        });

        window.addEventListener('alertaRegistroPago', event => {
            Swal.fire(
                event.detail.mensaje,
                '',
                'error'
            )
        });

        window.addEventListener('alertaRegistroPagoSuccess', event => {
            Swal.fire(
                event.detail.mensaje,
                '',
                'success'
            )
        });

        window.addEventListener('alertaEncuestaError', event => {
            Swal.fire(
                event.detail.mensaje,
                '',
                'error'
            )
        });
    </script>
@endsection