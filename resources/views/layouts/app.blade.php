<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@lang('catalog.news')</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}">
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        @lang('catalog.news')
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li><a href="{{ route('categories.index') }}">@lang('catalog.categories')</a></li>
                        <li><a href="{{ route('home.contact') }}">@lang('catalog.contact')</a></li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">@lang('catalog.login')</a></li>
                            <li><a href="{{ route('register') }}">@lang('catalog.register')</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            @lang('catalog.logout')
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            <!-- Admins -->
                            <li class="dropdown">
                                @if(Auth::user()->hasRole('admin'))
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                        {{ trans('catalog.admin') }} <span class="caret"></span>
                                    </a>

                                    <ul class="dropdown-menu" role="menu">
                                        <li>
                                            <a href="{{ route('admin.news') }}">@lang('catalog.news')</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.categories') }}">@lang('catalog.categories')</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.users') }}">@lang('catalog.users')</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.comments') }}">@lang('catalog.comments')</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.logs') }}">@lang('catalog.logs')</a>
                                        </li>
                                    </ul>
                                @endif
                            </li>
                        @endguest
                        <!-- Locales -->
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ trans('catalog.locales') }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                @if(App::getLocale() !== 'ru')
                                    <li>
                                        <a href="{{ route('locales', ['locale' => 'ru']) }}">@lang('catalog.russian')</a>
                                    </li>
                                @endif
                                @if(App::getLocale() !== 'uk')
                                    <li>
                                        <a href="{{ route('locales', ['locale' => 'uk']) }}">@lang('catalog.ukraine')</a>
                                    </li>
                                @endif
                                @if(App::getLocale() !== 'en')
                                    <li>
                                        <a href="{{ route('locales', ['locale' => 'en']) }}">@lang('catalog.english')</a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        @if ( session()->has('message') )
            <div class="alert alert-info">{{ session()->get('message') }}</div>
        @endif

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
