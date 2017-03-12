<div id="profile_users" class="grid-stack-item" data-gs-width="9" data-gs-height="4"


	 {{--data-gs-auto-position--}}

	 data-gs-x="3" data-gs-y="0"

>

	<div class="grid-stack-item-content panel panel-default">
		<div class="panel-heading">{!! trans('users::widgets/profileusers.title') !!}</div>
		<div class="panel-body">
			<table class="table table-bordered">
				<tbody>
					<tr class="cell-center">
						<th>
							<b>Email</b>
						</th>
						<td>
							{{ $user->email }}
						</td>
					</tr>
					{{--<tr>--}}
					{{--<td>--}}
					{{--<b>API key</b>--}}
					{{--</td>--}}
					{{--<td>--}}
					{{--{{ !is_null($user->apikey) ? $user->apikey->key : trans('users::users.show.message.no_apikey') }}--}}
					{{--<div class="pull-right">--}}
					{{--<button class="btn btn-flat btn-xs"><i class="fa fa-eye"></i> show</button>--}}
					{{--<button class="btn btn-flat btn-xs"><i class="fa fa-refresh"></i> regenerate</button>--}}
					{{--</div>--}}
					{{--</td>--}}
					{{--</tr>--}}
				</tbody>
			</table>

			{{--@if ($user->addresses->count())--}}
				{{--<table class="table table-bordered">--}}
					{{--<tbody>--}}
						{{--<tr class="cell-center">--}}
							{{--<th colspan="2">--}}
								{{--<b>Addresses</b>--}}
							{{--</th>--}}
						{{--</tr>--}}
						{{--@foreach ($user->addresses as $addresse)--}}
							{{--<tr class="cell-center">--}}
								{{--<td class="cell-center" width="15%">--}}
									{{--@if ($addresse->is_primary)--}}
										{{--Primary<br/>address--}}
									{{--@elseif ($addresse->is_billing)--}}
										{{--Billing<br/>address--}}
									{{--@elseif ($addresse->is_shipping)--}}
										{{--Shipping<br/>address--}}
									{{--@endif--}}
								{{--</td>--}}
								{{--<td>--}}
									{{--{!! trans($addresse->organization) !!}--}}
									{{--<br/>--}}
									{{--{!! trans($addresse->street) !!}--}}
									{{--{!! trans($addresse->street_extra) !!}--}}
									{{--<br/>--}}
									{{--{!! trans($addresse->city) !!}--}}
									{{--{!! trans($addresse->state_a2) !!}--}}
									{{--{!! trans($addresse->state_name) !!}--}}
									{{--{!! trans($addresse->zip) !!}<br/>--}}
									{{--{!! trans($addresse->country_a2) !!}--}}
									{{--{!! trans($addresse->country_name) !!}--}}
								{{--</td>--}}
							{{--</tr>--}}
						{{--@endforeach--}}
					{{--</tbody>--}}
				{{--</table>--}}
			{{--@endif--}}
		</div>
	</div>
</div>
