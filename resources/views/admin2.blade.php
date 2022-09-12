<!doctype html>
<html lang="es">

    <head>

        <meta charset="utf-8" />
        <title>Posgrado</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('/user/images/favicon.ico') }}">

        <!-- Bootstrap Css -->
        <link href="{{ asset('/user/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{ asset('/user/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{ asset('/user/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
        {{-- Icons --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@6.9.96/css/materialdesignicons.min.css">

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

        @livewireStyles
    </head>

    <body data-sidebar="dark">

        <!-- Begin page -->
        <div id="layout-wrapper">

            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a class="logo">
                                <span class="logo-sm">
                                    <img src="{{ asset('/user/images/LogoPosgradoSF.png') }}" alt="" height="30" width="25">
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>
                    </div>

                    <div class="d-flex">

                        <div class="dropdown d-inline-block d-lg-none ms-2">
                            <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="uil-search"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                aria-labelledby="page-header-search-dropdown">
                            </div>
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-user"></i>
                                <span class="d-none d-xl-inline-block ms-1 fw-medium font-size-15">Nombre de Usuario</span>
                                <i class="uil-angle-down d-none d-xl-inline-block font-size-15"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a class="dropdown-item" href="#"><i class="uil uil-user-circle font-size-18 align-middle text-muted me-1"></i> <span class="align-middle">Perfil</span></a>
                                <a class="dropdown-item" href="#"><i class="uil uil-sign-out-alt font-size-18 align-middle me-1 text-muted"></i> <span class="align-middle">Cerrar Sesión</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

                <!-- LOGO -->
                <div class="navbar-brand-box">
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

                <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
                    <i class="fa fa-fw fa-bars"></i>
                </button>

                <div data-simplebar class="sidebar-menu-scroll">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li class="menu-title">Menu</li>

                            <li>
                                <a href="/">
                                    <i class="uil-home-alt"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="uil-window-section"></i>
                                    <span>CRUDS</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="true">
                                    <li>
                                        <a href="javascript: void(0);" class="has-arrow">Persona</a>
                                        <ul class="sub-menu" aria-expanded="true">
                                            <li><a href="{{ url('Persona') }}" class="dropdown-item">Estudiantes</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="javascript: void(0);" class="has-arrow">Pago</a>
                                        <ul class="sub-menu" aria-expanded="true">
                                            <li><a href="{{ url('CanalPago') }}" class="dropdown-item">Canal Pago</a></li>
                                            <li><a href="{{ url('ConceptoPago') }}" class="dropdown-item">Concepto de Pago</a></li>
                                            <li><a href="{{ url('Pago') }}" class="dropdown-item">Pago</a> </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="javascript: void(0);" class="has-arrow">Admisión</a>
                                        <ul class="sub-menu" aria-expanded="true">
                                            <li><a href="{{ url('Admision') }}" class="dropdown-item">Admision</a></li>
                                            <li><a href="{{ url('Plan') }}" class="dropdown-item">Plan</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="javascript: void(0);" class="has-arrow">Expediente</a>
                                        <ul class="sub-menu" aria-expanded="true">
                                            <li><a href="{{ url('Expediente') }}" class="dropdown-item">Expediente</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="javascript: void(0);" class="has-arrow">Inscripción</a>
                                        <ul class="sub-menu" aria-expanded="true">
                                            <li><a href="{{ url('HistorialInscripcion') }}" class="dropdown-item">Historial de Inscripcion</a></li>
                                            <li><a href="{{ url('InscripcionPago') }}" class="dropdown-item">Inscripcion de Pago</a></li>
                                            <li><a href="{{ url('Inscripcion') }}" class="dropdown-item">Inscripcion</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="javascript: void(0);" class="has-arrow">Programas</a>
                                        <ul class="sub-menu" aria-expanded="true">
                                            <li><a href="{{ url('GradoAcademico') }}" class="dropdown-item">Grados Academicos</a></li>
                                            <li><a href="{{ url('Mencion') }}" class="dropdown-item">Mencion</a></li>
                                            <li><a href="{{ url('Programa') }}" class="dropdown-item">Programa</a></li>
                                            <li><a href="{{ url('Sede') }}"class="dropdown-item">Sede</a></li>
                                            <li><a href="{{ url('SubPrograma') }}" class="dropdown-item">Sub Programas</a></li>
                                            <li><a href="{{ url('Universidad') }}" class="dropdown-item">Universidades</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->



            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <!-- <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">Dashboard</h4>
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Inicio</a></li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <!-- end page title -->


                        <!-- Contenido de la page -->
                        <!-- -------------------- -->
                        <div class="card">
                            <div class="card-body">
                                @yield('content')
                            </div>
                        </div>
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




        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
        <script src="{{ asset('user/libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('user/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('user/libs/metismenu/metisMenu.min.js') }}"></script>
        <script src="{{ asset('user/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('user/libs/node-waves/waves.min.js') }}"></script>
        <script src="{{ asset('user/libs/waypoints/lib/jquery.waypoints.min.js') }}"></script>
        <script src="{{ asset('user/libs/jquery.counterup/jquery.counterup.min.js') }}"></script>

        <!-- apexcharts -->
        <script src="{{ asset('user/libs/apexcharts/apexcharts.min.js') }}"></script>

        <script src="{{ asset('user/js/pages/dashboard.init.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset('user/js/app.js') }}"></script>

    </body>

</html>