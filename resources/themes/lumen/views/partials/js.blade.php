<script src="{{ asset('themes/lumen/js/jquery.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" alt="{{ Session::get('lang') }}"></script>
@if (config('app.fallback_locale') !== Session::get('lang'))
	<script src="{{ asset('themes/lumen/bower/jquery-ui/ui/i18n/datepicker-' . Session::get('lang') . '.js') }}"></script>
@else
	<script>
		(function ($, W, D) {
			$.datepicker.regional["{{ Session::get('lang') }}"] = {
				closeText: 'close',
				prevText: 'prev',
				nextText: 'next',
				isRTL: false,
				currentText: "Today",
				monthNames: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December", ""],
				monthNamesShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec", ""],
				dayNames: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
				dayNamesShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
				dayNamesMin: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"],
				firstDay: 0,
				weekHeader: 'Week',
				dateFormat: 'yy-mm-dd',
				showMonthAfterYear: false,
				yearSuffix: ''
			};
			$.datepicker.setDefaults(
				$.datepicker.regional["{{ Session::get('lang') }}"]
			);
		})(jQuery, window, document);
	</script>
@endif
<script src="{{ asset('themes/lumen/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('themes/lumen/bower/select2/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('themes/lumen/js/custom.js') }}"></script>
@yield('js')
@stack('widget-scripts')
