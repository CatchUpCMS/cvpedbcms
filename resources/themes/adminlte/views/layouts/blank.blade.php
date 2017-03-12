<!DOCTYPE html>
<html>
	<head>
		@include('adminlte::partials.metadata')
	</head>
	<body class="hold-transition skin-blue sidebar-collapse sidebar-mini">
		<div class="wrapper">
			@include('adminlte::partials.message_session')
			@yield('content')
		</div>
		@include('adminlte::partials.js-footer')
	</body>
</html>
