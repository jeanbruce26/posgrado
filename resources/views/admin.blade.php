<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="ligh" data-sidebar-size="lg" data-layout-mode="light" data-sidebar-image="none" data-preloader="enable" data-layout-position="scrollable" data-layout-width="fluid">
<head>

    <meta charset="utf-8" />
    <title>Posgrado</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <!--Swiper slider css-->
    <link href="{{ asset('assets/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Layout config Js -->
    <script src="{{ asset('assets/js/layout.js') }}"></script>
    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css-admin/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css-admin/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css-admin/app2.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{ asset('assets/css-admin/custom.min.css') }}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/@mdi/font@6.9.96/css/materialdesignicons.min.css">

    <link href="{{ asset('https://cdn.jsdelivr.net/npm/remixicon@2.2.0/fonts/remixicon.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('https://unpkg.com/boxicons@latest/css/boxicons.min.css') }}">

    <script src="https://unpkg.com/boxicons@2.0.9/dist/boxicons.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    @yield('css')

    @livewireStyles
</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar">
            <div class="layout-width">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box horizontal-logo">
                            <a class="logo">
                                <span class="logo-sm">
                                    <img src="{{ asset('/user/images/LogoPosgradoSF.png') }}" alt="" height="30"
                                        width="25">
                                </span>
                            </a>
                        </div>

                        <button type="button"
                            class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger shadow-none"
                            id="topnav-hamburger-icon">
                            <span class="hamburger-icon">
                                <span></span>
                                <span></span>
                                <span></span>
                            </span>
                        </button>
                    </div>

                    <div class="d-flex align-items-center">

                        <div class="ms-1 header-item d-none d-sm-flex">
                            <button type="button"
                                class="btn btn-icon btn-topbar btn-ghost-dark rounded-circle shadow-none"
                                data-toggle="fullscreen">
                                <i class='bx bx-fullscreen fs-22'></i>
                            </button>
                        </div>

                        <div class="dropdown ms-sm-3 header-item topbar-user">
                            <button type="button" class="btn shadow-none" id="page-header-user-dropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="d-flex align-items-center">
                                    @if (auth('admin')->user()->TrabajadorTipoTrabajador->Trabajador->trabajador_perfil)
                                    <img class="rounded-circle header-profile-user" src="{{asset('Perfil/'.(auth('admin')->user()->TrabajadorTipoTrabajador->Trabajador->trabajador_perfil))}}" alt="Header Avatar">
                                    @else
                                    <img class="rounded-circle header-profile-user" src="{{asset('assets/images/avatar.png')}}" alt="Header Avatar">
                                    @endif
                                    <span class="text-start ms-xl-2">
                                        <span
                                            class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">{{auth('admin')->user()->TrabajadorTipoTrabajador->Trabajador->trabajador_nombres}}
                                            {{auth('admin')->user()->TrabajadorTipoTrabajador->Trabajador->trabajador_apellidos}}</span>
                                        <span
                                            class="d-none d-xl-block ms-1 fs-12 text-muted user-name-sub-text">{{auth('admin')->user()->TrabajadorTipoTrabajador->TipoTrabajador->tipo_trabajador}}</span>
                                    </span>
                                </span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <h6 class="dropdown-header">¡Bienvenido!</h6>

                                <a class="dropdown-item" href="#"><i
                                        class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span
                                        class="align-middle">Perfil</span></a>

                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item" href="{{ route('admin.logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> {{ __('Cerrar
                                    sesión') }}
                                </a>

                                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- ========== App Menu ========== -->
        <div class="app-menu navbar-menu">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <!-- Logo-->
                <a class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('user/images/LogoPosgradoSF.png') }}" alt="" height="35" width="30">
                    </span>
                    <span class="logo-lg">
                        <div class="d-flex justify-content-center align-items-center">
                            <img src="{{ asset('user/images/LogoPosgradoSF.png') }}" alt="" height="35" width="30">
                            <span class="fw-bold fs-3 ms-2 align-self-center text-uppercase" style="color: #2a2a50;">Posgrado</span>
                        </div>
                    </span>
                </a>
                <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
                    id="vertical-hover">
                    <i class="ri-record-circle-line"></i>
                </button>
            </div>

            <div id="scrollbar">
                <div class="container-fluid">

                    <div id="two-column-menu">
                    </div>
                    <!-- Left Menu Start -->
                    <ul class="navbar-nav" id="navbar-nav" style="font-weight: 600;">
                        <li class="menu-title"><span data-key="t-menu" class="">Menú</span></li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{ route('admin.index') }}" role="button" aria-expanded="false"
                                aria-controls="sidebarDashboard">
                                <i class="mdi mdi-speedometer"></i> <span data-key="t-apps">Dashboard</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarUser" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebarApps">
                                <i class="mdi mdi-account-group-outline"></i> <span data-key="t-apps">Usuarios</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarUser">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{ route('admin.user.index') }}" class="nav-link"
                                            data-key="t-analytics"> Usuario </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.trabajador.index') }}" class="nav-link"
                                            data-key="t-analytics"> Trabajador </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarGC" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebarApps">
                                <i class="mdi mdi-account-group-outline"></i> <span data-key="t-apps">Gestion Curricular</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarGC">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{ route('admin.sede.index') }}" class="nav-link"
                                            data-key="t-analytics"> Sede </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.plan.index') }}" class="nav-link"
                                            data-key="t-analytics"> Plan </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.programa.index') }}" class="nav-link"
                                            data-key="t-analytics"> Programas </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.admision.index') }}" class="nav-link"
                                            data-key="t-analytics"> Admision </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarApps" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebarApps">
                                <i class="mdi mdi-file-account-outline"></i> <span
                                    data-key="t-apps">Inscripción</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarApps">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{ route('admin.inscripcion.index') }}" class="nav-link"
                                            data-key="t-analytics"> Inscripción </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.inscripcion-pago.index') }}" class="nav-link"
                                            data-key="t-analytics"> Inscripción de Pago </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.pago.index') }}" class="nav-link" data-key="t-analytics">
                                            Pago </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{ route('admin.admitidos.index') }}" role="button" aria-expanded="false"
                                aria-controls="sidebarDashboard">
                                <i class="mdi mdi-account-multiple-check-outline"></i> <span data-key="t-apps">Admitidos</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarCruds" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebarCruds">
                                <i class="mdi mdi-speedometer"></i> <span data-key="t-dashboards">CRUDS</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarCruds">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{ route('admin.persona.index') }}" class="nav-link" data-key="t-analytics">
                                            Estudiantes </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.canal-pago.index') }}" class="nav-link"
                                            data-key="t-analytics"> Canal de Pago </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.concepto-pago.index') }}" class="nav-link"
                                            data-key="t-analytics"> Concepto de Pago </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('Expediente.index') }}" class="nav-link"
                                            data-key="t-analytics"> Expediente </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                    </ul>
                </div>
                <!-- Sidebar -->
            </div>

            <div class="sidebar-background"></div>
        </div>
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col">
                            @if(\Session::has('edit'))
                            <div class="alert alert-success alert-border-left alert-dismissible fade shadow show"
                                role="alert">
                                <div>
                                    <i class="ri-check-double-line me-3 align-middle fs-16"></i><strong>{{
                                        \Session::get('edit') }}</strong>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>

                            @endif

                            @if(session('new'))
                            <div class="alert alert-success alert-border-left alert-dismissible fade shadow show"
                                role="alert">
                                <div>
                                    {{ \Session::get('new') }}
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            @endif

                            @if(\Session::has('dupli'))
                            <div class="alert alert-danger alert-border-left alert-dismissible fade shadow show"
                                role="alert">
                                <div>
                                    <i class="ri-error-warning-line me-3 align-middle fs-16"></i><strong>{{
                                        \Session::get('dupli') }}</strong>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>

                            @endif

                            @yield('content')

                        </div> <!-- end col -->
                    </div>

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> © Posgrado.
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <div id="preloader">
        <div id="status">
            <div class="spinner-border text-primary avatar-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->

    <!-- validacon -->
    <script>
        function soloNumeros(e) {
            var key = e.keyCode || e.which,
                tecla = String.fromCharCode(key).toLowerCase(),
                letras = "1234567890.",
                especiales = [8, 37, 39, 46],
                tecla_especial = false;
        
            for (var i in especiales) {
                if (key == especiales[i]) {
                tecla_especial = true;
                break;
                }
            }
        
            if (letras.indexOf(tecla) == -1 && !tecla_especial) {
                return false;
            }
        }
    </script>

    <script>
        function soloLetras(e) {
            var key = e.keyCode || e.which,
                tecla = String.fromCharCode(key).toLowerCase(),
                letras = " áéíóúabcdefghijklmnñopqrstuvwxyz",
                especiales = [8, 37, 39, 46],
                tecla_especial = false;
        
            for (var i in especiales) {
                if (key == especiales[i]) {
                tecla_especial = true;
                break;
                }
            }
        
            if (letras.indexOf(tecla) == -1 && !tecla_especial) {
                return false;
            }
        }
    </script>
    <!-- end validacon -->

    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('assets/js/plugins.js') }}"></script>

    <!--Swiper slider js-->
    <script src="{{ asset('assets/libs/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Dashboard init -->
    <script src="{{ asset('assets/js/pages/dashboard-ecommerce.init.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <!-- Sweet Alerts js -->
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <!--jquery cdn-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    @yield('javascript')

    @livewireScripts
</body>

</html>