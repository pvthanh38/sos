<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- End Required meta tags -->

    <!-- Begin SEO tag -->
    <link rel="shortcut icon" href="{{ asset('vendor/vncore/favicon.ico') }}">
    <title>@yield('title')</title>
    <meta name="robots" content="noindex">
    <!-- End SEO tag -->

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('horicon::layouts.shared.styles')
</head>

<body>
    <div class="wrapper">
        <div class="content-page">
            <div class="content">
                @include('horicon::layouts.includes.top_bar')
                @include('horicon::layouts.includes.top_nav')
                <div class="container-fluid p-4">@yield('content')</div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="text-center">
            2022 © COLAB SOS P.1
        </div>
    </footer>

    @include('horicon::layouts.shared.scripts')
</body>
</html>
