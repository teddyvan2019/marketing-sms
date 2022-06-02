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
    <body class="bg-fixed-04">
        <!-- Begin Preloader -->
        <div id="preloader">
            <div class="canvas">
                <img src="{{ URL::asset('template/admin/dist/img/logo_smartprest.jpg') }}" alt="logo" class="loader-logo">
                <div class="spinner"></div>   
            </div>
        </div>
        <!-- End Preloader -->
        <!-- Begin Section -->
        <div class="container-fluid h-100 overflow-y">
            <div class="row flex-row h-100"> 
                <div class="col-12 my-auto">
                    <div class="lock-form mx-auto">
                        <div class="photo-profil">
                            <img src="{{ URL::asset('template/admin/dist/img/logo_smartprest.jpg') }}" alt="logo" class="" style="width:100%">
                        </div>
                        <h3> Connexion à la plateforme</h3>
                        <form  method="POST" action="{{ route('login') }}" >
                        @csrf
                            <div class="group material-input">
							    <input type="email" name="email" value="{{ old('email') }}" required>
							    <span class="highlight"></span>
							    <span class="bar"></span>
                                <label>Email :</label>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong style='color:red'>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                              
                            </div> 
                            <div class="group material-input">
							    <input type="password" name="password" required>
							    <span class="highlight"></span>
							    <span class="bar"></span>
                                <label>Password </label>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong style='color:red'>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif

                            </div>
                        <div class="button text-center">
                            <button class="btn btn-square btn-lg btn-gradient-01" type="submit"> Se connecter </button>
                        </div>
                    </form>
                    </div>      
                </div>
            </div>
            <!-- End Container -->
        </div>  
        <!-- End Section -->  
        <script src="{{ URL::asset('template/login/js/base/jquery.min.js') }}"></script>
        <script src="{{ URL::asset('template/login/js/base/core.min.js') }}"></script>

        <script src="{{ URL::asset('template/login/js/app/app.min.js') }}"></script>
        <script src="{{ URL::asset('template/login/js/nicescroll/nicescroll.min.js') }}"></script>
    </body>
</html>