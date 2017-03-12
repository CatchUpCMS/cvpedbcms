@extends('adminlte::layouts.default')

@section('title', trans('users::settings.meta_title'))
@section('meta-description', trans('users::settings.meta_description'))

@section('content')
	<div class="row">
		<div class="col-md-12">
			@if (count($errors) > 0)
				<div class="alert alert-danger" role="alert">
					<p class="pull-left">
						{{ count($errors) > 1 ? trans('global.errors') : trans('global.error') }}
					</p>
					<div class="clearfix"></div>
					@foreach ($errors->all() as $error)
						<br>
						<p>{{ trans($error) }}</p>
					@endforeach
				</div>
			@endif
			{!! Form::open(['route' => 'backend.users.settings.store', 'class' => 'forms js-call-form_validation']) !!}
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
					<li class="active">
						<a href="#control-sidebar-general-tab" data-toggle="tab">
							<i class="fa fa-gear"></i> {{ trans('global.general') }}
						</a>
					</li>
					<li>
						<a href="#control-sidebar-socials-tab" data-toggle="tab">
							<i class="fa fa-share-square-o"></i> {{ trans('users::settings.tabs.socials_title') }}
						</a>
					</li>
					<li>
						<a href="#control-sidebar-dashboard-tab" data-toggle="tab">
							<i class="fa fa-dashboard"></i> {{ trans('global.dashboard') }}
						</a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="control-sidebar-general-tab">
						<div class="form-group form-group-default">
							<label>{{ trans('users::settings.allow_registration') }}</label>
							<div class="material-switch pull-right" style="padding-top: 10px;">
								<input type="checkbox"
									   name="is_registration_allowed"
									   id="someSwitchOptionDefaultIsRegistrationAllowed"
									   data-init-plugin="switchery"
									   value="1"
									   	@if ($is_registration_allowed)
									   		checked="checked"
										@endif
								/>
								<label for="someSwitchOptionDefaultIsRegistrationAllowed" class="label-success"></label>
							</div>
						</div>
						<div class="form-group form-group-default">
							<label>{{ trans('users::settings.allow_role_management') }}</label>
							<div class="material-switch pull-right" style="padding-top: 10px;">
								<input type="checkbox"
									   name="is_role_management_allowed"
									   id="someSwitchOptionDefaultIsRoleManagementAllowed"
									   data-init-plugin="switchery"
									   value="1"
									   @if ($is_role_management_allowed)
									   checked="checked"
										@endif
								/>
								<label for="someSwitchOptionDefaultIsRoleManagementAllowed" class="label-success"></label>
							</div>
						</div>
					</div>
					<div class="tab-pane" id="control-sidebar-socials-tab">
						<div class="form-group form-group-default">
							<label>{{ trans('users::settings.switch_bitbucket_login') }}</label>
							<div class="material-switch pull-right" style="padding-top: 10px;">
								<input type="checkbox"
									   name="social_login[]"
									   id="someSwitchOptionDefaultBitbucket"
									   data-init-plugin="switchery"
									   value="bitbucket"
									   	@if (in_array('bitbucket', $social_login))
									   		checked="checked"
										@endif
								/>
								<label for="someSwitchOptionDefaultBitbucket" class="label-success"></label>
							</div>
						</div>
						<div class="form-group form-group-default">
							<label>{{ trans('users::settings.switch_facebook_login') }}</label>
							<div class="material-switch pull-right" style="padding-top: 10px;">
								<input type="checkbox"
									   name="social_login[]"
									   id="someSwitchOptionDefaultFacebook"
									   data-init-plugin="switchery"
									   value="facebook"
									   	@if (in_array('facebook', $social_login))
									   		checked="checked"
										@endif
								/>
								<label for="someSwitchOptionDefaultFacebook" class="label-success"></label>
							</div>
						</div>
						<div class="form-group form-group-default">
							<label>{{ trans('users::settings.switch_github_login') }}</label>
							<div class="material-switch pull-right" style="padding-top: 10px;">
								<input type="checkbox"
									   name="social_login[]"
									   id="someSwitchOptionDefaultGithub"
									   data-init-plugin="switchery"
									   value="github"
									   	@if (in_array('github', $social_login))
									   		checked="checked"
										@endif
								/>
								<label for="someSwitchOptionDefaultGithub" class="label-success"></label>
							</div>
						</div>
						<div class="form-group form-group-default">
							<label>{{ trans('users::settings.switch_google_login') }}</label>
							<div class="material-switch pull-right" style="padding-top: 10px;">
								<input type="checkbox"
									   name="social_login[]"
									   id="someSwitchOptionDefaultGoogle"
									   data-init-plugin="switchery"
									   value="google"
									   	@if (in_array('google', $social_login))
									   		checked="checked"
										@endif
								/>
								<label for="someSwitchOptionDefaultGoogle" class="label-success"></label>
							</div>
						</div>
						<div class="form-group form-group-default">
							<label>{{ trans('users::settings.switch_linkedin_login') }}</label>
							<div class="material-switch pull-right" style="padding-top: 10px;">
								<input type="checkbox"
									   name="social_login[]"
									   id="someSwitchOptionDefaultLinkedin"
									   data-init-plugin="switchery"
									   value="linkedin"
									   	@if (in_array('linkedin', $social_login))
									   		checked="checked"
										@endif
								/>
								<label for="someSwitchOptionDefaultLinkedin" class="label-success"></label>
							</div>
						</div>
						<div class="form-group form-group-default">
							<label>{{ trans('users::settings.switch_twitter_login') }}</label>
							<div class="material-switch pull-right" style="padding-top: 10px;">
								<input type="checkbox"
									   name="social_login[]"
									   id="someSwitchOptionDefaultTwitter"
									   data-init-plugin="switchery"
									   value="twitter"
									   	@if (in_array('twitter', $social_login))
									   		checked="checked"
										@endif
								/>
								<label for="someSwitchOptionDefaultTwitter" class="label-success"></label>
							</div>
						</div>
					</div>
					<div class="tab-pane" id="control-sidebar-dashboard-tab">
						<div class="row">
							@foreach ($widgets as $widget)
								<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
									<div class="box box-primary box-widget collapsed-box">
										<div class="box-header with-border">
											<div class="user-block">
												<button type="button"
														class="btn btn-box-tool"
														data-widget="collapse">
													<i class="fa fa-plus"></i>
												</button>
                                        <span class="username">
                                            {!! Widget::get($widget['name'], ['info'])['title'] !!}
                                        </span>
											</div>
											<div class="box-tools">
												<div class="material-switch pull-right" style="padding-top: 10px;">
													<input type="checkbox"
														   name="widgets[]"
														   id="someSwitchOptionDefault{{ $widget['name'] }}"
														   data-init-plugin="switchery" value="{{ $widget['name'] }}"
														   	@if (\cms\Domain\Dashboard\Settings\Repositories\SettingsRepository::DASHBOARD_WIDGET_STATUS_ACTIVE === $widget['status'])
														   		checked="checked"
															@endif
													/>
													<label for="someSwitchOptionDefault{{ $widget['name'] }}" class="label-success"></label>
												</div>
											</div>
										</div>
										<div class="box-body">
											{{ trans('global.module') }} : {{ $widget['module'] }}<br/>
											{{ trans('global.description') }} : {!! Widget::get($widget['name'], ['info'])['description'] !!}
										</div>
									</div>
								</div>
							@endforeach
						</div>
					</div>
				</div>
				<div class="box-footer clearfix">
					<div class="pull-left">
						<a href="{{ URL::current() }}" class="btn btn-default btn-flat">
							<i class="fa fa-cancel"></i> {{ trans('global.cancel') }}
						</a>
					</div>
					<div class="pull-right">
						<button class="btn btn-primary btn-flat" type="submit">
							<i class="fa fa-pencil"></i> {{ trans('users::settings.btn.edit') }}
						</button>
					</div>
				</div>
			</div>
			{!! Form::close() !!}
		</div>
	</div>
@endsection
