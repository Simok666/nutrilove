<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> {{ empty($title) ? '' : $title . ' | ' }} {{ config('app.name') }} </title>

    <link rel="stylesheet" href="{{ asset('admin_assets/dist/assets/css/bootstrap.css') }}">

    <link rel="stylesheet"
        href="{{ asset('admin_assets/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_assets/dist/assets/css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('admin_assets/dist/assets/images/favicon.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('admin_assets/dist/assets/vendors/simple-datatables/style.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_assets/plugins/sweetalert2/bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_assets/plugins/toastr/toastr.min.css') }}">
    <style>
        label.error{
            color:red;
            text-transform: capitalize;
        }

        .modal-content{
            /* overflow: auto!important */
        }
    </style>
    {{ $styles ?? '' }}
</head>

<body>
    <div id="app">
        <x-admin.navbar>

        </x-admin.navbar>

        <div id="main">
            
            <x-admin.header>

            </x-admin.header>

            <div class="main-content container-fluid">
                @isset($title)
                    <div class="page-title">
                        <div class="row">
                            <div class="col-md-6">
                                <h3>{{ $title }}</h3>
                            </div>
                            @isset( $buttons )
                            <div class="col-md-6" style="text-align-last: right;">
                                {{ $buttons }}
                            </div>
                            @endisset
                        </div>
                    </div>
                @endisset

                {{ $slot }}
                
            </div>

            <x-admin.footer>

            </x-admin.footer>
        </div>
    </div>
    <script src="{{ asset('admin_assets/dist/assets/js/feather-icons/feather.min.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="{{ asset('admin_assets/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('admin_assets/dist/assets/js/app.js') }}"></script>
    <script src="{{ asset('admin_assets/dist/assets/js/main.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/jquery.validate.min.js') }}"></script>
    <script src="//cdn.ckeditor.com/4.4.7/standard/ckeditor.js"></script>
    <script src="{{ asset('dashboard.js') }}"></script>


    
    {{ $scripts ?? '' }}
    
</body>

</html>
