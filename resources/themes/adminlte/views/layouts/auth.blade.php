<!DOCTYPE html>
<html>
	<head>
		@include('adminlte::partials.metadata')
		<link rel="stylesheet" href="{{ asset('themes/adminlte/bower/iCheck/skins/square/blue.css') }}">
	</head>
	<body class="hold-transition login-page">
		<div class="login-box">
			<div class="login-logo">
				<a href="{{ url('admin') }}">{!! trans('adminlte::adminlte.auth_title') !!}</a>
			</div>
			<div class="login-box-body">
				@yield('content')
				@yield('social')
				@yield('help')
			</div>
		</div>
		@include('adminlte::partials.js-footer')
		<script src="{{ asset('themes/adminlte/bower/iCheck/icheck.min.js') }}"></script>
		<script>$(function () {
				$('input[type="checkbox"]').iCheck({
					checkboxClass: 'icheckbox_square-blue',
					radioClass: 'iradio_square-blue',
					increaseArea: '20%'
				});
			});</script>
	</body>
</html>
