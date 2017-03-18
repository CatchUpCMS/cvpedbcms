@extends('adminlte::layouts.default')

@section('title', trans('environments::backend.meta_title'))
@section('meta-description', trans('environments::backend.meta_description'))
@section('subtitle', trans('environments::backend.meta_description'))

@section('head')
    <script>
        cvepdb_config.libraries.push(
                {
                    script: {
                        CVEPDB_FORM_VALIDATION_LOADED: (cvepdb_config.url_theme + cvepdb_config.script_path + 'scripts/form_validation.js')
                    },
                    trigger: '.js-call-form_validation',
                    mobile: true,
                    browser: true
                }
        );
    </script>
@endsection

@section('js')
    <script src="{{ asset('modules/environments/js/index.js') }}"></script>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">

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

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('environments::backend.index.title') }}</h3>
                    <div class="box-tools hidden-xs pull-right">
                        <a class="btn btn-box-tool btn-box-tool-primary"
                           data-toggle="modal"
                           data-target="#add_environment">
                            <i class="fa fa-plus"></i> {{ trans('environments::backend.index.btn.add') }}
                        </a>
                    </div>
                </div>


                <div class="box-body">
                    <div class="overlay hidden">
                        <i class="fa fa-refresh fa-spin"></i>
                    </div>
                    <div class="callout callout-info" role="alert">
                        <h4>
                            <i class="icon fa fa-info"></i> {{ trans('environments::backend.index.no_data.title') }}
                        </h4>
                        <p>{{ trans('environments::backend.index.no_data.description') }}</p>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="modal" id="add_environment">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['route' => 'backend.environments.store', 'class' => 'forms js-call-form_validation']) !!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title">{{ trans('environments::backend.index.modal.add.title') }}</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group form-group-default">
                        <label>{{ trans('global.name') }}</label>
                        <input type="text" class="form-control" name="name" required="required"
                               value="" placeholder="{{ trans('global.name') }}">
                    </div>

                    <div class="form-group form-group-default">
                        <label>{{ trans('global.reference') }}</label>
                        <input type="text" class="form-control"
                               name="reference"
                               required="required"
                               readonly="readonly"
                               value="" placeholder="{{ trans('global.reference') }}">
                    </div>

                    <div class="form-group form-group-default">
                        <label>{{ trans('global.domain') }}</label>
                        <input type="text" class="form-control" name="domain" required="required"
                               value="" placeholder="{{ trans('global.domain') }}">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">
                        {{ trans('global.cancel') }}
                    </button>
                    <button type="submit" class="btn btn-primary btn-flat">
                        <i class="fa fa-plus"></i> {{ trans('global.add') }}
                    </button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
