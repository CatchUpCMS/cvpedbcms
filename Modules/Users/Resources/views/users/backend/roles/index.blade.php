@extends('adminlte::layouts.default')

@section('title', trans('users::roles.meta_title'))
@section('subtitle', trans('users::roles.meta_title'))
@section('meta-description', trans('users::roles.meta_description'))

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">{{ trans('users::roles.index.title') }}</h3>
					<div class="box-tools hidden-xs pull-right">
						<a href="{{ route('backend.roles.create') }}" class="btn btn-box-tool btn-box-tool-primary">
							<i class="fa fa-plus"></i> {{ trans('users::roles.index.btn.add_role') }}
						</a>
					</div>
				</div>
				@if (count($roles['data']))
					<div class="box-body no-padding">
						<table class="table table-bordered">
							<tbody>
								<tr>
									<th class="cell-center">{!! trans('users::roles.index.tab.name') !!}</th>
									<th class="cell-center">{!! trans('users::roles.index.tab.description') !!}</th>
									@if ($user_can_see_env)
										<th class="cell-center">{!! trans('global.environment_s') !!}</th>
									@endif
									<th class="hidden-xs cell-center" width="20%">{{ trans('global.actions') }}</th>
								</tr>
								@foreach ($roles['data'] as $role)
									<tr>
										<td class="cell-center">
											{!! trans($role['display_name']) !!}
										</td>
										<td class="">
											{!! trans($role['description']) !!}
										</td>
										@if ($user_can_see_env)
											<td class="">
												@foreach ($role['environments'] as $i => $env)
													@if (0 < $i)
														,
													@endif

													{!! trans($env['name']) !!}

												@endforeach
											</td>
										@endif
										<td class="hidden-xs cell-center">

											@if ($role['unchangeable'])
												{{ trans('global.unchangeable') }}
											@else
												<a href="{{ route('backend.roles.edit', ['id' => $role['id']]) }}"
												   class="btn btn-warning btn-flat btn-mobile">
													<i class="fa fa-pencil"></i> {{ trans('global.edit') }}
												</a>
												<button type="button" class="btn btn-danger btn-flat btn-mobile"
														data-toggle="modal"
														data-target="#delete_user_{{ $role['id'] }}">
													<i
															class="fa fa-trash"></i>
													{{ trans('global.remove') }}
												</button>
											@endif
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					<div class="box-footer clearfix">
						<div class="pull-left">
							<a href="{{ route('backend.users.index') }}" class="btn btn-default btn-flat">
								<i class="fa fa-caret-left"></i> {{ trans('users::roles.index.btn.back_user_panel') }}
							</a>
						</div>
						{!! adminlte_pagination(
							$roles['meta']['pagination']['count'],
							$roles['meta']['pagination']['total'],
							$roles['meta']['pagination']['current_page'],
							$roles['meta']['pagination']['per_page']
						) !!}
					</div>
				@else
					<div class="box-body">
						<div class="callout callout-info" role="alert">
							<h4>
								<i class="icon fa fa-info"></i> {{ trans('users::roles.index.no_data.title') }}
							</h4>
							<p>{{ trans('users::roles.index.no_data.description') }}</p>
						</div>
					</div>
					<div class="box-footer clearfix">
						<div class="pull-left">
							<a href="{{ url('admin/users') }}" class="btn btn-default btn-flat">
								<i class="fa fa-caret-left"></i> {{ trans('global.back') }}
							</a>
						</div>
					</div>
				@endif
			</div>
		</div>
	</div>
	@foreach ($roles['data'] as $role)
		@if (!$role['unchangeable'])
			<div class="modal modal-danger" id="delete_user_{{ $role['id'] }}">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
							<h4 class="modal-title">{{ trans('global.attention') }}</h4>
						</div>
						<div class="modal-body">
							<p>{{ sprintf(trans('users::roles.index.delete.question'), $role['display_name']) }}</p>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default pull-left" data-dismiss="modal">
								{{ trans('users::roles.index.btn.cancel_delete') }}
							</button>
							{!! Form::open(['route' => ['backend.roles.destroy', $role['id']], 'method' => 'delete']) !!}
							<button type="submit" class="btn btn-danger">
								<i class="fa fa-trash"></i> {{ trans('users::roles.index.btn.valid_delete') }}
							</button>
							{!! Form::close() !!}
						</div>
					</div>
				</div>
			</div>
		@endif
	@endforeach
@endsection
