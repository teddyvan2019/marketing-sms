<!DOCTYPE html>
<html lang="en">
    <head>
        @include('layouts.partiels.admin.head')
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
                        <h1>500</h1>
                        <h2>Une erreur est survenue ! </h2>
                        <p>Veuillez ressayez si le probleme persiste contactez l'administrateur </p>
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
        @include('layouts.partiels.admin.scripts_js')
        <!-- End Page Vendor Js -->
    </body>
</html>