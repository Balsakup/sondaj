<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Sondaj') }} :: @yield('title')</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('/css/admin.css') }}">
    </head>
    <body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
        @include('admin::layouts.elements.header')

        <div class="app-body">
            @include('admin::layouts.elements.sidebar')

            <main class="main">
                @include('admin::layouts.elements.breadcrumb')

                <div class="container-fluid">
                    @if (session('danger'))
                        <div class="alert alert-danger">{{ session('danger') }}</div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if (session('warning'))
                        <div class="alert alert-warning">{{ session('warning') }}</div>
                    @endif

                    @if (session('info'))
                        <div class="alert alert-info">{{ session('info') }}</div>
                    @endif

                    <div class="animated fadeIn">
                        @yield('content')
                    </div>
                </div>
            </main>

            @include('admin::layouts.elements.aside')
        </div>

        <!-- Scripts -->
        <script src="{{ mix('/js/admin.js') }}"></script>
    </body>
</html>
