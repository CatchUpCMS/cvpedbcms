@extends('adminlte::layouts.blank')

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

		var FileBrowserDialogue = {
			init: function () {
				// Here goes your code for setting your custom things onLoad.
			},
			mySubmit: function (URL) {
				// pass selected file path to TinyMCE
				parent.tinymce.activeEditor.windowManager.getParams().setUrl(URL);

				// close popup window
				parent.tinymce.activeEditor.windowManager.close();
			}
		};

		$().ready(function () {
			var elf = $('#elfinder').elfinder({
				// set your elFinder options here
				@if ($locale != 'en')
				lang: "{{ $locale }}", // locale
				@endif
				customData: {
					_token: $('meta[name="csrf-token"]').attr('content')
				},
				url: '{{ route("elfinder.connector") }}',  // connector URL
				getFileCallback: function (file) { // editor callback
					FileBrowserDialogue.mySubmit(file.url); // pass selected file path to TinyMCE
				}
			}).elfinder('instance');
		});
	</script>
@endsection

@section('content')
	<div id="elfinder"></div>
@endsection
