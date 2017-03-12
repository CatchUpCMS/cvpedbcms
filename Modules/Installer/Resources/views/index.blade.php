@extends('installer::layouts.default')

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
	<script src="{{ asset('modules/installer/js/form_validation.js') }}"></script>
@endsection

@section('content')
	{!! Form::open(array('route' => 'installer.store', 'class' => 'forms js-call-form_validation')) !!}
	<div class="callout callout-info">
		<h4>{{ trans('installer::installer.intro_title') }}</h4>
		<p>{!! trans('installer::installer.intro_descritpion') !!}</p>
	</div>
	<div class="callout callout-warning">
		<p>{!! trans('installer::installer.intro_important_note') !!}</p>
	</div>
	@if (count($errors) > 0 && $errors->has('db_connection'))
		<div class="callout callout-danger">
			<h4>{{ trans('global.error') }}</h4>
			@foreach ($errors->get('db_connection') as $error)
				<p>{{ trans($error) }}</p>
			@endforeach

		</div>
	@endif
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">{{ trans('installer::installer.field_section_information') }}</h3>
		</div>
		<div class="box-body">
			@include('installer::chunks.section_information')
		</div>
	</div>
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">{{ trans('installer::installer.field_section_database') }}</h3>
		</div>
		<div class="box-body">
			@include('installer::chunks.section_database')
		</div>
	</div>
	<div class="box box-primary">
		<div class="box-footer">
			<a href="{{ url('installer') }}" class="btn btn-default">{{ trans('installer::installer.btn_cancel') }}</a>
			<button type="submit" class="btn btn-info pull-right">{{ trans('installer::installer.btn_install') }}</button>
		</div>
	</div>
	{!! Form::close() !!}
@endsection
