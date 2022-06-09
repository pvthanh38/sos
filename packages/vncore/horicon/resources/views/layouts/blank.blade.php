<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- End Required meta tags -->

    <!-- Begin SEO tag -->
    <title>@yield('title')</title>
    <!-- End SEO tag -->

    <!-- FAVICONS -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('tevi/assets/apple-touch-icon.png') }}">
    <link rel="shortcut icon" href="{{ asset('tevi/assets/favicon.ico') }}">
    <meta name="theme-color" content="#3063A0">
    <!-- End FAVICONS -->

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @stack('styles')
</head>

<body>
    @yield('content')

    <!-- BEGIN BASE JS -->
    <script src="{{ asset('tevi/vendor/jquery/jquery.min.js') }}"></script>
    <!-- END BASE JS -->
    @stack('scripts')
</body>
</html>
