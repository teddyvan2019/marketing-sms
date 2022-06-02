<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Font Awesome Icons -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> @yield('title') </title>
    <meta name="description" content="Systeme de suivi citoyen des recommandations">
    <meta name="keywords" content="CIFOEB,Recommandation,CITOYEN">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Google Fonts -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js"></script>
    <script>
        WebFont.load({
        google: {"families":["Montserrat:400,500,600,700","Noto+Sans:400,700"]},
        active: function() {
            sessionStorage.fonts = true;
        }
        });
    </script>
    <!-- Favicon -->
    <link rel="apple-touch-icon"       sizes="180x180"    href="{{ URL::asset('template/login/img/cifoeblogo.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ URL::asset('template/login/img/cifoeblogo.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ URL::asset('template/login/img/cifoeblogo.png') }}">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="{{ URL::asset('template/login/css/base/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('template/login/css/base/elisyam-1.5.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('template/login/css/animate/animate.min.css') }}">

    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>
    <body class="bg-error-01">
        <!-- Begin Preloader -->
        <div id="preloader">
            <div class="canvas">
                <div class="spinner"></div>   
            </div>
        </div>
        <!-- End Preloader -->
        <!-- Begin Container -->
        <div class="container-fluid h-100 error-01">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-12">
                    <!-- Begin Container -->
                    <div class="error-container mx-auto text-center">
                        <h1>404</h1>
                        <h2>Cette page n'existe pas ! </h2>
                        <p>. </p>
                        <a href="{{ url('/') }}" class="btn btn-shadow">
                            Retour
                        </a>
                    </div> 
                    <!-- End Container -->
                </div>
                <!-- End Col -->
            </div> 
            <!-- End Row -->
        </div>
        <!-- End Container -->
        <!-- Begin Vendor Js -->
        <script src="{{ URL::asset('template/login/js/base/jquery.min.js') }}"></script>
        <script src="{{ URL::asset('template/login/js/base/core.min.js') }}"></script>

        <script src="{{ URL::asset('template/login/js/app/app.min.js') }}"></script>
        <script src="{{ URL::asset('template/login/js/nicescroll/nicescroll.min.js') }}"></script>
          <!-- End Page Vendor Js -->
    </body>
</html>