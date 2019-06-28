<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }}</title>

    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
    <header>
        <navigation-bar>
            @foreach (config("navbar")["routes"] as $route)
                <navigation-link href="{{ route($route) }}">{{ __("navbar.$route") }}</navigation-link>
            @endforeach
        </navigation-bar>
    </header>
    <div id="app">
        @include($page)
    </div>
    <footer>

    </footer>
    <script src="/js/app.js"></script>
</body>
</html>
