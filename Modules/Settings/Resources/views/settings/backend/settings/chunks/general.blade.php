<div class="form-group form-group-default">
	<label>{{ trans('settings::backend.cms_site_name') }}</label>
	<input type="text" class="form-control" name="cms_site_name" required="required"
		   value="{{ old('cms_site_name', $settings->get('cms.site.name')) }}">
</div>

<div class="form-group form-group-default">
	<label>{{ trans('settings::backend.cms_site_description') }}</label>
	<input type="text" class="form-control" name="cms_site_description" required="required"
		   value="{{ old('cms_site_description', $settings->get('cms.site.description')) }}">
</div>

{{--<div class="form-group form-group-default">--}}
	{{--<label>{{ trans('settings::backend.cms_site_logo') }}</label>--}}

	{{--{!! Widget::files_fields(--}}
			{{--'cms_site_logo', [--}}
                {{--'value' => $settings->get('cms.site.logo'),--}}
                {{--'old_value' => old('cms_site_logo'),--}}
                {{--'placeholder' => '',--}}
                {{--'class' => '',--}}
            {{--]) !!}--}}

{{--</div>--}}

{{--<div class="form-group form-group-default">--}}
	{{--<label>{{ trans('settings::backend.cms_site_favico') }}</label>--}}

	{{--{!! Widget::files_fields(--}}
			{{--'cms_site_favico', [--}}
                {{--'value' => $settings->get('cms.site.favico'),--}}
                {{--'old_value' => old('cms_site_favico'),--}}
                {{--'placeholder' => '',--}}
                {{--'class' => '',--}}
            {{--]) !!}--}}

{{--</div>--}}
