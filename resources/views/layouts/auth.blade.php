<!DOCTYPE html>
<html>
<head lang="en">
    <title>@yield('title'){{ env('APP_NAME') }}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="image/png" href="{{ asset('lemon.png') }}">

    <link href="{{ asset('assets/fonts/feather-font/css/iconfont.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" />

    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets/js/spinner.js') }}"></script>
</head>
<body>

<div class="main-wrapper" id="app">
    <div class="page-wrapper full-page">
        <div class="page-content d-flex align-items-center justify-content-center">

            <div class="row w-100 mx-0 auth-page">
                <div class="col-md-8 col-xl-6 mx-auto">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('assets/plugins/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('assets/js/template.js') }}"></script>

</body>
</html>
