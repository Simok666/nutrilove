<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ empty($title) ? '' : $title . ' | ' }} {{ config('app.name') }}</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('user_assets/img/favicon.png')}}" rel="icon">
    <link href="{{ asset('user_assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset("user_assets/vendor/aos/aos.css")}}" rel="stylesheet">
    <link href="{{ asset("user_assets/vendor/bootstrap/css/bootstrap.min.css")}}" rel="stylesheet">
    <link href="{{ asset("user_assets/vendor/bootstrap-icons/bootstrap-icons.css")}}" rel="stylesheet">
    <link href="{{ asset("user_assets/vendor/boxicons/css/boxicons.min.css")}}" rel="stylesheet">
    <link href="{{ asset("user_assets/vendor/glightbox/css/glightbox.min.css")}}" rel="stylesheet">
    <link href="{{ asset("user_assets/vendor/swiper/swiper-bundle.min.css")}}" rel="stylesheet">
    <link href="{{ asset("user_assets/css/themify-icons.css")}}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('admin_assets/plugins/toastr/toastr.min.css') }}">

    <!-- Template Main CSS File -->
    <link href="{{ asset('user_assets/css/style.css')}}" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Ninestars - v4.8.0
  * Template URL: https://bootstrapmade.com/ninestars-free-bootstrap-3-theme-for-creative/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
    <style>
        label.error{
            color: red
        }
    </style>
    {{ $styles ?? '' }}
</head>

<body>

    <x-user.header>
    </x-user.header>
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">

        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
                    <h1>Bettter digital experience with Ninestars</h1>
                    <h2>We are team of talented designers making websites with Bootstrap</h2>
                    <div>
                        <a href="#about" class="btn-get-started scrollto">Get Started</a>
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2 hero-img">
                    <img src="user_assets/img/health.png" class="img-fluid animated" alt="">
                </div>
            </div>
        </div>

    </section><!-- End Hero --> 

    <main id="main">
        @if (Route::is('users.index'))
            @isset($title)
            @endisset
        @endif

        @if (Route::is('users.aboutus'))
            @isset($title)
            @endisset
        @endif

        @if (Route::is('users.blogs'))
            @isset($title)
            @endisset
        @endif

        @if (Route::is('users.singleblogs'))
            @isset($title)
            @endisset
        @endif

        {{ $slot }}

    </main><!-- End #main -->

    <x-user.footer>
    </x-user.footer>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
    
    
    
    <!-- Vendor JS Files -->
    <script src="{{ asset("user_assets/vendor/aos/aos.js")}}"></script>
    <script src="{{ asset("user_assets/vendor/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
    <script src="{{ asset("user_assets/vendor/glightbox/js/glightbox.min.js")}}"></script>
    <script src="{{ asset("user_assets/vendor/isotope-layout/isotope.pkgd.min.js")}}"></script>
    <script src="{{ asset("user_assets/vendor/swiper/swiper-bundle.min.js")}}"></script>
    <script src="{{ asset("user_assets/vendor/php-email-form/validate.js")}}"></script>


    <!-- Template Main JS File -->
    <script src="{{ asset("user_assets/js/main.js")}}"></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="{{ asset('admin_assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('dashboard.js') }}"></script>
    
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/631b049d37898912e9682442/1gcgok2e8';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
        })();
    </script>
    <!--End of Tawk.to Script-->
</body>

</html>
