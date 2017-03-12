<div class="modal" id="add_folder">
	<div class="modal-dialog">
		<div class="modal-content">
			{!! Form::open(['route' => 'backend.files.settings.store', 'class' => 'forms form-horizontal js-call-form_validation']) !!}
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
				<h4 class="modal-title">{{ trans('files::backend.settings.btn.add_folder') }}</h4>
			</div>
			<div class="modal-body">

				<input type="hidden" name="driver" value="local">

				<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
					<label for="name" class="col-md-4 control-label">{!! trans('global.name') !!}</label>
					<div class="col-md-8">
						<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">
						@if ($errors->has('name'))
							<span class="help-block">
								{{ $errors->first('name') }}
							</span>
						@endif
					</div>
				</div>

				<div class="form-group{{ $errors->has('is_public') ? ' has-error' : '' }}">
					<label for="is_public" class="col-md-4 control-label">{!! trans('projects::backend.is_public') !!}</label>
					<div class="col-md-8">
						<div class="material-switch" style="padding-top: 10px;">
							<input type="checkbox"
								   name="is_public"
								   id="someSwitchOptionDefaultIsRegistrationAllowed"
								   data-init-plugin="switchery"
								   value="1"
								{{--@if ($is_registration_allowed)--}}
								{{--checked="checked"--}}
								{{--@endif--}}
							/>
							<label for="someSwitchOptionDefaultIsRegistrationAllowed" class="label-success"></label>
						</div>
						@if ($errors->has('is_public'))
							<span class="help-block">
									{{ $errors->first('is_public') }}
								</span>
						@endif
					</div>
				</div>


				<div class="clear"></div>

			</div>
			<div class="modal-footer">


				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">
					{{ trans('global.cancel') }}
				</button>


				{{--{!! Form::open(['route' => ['backend.users.destroy'], 'method' => 'delete', "class" => "js-users_multi_delete-container"]) !!}--}}
				{{--<button type="submit" class="btn btn-danger">--}}
				{{--<i class="fa fa-trash"></i> {{ trans('users::backend.index.btn.valid_delete') }}--}}
				{{--</button>--}}
				{{--{!! Form::close() !!}--}}

				<div class="pull-right">
					<button class="btn btn-primary btn-flat" type="submit">
						<i class="fa fa-plus"></i> {{ trans('projects::backend.create.btn_add_new_project') }}
					</button>
				</div>

				<div class="clear"></div>

			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>