<!-- BEGIN BASE STYLES -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/vncore/libs/tailwind/tailwind.min.css') }}" rel="stylesheet">
<!-- END BASE STYLES -->

<!-- BEGIN ICONS -->
<link href="{{ asset('vendor/vncore/libs/fontawesome/css/all.min.css') }}" rel="stylesheet">
<!-- END ICONS -->

<!-- BEGIN THEME -->
<link href="{{ asset('vendor/vncore/css/theme.css') }}?time={{ time() }}" rel="stylesheet">
<!-- END THEME -->

@stack('styles')