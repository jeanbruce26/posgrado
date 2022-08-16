<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <title>POSGRADO | SISTEMA DE INSCRIPCION</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('/user/images/favicon.ico') }}">
        <!-- Bootstrap Css -->
        <link href="{{ asset('/user/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{ asset('/user/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{ asset('/user/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

        <!-- CSS -->
        <link rel="stylesheet" href="{{ asset('/assets/font-awesome/css/font-awesome.min.css') }}">
		<link rel="stylesheet" href="{{ asset('/assets/css/form-elements.css') }}">
        <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">

        @livewireStyles

    </head>
    <body data-layout="horizontal" data-topbar="dark">
        <!-- Begin page -->
        <div id="layout-wrapper">

            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box2">
                            <a class="logo">
                                <span class="logo-sm">
                                    <img src="{{ asset('user/images/LogoPosgradoSF.png') }}" alt="" height="30" width="25">
                                </span>
                                <span class="logo-lg">
                                    <div class="m-auto d-flex align-items-center">
                                        <img src="{{ asset('user/images/LogoPosgradoSF.png') }}" alt="" height="35" width="30">
                                        <h4 class="m-auto mx-3 text-uppercase text-white">Posgrado</h4>
                                    </div>
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item waves-effect waves-light" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>
                    </div>

                    <div class="d-flex">
                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium font-size-15">{{ auth('pagos')->user()->dni }}</span>
                                <i class="uil-angle-down d-none d-xl-inline-block font-size-15"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="uil uil-sign-out-alt font-size-18 align-middle me-1 text-muted"></i> <span class="align-middle">Cerrar Sesión</span></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="topnav">
                        <nav class="navbar navbar-light navbar-expand-lg topnav-menu">
                            <div class="collapse navbar-collapse" id="topnav-menu-content">
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="nav-link font-weight-bold" {{--  href="{{ route('inscripcion') }}"--}}> 
                                            <i class="uil uil-book me-2"></i> Inscripción
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </header>
    


            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">
                        @yield('content')  
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->
                
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <script>document.write(new Date().getFullYear())</script> © Escuela de Posgrado.
                            </div>
                        </div>
                    </div>
                </footer>

            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <!-- JAVASCRIPT -->
        <script src="{{ asset('/user/libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('/user/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('/user/libs/metismenu/metisMenu.min.js') }}"></script>
        <script src="{{ asset('/user/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('/user/libs/node-waves/waves.min.js') }}"></script>
        <script src="{{ asset('/user/libs/waypoints/lib/jquery.waypoints.min.js') }}"></script>
        <script src="{{ asset('/user/libs/jquery.counterup/jquery.counterup.min.js') }}"></script>

        <!-- jquery step -->
        <script src="{{ asset('/user/libs/jquery-steps/build/jquery.steps.min.js') }}"></script>

        <!-- form wizard init -->
        <script src="{{ asset('/user/js/pages/form-wizard.init.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset('/user/js/app.js') }}"></script>
        
        <!-- Javascript -->
        <script src="{{ asset('/assets/js/jquery-1.11.1.min.js') }}"></script>
        <script src="{{ asset('/assets/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('/assets/js/jquery.backstretch.min.js') }}"></script>
        <script src="{{ asset('/assets/js/retina-1.1.0.min.js') }}"></script>
        <script src="{{ asset('/assets/js/scripts.js') }}"></script>

        @livewireScripts

    </body>
</html>