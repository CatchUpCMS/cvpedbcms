@extends('adminlte::layouts.default')

@section('title', trans('files::backend.meta_title'))
@section('meta-description', trans('files::backend.meta_description'))
@section('subtitle', trans('files::backend.meta_description'))

@section('js')
@endsection

@section('content')
	<div class="row">
		<div class="col-md-2">
			<a href="javascript:void(0);" class="btn btn-primary btn-block margin-bottom"
			   data-toggle="modal" data-target="#add_folder">
				<i class="fa fa-folder"></i> {{ trans('files::backend.settings.btn.add_folder') }}
			</a>
			{{--<a href="javascript:void(0);" class="btn btn-primary btn-block margin-bottom"--}}
			{{--data-toggle="modal" data-target="#add_amazon">--}}
			{{--<i class="fa fa-amazon"></i> {{ trans('files::backend.settings.btn.add_amazon') }}--}}
			{{--</a>--}}
			{{--<a href="javascript:void(0);" class="btn btn-primary btn-block margin-bottom"--}}
			{{--data-toggle="modal" data-target="#add_dropbox">--}}
			{{--<i class="fa fa-dropbox"></i> {{ trans('files::backend.settings.btn.add_dropbox') }}--}}
			{{--</a>--}}
		</div>
		<div class="col-md-10">
			@if (count($errors) > 0)
				<div class="alert alert-danger" role="alert">
					<p class="pull-left">
						{{ count($errors) > 1 ? trans('global.errors') : trans('global.error') }}
					</p>
					<div class="clearfix"></div>
					@foreach ($errors->all() as $error)
						<br>
						<p>{{ trans($error) }}</p>
					@endforeach
				</div>
			@endif
			@if ($disks->count())
				@foreach ($disks as $disk_name => $disk)
					<div class="box box-solid collapsed-box">
						<div class="box-header with-border">
							<h3 class="box-title">
								<a href="javascript:void(0);" data-widget="collapse">
									{{ $disk['alias'] }}
								</a>
							</h3>
							<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse">
									<i class="fa fa-plus"></i>
								</button>
							</div>
						</div>
						<div class="box-body">
							<ul>
								<li>{{ $disk_name }}</li>
								<li>{{ $disk['driver'] }}</li>
								<li>{{ $disk['root'] }}</li>
								<li>{{ $disk['URL'] }}</li>
								@if (array_key_exists('visibility', $disk))
									<li>{{ $disk['visibility'] }}</li>
								@else
									<li>private</li>
								@endif
							</ul>
						</div>
						<div class="box-footer">
							The footer of the box
						</div>
					</div>
				@endforeach
			@else
				<div class="col-lg-12">
					<div class="callout callout-info">
						<h4>{{ trans('files::backend.settings.nodata_title') }}</h4>
						<p>{{ trans('files::backend.settings.nodata_description') }}</p>
					</div>
				</div>
			@endif
		</div>
	</div>
	@include('files::files.backend.settings.modals.delete_directory')
	{{--@include('files::files.backend.settings.modals.add_amazon')--}}
	{{--@include('files::files.backend.settings.modals.add_dropbox')--}}
	@include('files::files.backend.settings.modals.add_local')
@endsection
