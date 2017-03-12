<div class="form-group form-group-lg p-b-60
    @if ($errors->has('APP_SITE_NAME'))
        has-error
    @endif
">
    <label for="core_site_name" class="col-xs-12 col-sm-5 col-md-4 col-lg-3 control-label">
        {{ trans('installer::installer.field_core_site_name_title') }}<br/>
        <span class="instruction">{{ trans('installer::installer.field_core_site_name_instruction') }}</span>
    </label>
    <div class="col-xs-12 col-sm-7 col-md-8 col-lg-9">
        <input type="text" class="form-control input-lg" id="core_site_name"
               placeholder="{{ trans('installer::installer.field_core_site_name_placeholder') }}"
               name="APP_SITE_NAME" value="{{ old('APP_SITE_NAME') }}">
        @if ($errors->has('APP_SITE_NAME'))
            <div id="APP_SITE_NAME-error" class="">
                @foreach ($errors->get('APP_SITE_NAME') as $key => $error)
                    {!! trans($error) !!}
                    @if ($key < count($errors->get('APP_SITE_NAME')))
                        <br/>
                    @endif
                @endforeach
            </div>
        @endif
    </div>
</div>

<div class="form-group form-group-lg p-b-60
    @if ($errors->has('APP_SITE_DESCRIPTION'))
        has-error
    @endif
">
    <label for="core_site_description" class="col-xs-12 col-sm-5 col-md-4 col-lg-3 control-label">
        {{ trans('installer::installer.field_core_site_description_title') }}<br/>
        <span class="instruction">{{ trans('installer::installer.field_core_site_description_instruction') }}</span>
    </label>
    <div class="col-xs-12 col-sm-7 col-md-8 col-lg-9">
        <input type="text" class="form-control input-lg" id="core_site_description"
               placeholder="{{ trans('installer::installer.field_core_site_description_placeholder') }}"
               name="APP_SITE_DESCRIPTION" value="{{ old('APP_SITE_DESCRIPTION') }}">
        @if ($errors->has('APP_SITE_DESCRIPTION'))
            <div id="APP_SITE_DESCRIPTION-error" class="">
                @foreach ($errors->get('APP_SITE_DESCRIPTION') as $key => $error)
                    {!! trans($error) !!}
                    @if ($key < count($errors->get('APP_SITE_DESCRIPTION')))
                        <br/>
                    @endif
                @endforeach
            </div>
        @endif
    </div>
</div>

<div class="form-group form-group-lg p-b-60
    @if ($errors->has('APP_URL'))
        has-error
    @endif
">
    <label for="core_url" class="col-xs-12 col-sm-5 col-md-4 col-lg-3 control-label">
        {{ trans('installer::installer.field_core_url_title') }}<br/>
        <span class="instruction">{{ trans('installer::installer.field_core_url_instruction') }}</span>
    </label>
    <div class="col-xs-12 col-sm-7 col-md-8 col-lg-9">
        <input type="text" class="form-control input-lg" id="core_url"
               placeholder="{{ trans('installer::installer.field_core_url_placeholder') }}"
               name="APP_URL" value="{{ old('APP_URL', $core_url) }}" readonly="readonly">
        @if ($errors->has('APP_URL'))
            <div id="APP_URL-error" class="">
                @foreach ($errors->get('APP_URL') as $key => $error)
                    {!! trans($error) !!}
                    @if ($key < count($errors->get('APP_URL')))
                        <br/>
                    @endif
                @endforeach
            </div>
        @endif
    </div>
</div>

<div class="form-group form-group-lg p-b-60
    @if ($errors->has('civility'))
        has-error
    @endif
        ">
    <label for="civility" class="col-xs-12 col-sm-5 col-md-4 col-lg-3 control-label">
        {{ trans('installer::installer.field_civility_title') }}<br/>
        <span class="instruction">{{ trans('installer::installer.field_civility_instruction') }}</span>
    </label>
    <div class="col-xs-12 col-sm-7 col-md-8 col-lg-9">
        {!! Form::select('civility', $civilities, old('civility')) !!}
        @if ($errors->has('civility'))
            <div id="first_name-error" class="">
                @foreach ($errors->get('civility') as $key => $error)
                    {!! trans($error) !!}
                    @if ($key < count($errors->get('civility')))
                        <br/>
                    @endif
                @endforeach
            </div>
        @endif
    </div>
</div>

<div class="form-group form-group-lg p-b-60
    @if ($errors->has('first_name'))
        has-error
    @endif
">
    <label for="first_name" class="col-xs-12 col-sm-5 col-md-4 col-lg-3 control-label">
        {{ trans('installer::installer.field_first_name_title') }}<br/>
        <span class="instruction">{{ trans('installer::installer.field_first_name_instruction') }}</span>
    </label>
    <div class="col-xs-12 col-sm-7 col-md-8 col-lg-9">
        <input type="text" class="form-control input-lg" id="first_name"
               placeholder="{{ trans('installer::installer.field_first_name_placeholder') }}"
               name="first_name" value="{{ old('first_name') }}">
        @if ($errors->has('first_name'))
            <div id="first_name-error" class="">
                @foreach ($errors->get('first_name') as $key => $error)
                    {!! trans($error) !!}
                    @if ($key < count($errors->get('first_name')))
                        <br/>
                    @endif
                @endforeach
            </div>
        @endif
    </div>
</div>

<div class="form-group form-group-lg p-b-60
    @if ($errors->has('last_name'))
        has-error
    @endif
">
    <label for="last_name" class="col-xs-12 col-sm-5 col-md-4 col-lg-3 control-label">
        {{ trans('installer::installer.field_last_name_title') }}<br/>
        <span class="instruction">{{ trans('installer::installer.field_last_name_instruction') }}</span>
    </label>
    <div class="col-xs-12 col-sm-7 col-md-8 col-lg-9">
        <input type="text" class="form-control input-lg" id="last_name"
               placeholder="{{ trans('installer::installer.field_last_name_placeholder') }}" name="last_name"
               value="{{ old('last_name') }}">
        @if ($errors->has('last_name'))
            <div id="last_name-error" class="">
                @foreach ($errors->get('last_name') as $key => $error)
                    {!! trans($error) !!}
                    @if ($key < count($errors->get('last_name')))
                        <br/>
                    @endif
                @endforeach
            </div>
        @endif
    </div>
</div>

<div class="form-group form-group-lg p-b-60
    @if ($errors->has('email'))
        has-error
    @endif
">
    <label for="email" class="col-xs-12 col-sm-5 col-md-4 col-lg-3 control-label">
        {{ trans('installer::installer.field_email_title') }}<br/>
        <span class="instruction">{{ trans('installer::installer.field_email_instruction') }}</span>
    </label>
    <div class="col-xs-12 col-sm-7 col-md-8 col-lg-9">
        <input type="email" class="form-control input-lg" id="email"
               placeholder="{{ trans('installer::installer.field_email_placeholder') }}"
               name="email" value="{{ old('email') }}">
        @if ($errors->has('email'))
            <div id="email-error" class="">
                @foreach ($errors->get('email') as $key => $error)
                    {!! trans($error) !!}
                    @if ($key < count($errors->get('email')))
                        <br/>
                    @endif
                @endforeach
            </div>
        @endif
    </div>
</div>

<div class="form-group form-group-lg p-b-60
    @if ($errors->has('password'))
        has-error
    @endif
">
    <label for="password" class="col-xs-12 col-sm-5 col-md-4 col-lg-3 control-label">
        {{ trans('installer::installer.field_password_title') }}<br/>
        <span class="instruction">{{ trans('installer::installer.field_password_instruction') }}</span>
    </label>
    <div class="col-xs-12 col-sm-7 col-md-8 col-lg-9">
        <input type="password" class="form-control input-lg" id="password"
               placeholder="{{ trans('installer::installer.field_password_placeholder') }}"
               name="password">
        @if ($errors->has('password'))
            <div id="password-error" class="">
                @foreach ($errors->get('password') as $key => $error)
                    {!! trans($error) !!}
                    @if ($key < count($errors->get('password')))
                        <br/>
                    @endif
                @endforeach
            </div>
        @endif
    </div>
</div>

<div class="form-group form-group-lg p-b-60
    @if ($errors->has('password_confirmation'))
        has-error
    @endif
">
    <label for="password_confirmation" class="col-xs-12 col-sm-5 col-md-4 col-lg-3 control-label">
        {{ trans('installer::installer.field_confirm_password_title') }}<br/>
        <span class="instruction">{{ trans('installer::installer.field_confirm_password_instruction') }}</span>
    </label>
    <div class="col-xs-12 col-sm-7 col-md-8 col-lg-9">
        <input type="password" class="form-control input-lg" id="password_confirmation"
               placeholder="{{ trans('installer::installer.field_confirm_password_placeholder') }}"
               name="password_confirmation">
        @if ($errors->has('password_confirmation'))
            <div id="password_confirmation-error" class="">
                @foreach ($errors->get('password_confirmation') as $key => $error)
                    {!! trans($error) !!}
                    @if ($key < count($errors->get('password_confirmation')))
                        <br/>
                    @endif
                @endforeach
            </div>
        @endif
    </div>
</div>
