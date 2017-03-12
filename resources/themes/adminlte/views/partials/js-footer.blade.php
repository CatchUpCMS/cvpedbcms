<script src="{{ asset('themes/adminlte/bower/jquery/dist/jquery.min.js') }}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ajaxStart(function() { Pace.restart(); });
</script>
<script src="{{ asset('themes/adminlte/bower/jquery-ui/jquery-ui.min.js') }}"></script>
@if (config('app.fallback_locale') !== Session::get('lang'))
	<script src="{{ asset('themes/adminlte/bower/jquery-ui/ui/i18n/datepicker-' . Session::get('lang') . '.js') }}"></script>
@endif
<script src="{{ asset('themes/adminlte/bower/iCheck/icheck.min.js') }}"></script>
<script src="{{ asset('themes/adminlte/bower/headjs/dist/1.0.0/head.load.min.js') }}"></script>
<script src="{{ asset('themes/adminlte/bower/cvepdbjs/cvepdb.js') }}"></script>
@yield('js')
@stack('widget-scripts')
