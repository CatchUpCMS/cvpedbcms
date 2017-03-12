{{--@if (Auth::check() && Auth::hasRole('admin'))--}}
<div id="export_users" class="grid-stack-item col-md-3" data-gs-width="4" data-gs-height="2"


	 {{--data-gs-auto-position--}}

	 data-gs-x="4" data-gs-y="0"

>
	<!-- small box -->
	<div class="grid-stack-item-content small-box bg-green">
		<div class="inner">
			<h3>{{ trans('users::backend.export.users_list.title') }}</h3>
			<p>{!! trans('users::widgets/exportusers.title') !!}</p>
		</div>
		<div class="icon">
			<i class="fa fa-file-excel-o"></i>
		</div>
		{{--@if (Auth::check() && Auth::hasRole('admin'))--}}
		<a href="{{ route('backend.users.export') }}" class="small-box-footer">
			{!! trans('users::widgets/exportusers.link.bottom') !!}
			<i class="fa fa-arrow-circle-right"></i>
		</a>
		{{--@endif--}}
	</div>
</div>
{{--@endif--}}
