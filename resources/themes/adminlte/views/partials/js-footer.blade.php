<script src="{{ asset('themes/adminlte/bower/jquery/dist/jquery.min.js') }}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script src="{{ asset('themes/adminlte/bower/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('themes/adminlte/bower/headjs/dist/1.0.0/head.load.min.js') }}"></script>
<script src="{{ asset('themes/adminlte/bower/cvepdbjs/cvepdb.js') }}"></script>
@yield('js')