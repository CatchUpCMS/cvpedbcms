(function ($, W, D) {
	$(D).bind('CVEPDB_READY', function () {
		cvepdb.debug('admin.form.js > CVEPDB_READY : success : Start');
		cvepdb.debug('admin.form.js > CVEPDB_READY : success : End');
	});

	$(D).bind('CVEPDB_SELECT2_READY', function () {
		cvepdb.debug('select2.js > CVEPDB_SELECT2_READY : success : Start');

		// select2 load time is too much important, to have this CSS loaded after all select2 we have to load it now
		cvepdb.headjs.loadjs({
			script: {
				CVEPDB_THEME_ADMIN_JS_LOADED: (cvepdb_config.url_theme + cvepdb_config.base_path + "select2-bootstrap-theme/dist/select2-bootstrap.min.css")
			},
			trigger: 'always',
			mobile: true,
			browser: true
		});

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

		cvepdb.debug('select2.js > CVEPDB_SELECT2_READY : success : End');
	});

	$(D).bind('CVEPDB_FORM_VALIDATION_READY', function () {
		cvepdb.debug('admin.form.js > CVEPDB_FORM_VALIDATION_READY : success : Start');

		cvepdb.fv.on_submit(function () {
			return true;
		});

		cvepdb.fv.set_rules('form.forms', {
			rules: {
				civility: {
					required: true
				},
				last_name: {
					required: true,
					maxlength: 254
				},
				first_name: {
					required: true,
					maxlength: 254
				},
				email: {
					required: true,
					email: true,
					maxlength: 254
				},
				birth_date: {}
			},
			messages: {
				civility: {
					required: cvepdb.globalize.translate('FIELD_REQUIRED')
				},
				last_name: {
					required: cvepdb.globalize.translate('FIELD_REQUIRED'),
					maxlength: cvepdb.globalize.translate('FIELD_MAXLENGTH').replace('%text%', '{0}')
				},
				first_name: {
					required: cvepdb.globalize.translate('FIELD_REQUIRED'),
					maxlength: cvepdb.globalize.translate('FIELD_MAXLENGTH').replace('%text%', '{0}')
				},
				email: {
					required: cvepdb.globalize.translate('FIELD_REQUIRED'),
					email: cvepdb.globalize.translate('FIELD_VALID_EMAIL'),
					maxlength: cvepdb.globalize.translate('FIELD_MAXLENGTH').replace('%text%', '{0}')
				},
				birth_date: {}
			},
			errorPlacement: function (error, element) {

				error.insertAfter(element);

				var current_form_group = $(element).closest(".form-group");
				current_form_group.removeClass("has-success");
				current_form_group.addClass("has-error");
			},
			errorElement: "div",
			errorClass: 'required',
			highlight: function (element) { // <-- fires when element has error
				var current_form_group = $(element).closest(".form-group");
				current_form_group.removeClass("has-success");
				current_form_group.addClass("has-error");
			},
			unhighlight: function (element) { // <-- fires when element is valid
				var current_form_group = $(element).closest(".form-group");
				current_form_group.removeClass("has-error");
				current_form_group.addClass("has-success");
			},
			success: function (element) {
				var current_form_group = element.closest(".form-group");
				current_form_group.removeClass("has-error");
				current_form_group.addClass("has-success");
			}
		});
		cvepdb.debug('admin.form.js > CVEPDB_FORM_VALIDATION_READY : success : End');
	});
})(jQuery, window, document);