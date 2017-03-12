@extends('adminlte::layouts.default')

@section('title', trans('users::backend.meta_title'))
@section('subtitle', trans('users::backend.meta_title'))
@section('meta-description', trans('users::backend.meta_description'))

@section('head')
	<script>
		cvepdb_config.libraries.push(
				{
					script: {
						CVEPDB_FILTERS_LOADED: (cvepdb_config.url_theme + cvepdb_config.script_path + 'scripts/filters.js')
					},
					trigger: '.js-call-filters',
					mobile: true,
					browser: true
				}
		);
	</script>
@endsection

@section('js')
	<script src="{{ asset('modules/users/js/admin.users.index.js') }}"></script>
@endsection

@section('content')
	<div class="row">
		<div class="col-md-3">
			<a href="{{ route('backend.users.create') }}" class="btn btn-primary btn-block margin-bottom">
				<i class="fa fa-user-plus"></i> {{ trans('users::backend.index.btn.add_user') }}
			</a>
			@include('users::users.backend.users.chunks.index_filters', ['filters' => $filters, 'user_can_see_env' => $user_can_see_env])
		</div>
		<div class="col-md-9">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">{{ trans('users::backend.index.title') }}</h3>
					<div class="box-tools hidden-xs pull-right">
						@if ($is_role_management_allowed)
							<a href="{{ route('backend.roles.index') }}" class="btn btn-box-tool btn-box-tool-primary">
								<i class="fa fa-user-md"></i> {{ trans('users::backend.index.btn.roles') }}
							</a>
						@endif
						<a href="{{ route('backend.users.export') }}" class="btn btn-box-tool">
							<i class="fa fa-file-excel-o"></i> {{ trans('users::backend.index.btn.export') }}
						</a>
					</div>
				</div>
				<div class="js-call-filters">
					<div id="filter-stage" style="display: block;">
						@include('users::users.backend.users.chunks.index_tables', ['users' => $users, 'user_can_see_env' => $user_can_see_env])
					</div>
				</div>
			</div>
		</div>
	</div>
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
@endsection
