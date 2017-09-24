<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#333">
    <meta name="msapplication-navbutton-color" content="#333">
    <meta name="apple-mobile-web-app-status-bar-style" content="#222">
    <link rel="stylesheet" href="/css/app.css">
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="/js/app.js"></script>

    <title>{{ (isset($title) && $title ? "$title - " : "") }}InterCraft</title>

</head>
<body>
    @yield("body")
    
    @unless(isMobile())
        <script>initParticles();</script>
    @endunless
    <script>
        $(document).ready(function() {
            if ($('#image-gallery'))
                $('#image-gallery').lightGallery({
                    galleryId: 0    
                });
        });
    </script>
</body>
</html>