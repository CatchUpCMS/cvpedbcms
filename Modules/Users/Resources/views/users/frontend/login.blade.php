@extends('lumen::layouts.default')

@section('title', trans('users::frontend.login.meta_title'))
@section('meta-description', trans('users::frontend.login.meta_description'))

@section('content')
	<div class="row">
		<div class="col-md-12">
			<h1>{{ trans('users::frontend.login.meta_title') }}</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8 col-md-offset-2 well">
			<form class="form-horizontal" role="form" method="POST" action="{{ url('login') }}">
				{!! csrf_field() !!}
				<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
					<label class="col-md-4 control-label">
						{{ trans('global.email') }}
					</label>
					<div class="col-md-6">
						<input type="email" class="form-control" name="email" value="{{ old('email') }}">
						@if ($errors->has('email'))
							<span class="help-block">
								<strong>{{ $errors->first('email') }}</strong>
							</span>
						@endif
					</div>
				</div>
				<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
					<label class="col-md-4 control-label">
						{{ trans('global.password') }}
					</label>
					<div class="col-md-6">
						<input type="password" class="form-control" name="password">
						@if ($errors->has('password'))
							<span class="help-block">
								<strong>{{ $errors->first('password') }}</strong>
							</span>
						@endif
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-6 col-md-offset-4">
						<div class="checkbox">
							<label>
								<input type="checkbox" name="remember"> {{ trans('global.remember_me') }}
							</label>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-6 col-md-offset-4">
						<button type="submit" class="btn btn-primary">
							{{ trans('global.login') }}
						</button>
						<a class="btn btn-link" href="{{ url('/password/reset') }}">
							{{ trans('users::frontend.login.forgot_password') }}
						</a>
					</div>
				</div>
			</form>
		</div>
		@if (!empty($social_login))
			<div class="col-md-8 col-md-offset-2">
				<div class="social-auth-links text-center">
					<h4>{{ trans('users::frontend.login.connect_with') }}</h4>
					@if (in_array('bitbucket', $social_login))
						<a href="{{ url('login/bitbucket') }}" class="btn btn-primary btn-social btn-bitbucket">
							<i class="fa fa-bitbucket"></i> | {{ trans('users::frontend.login.signin_bitbucket') }}
						</a>
					@endif
					@if (in_array('facebook', $social_login))
						<a href="{{ url('login/facebook') }}" class="btn btn-primary btn-social btn-facebook">
							<i class="fa fa-facebook"></i> | {{ trans('users::frontend.login.signin_facebook') }}
						</a>
					@endif
					@if (in_array('github', $social_login))
						<a href="{{ url('login/github') }}" class="btn btn-primary btn-social btn-github">
							<i class="fa fa-github"></i> | {{ trans('users::frontend.login.signin_github') }}
						</a>
					@endif
					@if (in_array('google', $social_login))
						<a href="{{ url('login/google') }}" class="btn btn-primary btn-social btn-google">
							<i class="fa fa-google-plus"></i> | {{ trans('users::frontend.login.signin_google_plus') }}
						</a>
					@endif
					@if (in_array('linkedin', $social_login))
						<a href="{{ url('login/linkedin') }}" class="btn btn-primary btn-social btn-linkedin">
							<i class="fa fa-linkedin"></i> | {{ trans('users::frontend.login.signin_linkedin') }}
						</a>
					@endif
					@if (in_array('twitter', $social_login))
						<a href="{{ url('login/twitter') }}" class="btn btn-primary btn-social btn-twitter">
							<i class="fa fa-twitter"></i> | {{ trans('users::frontend.login.signin_twitter') }}
						</a>
					@endif
				</div>
			</div>
		@endif
	</div>
@endsection
