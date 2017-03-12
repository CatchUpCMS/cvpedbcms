@extends('adminlte::layouts.default')

@section('title', trans('users::backend.meta_title'))
@section('subtitle', trans('users::backend.meta_title'))
@section('meta-description', trans('users::backend.meta_description'))

@section('head')
	<script>
		cvepdb_config.libraries.push(
				{
					script: {
						CVEPDB_FORM_VALIDATION_LOADED: (cvepdb_config.url_theme + cvepdb_config.script_path + 'scripts/form_validation.js')
					},
					trigger: '.js-call-form_validation',
					mobile: true,
					browser: true
				},
				{
					script: {
						CVEPDB_SELECT2: (cvepdb_config.url_theme + cvepdb_config.script_path + 'scripts/select2.js')
					},
					trigger: '.js-call-select2',
					mobile: true,
					browser: true
				}
		);
	</script>
@endsection

@section('js')
	<script src="{{ asset('modules/users/js/admin.users.form.js') }}"></script>
@endsection

@section('content')
	{!! Form::open(array('route' => ['backend.users.update', $user['data']['id']], 'class' => 'forms form-horizontal js-call-form_validation', 'method' => 'PUT')) !!}
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">{{ trans('users::backend.edit.title') }}</h3>
				</div>
				<div class="box-body">
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
					@if ($user_can_see_env)
						<div class="form-group{{ $errors->has('environments') ? ' has-error' : '' }}">
							<label for="environments" class="col-md-3 control-label">{!! trans('global.environment_s') !!}</label>
							<div class="col-md-9">
								{!! Widget::field_environments(
									'environments[]',
									[
										'all' => true,
										'default' => true,
										'value' => $user['data']['environments_ids'],
										'class' => 'form-control'
									]
								) !!}
								@if ($errors->has('environments'))
									<span class="help-block">
										{{ $errors->first('environments') }}
									</span>
								@endif
							</div>
						</div>
					@endif
					<div class="form-group{{ $errors->has('roles') ? ' has-error' : '' }}">
						<label for="roles" class="col-md-3 control-label">{!! trans('global.role_s') !!}</label>
						<div class="col-md-9">
							{!! Widget::field_roles(
								'roles[]',
								[
									'all' => true,
									'default' => true,
									'value' => $user['data']['roles_ids'],
									'class' => 'form-control'
								]
							) !!}
							@if ($errors->has('roles'))
								<span class="help-block">
									{{ $errors->first('roles') }}
								</span>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="box box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">{{ trans('users::backend.create.address_form') }}</h3>
				</div>
				<div class="box-body">
					{!! Widget::field_address('primary', ['type' => 'primary', 'address' => $user['data']['addresses']['primary'], 'show_country' => true, 'show_state' => true]) !!}
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="box box-solid">
				<div class="box-body">
					<div class="pull-left">
						<a href="{{ route('backend.users.index') }}" class="btn btn-default btn-flat">
							<i class="fa fa-caret-left"></i> {{ trans('global.back') }}
						</a>
					</div>
					<div class="pull-right">
						<button class="btn btn-primary btn-flat" type="submit">
							<i class="fa fa-pencil"></i> {{ trans('users::backend.edit.btn.edit_user') }}
						</button>
					</div>
				</div>
			</div>
		</div>
	{!! Form::close() !!}
@endsection
