<title>
Hello world
</title>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<link rel="stylesheet" href="{{ asset('themes/lumen/css/bootstrap.min.css') }}" media="screen">
<link rel="stylesheet" href="{{ asset('themes/lumen/css/custom.min.css') }}">
<link rel="stylesheet" href="{{ asset('themes/lumen/bower/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('themes/lumen/bower/select2-bootstrap-theme/dist/select2-bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('themes/lumen/bower/components-font-awesome/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
<style>
    .table .cell-center,
    .table-bordered .cell-center {
        text-align: center;
        vertical-align: middle;
    }

    .table tr:hover td,
    .table-bordered tr:hover td {
        background-color: #CEE3F6;
    }

    .btn-social {
        margin: 5px;
    }
</style>
<!--[if lt IE 9]>
<script src="{{ asset('themes/lumen/bower/html5shiv/dist/html5shiv.min.js') }}"></script>
<script src="{{ asset('themes/lumen/bower/respond/dest/respond.min.js') }}"></script>
<![endif]-->
@yield('head')
