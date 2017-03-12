@extends('adminlte::layouts.errors')

@section('content')
    <div class="error-page">
        <h2 class="headline text-yellow"> 403</h2>

        <div class="error-content">
            <h3><i class="fa fa-warning text-yellow"></i> Oops! Access forbidden.</h3>

            <p>
                A request was made of a resource that you do not have permission to view the requested file or resource.<br/>
                Meanwhile, you may <a href="{{ route('backend.environments.index') }}">return to dashboard</a>.
            </p>

            {{--<form class="search-form">--}}
            {{--<div class="input-group">--}}
            {{--<input type="text" name="search" class="form-control" placeholder="Search">--}}

            {{--<div class="input-group-btn">--}}
            {{--<button type="submit" name="submit" class="btn btn-warning btn-flat"><i class="fa fa-search"></i>--}}
            {{--</button>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--<!-- /.input-group -->--}}
            {{--</form>--}}
        </div>

        {{--<p>--}}
            {{--<img src="http://theocddiaries.com/wp-content/uploads/2014/04/4718384082_ec70cab88f_z.jpg" alt="Access forbidden">--}}
        {{--</p>--}}

    </div>
@endsection