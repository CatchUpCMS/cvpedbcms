<div class="modal" id="add_dropbox">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
				<h4 class="modal-title">{{ trans('files::backend.settings.btn.add_dropbox') }}</h4>
			</div>
			<div class="modal-body">


				<div class="form-group form-group-default">
					<label>{{ trans('files::backend.settings.filesystems_disks_dropbox_appSecret') }}</label>
					<input type="text" class="form-control" name="filesystems_disks_dropbox_appSecret"
						   value="{{ old('filesystems_disks_dropbox_appSecret') }}">
				</div>
				<div class="form-group form-group-default">
					<label>{{ trans('files::backend.settings.filesystems_disks_dropbox_accessToken') }}</label>
					<input type="text" class="form-control" name="filesystems_disks_dropbox_accessToken"
						   value="{{ old('filesystems_disks_dropbox_accessToken') }}">
				</div>


			</div>
			<div class="modal-footer">


				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">
					{{ trans('global.cancel') }}
				</button>


				{!! Form::open(['route' => ['backend.users.destroy_multiple'], 'method' => 'delete', "class" => "js-users_multi_delete-container"]) !!}
				<button type="submit" class="btn btn-danger">
					<i class="fa fa-trash"></i> {{ trans('users::admin.index.btn.valid_delete') }}
				</button>
				{!! Form::close() !!}


			</div>
		</div>
	</div>
</div>