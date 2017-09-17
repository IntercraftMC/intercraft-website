<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#333">
    <meta name="msapplication-navbutton-color" content="#333">
    <meta name="apple-mobile-web-app-status-bar-style" content="#222">
    <link rel="stylesheet" href="css/app.css">
    <script href="js/app.js"></script>

    <title>{{ (isset($title) && $title ? "$title - " : "") }}InterCraft</title>

</head>
<body>
    @yield("body")
    <script type="text/javascript">
    	$(document).ready(function() {
    	document.write("Test");
    });
    </script>
</body>
</html>