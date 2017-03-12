@push('widget-scripts')
<script src="{{ asset('assets/js/core.settings.js') }}"></script>
<script src="{{ asset('themes/adminlte/bower/jquery-throttle-debounce/jquery.ba-throttle-debounce.min.js') }}"></script>
<script>
    (function ($, W, D) {
        function set_my_setting(key, $input) {
            $.cms.settings.set(
                    key,
                    $input.val(),
                    function () { // success
                        $input.removeClass('ui-autocomplete-loading')
                                .closest('.form-group')
                                .removeClass('has-warning')
                                .removeClass('has-error')
                                .addClass('has-success');
                    },
                    function () { // error
                        $input.removeClass('ui-autocomplete-loading')
                                .closest('.form-group')
                                .removeClass('has-success')
                                .removeClass('has-warning')
                                .addClass('has-error');
                    },
                    function () { // complete
                    },
                    function () { // beforeSend
                        $input.addClass('ui-autocomplete-loading')
                                .closest('.form-group')
                                .removeClass('has-success')
                                .removeClass('has-error')
                                .addClass('has-warning');
                    });
        }

        $('input[name="APP_SITE_NAME"]').on('keyup', $.debounce(500, function () {
            set_my_setting('APP_SITE_NAME', $(this));
        }));

        $('input[name="APP_SITE_DESCRIPTION"]').on('keyup', $.debounce(500, function () {
            set_my_setting('APP_SITE_DESCRIPTION', $(this));
        }));

        $('input[name="APP_CONTACT_MAIL"]').on('keyup', $.debounce(500, function () {
            set_my_setting('APP_CONTACT_MAIL', $(this));
        }));

        $('input[name="APP_CONTACT_DISPLAY_NAME"]').on('keyup', $.debounce(500, function () {
            set_my_setting('APP_CONTACT_DISPLAY_NAME', $(this));
        }));

    })(jQuery, window, document);
</script>
@endpush
<aside class="control-sidebar control-sidebar-dark">
    {!! $settings['menu'] !!}
    <div class="tab-content">
        @foreach ($settings['modules'] as $slug => $modules)
            <div class="tab-pane" id="control-sidebar-{{ $slug }}-tab">
                <div class="box box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ $modules['title'] }}</h3>
                        <div class="box-tools hidden-xs pull-right">
                            <a href="javascript:void(0);" class="btn btn-box-tool btn-box-tool-primary"
                               data-toggle="control-sidebar">
                                <i class="fa fa-times"></i> {{ trans('adminlte::adminlte.settings:close') }}
                            </a>
                        </div>
                    </div>
                    <div class="box-body">
                        @foreach ($modules['widgets'] as $widget)
                            {!! Widget::get($widget) !!}
                        @endforeach
                    </div>
                    <div class="box-footer">
                        <div class="box-tools hidden-xs pull-left">

                        </div>
                        <div class="pull-right">
                            {{--<a href="javascript:void(0);" class="btn btn-primary btn-flat">--}}
                            {{--<i class="fa fa-save"></i> {{ trans('adminlte::adminlte.settings:save') }}--}}
                            {{--</a>--}}
                            <a href="javascript:void(0);" class="btn btn-box-tool btn-box-tool-primary"
                               data-toggle="control-sidebar">
                                <i class="fa fa-times"></i> {{ trans('adminlte::adminlte.settings:close') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="tab-pane active" id="control-sidebar-settings-tab">
            <div class="box box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('adminlte::adminlte.settings:title') }}</h3>
                    <div class="box-tools hidden-xs pull-right">
                        <a href="javascript:void(0);" class="btn btn-box-tool btn-box-tool-primary"
                           data-toggle="control-sidebar">
                            <i class="fa fa-times"></i> {{ trans('adminlte::adminlte.settings:close') }}
                        </a>
                    </div>
                </div>
                <div class="box-body forms">


                    <div class="form-group form-group-default has-success">
                        <label>{{ trans('settings.APP_SITE_NAME') }}</label>
                        <input type="text" class="form-control" name="APP_SITE_NAME" required="required"
                               value="{{ $settings['list']['APP_SITE_NAME'] }}">
                    </div>


                    <div class="form-group form-group-default has-success">
                        <label>{{ trans('settings.APP_SITE_DESCRIPTION') }}</label>
                        <input type="text" class="form-control" name="APP_SITE_DESCRIPTION" required="required"
                               value="{{ $settings['list']['APP_SITE_DESCRIPTION'] }}">
                    </div>

                    <div class="form-group form-group-default has-success">
                        <label>{{ trans('settings.APP_CONTACT_MAIL') }}</label>
                        <input type="text" class="form-control" name="APP_CONTACT_MAIL" required="required"
                               value="{{ $settings['list']['APP_CONTACT_MAIL'] }}">
                    </div>

                    <div class="form-group form-group-default has-success">
                        <label>{{ trans('settings.APP_CONTACT_DISPLAY_NAME') }}</label>
                        <input type="text" class="form-control" name="APP_CONTACT_DISPLAY_NAME" required="required"
                               value="{{ $settings['list']['APP_CONTACT_DISPLAY_NAME'] }}">
                    </div>


                </div>
                <div class="box-footer">
                    <div class="box-tools hidden-xs pull-left">

                    </div>
                    <div class="pull-right">
                        {{--<a href="javascript:void(0);" class="btn btn-primary btn-flat">--}}
                        {{--<i class="fa fa-save"></i> {{ trans('adminlte::adminlte.settings:save') }}--}}
                        {{--</a>--}}
                        <a href="javascript:void(0);" class="btn btn-box-tool btn-box-tool-primary"
                           data-toggle="control-sidebar">
                            <i class="fa fa-times"></i> {{ trans('adminlte::adminlte.settings:close') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</aside>
<div class="control-sidebar-bg"></div>
