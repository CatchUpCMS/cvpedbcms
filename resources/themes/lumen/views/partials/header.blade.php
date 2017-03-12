<div class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a href="{{ route('home') }}" class="navbar-brand">SiteName</a>
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
            <ul class="nav navbar-nav">


                <li>
                    <a href="{{ route('home') }}">Home</a>
                </li>


            </ul>
            <ul class="nav navbar-nav navbar-right">

                @if (Auth::check())
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="download" aria-expanded="false">
                            {{ Auth::user()->full_name }}
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="download">
                            <li>
                                <a href="{{ route('users.my-profile') }}">
                                    {{ trans('lumen::lumen.my_profile') }}
                                </a>
                            </li>
                            <li class="divider"></li>

                                <li>
                                    <a href="{{ url('admin') }}" target="_blank">
                                        {{ trans('global.admin_dashboard') }}
                                    </a>
                                </li>
                                <li class="divider"></li>

                            <li>
                                <a href="{{ url('logout') }}">
                                    {{ trans('global.logout') }}
                                </a>
                            </li>
                        </ul>
                    </li>
                @else
                    @if ($is_registration_allowed)
                        <li>
                            <a href="{{ url('register') }}">
                                {{ trans('global.register') }}
                            </a>
                        </li>
                        <li class="divider"></li>
                    @endif
                    <li>
                        <a href="{{ url('login') }}">
                            {{ trans('global.login') }}
                        </a>
                    </li>
                @endif

                @if (Session::get('impersonate_member'))
                    <li>
                        <a href="{{ route('backend.users.endimpersonate') }}">
                            {{ trans('global.restore_session') }}
                        </a>
                    </li>
                @endif

            </ul>
        </div>
    </div>
</div>
