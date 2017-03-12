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

        {{-- Only for "top navigation" navigation --}}
        <div class="navbar-collapse pull-left collapse" id="navbar-collapse" aria-expanded="false" style="height: 1px;">
            {{--{!! adminlte_menu_front_mobile() !!}--}}Temp
        </div>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        @if (Auth::check())
                            {!! Widget::get('gravatar', [Auth::user()->email, ["class" => "user-image"]]) !!}
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
                        {{--@if (Auth::check())--}}
                        {{--{{ Widget::get('gravatar', [Auth::user()->email, ["class" => "img-circle"]]) }}--}}
                        {{--<p>--}}
                        {{--{{ Auth::user()->full_name }}--}}
                        {{--<small>Member since Nov. 2012</small>--}}
                        {{--</p>--}}
                        {{--@endif--}}
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
                            <a class="btn btn-default btn-flat" href="{{ url('backend/logout') }}"><i
                                        class="fa fa-btn fa-sign-out"></i>Sign out</a>
                            {{--</div>--}}
                        </li>
                    </ul>
                </li>
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="">
                            <img alt="{{ Session::get('lang') }}"
                                 src="{{ asset('/themes/adminlte/img/lang/png/'.Session::get('lang').'.png') }}">
                        </span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-footer">
                            <a class="btn btn-default btn-flat" href="{{ URL::current() }}/?lang=fr">
                                <img src="{!! asset('/themes/adminlte/img/lang/png/fr.png') !!}"
                                     alt="fr"> {!! trans('global.lang_fr') !!}
                            </a>
                        </li>
                        <li class="user-footer">
                            <a class="btn btn-default btn-flat" href="{{ URL::current() }}/?lang=en">
                                <img src="{!! asset('/themes/adminlte/img/lang/png/en.png') !!}"
                                     alt="en"> {!! trans('global.lang_en') !!}
                            </a>
                        </li>
                    </ul>
                </li>
                {{--<li>--}}
                {{--<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>--}}
                {{--</li>--}}
            </ul>
        </div>
    </nav>
</header>