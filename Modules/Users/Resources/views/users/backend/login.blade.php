@extends('adminlte::layouts.auth')

@section('title', trans('users::frontend.login.meta_title'))
@section('meta-description', trans('users::frontend.login.meta_description'))

@section('content')
	<p class="login-box-msg">{{ trans('adminlte::adminlte.auth_introduction') }}</p>
	<form action="{{ url('backend/login') }}" method="post">
		{!! csrf_field() !!}
		<div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
			<input type="email" class="form-control" name="email" value="{{ old('email') }}"
				   placeholder="{{ trans('adminlte::adminlte.auth_placeholder_email') }}">
			<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
			@if ($errors->has('email'))
				<span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
			@endif
		</div>
		<div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
			<input type="password" class="form-control" name="password"
				   placeholder="{{ trans('adminlte::adminlte.auth_placeholder_password') }}">
			<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			@if ($errors->has('password'))
				<span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
			@endif
		</div>
		<div class="row">
			<div class="col-xs-8">
				<div class="checkbox icheck">
					<label>
						<input type="checkbox" name="remember"> {{ trans('adminlte::adminlte.auth_label_rememberme') }}
					</label>
				</div>
			</div>
			<div class="col-xs-4">
				<button type="submit" class="btn btn-primary btn-block btn-flat">
					{{ trans('adminlte::adminlte.auth_btn_login') }}
				</button>
			</div>
		</div>
	</form>
@endsection

@section('social')
	@if (!empty($social_login))
		<div class="social-auth-links text-center">
			<p>- OR -</p>
			@if (in_array('bitbucket', $social_login))
				<a href="{{ url('login/bitbucket') }}" class="btn btn-block btn-social btn-bitbucket">
					<span class="fa fa-bitbucket"></span> {{ trans('users::frontend.login.signin_bitbucket') }}
				</a>
			@endif
			@if (in_array('facebook', $social_login))
				<a href="{{ url('login/facebook') }}" class="btn btn-block btn-social btn-facebook">
					<span class="fa fa-facebook"></span> {{ trans('users::frontend.login.signin_facebook') }}
				</a>
			@endif
			@if (in_array('github', $social_login))
				<a href="{{ url('login/github') }}" class="btn btn-block btn-social btn-github">
					<span class="fa fa-github"></span> {{ trans('users::frontend.login.signin_github') }}
				</a>
			@endif
			@if (in_array('google', $social_login))
				<a href="{{ url('login/google') }}" class="btn btn-block btn-social btn-google">
					<span class="fa fa-google-plus"></span> {{ trans('users::frontend.login.signin_google_plus') }}
					Google+
				</a>
			@endif
			@if (in_array('linkedin', $social_login))
				<a href="{{ url('login/linkedin') }}" class="btn btn-block btn-social btn-linkedin">
					<span class="fa fa-linkedin"></span> {{ trans('users::frontend.login.signin_linkedin') }}
				</a>
			@endif
			@if (in_array('twitter', $social_login))
				<a href="{{ url('login/twitter') }}" class="btn btn-block btn-social btn-twitter">
					<span class="fa fa-twitter"></span> {{ trans('users::frontend.login.signin_twitter') }}
				</a>
			@endif
		</div>
	@endif
@endsection

@section('help')
	<hr>
	<a href="{{ url('password/reset') }}">
		I forgot my password
	</a>
	<br>
	@if ($is_registration_allowed)
		<a href="{{ url('register') }}" class="text-center">
			Register a new membership
		</a>
	@endif
@endsection
