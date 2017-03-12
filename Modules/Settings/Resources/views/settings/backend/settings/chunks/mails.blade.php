<div class="form-group form-group-default">
	<label>{{ trans('settings::backend.mail_from_address') }}</label>
	<input type="text" class="form-control" name="mail_from_address" required="required"
		   value="{{ old('mail_from_address', $settings->get('mail.from.address')) }}">
</div>

<div class="form-group form-group-default">
	<label>{{ trans('settings::backend.mail_from_name') }}</label>
	<input type="text" class="form-control" name="mail_from_name" required="required"
		   value="{{ old('mail_from_name', $settings->get('mail.from.name')) }}">
</div>

<div class="form-group form-group-default">
	<label>{{ trans('settings::backend.cms_mail_mailwatch') }}</label>
	<input type="text" class="form-control" name="cms_mail_mailwatch"
		   value="{{ old('cms_mail_mailwatch', $settings->get('cms.mail.mailwatch')) }}">
</div>

<div class="box box-primary box-widget collapsed-box">
	<div class="box-header with-border">
		<div class="user-block">
			<button type="button" class="btn btn-box-tool"
					data-widget="collapse"><i class="fa fa-plus"></i>
			</button>
            <span class="username">
                {!! trans('settings::backend.mail_provider_title') !!}
            </span>
		</div>
	</div>
	<div class="box-body">

		<div class="form-group form-group-default">
			<label>{{ trans('settings::backend.mail_host') }}</label>
			<input type="text" class="form-control" name="mail_host"
				   value="{{ old('mail_host', $settings->get('mail.host')) }}">
		</div>

		<div class="form-group form-group-default">
			<label>{{ trans('settings::backend.mail_username') }}</label>
			<input type="text" class="form-control" name="mail_username"
				   value="{{ old('mail_username', $settings->get('mail.username')) }}">
		</div>

		<div class="form-group form-group-default">
			<label>{{ trans('settings::backend.mail_password') }}</label>
			<input type="password" class="form-control" name="mail_password"
				   value="{{ old('mail_password', $settings->get('mail.password')) }}">
		</div>

		<div class="form-group form-group-default">
			<label>{{ trans('settings::backend.mail_driver') }}</label>
			{{ Form::select('mail_driver', ['smtp' => 'SMTP'], old('mail_driver', $settings->get('mail.driver')), ['class' => 'form-control']) }}
		</div>

		<div class="form-group form-group-default">
			<label>{{ trans('settings::backend.mail_port') }}</label>
			<input type="text" class="form-control" name="mail_port"
				   value="{{ old('mail_port', $settings->get('mail.port')) }}">
		</div>

		<div class="form-group form-group-default">
			<label>{{ trans('settings::backend.mail_encryption') }}</label>
			{{ Form::select('mail_encryption', ['' => 'No encryption','tls' => 'TLS'], old('mail_encryption', $settings->get('mail.encryption')), ['class' => 'form-control']) }}
		</div>

	</div>
</div>
