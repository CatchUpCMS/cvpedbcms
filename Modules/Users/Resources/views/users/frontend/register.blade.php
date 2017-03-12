@extends('lumen::layouts.default')

@section('title', trans('users::frontend.register.meta_title'))
@section('meta-description', trans('users::frontend.register.meta_description'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>{{ trans('users::frontend.register.meta_title') }}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2 well">
            @if (isset($provider))
                <div class="alert alert-info">
                    {{ sprintf(trans('users::frontend.register.social_registration'), ucfirst($provider)) }}
                </div>
            @endif
            <form class="form-horizontal" role="form" method="POST"
                  action="{{ url(isset($uri) ? $uri : '/register') }}">
                {!! csrf_field() !!}

                <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">
                        {{ trans('global.first_name') }}
                    </label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}">
                        @if ($errors->has('first_name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('first_name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">
                        {{ trans('global.last_name') }}
                    </label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}">
                        @if ($errors->has('last_name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('last_name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">
                        {{ trans('global.email') }}
                    </label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="email" value="{{ old('email') }}">
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
                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">
                        {{ trans('global.confirm_password') }}
                    </label>
                    <div class="col-md-6">
                        <input type="password" class="form-control" name="password_confirmation">
                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            {{ trans('users::frontend.register.btn_register') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
        @if (!isset($provider) && !empty($social_login))
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
