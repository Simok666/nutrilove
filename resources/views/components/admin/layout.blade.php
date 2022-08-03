<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> {{ empty($title) ? '' : $title . ' | ' }} {{ config('app.name') }} </title>

    <link rel="stylesheet" href="{{ asset('admin_assets/dist/assets/css/bootstrap.css') }}">

    <link rel="stylesheet"
        href="{{ asset('admin_assets/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_assets/dist/assets/css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('admin_assets/dist/assets/images/favicon.svg') }}" type="image/x-icon">

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
                            <div class="col-12 col-md-6">
                                <h3>{{ $title }}</h3>
                            </div>
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
    <script src="{{ asset('admin_assets/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('admin_assets/dist/assets/js/app.js') }}"></script>
    <script src="{{ asset('admin_assets/dist/assets/js/main.js') }}"></script>

    {{ $scripts ?? '' }}
</body>

</html>
