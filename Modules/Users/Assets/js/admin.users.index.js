(function ($, D, W) {

	_users = {

		checkboxes_counter: 0,
		$filter_stage: $('#filter-stage'),
		multi_delete_checkbox: '.js-users_multi_delete',
		$multi_delete_form: $('.js-users_multi_delete-container'),
		$multi_delete_btn: $('.js-btn-users_multi_delete'),

		setup: function () {
			_users.$filter_stage.on('change', _users.multi_delete_checkbox, function () {

				var current_value = $(this).val();

				if ($(this).is(':checked')) {
					_users.checkboxes_counter++;
					_users.$multi_delete_form.append(
						'<input type="hidden" class="js-users_multi_delete-'
						+ current_value
						+ '" value="' + current_value + '" name="users_multi_destroy[]" />'
					);
				}
				else {
					_users.checkboxes_counter--;
					_users.$multi_delete_form.find('.js-users_multi_delete-' + current_value).remove();
				}

				if (_users.checkboxes_counter > 0) {
					_users.$multi_delete_btn.attr('disabled', false).removeClass('disabled');
				}
				else {
					_users.$multi_delete_btn.attr('disabled', true).addClass('disabled');
				}
			});
		},

		reset: function () {
			_users.checkboxes_counter = 0;
			_users.$multi_delete_form = $('.js-users_multi_delete-container');
			_users.$multi_delete_btn = $('.js-btn-users_multi_delete');
			_users.$multi_delete_form.find('input[class^="js-users_multi_delete-"]').remove();
			_users.$multi_delete_btn.attr('disabled', true).addClass('disabled');
		}
	};

	$(D).bind('CVEPDB_SELECT2_READY', function () {

		var select_trashed = $('select[name="trashed"]');

		select_trashed.select2({
			theme: "bootstrap",
			width: '100%',
			minimumResultsForSearch: Infinity
		});
		$('.js-cancel-filters').on('click', function () {
			select_trashed.select2("val", "");
		});
	});

	$(D).bind('CVEPDB_READY', function () {
		_users.setup();
		// Open filters form
		if ((window.location.href).indexOf('?') != -1) {
			var queryString = (window.location.href).substr((window.location.href).indexOf('?') + 1);
			var getElements = (queryString.split('&'));
			$.each(getElements, function (i, val) {
				var value = (val.split('='));
				var elemName = value[0];
				var elemValue = decodeURIComponent(value[1]);
				if (elemName != 'page' && elemName != 'f_module' && elemValue != '' && elemValue != null) {
					$('#filters .box').removeClass('collapsed-box')
						.find('.box-tools button i')
						.removeClass('fa-plus')
						.addClass('fa-minus');
				}
			});
		}

		//$('input[type="checkbox"]').iCheck({
		//    checkboxClass: 'icheckbox_square-blue',
		//    radioClass: 'iradio_square-blue',
		//    increaseArea: '20%'
		//});
	});

	$(D).bind('CVEPDB_FILTERS_DOFILTER_START', function () {
		$('.overlay').removeClass('hidden');
	});

	$(D).bind('CVEPDB_FILTERS_DOFILTER_END', function () {
		_users.reset();
		$('.overlay').addClass('hidden');
	});

	$(D).bind('CVEPDB_FILTERS_READY', function () {
		cvepdb.filter.display_get_filters = true;
		cvepdb.filter.startup_load_filters = false;
		cvepdb.filter.init();
	});

	$('#filters').find("button[data-widget='collapse']").click();

})(jQuery, document, window);