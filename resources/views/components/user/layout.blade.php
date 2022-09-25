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
    <link href="{{ asset('user_assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('user_assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('user_assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('user_assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('user_assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('user_assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('user_assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('user_assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('user_assets/css/themify-icons.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('admin_assets/plugins/toastr/toastr.min.css') }}">

    <!-- Template Main CSS File -->
    <link href="{{ asset('user_assets/css/style.css') }}" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Ninestars - v4.8.0
  * Template URL: https://bootstrapmade.com/ninestars-free-bootstrap-3-theme-for-creative/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
    <style>
        label.error {
            color: red
        }

        * {
            padding: 0;
            margin: 0;
        }

        body {
            background: #e9eaed;
            font-family: arial, sans-serif;
        }

        .field-reactions:checked:focus~.text-desc,
        .field-reactions,
        [class*=reaction-],
        .text-desc {
            clip: rect(1px, 1px, 1px, 1px);
            overflow: hidden;
            position: absolute;
            top: 0;
            left: 0;
        }

        .field-reactions:checked~[class*=reaction-],
        .box:hover [class*=reaction-],
        .field-reactions:focus~.text-desc {
            clip: auto;
            overflow: visible;
            opacity: 1;
        }

        .main-title {
            background: #3a5795;
            padding: 10px;
            color: #fff;
            text-align: center;
            font-size: 16px;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
        }

        .text-desc {
            font-weight: normal;
            text-align: center;
            transform: translateY(-50px);
            white-space: nowrap;
            font-size: 13px;
            width: 100%;
        }

        [class*=reaction-] {
            border: none;
            background-image: url(http://deividmarques.github.io/facebook-reactions-css/assets/images/facebook-reactions.png);
            background-color: transparent;
            display: block;
            cursor: pointer;
            height: 48px;
            position: absolute;
            width: 48px;
            z-index: 11;
            top: -28;
            transform-origin: 50% 100%;
            transform: scale(0.1);
            transition: all 0.3s;
            outline: none;
            will-change: transform;
            opacity: 0;
        }

        .box {
            position: absolute;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 9;
            visibility: hidden;
        }

        .field-reactions:focus~.label-reactions {
            border-color: rgba(88, 144, 255, 0.3);
        }

        .field-reactions:checked:focus~.label-reactions {
            border-color: transparent;
        }

        .label-reactions {
            background: url(https://cdn4.iconfinder.com/data/icons/facebook-likes/100/1.png) no-repeat 0 0;
            border: 2px dotted transparent;
            display: block;
            height: 100px;
            margin: 0 auto;
            width: 100px;
            color: transparent;
            cursor: pointer;
        }

        .toolbox {
            background: #fff;
            height: 52px;
            box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.08), 0 2px 2px rgba(0, 0, 0, 0.15);
            width: 300px;
            border-radius: 40px;
            top: -30px;
            left: 0;
            position: absolute;
            visibility: hidden;
            opacity: 0;
            transition: opacity 0.15s;
        }

        .legend-reaction {
            background: rgba(0, 0, 0, 0.75);
            border-radius: 10px;
            box-sizing: border-box;
            color: #fff;
            display: inline-block;
            font-size: 11px;
            text-overflow: ellipsis;
            font-weight: bold;
            line-height: 20px;
            max-width: 100%;
            opacity: 0;
            overflow: hidden;
            padding: 0 6px;
            transition: opacity 50ms ease;
            left: 50%;
            position: absolute;
            text-align: center;
            top: -28px;
            transform: translateX(-50%);
        }

        .box:hover [class*=reaction-] {
            transform: scale(0.8) translateY(-40px);
        }

        .box:hover [class*=reaction-]:hover,
        .box:hover [class*=reaction-]:focus {
            transition: all 0.2s ease-in;
            transform: scale(1) translateY(-35px);
        }

        .box:hover [class*=reaction-]:hover .legend-reaction,
        .box:hover [class*=reaction-]:focus .legend-reaction {
            opacity: 1;
        }

        .box:hover .toolbox {
            opacity: 1;
        }

        .box:hover .toolbox {
            visibility: visible;
        }

        .box:hover .reaction-love {
            transition-delay: 0.06s;
        }

        .box:hover .reaction-haha {
            transition-delay: 0.09s;
        }

        .box:hover .reaction-wow {
            transition-delay: 0.12s;
        }

        .box:hover .reaction-sad {
            transition-delay: 0.15s;
        }

        .box:hover .reaction-angry {
            transition-delay: 0.18s;
        }

        .field-reactions:checked~[class*=reaction-] {
            transform: scale(0.8) translateY(-40px);
        }

        .field-reactions:checked~[class*=reaction-]:hover,
        .field-reactions:checked~[class*=reaction-]:focus {
            transition: all 0.2s ease-in;
            transform: scale(1) translateY(-35px);
        }

        .field-reactions:checked~[class*=reaction-]:hover .legend-reaction,
        .field-reactions:checked~[class*=reaction-]:focus .legend-reaction {
            opacity: 1;
        }

        .field-reactions:checked~.toolbox {
            opacity: 1;
        }

        .field-reactions:checked~.toolbox,
        .field-reactions:checked~.overlay {
            visibility: visible;
        }

        .field-reactions:checked~.reaction-love {
            transition-delay: 0.03s;
        }

        .field-reactions:checked~.reaction-haha {
            transition-delay: 0.09s;
        }

        .field-reactions:checked~.reaction-wow {
            transition-delay: 0.12s;
        }

        .field-reactions:checked~.reaction-sad {
            transition-delay: 0.15s;
        }

        .field-reactions:checked~.reaction-angry {
            transition-delay: 0.18s;
        }

        .reaction-like {
            left: 0;
            background-position: 0 -144px;
        }

        .reaction-love {
            background-position: -48px 0;
            left: 50px;
        }

        .reaction-haha {
            background-position: -96px 0;
            left: 100px;
        }

        .reaction-wow {
            background-position: -144px 0;
            left: 150px;
        }

        .reaction-sad {
            background-position: -192px 0;
            left: 200px;
        }

        .reaction-angry {
            background-position: -240px 0;
            left: 250px;
        }
    </style>
    {{ $styles ?? '' }}
</head>

<body>

    <x-User.Header>
    </x-User.Header>
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">

        <div class="container">
            {{-- <div class="row gy-4"> --}}
            <div class="overlay-hero">
                <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
                    <h1>NUTRILOVE</h1>
                    <h2>Eat Wisely, Life Healthy, Good Body</h2>

                </div>
            </div>
            {{-- </div> --}}
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

        @if (Route::is('users.contact'))
            @isset($title)
            @endisset
        @endif

        @if (Route::is('userslist.faq'))
            @isset($title)
            @endisset
        @endif

        {{ $slot }}

    </main><!-- End #main -->

    <div class="modal fade" id="login-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="login-form">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control" placeholder="Email">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="password">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button class="btn btn-primary me-md-2" data-bs-dismiss="modal" type="button">Close</button>
                        <button class="btn btn-primary" form="login-form" type="submit">Login</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-user.footer>
    </x-user.footer>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>



    <!-- Vendor JS Files -->
    <script src="{{ asset('user_assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('user_assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('user_assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('user_assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('user_assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    {{-- <script src="{{ asset("user_assets/vendor/php-email-form/validate.js")}}"></script> --}}


    <!-- Template Main JS File -->
    <script src="{{ asset('user_assets/js/main.js') }}"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="{{ asset('admin_assets/plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('dashboard.js') }}"></script>

    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/631b049d37898912e9682442/1gcgok2e8';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();


        const showLoginModal = () => {
            var myModal = new bootstrap.Modal(document.getElementById('login-modal'))
            modalToggle = document.getElementById('login-modal') // relatedTarget
            myModal.show(modalToggle)
        }

        var addComment = $("#login-form").validate({
            submitHandler: function(form) {
                submitData(form, "/login/ajax", function(resp) {
                    location.reload()
                })
            },
            errorPlacement: function(error, element) {
                if (element.parent(".input-group").length) {
                    error.insertAfter(element.parent()); // radio/checkbox?
                } else if (element.hasClass("select2") || element.hasClass("select")) {
                    error.insertAfter(element.next("span")); // select2
                } else {
                    error.insertAfter(element); // default
                }
            }
        });
    </script>
    <!--End of Tawk.to Script-->
    {{ $script ?? '' }}

</body>

</html>
