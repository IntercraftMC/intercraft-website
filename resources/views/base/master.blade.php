<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title }}</title>

        <link href="/css/app.css" rel="stylesheet" type="text/css">
        @stack("head")
    </head>
    <body>
        {{-- Modals --}}
        @include("component.photoswipe")
        {{-- Main content --}}
        <div id="prebody">
            @stack("prebody")
        </div>
        <div id="body">
            @yield("body")
        </div>

        {{-- Scripts --}}
        <script src="/js/app.js"></script>
        @stack("scripts")
    </body>
</html>
