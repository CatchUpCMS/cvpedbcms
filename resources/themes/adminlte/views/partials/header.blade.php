<header class="main-header">


    <a href="{{ url('admin') }}" class="logo">
        <span class="logo-mini"><b>C</b>MS</span>
        <span class="logo-lg"><b>#CVEPDB</b> CMS</span>
    </a>


    <nav class="navbar navbar-static-top" role="navigation">


        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">


                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        @if (Auth::check())
                            @gravatar(Auth::user()->email, ["class" => "user-image"])
                        @endif

                        <span class="hidden-xs">
                            @if (Auth::check())
                                {{ Auth::user()->full_name }}
                            @endif
                        </span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        {{--<li class="user-header">--}}
                            {{--<img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">--}}

                            {{--<p>--}}
                                {{--Alexander Pierce - Web Developer--}}
                                {{--<small>Member since Nov. 2012</small>--}}
                            {{--</p>--}}
                        {{--</li>--}}
                        {{--<!-- Menu Body -->--}}
                        {{--<li class="user-body">--}}
                            {{--<div class="row">--}}
                                {{--<div class="col-xs-4 text-center">--}}
                                    {{--<a href="#">Followers</a>--}}
                                {{--</div>--}}
                                {{--<div class="col-xs-4 text-center">--}}
                                    {{--<a href="#">Sales</a>--}}
                                {{--</div>--}}
                                {{--<div class="col-xs-4 text-center">--}}
                                    {{--<a href="#">Friends</a>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<!-- /.row -->--}}
                        {{--</li>--}}
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            {{--<div class="pull-left">--}}
                                {{--<a href="#" class="btn btn-default btn-flat">Profile</a>--}}
                            {{--</div>--}}
                            {{--<div class="pull-right">--}}
                                <a class="btn btn-default btn-flat" href="{{ url('logout') }}"><i class="fa fa-btn fa-sign-out"></i>Sign out</a>
                            {{--</div>--}}
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
                {{--<li>--}}
                    {{--<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>--}}
                {{--</li>--}}
            </ul>
        </div>
    </nav>
</header>