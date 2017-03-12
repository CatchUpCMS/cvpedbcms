@push('widget-scripts')
<script>
	$(document).on("hidden.bs.modal", '#file_{{ $name }}', function (e) {
		$(e.target).removeData("bs.modal").find(".modal-content").empty();
	});
</script>
@endpush

<div class="input-group">
	<div class="input-group-btn">
		<a data-toggle="modal"
		   href="{{ url('files/ajax/popup/input_file_' . $name) }}"
		   data-target="#file_{{ $name }}"
		   class="btn btn-primary">
			Choose file
		</a>
	</div>
	<input type="text" id="input_file_{{ $name }}" name="{{ $name }}" value="{{ $value }}" class="form-control {{ $class }}">
</div>
<div class="modal modal-default" id="file_{{ $name }}">
	<div class="modal-dialog" style="width:90%;">
		<div class="modal-content"></div>
	</div>
</div>
