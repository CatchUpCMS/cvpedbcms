@if (count($users))
	<div class="box-body no-padding">
		<div class="overlay hidden">
			<i class="fa fa-refresh fa-spin"></i>
		</div>
		<table class="table table-bordered">
			<tbody>
				<tr>
					<th class="hidden-xs cell-center" width="5%">
						<button type="button"
								class="btn btn-danger btn-flat btn-mobile disabled js-btn-users_multi_delete"
								data-toggle="modal" data-target="#delete_multiple_user"
								disabled="disabled">
							<i class="fa fa-trash"></i>
						</button>
					</th>
					<th class="cell-center">{{ trans('users::backend.index.tab.full_name') }}</th>
					<th class="cell-center">{{ trans('global.email') }}</th>
					<th class="hidden-xs cell-center" width="20%">{{ trans('global.actions') }}</th>
				</tr>
				@foreach ($users['data'] as $user)
					<tr @if (!is_null($user['deleted_at']))style="background-color:#f39c12;"@endif>
						<td class="hidden-xs cell-center" width="5%">
							<input type="checkbox" class="js-users_multi_delete"
								   value="{{ $user['id'] }}">
						</td>
						<td class="cell-center">
							@if (is_null($user['deleted_at']))
								<a data-toggle="modal" href="{{ route('backend.users.show', ['id' => $user['id']]) }}"
								   data-target="#user_show_{{ $user['id'] }}">
									{{ $user['full_name'] }}
								</a>
							@else
								{{ $user['full_name'] }}
							@endif
						</td>
						<td class="cell-center">
							@if (is_null($user['deleted_at']))
								<a href="mailto:{{ $user['email'] }}">{{ $user['email'] }}</a>
							@else
								{{ $user['email'] }}
							@endif
						</td>
						<td class="hidden-xs cell-center">
							@if (is_null($user['deleted_at']))
								<a href="{{ route('backend.users.edit', ['id' => $user['id']]) }}"
								   class="btn btn-warning btn-flat btn-mobile btn-sm">
									<i class="fa fa-edit"></i> {{ trans('global.edit') }}
								</a>
								<button type="button" class="btn btn-danger btn-flat btn-mobile btn-sm"
										data-toggle="modal"
										data-target="#delete_user_{{ $user['id'] }}">
									<i
											class="fa fa-trash"></i>
									{{ trans('global.remove') }}
								</button>
							@else
								<button type="button" class="btn btn-warning btn-flat btn-mobile"
										data-toggle="modal"
										data-target="#re-active_user_{{ $user['id'] }}">
									<i class="fa fa-play-circle-o"></i>
									{{ trans('global.re-active') }}
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
			{{ trans('users::backend.index.total_users') }} {{ $nb_users }}
		</div>
		{!! adminlte_pagination(
			$users['meta']['pagination']['count'],
			$users['meta']['pagination']['total'],
			$users['meta']['pagination']['current_page'],
			$users['meta']['pagination']['per_page']
		) !!}
	</div>
@else
	<div class="box-body">

		<div class="overlay hidden">
			<i class="fa fa-refresh fa-spin"></i>
		</div>

		<div class="callout callout-info" role="alert">
			<h4>
				<i class="icon fa fa-info"></i> {{ trans('users::backend.index.no_data.title') }}
			</h4>

			<p>{{ trans('users::backend.index.no_data.description') }}</p>
		</div>
	</div>
@endif

@foreach ($users['data'] as $user)
	@if (is_null($user['deleted_at']))
		<div class="modal modal-danger" id="delete_user_{{ $user['id'] }}">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
						<h4 class="modal-title">{{ trans('global.attention') }}</h4>
					</div>
					<div class="modal-body">
						<p>{{ trans('users::backend.index.delete.question') }} {{ $user['full_name'] }}
							?</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default pull-left" data-dismiss="modal">
							{{ trans('users::backend.index.btn.cancel_delete') }}
						</button>
						{!! Form::open(['route' => ['backend.users.destroy', $user['id']], 'method' => 'delete']) !!}
						<button type="submit" class="btn btn-danger">
							<i class="fa fa-trash"></i> {{ trans('users::backend.index.btn.valid_delete') }}
						</button>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
		<div class="modal modal-default" id="user_show_{{ $user['id'] }}">
			<div class="modal-dialog">
				<div class="modal-content">
				</div>
			</div>
		</div>
	@else
		<div class="modal modal-warning" id="re-active_user_{{ $user['id'] }}">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
						<h4 class="modal-title">{{ trans('global.attention') }}</h4>
					</div>
					<div class="modal-body">
						<p>{{ trans('users::backend.index.re-active.question') }} {{ $user['full_name'] }}
							?</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default pull-left" data-dismiss="modal">
							{{ trans('users::backend.index.btn.cancel_re-active') }}
						</button>
						{!! Form::open(['route' => ['backend.users.reactive', $user['id']], 'method' => 'PUT']) !!}
						<button type="submit" class="btn btn-warning">
							<i class="fa fa-play-circle-o"></i> {{ trans('users::backend.index.btn.valid_re-active') }}
						</button>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
		<div class="modal modal-default" id="user_show_{{ $user['id'] }}">
			<div class="modal-dialog">
				<div class="modal-content">
				</div>
			</div>
		</div>
	@endif
@endforeach