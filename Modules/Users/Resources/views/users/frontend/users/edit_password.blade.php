@extends('lumen::layouts.default')

@section('title', trans('users::frontend.passwords.change.meta_title'))
@section('meta-description', trans('users::frontend.passwords.change.meta_description'))

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="page-header" id="banner" style="min-height: 150px;">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12">
							<h1>{!! trans('users::frontend.passwords.change.meta_title') !!}</h1>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				{!! Form::open(['route' => ['users.update-my-password'], 'class' => 'forms form-horizontal js-call-form_validation well', 'method' => 'PUT']) !!}
				<div class="form-group{{ $errors->has('old_password') ? ' has-error' : '' }}">
					<label class="col-md-4 control-label">
						{{ trans('users::frontend.passwords.change.old_password') }}
					</label>
					<div class="col-md-6">
						<input type="password" class="form-control" name="old_password">
						@if ($errors->has('old_password'))
							<span class="help-block">
								<strong>{{ $errors->first('old_password') }}</strong>
							</span>
						@endif
					</div>
				</div>
				<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
					<label class="col-md-4 control-label">
						{{ trans('users::frontend.passwords.change.password') }}
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
						{{ trans('users::frontend.passwords.change.password_confirmation') }}
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
				<hr>
				<div class="clearfix">
					<div class="pull-left">
						<a href="{{ url('users/my-profile') }}" class="btn btn-default">
							<i class="fa fa-caret-left"></i> {{ trans('global.back') }}
						</a>
					</div>
					<div class="pull-right">
						<button class="btn btn-primary" type="submit">
							<i class="fa fa-edit"></i> {{ trans('users::frontend.passwords.change.btn_edit_password') }}
						</button>
					</div>
				</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
@endsection
