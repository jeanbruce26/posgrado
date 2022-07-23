<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Posgrado</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{ asset('/favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">

    @livewireStyles
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        
        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3 ">
            <nav class="navbar bg-light navbar-light justify-content-around">
                <a href="/user" class="navbar-brand mx-4 mb-3 d-flex flex-column justify-content-center align-items-center">
                    <img src="{{ asset('/img/LogoPosgradoSF.png') }}" style="width: 50px; height: 65px;" class="img-fluid rounded-top m-auto" alt="">
                    <h3 class="text-success mt-1 m-auto"></i>POSGRADO</h3>
                </a>
                <div class="d-flex align-items-center mb-4">
                    <div class="ms-3">
                        <div class="card">
                            <div class="card-header">
                                Ciclo Academico 2022-I
                            </div>
                            <div class="card-body">
                                <h4 class="card-title text-center text-secondary mt-2">Bienvenido</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="navbar-nav w-100">                 
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-user-edit me-2"></i>Inscripcion</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{ url('/Inscripcion') }}" class="dropdown-item">Inscripcion</a> 
                        </div>
                    </div> 
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="/" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars text-success"></i>
                </a>
                <div class="navbar-nav align-items-center">
                    <a href="/user" class="nav-link">   
                        <h4 class="d-none d-lg-inline-flex mt-2 text-success">ESCUELA DE POSGRADO - UNU</h4>
                    </a>
                </div>
            </nav>
            <!-- Navbar End -->


            <!-- Blank Start -->
            <div class="container-fluid pt-4 px-4">
                @yield('content')  
            </div>
            <!-- Blank End -->


            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4 ">
                
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-success btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

    @livewireScripts
</body>

</html>