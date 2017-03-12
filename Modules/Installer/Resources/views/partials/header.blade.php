<header class="main-header">
    <nav class="navbar navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <a href="{{ url('installer') }}" class="navbar-brand"><b>#CVEPDB</b> CMS</a>
            </div>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
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
                </ul>
            </div>
        </div>
    </nav>
</header>
