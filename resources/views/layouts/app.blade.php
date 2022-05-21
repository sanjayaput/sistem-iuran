<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>{{ config('app.name') }} - @yield('title', 'System')</title>

        <!-- Global stylesheets -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/global/css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/global/css/icons/material/icons.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/bootstrap_limitless.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/layout.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/components.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/colors.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('chart.js/Chart.css') }}" rel="stylesheet" type="text/css" />
        <!-- /global stylesheets -->
        @yield('stylesheet')
        <style>
            .sidebar-dark {
                background-color: #226b6e;
                color: #fff;
            }

            .navbar-dark {
                background-color: #226b6e;
            }
        </style>
    </head>

    <body class="navbar-top">
        @include('layouts.navbar')
        <div class="page-content">
            @include('layouts.sidebar')

            <div class="content-wrapper">
                @include('layouts.breadcrumbs')

                <div class="content">
                    @yield('content')
                </div>

                @include('layouts.footer')
                @include('layouts.notification')
            </div>
        </div>
    </body>
        <!-- Core JS files -->
        <script src="{{ asset('assets/global/js/main/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/global/js/main/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/global/js/plugins/loaders/blockui.min.js') }}"></script>
        <script src="{{ asset('assets/global/js/plugins/notifications/pnotify.min.js') }}"></script>
        <script>
        $(function() {
        var base_url = {!! json_encode(url('/')) !!}; // base URL
            if(window.location.href === base_url+"/pemasukan" || window.location.href === base_url+"/pengeluaran" || window.location.href === base_url+"/iuran") {
             $('body').addClass('sidebar-component-hidden');
            }
        });
        </script>
        <!-- /core JS files -->
        @yield('javascript')
        <!-- Theme JS files -->
        <script src="{{ asset('assets/js/app.js') }}"></script>
        <!-- /theme JS files -->
        @yield('init')
        @stack('scripts')
</html>
