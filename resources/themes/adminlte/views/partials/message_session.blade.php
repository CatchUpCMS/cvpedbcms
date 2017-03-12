@if (Session::has('message-success'))
	<div class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h4><i class="icon fa fa-check"></i> Success!</h4>
		{{ trans(Session::get('message-success')) }}
	</div>
@endif

@if (Session::has('message-error'))
	<div class="alert alert-danger alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h4><i class="icon fa fa-warning"></i> Error!</h4>
		{{ trans(Session::get('message-error')) }}
	</div>
@endif

@if (Session::has('message-warning'))
	<div class="alert alert-warning alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h4><i class="icon fa fa-warning"></i> Error!</h4>
		{{ trans(Session::get('message-warning')) }}
	</div>
@endif