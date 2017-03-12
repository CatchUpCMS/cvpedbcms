<!DOCTYPE html>
<html>
    <head>
        @include('installer::partials.metadata')
        <style>
            .instruction {
                font-size: 12px;
                font-weight: normal;
            }
            .p-b-60 {
                padding-bottom: 60px;
            }
            div[id$="-error"] {
                margin-bottom: 25px;
                color: #dd4b39;
            }
        </style>
    </head>
    <body class="hold-transition skin-blue layout-top-nav">
        <div class="wrapper">
            @include('installer::partials.header')
            <div class="content-wrapper">
                <div class="container">
                    <section class="content-header">
                        <h1>
                            {{ Lang::get('installer::installer.title') }}
                            <small>({{ config('cms.version') }})</small>
                        </h1>
                    </section>
                    <section class="content">
                        @yield('content')
                    </section>
                </div>
            </div>
            @include('installer::partials.footer')
        </div>
        @include('installer::partials.js-footer')
    </body>
</html>
