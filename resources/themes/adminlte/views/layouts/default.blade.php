<!DOCTYPE html>
<html>
	<head>
		@include('adminlte::partials.metadata')
	</head>
	<body class="hold-transition skin-blue sidebar-collapse sidebar-mini">
		<div class="wrapper">
			@include('adminlte::partials.header')
			@include('adminlte::partials.sidebar')
			<div class="content-wrapper">
				<section class="content-header">
					<h1>
						@section('title')
							{{ Widget::site_name() }}
						@show
						<small>
							@section("meta-description")
								{{ Widget::site_description() }}
							@show
						</small>
					</h1>
					<ol class="breadcrumb">
						{!! $breadcrumbs or '&nbsp;' !!}
					</ol>
				</section>
				<section class="content">
					@include('adminlte::partials.message_session')
					@yield('content')
				</section>
			</div>
			@include('adminlte::partials.footer')
			{{--    @include('adminlte::partials.config_sidebar')--}}
		</div>
		@include('adminlte::partials.js-footer')
	</body>
</html>
