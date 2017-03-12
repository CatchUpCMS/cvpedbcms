<div class="form-group form-group-lg p-b-60
    @if ($errors->has('DB_HOST'))
        has-error
    @endif
">
    <label for="core_db_host" class="col-xs-12 col-sm-5 col-md-4 col-lg-3 control-label">
        {{ trans('installer::installer.field_db_host_title') }}<br/>
        <span class="instruction">{{ trans('installer::installer.field_db_host_instruction') }}</span>
    </label>
    <div class="col-xs-12 col-sm-7 col-md-8 col-lg-9">
        <input type="text" class="form-control input-lg" id="core_db_host"
               placeholder="{{ trans('installer::installer.field_db_host_placeholder') }}"
               name="DB_HOST" value="{{ old('DB_HOST') }}">
        @if ($errors->has('DB_HOST'))
            <div id="core_db_host-error" class="">
                @foreach ($errors->get('DB_HOST') as $key => $error)
                    {!! trans($error) !!}
                    @if ($key < count($errors->get('DB_PASSWORD')))
                        <br/>
                    @endif
                @endforeach
            </div>
        @endif
    </div>
</div>

<div class="form-group form-group-lg p-b-60
    @if ($errors->has('DB_DATABASE'))
        has-error
    @endif
">
    <label for="core_db_database" class="col-xs-12 col-sm-5 col-md-4 col-lg-3 control-label">
        {{ trans('installer::installer.field_db_database_title') }}<br/>
        <span class="instruction">{{ trans('installer::installer.field_db_database_instruction') }}</span>
    </label>
    <div class="col-xs-12 col-sm-7 col-md-8 col-lg-9">
        <input type="text" class="form-control input-lg" id="core_db_database"
               placeholder="{{ trans('installer::installer.field_db_database_placeholder') }}"
               name="DB_DATABASE" value="{{ old('DB_DATABASE') }}">
        @if ($errors->has('DB_DATABASE'))
            <div id="core_db_database-error" class="">
                @foreach ($errors->get('DB_DATABASE') as $key => $error)
                    {!! trans($error) !!}
                    @if ($key < count($errors->get('DB_PASSWORD')))
                        <br/>
                    @endif
                @endforeach
            </div>
        @endif
    </div>
</div>

<div class="form-group form-group-lg p-b-60
    @if ($errors->has('DB_USERNAME'))
        has-error
    @endif
">
    <label for="core_db_username" class="col-xs-12 col-sm-5 col-md-4 col-lg-3 control-label">
        {{ trans('installer::installer.field_db_username_title') }}<br/>
        <span class="instruction">{{ trans('installer::installer.field_db_username_instruction') }}</span>
    </label>
    <div class="col-xs-12 col-sm-7 col-md-8 col-lg-9">
        <input type="text" class="form-control input-lg" id="core_db_username"
               placeholder="{{ trans('installer::installer.field_db_username_placeholder') }}"
               name="DB_USERNAME" value="{{ old('DB_USERNAME') }}">
        @if ($errors->has('DB_USERNAME'))
            <div id="core_db_username-error" class="">
                @foreach ($errors->get('DB_USERNAME') as $key => $error)
                    {!! trans($error) !!}
                    @if ($key < count($errors->get('DB_PASSWORD')))
                        <br/>
                    @endif
                @endforeach
            </div>
        @endif
    </div>
</div>

<div class="form-group form-group-lg p-b-60
    @if ($errors->has('DB_PASSWORD'))
        has-error
    @endif
">
    <label for="core_db_password" class="col-xs-12 col-sm-5 col-md-4 col-lg-3 control-label">
        {{ trans('installer::installer.field_db_password_title') }}<br/>
        <span class="instruction">{{ trans('installer::installer.field_db_password_instruction') }}</span>
    </label>
    <div class="col-xs-12 col-sm-7 col-md-8 col-lg-9">
        <input type="password" class="form-control input-lg" id="core_db_password"
               placeholder="{{ trans('installer::installer.field_db_password_placeholder') }}"
               name="DB_PASSWORD">
        @if ($errors->has('DB_PASSWORD'))
            <div id="core_db_password-error" class="">
                @foreach ($errors->get('DB_PASSWORD') as $key => $error)
                    {!! trans($error) !!}
                    @if ($key < count($errors->get('DB_PASSWORD')))
                        <br/>
                    @endif
                @endforeach
            </div>
        @endif
    </div>
</div>
