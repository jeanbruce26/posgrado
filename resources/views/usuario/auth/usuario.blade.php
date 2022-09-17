<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">

<head>

    <meta charset="utf-8" />
    <title>Posgrado</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <!-- Layout config Js -->
    <script src="{{ asset('assets/js/layout.js') }}"></script>
    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{ asset('assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
    
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/@mdi/font@6.9.96/css/materialdesignicons.min.css">

    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    @livewireStyles
</head>

<body class="auth-bg-login">

    <div class="auth-page-wrapper auth-bg-cover">
    
        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row mt-3">
                    <div class="col-lg-12 d-flex justify-content-center align-items-center mt-4">
                        <div class="text-center text-white">
                            <div>
                                <a class="d-inline-block auth-logo">
                                    <img src="{{asset('assets/images/unu.png')}}" alt="" height="120">
                                </a>
                            </div>
                        </div>
                        <div class="text-center text-white mx-5">
                            <p class="mt-3 fs-20 fw-bold">UNIVERSIDAD NACIONAL DE UCAYALI</p>
                            <p class="fs-15 fw-bold">ESCUELA DE POSGRADO</p>
                            <p class="fs-15 fw-bold">{{$admision->admision}}</p>
                        </div>
                        <div class="text-center text-white">
                            <div>
                                <a" class="d-inline-block auth-logo">
                                    <img src="{{asset('assets/images/LogoPosgradoSF.png')}}" alt="" height="120" width="100">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row justify-content-center mt-4">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="card mt-4">

                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5 class="fw-bold">Inicie Sesión</h5>
                                </div>
                                
                                <livewire:usuario-login/>

                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <!-- footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0">&copy;
                                <script>document.write(new Date().getFullYear())</script> Posgrado.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Guia de Inscripción</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <img src="{{ asset('Manual/Diapositiva1.png') }}" class="w-100" alt="">
                <img src="{{ asset('Manual/Diapositiva2.PNG') }}" class="w-100" alt="">
                <img src="{{ asset('Manual/Diapositiva3.PNG') }}" class="w-100" alt="">
                <img src="{{ asset('Manual/Diapositiva4.PNG') }}" class="w-100" alt="">
                <img src="{{ asset('Manual/Diapositiva5.PNG') }}" class="w-100" alt="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <a target="_blank" href="{{ asset('Manual/manual_inscripcion.pdf') }}" class="btn btn-success">Descargar</a>
                </div>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('assets/js/plugins.js') }}"></script>

    <!-- particles js -->
    <script src="{{ asset('assets/libs/particles.js/particles.js') }}"></script>
    <!-- particles app js -->
    <script src="{{ asset('assets/js/pages/particles.app.js') }}"></script>
    <!-- password-addon init -->
    <script src="{{ asset('assets/js/pages/password-addon.init.js') }}"></script>
    
    @livewireScripts
</body>

</html>