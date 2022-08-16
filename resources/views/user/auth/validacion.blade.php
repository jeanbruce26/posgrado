<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <title>POSGRADO | SISTEMA DE INSCRIPCION</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('/user/images/favicon.ico') }}" type="image/x-icon">

        <!-- Bootstrap Css -->
        <link href="{{ asset('/user/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{ asset('/user/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{ asset('/user/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    </head>

    <body class="authentication-bg">
        <div class="account-pages my-5 pt-sm-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                        </div>
                    </div>
                </div>
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card">
                            <div class="card-body p-4"> 
                                <div class="text-center">
                                    <a class="mb-3 d-block auth-logo">
                                        <img src="{{ asset('user/images/LogoPosgradoSF.png') }}" alt="" height="90" width="70" class="logo logo-dark">
                                    </a>
                                    <h3 class="text-primary">ESCUELA DE POSGRADO</h3>
                                    <h5 class="mt-4">Forlumario de validación de pago</h5>
                                </div>
                                <div class="text-center mt-4">
                                    <p class="text-muted">Recuerda que, puedes realizar tu inscripción al dia siguiente de haber realizado tu pago.</p>
                                </div>
                                <div class="p-2 mt-4">
                                    <form action="{{ route('login.store') }}" method="POST" novalidate>
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label">Numero de documento *</label>
                                            <input type="text" name="dni" value="{{ old('dni') }}" class="form-control" placeholder="Ingrese su número de documento">
                                            @error('dni')
                                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                
                                        <div class="mb-3">
                                            <label class="form-label">Número de operación *</label>
                                            <input type="text" name="nro_operacion" value="{{ old('nro_operacion') }}" class="form-control" placeholder="Ingrese su número de operación">
                                            @error('nro_operacion')
                                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        @if (session('mensaje'))
                                            <div class="alert alert-danger mt-1 mb-1">{{ session('mensaje') }}</div>
                                        @endif
                                        
                                        <div class="mt-4">
                                            <button class="btn btn-primary w-100 w-sm waves-effect waves-light" type="submit">Ingresar</button>
                                        </div>

                                        <div class="mt-4">
                                            - <a class="guia" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                Guia de Inscripción
                                            </a>
                                        </div>
                                    </form>
                                </div>
            
                            </div>
                        </div>

                        

                        <div class="mt-5 text-center text-white">
                            <p>© <script>document.write(new Date().getFullYear())</script> Escuela de Posgrado</p>
                        </div>


                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>

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
                        <a target="_blank" href="{{ asset('Manual/manual_inscripcion.pdf') }}" class="btn btn-primary">Descargar</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- JAVASCRIPT -->
        <script src="{{ asset('/user/libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('/user/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('/user/libs/metismenu/metisMenu.min.js') }}"></script>
        <script src="{{ asset('/user/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('/user/libs/node-waves/waves.min.js') }}"></script>
        <script src="{{ asset('/user/libs/waypoints/lib/jquery.waypoints.min.js') }}"></script>
        <script src="{{ asset('/user/libs/jquery.counterup/jquery.counterup.min.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset('/assets/js/app.js') }}"></script>



    </body>
</html>
