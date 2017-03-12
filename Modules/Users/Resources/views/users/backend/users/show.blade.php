@extends('adminlte::layouts.modal')

@section('title', $user['data']['full_name'])
@section('subtitle', trans('users::backend.meta_title'))
@section('meta-description', trans('users::backend.meta_description'))

@section('content')
	<div class="box-body no-padding">
		<table class="table table-bordered">
			<tbody>
				<tr class="cell-center">
					<th>
						<b>{{ trans('global.civility') }}</b>
					</th>
					<td>
						{{ $user['data']['civility'] }}
					</td>
				</tr>
				<tr class="cell-center">
					<th>
						<b>{{ trans('global.last_name') }}</b>
					</th>
					<td>
						{{ $user['data']['last_name'] }}
					</td>
				</tr>
				<tr class="cell-center">
					<th>
						<b>{{ trans('global.first_name') }}</b>
					</th>
					<td>
						{{ $user['data']['first_name'] }}
					</td>
				</tr>
				<tr class="cell-center">
					<th>
						<b>{{ trans('global.email') }}</b>
					</th>
					<td>
						{{ $user['data']['email'] }}
					</td>
				</tr>
				<tr class="cell-center">
					<th>
						<b>{{ trans('global.birth_date') }}</b>
					</th>
					<td>
						{{ $user['data']['birth_date'] }}
					</td>
				</tr>
				<tr>
					<td>
						<b>API key</b>
					</td>
					<td>
						{{ !is_null($user['data']['apikey']) ? $user['data']['apikey'] : trans('users::backend.show.message.no_apikey') }}

						{{-- xABE Todo : #7 do show/hide action to show/hide apikey --}}
						{{-- xABE Todo : #8 do regenerate action to regenerate apikey --}}

						{{--<div class="pull-right">--}}
							{{--<button class="btn btn-flat btn-xs"><i class="fa fa-eye"></i> show</button>--}}
							{{--<button class="btn btn-flat btn-xs"><i class="fa fa-refresh"></i> regenerate</button>--}}
						{{--</div>--}}
					</td>
				</tr>
			</tbody>
		</table>
		<br>
		<table class="table table-bordered">
			<tbody>
				<tr class="cell-center">
					<th colspan="2">
						<b>{{ trans('global.address') }}</b>
					</th>
				</tr>
					<tr class="cell-center">
						<td>

							{{-- xABE Todo : #9 display message for incomplete address or empty address --}}

							{!! trans($user['data']['addresses']['primary']['street']) !!}
							{!! trans($user['data']['addresses']['primary']['street_extra']) !!}
							<br/>
							{!! trans($user['data']['addresses']['primary']['city']) !!}
							{!! trans($user['data']['addresses']['primary']['zip']) !!}
							<br/>
							{!! trans($user['data']['addresses']['primary']['state_name']) !!}
							{!! trans($user['data']['addresses']['primary']['substate_name']) !!}
							{!! trans($user['data']['addresses']['primary']['country_name']) !!}
						</td>
					</tr>
			</tbody>
		</table>

		@if ($user_can_see_env && count($user['data']['environments']))
			<br>
			<table class="table table-bordered">
				<tbody>
					<tr class="cell-center">
						<th colspan="2">
							<b>{!! trans('global.environment_s') !!}</b>
						</th>
					</tr>
					@foreach ($user['data']['environments'] as $environment)
						<tr class="cell-center">
							<th>
								{!! trans($environment['name']) !!}
							</th>
							<td>
								{{ $environment['domain'] }}<br/>
								{!! trans('global.reference') !!} : {!! trans($environment['reference']) !!}
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@endif

		@if (count($user['data']['roles']))
			<br>
			<table class="table table-bordered">
				<tbody>
					<tr class="cell-center">
						<th>
							<b>{!! trans('global.role_s') !!}</b>
						</th>
					</tr>
					@foreach ($user['data']['roles'] as $role)
						<tr class="cell-center">
							<td>
								{!! trans($role['display_name']) !!}
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@endif

	</div>
@endsection

@section('footer')
	<div class="row">
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			<a href="{{ route('backend.users.impersonate', ['id' => $user['data']['id']]) }}" class="btn btn-flat btn-default btn-block">
				<i class="fa fa-user-secret pull-left"></i> {{ trans('users::backend.show.btn.impersonate') }}
			</a>
			<a href="{{ route('backend.users.resetpassword', ['id' => $user['data']['id']]) }}" class="btn btn-flat btn-default  btn-block">
				{{ trans('users::backend.show.btn.reset_password') }}
			</a>
		</div>
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			<button type="button" class="btn btn-flat btn-default btn-block" data-dismiss="modal">
				{{ trans('global.close') }}
			</button>
		</div>
	</div>
@endsection
