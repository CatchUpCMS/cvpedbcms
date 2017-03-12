@extends('adminlte::layouts.errors')

@section('content')
    <div class="error-page">
        <h2 class="headline text-yellow"> 405</h2>

        <div class="error-content">
            <h3><i class="fa fa-warning text-yellow"></i> Oops! Method not allowed.</h3>

            <p>
                A request was made of a resource using a request method not supported by that resource; for example, using GET on a form which requires data to be presented via POST, or using PUT on a read-only resource.<br/>
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
            {{--<img src="http://i1.wp.com/httpstatusdogs.com/wp-content/uploads/2011/12/405.jpg?fit=650%2C500" alt="Method not allowed">--}}
        {{--</p>--}}

    </div>
@endsection