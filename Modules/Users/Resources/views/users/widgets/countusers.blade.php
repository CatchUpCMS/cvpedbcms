{{--@if (Auth::check() && Auth::hasRole('admin'))--}}
<div id="count_users" class="grid-stack-item col-md-3" data-gs-width="4" data-gs-height="2"


	 {{--data-gs-auto-position--}}

	 data-gs-x="0" data-gs-y="0"


>
	<!-- small box -->
	<div class="grid-stack-item-content small-box bg-yellow">
		<div class="inner">
			<h3>{{ $nb_users }}</h3>
			<p>{{ trans('users::users.index.total_users') }}</p>
		</div>
		<div class="icon">
			<i class="ion ion-person-add"></i>
		</div>
		{{--@if (Auth::check() && Auth::hasRole('admin'))--}}
		<a href="{{ route('backend.users.index') }}" class="small-box-footer">
			{!! trans('users::widgets/countusers.link.bottom') !!}
			<i class="fa fa-arrow-circle-right"></i>
		</a>
		{{--@endif--}}
	</div>
</div>
{{--@endif--}}
