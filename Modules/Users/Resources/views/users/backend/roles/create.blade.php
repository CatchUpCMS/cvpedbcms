@extends('adminlte::layouts.default')

@section('title', trans('users::roles.meta_title'))
@section('subtitle', trans('users::roles.meta_title'))
@section('meta-description', trans('users::roles.meta_description'))

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
	<script src="{{ asset('modules/users/js/admin.roles.form.js') }}"></script>
@endsection

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">{{ trans('users::roles.create.title') }}</h3>
				</div>
				{!! Form::open(['route' => 'backend.roles.store', 'class' => 'forms form-horizontal js-call-form_validation']) !!}
				<div class="box-body">

						<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
							<label for="name" class="col-md-3 control-label">{!! trans('global.name') !!}</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="display_name" required="required"
									   value="{{ old('display_name') }}" placeholder="{{ trans('global.name') }}">
								<input type="hidden" class="form-control" name="name" value="{{ old('name') }}">
								@if ($errors->has('name'))
									<span class="help-block">
										{{ $errors->first('name') }}
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
											'value' => [],
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

						<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
							<label for="environments" class="col-md-3 control-label">{!! trans('users::roles.create.description') !!}</label>
							<div class="col-md-9">
								<textarea id="description" class="js-call-tinymce" name="description"
										  placeholder="{{ trans('users::roles.description') }}">
									{{ old('description') }}
								</textarea>
								@if ($errors->has('description'))
									<span class="help-block">
										{{ $errors->first('description') }}
									</span>
								@endif
							</div>
						</div>

					<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
						<label for="permissions" class="col-md-3 control-label">{!! trans('global.permission_s') !!}</label>
						<div class="col-md-9">
							@if ($permissions->count())
								@foreach ($permissions as $permission)
									<div class="box box-widget collapsed-box">
										<div class="box-header with-border">
											<div class="user-block">

												<button type="button" class="btn btn-box-tool" data-widget="collapse">
													<i class="fa fa-plus"></i>
												</button>

												<span class="username">{!! trans($permission->display_name) !!}</span>
											</div>
											<div class="box-tools">
												<div class="material-switch pull-right" style="padding-top: 10px;">
													<input type="checkbox" name="role_permission_id[]" id="someSwitchOptionDefault{{ $permission->id }}"
														   data-init-plugin="switchery" value="{{ $permission->id }}"/>
													<label for="someSwitchOptionDefault{{ $permission->id }}" class="label-success"></label>
												</div>
											</div>
										</div>
										<div class="box-body">
											{!! trans($permission->description) !!}
										</div>
									</div>
								@endforeach
							@else
								<div class="alert alert-info" role="alert">
									Il n'y a aucune permission
								</div>
							@endif
						</div>
					</div>

				</div>
				<div class="box-footer clearfix">
					<div class="pull-left">
						<a href="{{ route('backend.roles.index') }}" class="btn btn-default btn-flat">
							<i class="fa fa-caret-left"></i> {{ trans('global.back') }}
						</a>
					</div>
					<div class="pull-right">
						<button class="btn btn-primary btn-flat" type="submit">
							<i class="fa fa-plus"></i> {{ trans('users::roles.create.btn.add_role') }}
						</button>
					</div>
				</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
@endsection