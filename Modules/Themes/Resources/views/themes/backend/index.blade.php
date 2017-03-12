@extends('adminlte::layouts.default')

@section('title', trans('themes::backend.meta_title'))
@section('subtitle', trans('themes::backend.meta_description'))
@section('meta-description', trans('themes::backend.meta_description'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('themes::backend.index.title_frontend') }}</h3>
                    {{--<div class="box-tools pull-right">--}}
                    {{--<a href="{{ url('backend/users/create') }}" class="btn btn-box-tool btn-box-tool-primary">--}}
                    {{--<i class="fa fa-navicon"></i> {{ trans('global.navigation') }}--}}
                    {{--</a>--}}
                    {{--</div>--}}
                </div>
                @if (count($themes['frontend']))
                    <div class="box-body no-padding">
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <th class="cell-center" width="5%">{{ trans('global.status') }}</th>
                                <th class="cell-center">{{ trans('global.name') }}</th>
                                <th class="hidden-xs cell-center" width="20%">{{ trans('global.actions') }}</th>
                            </tr>
                            @foreach ($themes['frontend'] as $theme)
                                <tr>
                                    <td class="cell-center">
                                        @if ($theme['active'])
                                            <small class="label bg-green">
                                                {{ trans('themes::backend.index.label.status:active') }}
                                            </small>
                                        @endif
                                    </td>
                                    <td class="cell-center">
                                        @if (!empty($theme['preview']))
                                            <a href="javascript:void(0);" data-toggle="modal"
                                               data-target="#thumbnail_{{ $theme['name'] }}">
                                                @endif
                                                {{ $theme['name'] }}
                                                @if (!empty($theme['preview']))
                                            </a>
                                        @endif
                                    </td>
                                    <td class="hidden-xs cell-center">
                                        {!! Form::open(['route' => ['backend.themes.update', $theme['name']], 'class' => 'forms', 'method' => 'PUT']) !!}
                                        <input type="hidden" name="type" value="frontend">
                                        <button type="submit"
                                                class="btn btn-warning btn-flat @if ($theme['active']) disabled @endif"
                                                @if ($theme['active'])disabled="disabled"@endif>
                                            <i class="fa fa-paint-brush"></i> {{ trans('themes::backend.index.btn.use') }}
                                        </button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('themes::backend.index.title_backend') }}</h3>
                </div>
                @if (count($themes['backend']))
                    <div class="box-body no-padding">
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <th class="cell-center" width="5%">{{ trans('global.status') }}</th>
                                <th class="cell-center">{{ trans('global.name') }}</th>
                                <th class="hidden-xs cell-center" width="20%">{{ trans('global.actions') }}</th>
                            </tr>
                            @foreach ($themes['backend'] as $theme)
                                <tr>
                                    <td class="cell-center">
                                        @if ($theme['active'])
                                            <small class="label bg-green">
                                                {{ trans('themes::backend.index.label.status:active') }}
                                            </small>
                                        @endif
                                    </td>
                                    <td class="cell-center">
                                        @if (!empty($theme['preview']))
                                            <a href="javascript:void(0);" data-toggle="modal"
                                               data-target="#thumbnail_{{ $theme['name'] }}">
                                                @endif
                                                {{ $theme['name'] }}
                                                @if (!empty($theme['preview']))
                                            </a>
                                        @endif
                                    </td>
                                    <td class="hidden-xs cell-center">
                                        {!! Form::open(['route' => ['backend.themes.update', $theme['name']], 'class' => 'forms', 'method' => 'PUT']) !!}
                                        <input type="hidden" name="type" value="backend">
                                        <button type="submit"
                                                class="btn btn-warning btn-flat @if ($theme['active']) disabled @endif"
                                                @if ($theme['active'])disabled="disabled"@endif>
                                            <i class="fa fa-paint-brush"></i> {{ trans('themes::backend.index.btn.use') }}
                                        </button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
    @foreach ($themes as $type => $themes_Xend)
        @foreach ($themes_Xend as $theme)
            <div class="modal modal-default" id="thumbnail_{{ $theme['name'] }}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title">{{ trans('global.preview') }}</h4>
                        </div>
                        <div class="modal-body">
                            <p>
                                @if (!empty($theme['preview']))
                                    <img src="{{ url($theme['preview_path'] . $theme['preview']) }}" alt="thumbnail"
                                         width="100%">
                                @endif
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">
                                {{ trans('global.close') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endforeach
@endsection
