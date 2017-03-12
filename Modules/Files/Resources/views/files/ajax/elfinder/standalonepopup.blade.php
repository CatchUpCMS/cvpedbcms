@extends('adminlte::layouts.modal')

@section('head')
	<link rel="stylesheet" type="text/css" href="{{ asset('themes/adminlte/css/jquery-ui_custom/jquery-ui.min.css') }}"/>
	<link rel="stylesheet" type="text/css" href="{{ asset('modules/files/css/elfinder.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('modules/files/css/theme.css') }}">
@endsection

@section('js')
	<script src="{{ asset('modules/files/js/elfinder.min.js') }}"></script>

	@if ($locale != 'en')
		<script src="{{ asset('modules/files/js/i18n/elfinder.'.$locale.'.js') }}"></script>
	@endif

	<script type="text/javascript" charset="utf-8">

		$().ready(function () {
			var elf = $('#elfinder_popup').elfinder({
				// set your elFinder options here
				@if ($locale != 'en')
				lang: "{{ $locale }}", // locale
				@endif
				customData: {
					_token: $('meta[name="csrf-token"]').attr('content')
				},
				url: '{{ route("elfinder.connector") }}',  // connector URL
				dialog: {width: 900, modal: true, title: 'Select a file'},
				resizable: false,
				commandsOptions: {
					getfile: {
						oncomplete: 'destroy'
					}
				},
				getFileCallback: function (file) {
					window.parent.$('#{{ $input_id }}').val(file.path);

					var modal_name = '{{ $input_id }}';
					modal_name = modal_name.replace('input_file_', 'file_');
					$('#' + modal_name).modal('hide');
				}
			}).elfinder('instance');
		});
	</script>
@endsection

@section('title')
	Choose a file
@endsection

@section('content')
	<div class="box-body no-padding">
		<div class="box box-primary">
			<div id="elfinder_popup"></div>
		</div>
	</div>
@endsection

@section('footer')
	<button type="button" class="btn btn-default pull-right" data-dismiss="modal">
		{{ trans('global.close') }}
	</button>
@endsection
