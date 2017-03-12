@extends('lumen::layouts.default')

@section('title', sprintf(trans('users::frontend.edit.meta_title'), $user['data']['full_name']))
@section('meta-description', trans('users::frontend.edit.meta_description'))

@section('head')
	<style>
		.select2-container--bootstrap .select2-selection {
			display: block !important;
			width: 100% !important;
			height: 38px !important;
			padding: 7px 12px !important;
			font-size: 14px !important;
			line-height: 1.42857143 !important;
			color: #555555 !important;
			background-color: #ffffff !important;
			background-image: none !important;
			border: 1px solid #e7e7e7 !important;
			border-radius: 4px !important;
			-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075) !important;
			box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075) !important;
			-webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s !important;
			-o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s !important;
			transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s !important;
		}
	</style>
@endsection

@section('js')
	<script src="{{ asset('modules/users/js/edit.users.form.js') }}"></script>
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="page-header" id="banner" style="min-height: 150px;">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12">
							<h1 class="box-title">{{ trans('users::frontend.edit.title') }}</h1>
						</div>
					</div>
				</div>
				{!! Form::open(['route' => ['users.update-my-profile'], 'class' => 'forms form-horizontal js-call-form_validation well', 'method' => 'PUT']) !!}
				<div class="form-group{{ $errors->has('civility') ? ' has-error' : '' }}">
					<label for="civility" class="col-md-3 control-label">{!! trans('global.civility') !!}</label>
					<div class="col-md-9">
						{!! Form::select('civility', $civilities, old('civility', $user['data']['civility'])) !!}
						@if ($errors->has('civility'))
							<span class="help-block">
									{{ $errors->first('civility') }}
								</span>
						@endif
					</div>
				</div>
				<div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
					<label for="last_name" class="col-md-3 control-label">{!! trans('global.last_name') !!}</label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="last_name" value="{{ old('last_name', $user['data']['last_name']) }}">
						@if ($errors->has('last_name'))
							<span class="help-block">
									{{ $errors->first('last_name') }}
								</span>
						@endif
					</div>
				</div>
				<div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
					<label for="first_name" class="col-md-3 control-label">{!! trans('global.first_name') !!}</label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="first_name" value="{{ old('first_name', $user['data']['first_name']) }}">
						@if ($errors->has('first_name'))
							<span class="help-block">
									{{ $errors->first('first_name') }}
								</span>
						@endif
					</div>
				</div>
				<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
					<label for="email" class="col-md-3 control-label">{!! trans('global.email') !!}</label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="email" value="{{ old('email', $user['data']['email']) }}">
						@if ($errors->has('email'))
							<span class="help-block">
									{{ $errors->first('email') }}
								</span>
						@endif
					</div>
				</div>
				<div class="form-group{{ $errors->has('birth_date') ? ' has-error' : '' }}">
					<label for="birth_date" class="col-md-3 control-label">{!! trans('global.birth_date') !!}</label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="birth_date" value="{{ old('birth_date', $user['data']['birth_date']) }}">
						@if ($errors->has('birth_date'))
							<span class="help-block">
									{{ $errors->first('birth_date') }}
								</span>
						@endif
					</div>
				</div>
				<hr>
				{!! Widget::field_address('primary', ['type' => 'primary', 'address' => $user['data']['addresses']['primary'], 'show_country' => true, 'show_state' => true]) !!}
				<hr>
				<div class="clearfix">
					<div class="pull-left">
						<a href="{{ url('users/my-profile') }}" class="btn btn-default">
							<i class="fa fa-caret-left"></i> {{ trans('global.back') }}
						</a>
					</div>
					<div class="pull-right">
						<button class="btn btn-primary" type="submit">
							<i class="fa fa-edit"></i> {{ trans('users::frontend.edit.btn.edit_user') }}
						</button>
					</div>
				</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
@endsection
