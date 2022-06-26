<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body class="text-neutral-800 font-mono antialiased">
<div class="w-full flex" id="app">
    <div class="w-64 px-4 pt-4 shadow h-screen">
        <div class="w-full flex mb-10 justify-center cursor-pointer">
            <img class="w-12" src="{{url('img/coffee-logo.png')}}">
        </div>
        @include('layouts.menu')
    </div>

    <div class="w-full h-screen flex shadow-inner overscroll-auto overflow-auto justify-center">
        @yield('content')
    </div>
</div>

<script src="{{ asset('js/app.js') }}"></script>
@yield('script')
</body>
</html>
