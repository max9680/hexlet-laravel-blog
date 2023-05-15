<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Hexlet Blog - @yield('title')</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="csrf-param" content="_token" />
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script src="{{ asset('js/app.js') }}"></script>
    </head>

    @if ($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
        {{ $message }}
        </div>
    @endif

    <body>
        <div class="container mt-4">
            <div>
                <a href="{{ route('articles.index')}}">Статьи</a>
            </div>
            <div>
                <a href="{{ route('articles.create')}}">Создать статью</a>
            </div>
            <div>
                <a href="{{ route('about')}}">О блоге</a>
            </div>
            <h1>@yield('header')</h1>
            <div>
                @yield('content')
            </div>
        </div>
    </body>
</html>