@extends('lumen::layouts.default')

@section('title', trans('users::frontend.passwords.reset.meta_title'))
@section('meta-description', trans('users::frontend.passwords.reset.meta_description'))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>{{ trans('users::frontend.passwords.reset.meta_title') }}</h1>
            </div>
            <div class="col-md-8 col-md-offset-2 well">
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
                    {!! csrf_field() !!}
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label class="col-md-4 control-label">
                            {{ trans('global.email') }}
                        </label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="email" value="{{ $email or old('email') }}">
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
                                {{ trans('users::frontend.passwords.reset.btn_reset_password') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
