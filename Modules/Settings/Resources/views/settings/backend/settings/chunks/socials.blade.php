<div class="box box-primary box-widget collapsed-box">
	<div class="box-header with-border">
		<div class="user-block">
			<button type="button" class="btn btn-box-tool"
					data-widget="collapse"><i class="fa fa-plus"></i>
			</button>
            <span class="username">
                {{ trans('settings::backend.bitbucket') }}
            </span>
		</div>
	</div>
	<div class="box-body">

		<div class="form-group form-group-default">
			<label>{{ trans('settings::backend.bitbucket_client_id') }}</label>
			<input type="text" class="form-control" name="services_bitbucket_client_id"
				   value="{{ old('services_bitbucket_client_id', $settings->get('services.bitbucket.client_id')) }}">
		</div>

		<div class="form-group form-group-default">
			<label>{{ trans('settings::backend.bitbucket_client_secret') }}</label>
			<input type="password" class="form-control" name="services_bitbucket_client_secret"
				   value="{{ old('services_bitbucket_client_secret', $settings->get('services.bitbucket.client_secret')) }}">
		</div>

	</div>
</div>

<div class="box box-primary box-widget collapsed-box">
	<div class="box-header with-border">
		<div class="user-block">
			<button type="button" class="btn btn-box-tool"
					data-widget="collapse"><i class="fa fa-plus"></i>
			</button>
            <span class="username">
                {{ trans('settings::backend.facebook') }}
            </span>
		</div>
	</div>
	<div class="box-body">

		<div class="form-group form-group-default">
			<label>{{ trans('settings::backend.facebook_client_id') }}</label>
			<input type="text" class="form-control" name="services_facebook_client_id"
				   value="{{ old('services_facebook_client_id', $settings->get('services.facebook.client_id')) }}">
		</div>

		<div class="form-group form-group-default">
			<label>{{ trans('settings::backend.facebook_client_secret') }}</label>
			<input type="password" class="form-control" name="services_facebook_client_secret"
				   value="{{ old('services_facebook_client_secret', $settings->get('services.facebook.client_secret')) }}">
		</div>

	</div>
</div>

<div class="box box-primary box-widget collapsed-box">
	<div class="box-header with-border">
		<div class="user-block">
			<button type="button" class="btn btn-box-tool"
					data-widget="collapse"><i class="fa fa-plus"></i>
			</button>
            <span class="username">
                {{ trans('settings::backend.github') }}
            </span>
		</div>
	</div>
	<div class="box-body">

		<div class="form-group form-group-default">
			<label>{{ trans('settings::backend.github_client_id') }}</label>
			<input type="text" class="form-control" name="services_github_client_id"
				   value="{{ old('services_github_client_id', $settings->get('services.github.client_id')) }}">
		</div>

		<div class="form-group form-group-default">
			<label>{{ trans('settings::backend.github_client_secret') }}</label>
			<input type="password" class="form-control" name="services_github_client_secret"
				   value="{{ old('services_github_client_secret', $settings->get('services.github.client_secret')) }}">
		</div>

	</div>
</div>

<div class="box box-primary box-widget collapsed-box">
	<div class="box-header with-border">
		<div class="user-block">
			<button type="button" class="btn btn-box-tool"
					data-widget="collapse"><i class="fa fa-plus"></i>
			</button>
            <span class="username">
                {{ trans('settings::backend.google') }}
            </span>
		</div>
	</div>
	<div class="box-body">

		<div class="form-group form-group-default">
			<label>{{ trans('settings::backend.google_client_id') }}</label>
			<input type="text" class="form-control" name="services_google_client_id"
				   value="{{ old('services_google_client_id', $settings->get('services.google.client_id')) }}">
		</div>

		<div class="form-group form-group-default">
			<label>{{ trans('settings::backend.google_client_secret') }}</label>
			<input type="password" class="form-control" name="services_google_client_secret"
				   value="{{ old('services_google_client_secret', $settings->get('services.google.client_secret')) }}">
		</div>

	</div>
</div>

<div class="box box-primary box-widget collapsed-box">
	<div class="box-header with-border">
		<div class="user-block">
			<button type="button" class="btn btn-box-tool"
					data-widget="collapse"><i class="fa fa-plus"></i>
			</button>
            <span class="username">
                {{ trans('settings::backend.linkedin') }}
            </span>
		</div>
	</div>
	<div class="box-body">

		<div class="form-group form-group-default">
			<label>{{ trans('settings::backend.linkedin_client_id') }}</label>
			<input type="text" class="form-control" name="services_linkedin_client_id"
				   value="{{ old('services_linkedin_client_id', $settings->get('services.linkedin.client_id')) }}">
		</div>

		<div class="form-group form-group-default">
			<label>{{ trans('settings::backend.linkedin_client_secret') }}</label>
			<input type="password" class="form-control" name="services_linkedin_client_secret"
				   value="{{ old('services_linkedin_client_secret', $settings->get('services.linkedin.client_secret')) }}">
		</div>

	</div>
</div>

<div class="box box-primary box-widget collapsed-box">
	<div class="box-header with-border">
		<div class="user-block">
			<button type="button" class="btn btn-box-tool"
					data-widget="collapse"><i class="fa fa-plus"></i>
			</button>
            <span class="username">
                {{ trans('settings::backend.twitter') }}
            </span>
		</div>
	</div>
	<div class="box-body">

		<div class="form-group form-group-default">
			<label>{{ trans('settings::backend.twitter_client_id') }}</label>
			<input type="text" class="form-control" name="services_twitter_client_id"
				   value="{{ old('services_twitter_client_id', $settings->get('services.twitter.client_id')) }}">
		</div>

		<div class="form-group form-group-default">
			<label>{{ trans('settings::backend.twitter_client_secret') }}</label>
			<input type="password" class="form-control" name="services_twitter_client_secret"
				   value="{{ old('services_twitter_client_secret', $settings->get('services.twitter.client_secret')) }}">
		</div>

	</div>
</div>
