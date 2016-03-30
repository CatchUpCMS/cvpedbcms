@if ($users->count())
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
                <th class="cell-center">{{ trans('users::admin.index.tab.full_name') }}</th>
                <th class="cell-center">{{ trans('global.email') }}</th>
                <th class="hidden-xs cell-center" width="20%">{{ trans('global.actions') }}</th>
            </tr>
            @foreach ($users as $user)
                <tr>
                    <td class="hidden-xs cell-center" width="5%">
                        <input type="checkbox" class="js-users_multi_delete"
                               value="{{ $user->id }}">
                    </td>
                    <td class="cell-center">
                        <a data-toggle="modal" href="{{ url('admin/users/'.$user->id) }}"
                           data-target="#user_show_{{ $user->id }}">
                            {{ $user->full_name }}
                        </a>
                    </td>
                    <td class="cell-center"><a
                                href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                    <td class="hidden-xs cell-center">
                        <a href="{{ url('admin/users/' . $user->id . '/edit') }}"
                           class="btn btn-warning btn-flat btn-mobile">
                            <i class="fa fa-pencil"></i> {{ trans('global.edit') }}
                        </a>
                        <button type="button" class="btn btn-danger btn-flat btn-mobile"
                                data-toggle="modal"
                                data-target="#delete_user_{{ $user->id }}"><i
                                    class="fa fa-trash"></i>
                            {{ trans('global.remove') }}
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="box-footer clearfix">
        <div class="pull-left">
            {{ trans('users::admin.index.total_users') }} {{ $nb_users }}
        </div>
        {!! with(new \Modules\Users\Resources\IndexAdminPagination($users))->render() !!}
    </div>
@else
    <div class="box-body">

        <div class="overlay hidden">
            <i class="fa fa-refresh fa-spin"></i>
        </div>

        <div class="callout callout-info" role="alert">
            <h4><i class="icon fa fa-info"></i> {{ trans('users::admin.index.no_data.title') }}
            </h4>

            <p>{{ trans('users::admin.index.no_data.description') }}</p>
        </div>
    </div>
@endif

@foreach ($users as $user)
    <div class="modal modal-danger" id="delete_user_{{ $user->id }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title">{{ trans('global.attention') }}</h4>
                </div>
                <div class="modal-body">
                    <p>{{ trans('users::admin.index.delete.question') }} {{ $user->full_name }} ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">
                        {{ trans('users::admin.index.btn.cancel_delete') }}
                    </button>
                    {!! Form::open(['route' => ['admin.users.destroy', $user->id], 'method' => 'delete']) !!}
                    <button type="submit" class="btn btn-danger">
                        <i class="fa fa-trash"></i> {{ trans('users::admin.index.btn.valid_delete') }}
                    </button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <div class="modal modal-default" id="user_show_{{ $user->id }}">
        <div class="modal-dialog">
            <div class="modal-content">
            </div>
        </div>
    </div>
@endforeach