<div class="modal modal-danger" id="delete_multiple_user">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
				<h4 class="modal-title">{{ trans('global.attention') }}</h4>
			</div>
			<div class="modal-body">
				<p>{{ trans('users::backend.index.delete_multiple.question') }}</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">
					{{ trans('users::backend.index.btn.cancel_delete') }}
				</button>
				{!! Form::open(['route' => ['backend.users.destroy_multiple'], 'method' => 'delete', "class" => "js-users_multi_delete-container"]) !!}
				<button type="submit" class="btn btn-danger">
					<i class="fa fa-trash"></i> {{ trans('users::backend.index.btn.valid_delete') }}
				</button>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>