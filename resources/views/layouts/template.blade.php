<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="Samamea Resto & Bar" />
        <meta name="author" content="Samamea" />
        <meta name="robots" content="noindex">
        <meta name="googlebot" content="noindex">

        <title>SAMAMEA Resto & Bar</title>
        <link rel="icon" href="{{URL('https://images.arasatu.com/arasatu/logo/samamea_logo_128.png')}}">

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap-theme.min.css') }}">

        @stack('css')
    </head>
    <body>
        <div class="mobile-container">
            <div class="topnav">
                <a href="{{url('/')}}" class="active">
                    <img class="logo" src="https://images.arasatu.com/arasatu/logo/samameaonly.png" alt="SAMAMEA">
                </a>
                <div id="myLinks">
                    <a href="/">Food</a>
                    <a href="#bar">Bar</a>
                </div>
                <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                    <i class="fa fa-bars"></i>
                </a>
            </div>         
            @yield('content')
        </div>
        @if($pageTitle == "Menu")
            <div id="checkout">
                <a href="{{url('/order')}}" class="w-100"><i class="far fa-shopping-cart"></i>CART</a>
            </div>
        @endif
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script>
            function myFunction() {
                var x = document.getElementById("myLinks");
                if (x.style.display === "block") {
                    x.style.display = "none";
                } else {
                    x.style.display = "block";
                }
            }
        </script>
    </body>
    @stack('bottomscripts')
    <footer>
        <?php
            echo "<p class='text-center m-0'>SAMAMEA &copy; ".date("Y")."</p>";
        ?>
    </footer>
</html>
