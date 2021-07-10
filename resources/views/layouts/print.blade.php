<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @stack('plugins')

    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />

    @stack('styles')
</head>
<body style="background-color: #fff;">

@yield('content')

<script src="{{ asset('js/app.js') }}"></script>
@stack('scripts')
</body>
</html>
