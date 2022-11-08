<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

        <!-- Theme Config Js -->
        <script src="{{ asset('assets/js-login/hyper-config.js') }}"></script>

        <!-- App css -->
        <link href="{{ asset('assets/css-login/app-saas.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

        <!-- Icons css -->
        <link href="{{ asset('assets/css-login/icons.min.css') }}" rel="stylesheet" type="text/css" />
        
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/@mdi/font@6.9.96/css/materialdesignicons.min.css">

        @livewireStyles

    </head>

    <body class="authentication-bg pb-0">

        <div class="auth-fluid">
            <!--Auth fluid left content -->
            <div class="auth-fluid-form-box">
                <div class="align-items-center d-flex h-100">
                    <div class="card-body">

                        <!-- Logo -->
                        <div class="auth-brand text-center text-lg-start">
                            <a class="logo-dark">
                                <span class="logo-lg">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <img src="{{ asset('user/images/LogoPosgradoSF.png') }}" alt="" height="35" width="30">
                                        <span class="fw-bold fs-3 ms-2 align-self-center text-uppercase" style="color: #2a2a50;">Posgrado</span>
                                    </div>
                                </span>
                            </a>
                        </div>

                        <!-- title-->
                        <h4 class="mt-0 text-center">¡BIENVENIDOS!</h4>
                        <p class="text-muted mb-4 text-center">Sistema Administrativo.</p>

                        <!-- form -->
                        @livewire('modulo-administrador.auth.login')
                        <!-- end form-->

                        <!-- Footer-->
                        <footer class="footer footer-alt">
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

                    </div> <!-- end .card-body -->
                </div> <!-- end .align-items-center.d-flex.h-100-->
            </div>
            <!-- end auth-fluid-form-box-->

            <!-- Auth fluid right content -->
            <div class="auth-fluid-right text-center">
                <div class="auth-user-testimonial">
                    <h3 class="mb-2">Escuela de Posgrado</h2>
                    <p class="lead"> Universidad Nacional de Ucayali </p>
                </div> <!-- end auth-user-testimonial-->
            </div>
            <!-- end Auth fluid right content -->
        </div>
        <!-- end auth-fluid-->
        <!-- Vendor js -->
        <script src="{{ asset('assets/js-login/vendor.min.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset('assets/js-login/app.min.js') }}"></script>

        @livewireScripts

    </body>

</html>