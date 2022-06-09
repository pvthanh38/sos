<!-- BEGIN BASE JS -->
<script src="{{ asset('js/app.js') }}"></script>
<!-- END BASE JS -->

<!-- BEGIN PLUGINS JS -->
<script src="{{ asset('vendor/vncore/libs/slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- END PLUGINS JS -->

<!-- BEGIN THEME JS -->
<script src="{{ asset('vendor/vncore/js/theme.js') }}?time={{ time() }}"></script>
<!-- END THEME JS -->

@stack('scripts')