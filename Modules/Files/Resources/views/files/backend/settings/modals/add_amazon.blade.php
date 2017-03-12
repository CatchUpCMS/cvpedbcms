<div class="modal" id="add_amazon">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
				<h4 class="modal-title">{{ trans('files::backend.settings.btn.add_amazon') }}</h4>
			</div>
			<div class="modal-body">


				<div class="form-group form-group-default">
					<label>{{ trans('files::backend.settings.filesystems_disks_s3_key') }}</label>
					<input type="text" class="form-control" name="filesystems_disks_s3_key"
						   value="{{ old('filesystems_disks_s3_key') }}">
				</div>
				<div class="form-group form-group-default">
					<label>{{ trans('files::backend.settings.filesystems_disks_s3_secret') }}</label>
					<input type="text" class="form-control" name="filesystems_disks_s3_secret"
						   value="{{ old('filesystems_disks_s3_secret') }}">
				</div>
				<div class="form-group form-group-default">
					<label>{{ trans('files::backend.settings.filesystems_disks_s3_region') }}</label>
					{{ Form::select('filesystems_disks_s3_region', config('files.amazon.region'), old('mail_driver'), ['class' => 'form-control']) }}
				</div>
				<div class="form-group form-group-default">
					<label>{{ trans('files::backend.settings.filesystems_disks_s3_bucket') }}</label>
					<input type="text" class="form-control" name="filesystems_disks_s3_bucket"
						   value="{{ old('filesystems_disks_s3_bucket') }}">
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