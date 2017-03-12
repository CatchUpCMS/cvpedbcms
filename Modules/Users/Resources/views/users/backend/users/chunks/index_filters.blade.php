<div id="filters">
	{!! Form::open(['route' => ['backend.users.index'], 'method' => 'GET', "class" => "hidden-xs"]) !!}
	<div class="box box-solid">
		<div class="box-header with-border">
			<div>
				<i class="fa fa-filter"></i> {{ trans('global.filters') }}
			</div>
		</div>
		<div class="box-body">
			<input type="hidden" name="f_module" class="form-control" value="users">
			<div class="form-group form-group-default">
				<label for="name">{{ trans('users::backend.index.tab.full_name') }}</label>
				<input type="text" name="name" class="form-control"
					   value="{{ old('name', $filters['name']) }}">
			</div>
			<div class="form-group form-group-default">
				<label for="email">{{ trans('global.email') }}</label>
				<input type="text" name="email" class="form-control"
					   value="{{ old('email', $filters['email']) }}">
			</div>
			<div class="form-group form-group-default">
				<label for="roles">{{ trans('global.role_s') }}</label>
				{!! Widget::field_roles(
					'roles[]',
					[
						'all' => true,
						'value' => $filters['roles'],
						'placeholder' => '',
						'class' => 'form-control'
					]
				) !!}
			</div>
			@if ($user_can_see_env)
				<div class="form-group form-group-default">
					<label for="environments">{{ trans('global.environment_s') }}</label>
					{!! Widget::field_environments(
						'environments[]',
						[
							'all' => true,
							'value' => $filters['environments'],
							'placeholder' => '',
							'class' => 'form-control'
						]
					) !!}
				</div>
			@endif
			<div class="form-group form-group-default">
				<label for="status">{{ trans('global.status') }}</label>
				<small class="label pull-right bg-red">does not work</small>
				{!! Form::select('trashed',
				 ['' => 'Active users', 'with_trashed' => 'With trashed', 'only_trashed' => 'Only trashed'],
				 '',
				 ['class' => 'form-control js-call-select2', 'style' => 'border-radius:0px;']) !!}
			</div>
		</div>
		<div class="box-footer">
			<div class="text-center">
				<a href="javascript:void(0);" class="btn btn-default btn-flat btn-xs cancel js-cancel-filters">
					{{ trans('users::backend.index.btn.reset_filters') }}
				</a>
			</div>
		</div>
	</div>
	{!! Form::close() !!}
</div>
