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
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}">
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>
    <div id="app">
        @component('layouts.header')
        @endcomponent

        @if ( session()->has('message') )
            <div class="alert alert-info">{{ session()->get('message') }}</div>
        @endif

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
