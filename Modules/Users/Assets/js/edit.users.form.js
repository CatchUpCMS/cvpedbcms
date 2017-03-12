(function ($, W, D) {
	$(D).ready(function () {
		$('select[name="civility"]').select2({
			theme: "bootstrap",
			width: '100%',
			minimumInputLength: 0,
			minimumResultsForSearch: Infinity
		});
		$('input[name="birth_date"]').datepicker({
			yearRange: "-75:+0",
			minDate: null,
			changeMonth: true,
			changeYear: true
		});
	});
})(jQuery, window, document);
