<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h4 style="color: #E6E6E6;">{{ trans('files::setupfiles.inactive_w_title') }}</h4>


    </div>
</div>
<script>
    cvepdb_config.libraries.push(
            {
                script: {
                    CVEPDB_THEME_ADMIN_JS_LOADED: ('{{ asset('modules/files/js/files.settings.js') }}')
                },
                trigger: 'always',
                mobile: true,
                browser: true
            });
</script>
