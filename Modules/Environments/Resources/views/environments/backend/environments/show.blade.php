@extends('adminlte::layouts.modal')

@section('title')
	{{ $environment->name }} <small>({{ $environment->reference }})</small>
@endsection

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
				}
		);
	</script>
@endsection

@section('js')
	<script src="{{ asset('assets/js/environments/show.js') }}"></script>
@endsection

@section('before')
	{!! Form::open(['route' => ['backend.environments.update', $environment['id']], 'class' => 'forms js-call-form_validation', 'method' => 'PUT']) !!}
@endsection

@section('content')
	<div class="box-body no-padding">
		<div class="form-group form-group-default">
			<label>{{ trans('global.name') }}</label>
			<input type="text" class="form-control" name="name" required="required"
				   value="{{ $environment['name'] }}" placeholder="{{ trans('global.name') }}">
		</div>
		<div class="form-group form-group-default">
			<label>{{ trans('global.reference') }}</label>
			<input type="text" class="form-control"
				   name="reference"
				   required="required" readonly="readonly"
				   value="{{ $environment['reference'] }}" placeholder="{{ trans('global.reference') }}">
		</div>
		<div class="form-group form-group-default">
			<label>{{ trans('global.domain') }}</label>
			<input type="text" class="form-control" name="domain" required="required"
				   value="{{ $environment['domain'] }}" placeholder="{{ trans('global.domain') }}">
		</div>
	</div>
@endsection

@section('footer')
	<button type="button" class="btn btn-default pull-left" data-dismiss="modal">
		{{ trans('global.cancel') }}
	</button>
	<button type="submit" class="btn btn-primary pull-right">
		<i class="fa fa-pencil"></i> {{ trans('environments/backend.index.modal.update.btn.edit') }}
	</button>
@endsection

@section('after')
	{!! Form::close() !!}
@endsection
