<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{ asset('web') }}/assets/images/favicon-32x32.png" type="image/png" />
    <!--plugins-->
    <link href="{{ asset('web') }}/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <link href="{{ asset('web') }}/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="{{ asset('web') }}/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="{{ asset('web') }}/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <!-- loader-->
    <link href="{{ asset('web') }}/assets/css/pace.min.css" rel="stylesheet" />
    <script src="{{ asset('web') }}/assets/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('web') }}/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('web') }}/assets/css/bootstrap-extended.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="{{ asset('web') }}/assets/css/app.css" rel="stylesheet">
    <link href="{{ asset('web') }}/assets/css/icons.css" rel="stylesheet">
    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="{{ asset('web') }}/assets/css/dark-theme.css" />
    <link rel="stylesheet" href="{{ asset('web') }}/assets/css/semi-dark.css" />
    <link rel="stylesheet" href="{{ asset('web') }}/assets/css/header-colors.css" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Bebas+Neue&display=swap" rel="stylesheet">
    @yield('style')
    <style>
        body {
            font-family: "Anton", sans-serif;
            font-weight: 300;
            font-style: normal;
        }
    </style>
    <title>Nevermore</title>
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">
        <!--start header wrapper-->
        <div class="header-wrapper">
            <!--start header -->
            @include('template-web.header')

            <!--end header -->
            <!--navigation-->
            @include('template-web.navbar')

            <!--end navigation-->
        </div>
        <!--end header wrapper-->
        <!--start page wrapper -->

        @yield('content')

        <!--end page wrapper -->
        <!--start overlay-->
        <div class="overlay toggle-icon"></div>
        <!--end overlay-->
        <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i
                class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->



    </div>
    <div class="container">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <p class="col-md-4 mb-0 text-muted">&copy; 2022 Company, Inc</p>

            <a href="/"
                class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                    class="bi bi-bag-heart-fill" viewBox="0 0 16 16">
                    <path
                        d="M11.5 4v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m0 6.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132" />
                </svg>
            </a>

            <ul class="nav col-md-4 justify-content-end">
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Home</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Features</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Pricing</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">FAQs</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
            </ul>
        </footer>
    </div>
    @include('sweetalert::alert')

    @yield('script')
    <!--end wrapper-->
    <!-- Bootstrap JS -->
    <script src="{{ asset('web') }}/assets/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="{{ asset('web') }}/assets/js/jquery.min.js"></script>
    <script src="{{ asset('web') }}/assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="{{ asset('web') }}/assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="{{ asset('web') }}/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <script src="{{ asset('web') }}/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="{{ asset('web') }}/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="{{ asset('web') }}/assets/plugins/chartjs/js/Chart.min.js"></script>
    <script src="{{ asset('web') }}/assets/plugins/chartjs/js/Chart.extension.js"></script>
    <script src="{{ asset('web') }}/assets/js/index.js"></script>
    <!--app JS-->
    <script src="{{ asset('web') }}/assets/js/app.js"></script>
</body>

</html>
