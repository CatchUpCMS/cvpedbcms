/*
 * form_validation
 */
(function ($, W, D) {
	$(D).bind('CVEPDB_SELECT2_READY', function () {
		cvepdb.debug('select2.js > CVEPDB_SELECT2_READY : success : Start');

		$('select[name="civility"]').select2({
			theme: "bootstrap",
			width: '100%',
			minimumInputLength: 0,
			minimumResultsForSearch: Infinity
		});

		cvepdb.debug('select2.js > CVEPDB_SELECT2_READY : success : End');
	});

	$(D).bind('CVEPDB_FORM_VALIDATION_READY', function () {

		cvepdb.fv.on_submit(function () {
			return true;
		});

		var field_maxlength = cvepdb.globalize.translate('FIELD_MAXLENGTH').replace('%text%', '{0}');
		var field_minlength = cvepdb.globalize.translate('FIELD_MINLENGTH').replace('%text%', '{0}');

		cvepdb.fv.set_rules(
			'.forms',
			{
				rules: {
					APP_SITE_NAME: {
						required: true,
						maxlength: 254
					},
					APP_SITE_DESCRIPTION: {
						required: true,
						maxlength: 254
					},
					APP_URL: {
						required: true,
						maxlength: 254,
						url: true
					},
					civility: {
						required: true
					},
					last_name: {
						required: true,
						maxlength: 50
					},
					first_name: {
						required: true,
						maxlength: 50
					},
					email: {
						required: true,
						maxlength: 254,
						email: true
					},
					password: {
						required: true,
						maxlength: 60,
						minlength: 6
					},
					password_confirmation: {
						equalTo: "#password"
					},
					DB_HOST: {
						required: true,
						maxlength: 254
					},
					DB_DATABASE: {
						required: true,
						maxlength: 254
					},
					DB_USERNAME: {
						required: true,
						maxlength: 254
					},
					DB_PASSWORD: {
						required: true,
						maxlength: 254
					}
				},
				messages: {
					APP_SITE_NAME: {
						required: cvepdb.globalize.translate('FIELD_REQUIRED'),
						maxlength: field_maxlength
					},
					APP_SITE_DESCRIPTION: {
						required: cvepdb.globalize.translate('FIELD_REQUIRED'),
						maxlength: field_maxlength
					},
					APP_URL: {
						required: cvepdb.globalize.translate('FIELD_REQUIRED'),
						maxlength: field_maxlength,
						url: cvepdb.globalize.translate('FIELD_VALID_URL')
					},
					civility: {
						required: cvepdb.globalize.translate('FIELD_REQUIRED')
					},
					last_name: {
						required: cvepdb.globalize.translate('FIELD_REQUIRED'),
						maxlength: field_maxlength
					},
					first_name: {
						required: cvepdb.globalize.translate('FIELD_REQUIRED'),
						maxlength: field_maxlength
					},
					email: {
						required: cvepdb.globalize.translate('FIELD_REQUIRED'),
						maxlength: field_maxlength,
						email: cvepdb.globalize.translate('FIELD_VALID_EMAIL')
					},
					password: {
						required: cvepdb.globalize.translate('FIELD_REQUIRED'),
						minlength: field_minlength,
						maxlength: field_maxlength
					},
					DB_HOST: {
						required: cvepdb.globalize.translate('FIELD_REQUIRED'),
						maxlength: field_maxlength
					},
					DB_DATABASE: {
						required: cvepdb.globalize.translate('FIELD_REQUIRED'),
						maxlength: field_maxlength
					},
					DB_USERNAME: {
						required: cvepdb.globalize.translate('FIELD_REQUIRED'),
						maxlength: field_maxlength
					},
					DB_PASSWORD: {
						required: cvepdb.globalize.translate('FIELD_REQUIRED'),
						maxlength: field_maxlength
					}
				},
				ignore: [':textarea:hidden.not(".js-call-tinymce")'],
				highlight: function (element) { // <-- fires when element has error
					$(element)
						.closest('.form-group')
						.removeClass("has-success")
						.addClass("has-error");
				},
				unhighlight: function (element) { // <-- fires when element is valid
					$(element)
						.closest('.form-group')
						.removeClass("has-error")
						.addClass("has-success");
				},
				success: function (element) {
					element
						.closest('.form-group')
						.removeClass("has-error")
						.addClass("has-success");
				},
				errorElement: "div",
				errorClass: 'required',
				errorPlacement: function (error, element) {
					element
						.closest('.form-group')
						.removeClass("has-success")
						.addClass("has-error");
					if (element.attr('type') == 'checkbox') {
						error.insertBefore(element.closest('div'));
					}
					else {
						error.insertAfter(element);
					}
				}
			}
		);
	});
})(jQuery, window, document);
