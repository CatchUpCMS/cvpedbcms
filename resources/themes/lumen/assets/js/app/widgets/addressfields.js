(function ($, W, D) {
	$(D).ready(function () {

		input_substates = $('select[name="primary_address_substate_id"]');

		if (input_substates.length) {

			var substates_zip = null;

			input_substates.select2({
				theme: "bootstrap",
				width: '100%',
				placeholder: "",
				minimumInputLength: 0,
				minimumResultsForSearch: 1,
				ajax: {
					url: '/ajax/addresses/substates',
					dataType: 'json',
					delay: 250,
					data: function (params) {
						return {
							search_term: params.term,
							page: params.page,
							country_id: input_substates.attr('data-country_id'),
							state_id: input_substates.attr('data-state_id')
						};
					},
					processResults: function (data, params) {
						params.page = params.page || 1;
						return {
							results: data
						};
					},
					cache: true
				},
				escapeMarkup: function (markup) {
					return markup;
				},
				templateSelection: function (repo) {
					substates_old_zip = substates_zip;
					substates_zip = repo.iso_3166_alpha_2;
					return repo.name || repo.text;
				},
				templateResult: function (repo) {
					return repo.name;
				}
			})
				.on("change", function (e) {
					var zipcode = $('input[name="primary_address_zip"]');
					zipcode.val('');
				});
		}

		input_states = $('select[name="primary_address_state_id"]');

		if (input_states.length) {

			input_states.select2({
				theme: "bootstrap",
				width: '100%',
				placeholder: "",
				minimumInputLength: 0,
				minimumResultsForSearch: Infinity,
				ajax: {
					url: '/ajax/addresses/states',
					dataType: 'json',
					delay: 250,
					data: function (params) {
						return {
							search_term: params.term,
							page: params.page,
							country_id: input_states.attr('data-country_id')
						};
					},
					processResults: function (data, params) {
						params.page = params.page || 1;
						return {
							results: data
						};
					},
					cache: true
				},
				escapeMarkup: function (markup) {
					return markup;
				},
				templateSelection: function (repo) {
					return repo.name || repo.text;
				},
				templateResult: function (repo) {
					return repo.name;
				}
			})
				.on("change", function (e) {
					input_substates.attr('data-state_id', this.value);
					input_substates.empty();
					input_substates.trigger('change.select2');
				});
		}


		input_countries = $('select[name="primary_address_country_id"]');

		if (input_countries.length) {

			input_countries.select2({
				theme: "bootstrap",
				width: '100%',
				placeholder: "",
				minimumInputLength: 0,
				minimumResultsForSearch: 1
			})
				.on("change", function (e) {
					input_substates.attr('data-country_id', this.value);
					input_substates.empty();
					input_substates.trigger('change.select2');
					input_states.attr('data-country_id', this.value);
					input_states.empty();
					input_states.trigger('change.select2');
				});
		}


		var selected_id = input_substates.attr('data-value');

		if ("" != selected_id) {
			$.ajax({
				url: '/ajax/addresses/substates',
				data: {
					substate_id: selected_id,
					country_id: input_substates.attr('data-country_id')
				},
				dataType: "json"
			})
				.then(function (json) {
					var item = json[0];
					// Create the DOM option that is pre-selected by default
					var option = new Option(item.name, item.id, true, true);
					// Append it to the select
					input_substates.append(option);
					input_substates.trigger('change.select2');
				});
		}


		selected_id = input_states.attr('data-value');

		if ("" != selected_id) {
			$.ajax({
				url: '/ajax/addresses/states',
				data: {
					state_id: selected_id
				},
				dataType: "json"
			})
				.then(function (json) {
					var item = json[0];
					// Create the DOM option that is pre-selected by default
					var option = new Option(item.name, item.id, true, true);
					// Append it to the select
					input_states.append(option);
					input_states.trigger('change.select2');
				});


		}
	});
})(jQuery, window, document);