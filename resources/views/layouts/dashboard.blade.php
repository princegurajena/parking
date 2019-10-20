<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en" />
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#4188c9">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <link rel="icon" href="{{asset('favicon.ico')}}" type="image/x-icon"/>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />
    <title>{{ config('app.name', 'Laravel') .' | ' . $title  }}</title>
    <link href="{{asset('css/argon-dash.css')}}" rel="stylesheet" />
    <link href="{{asset('/vendor/bootstrap/css/bootstrap.css')}}" rel="stylesheet" />
    <link href="{{asset('/assets/css/dashboard.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
    @yield('css')
</head>
<body class="">
<div  id="app">
    <div class="page">
        <div class="page-main">
            <div class="">
                <div class="">
                    <div class="header py-4">
                        <div class="container">
                            <div class="d-flex">
                                <a class="header-brand" href="/home">
                                    {{ config('app.name', 'Dash') }}
                                </a>
                                <div class="d-flex order-lg-2 ml-auto">
                                    <div class="dropdown">
                                        <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                                            <span class="avatar avatar-green">{{ auth()->user()->short_name }}</span>
                                            <span class="ml-2 d-none d-lg-block">
                                        <span class="text-default"> {{ auth()->user()->name }} </span>
                                     <small class="text-muted d-block mt-1">{{ auth()->user()->role }}</small>
                                    </span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item" href="/users/my-profile">
                                                <i class="dropdown-icon fe fe-user"></i> Profile
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
                                    <span class="header-toggler-icon"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
                        <div class="container">
                            <div class="row zalign-items-center">
                                <div class="col-lg order-lg-first">
                                    <ul class="nav nav-tabs border-0 flex-column flex-lg-row small">
                                        <li class="nav-item">
                                            <a href="/home" class="nav-link {{ $title == 'home' ? 'active' : '' }}"><i class="fe fe-map mr-3"></i>Home</a>
                                        </li>
{{--                                        <li class="nav-item">--}}
{{--                                            <a href="/dashboard" class="nav-link {{ $title == 'home' ? 'active' : '' }}"><i class="fe fe-bar-chart mr-3"></i>Dashboard</a>--}}
{{--                                        </li>--}}
                                        @can('admin', \App\System::class)
                                            <li class="nav-item">
                                                <a href="/parking-space/all" class="nav-link {{ $title == 'Documentation' ? 'active' : '' }}"><i class="fe fe-map-pin"></i>Parking Spaces</a>
                                            </li>
                                        @endcan
                                        @can('admin', \App\System::class)
                                            <li class="nav-item">
                                                <a href="/users/all" class="nav-link {{ $title == 'Documentation' ? 'active' : '' }}"><i class="fe fe-users"></i>Users</a>
                                            </li>
                                        @endcan
                                        <li class="nav-item">
                                            <a href="/vehicles/all" class="nav-link {{ $title == 'Documentation' ? 'active' : '' }}"><i class="fe fe-send"></i>Vehicles</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="/requests/all" class="nav-link {{ $title == 'Documentation' ? 'active' : '' }}"><i class="fe fe-git-pull-request"></i>Requests</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="/payments/all" class="nav-link {{ $title == 'Documentation' ? 'active' : '' }}"><i class="fe fe-shopping-cart"></i>Payments</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="" style="min-height: 90vh;">
                @yield('content')
            </div>
        </div>
{{--        <footer class="footer">--}}
{{--            <div class="container">--}}
{{--                <div class="row align-items-center flex-row-reverse">--}}
{{--                    <div class="col-auto ml-lg-auto">--}}
{{--                        <div class="row align-items-center">--}}
{{--                            <div class="col-auto">--}}
{{--                                <ul class="list-inline list-inline-dots mb-0">--}}

{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-12 col-lg-auto mt-3 mt-lg-0 text-center">--}}
{{--                        Copyright © 2019 {{ config('app.name', 'Dash') }}  All rights reserved.--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </footer>--}}
    </div>
</div>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('assets/js/core.js') }}"></script>
@yield('scripts')
</body>
</html>


