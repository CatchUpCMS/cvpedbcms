@push('widget-scripts')
{{--<script src="{{ asset('modules/users/js/fields/select_envs.js') }}"></script>--}}
<script>
	(function ($, W, D) {
		$(D).bind('CVEPDB_SELECT2_READY', function () {
			var select_env = $('select[name="{{ $name }}"]');

			select_env.select2({
				theme: "bootstrap",
				width: '100%',
				minimumInputLength: 0,

				placeholder: "{{ $placeholder }}"
			})
					.on("select2:select", function (e) {
						if (e.params.data.id == 0) { // All selected
							$('select[name="{{ $name }}"] > option').prop("selected", true);
							$('select[name="{{ $name }}"] > option[value="0"]').prop("selected", false);
							$('select[name="{{ $name }}"]').trigger("change");
							return false;
						}
					});

			$('.js-cancel-filters').on('click', function () {
				select_env.select2("val", "{{ $default_env }}");
			});

			if (select_env.val() == null) {
				select_env.select2("val", "{{ $default_env }}");
			}
		});
	})(jQuery, window, document);
</script>
@endpush

<?php $attributes = ['class' => $class, 'multiple' => 'multiple']; ?>

@if (!cms_is_admin())

	<?php $attributes = ['class' => $class, 'multiple' => 'multiple', 'disabled' => 'disabled']; ?>

@endif

{!! Form::select($name, $environments, $value, $attributes) !!}
