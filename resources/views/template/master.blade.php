<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="InterCraft is a lightly modded Minecraft survival server created and maintained by software developers.">
    <meta name="keywords" content="Minecraft,Modded,Vanilla,Whitelisted,OpenComputers">
    <meta name="author" content="David Ludwig">
    <meta name="theme-color" content="#333">
    <meta name="msapplication-navbutton-color" content="#333">
    <meta name="apple-mobile-web-app-status-bar-style" content="#222">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="icon" type="image/ico" href="/images/intercraft.ico">
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="/js/app.js"></script>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-T7FCZP8');</script>
    <!-- End Google Tag Manager -->
    <!-- Global Site Tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-106954611-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments)};
        gtag('js', new Date());
        gtag('config', '{{ env('GOOGLE_ANALYTICS_TRACKING_ID') }}');
    </script>

    <title>{{ (isset($title) && $title ? "$title - " : "") }}InterCraft</title>

</head>
<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-T7FCZP8"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
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
