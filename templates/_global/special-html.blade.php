<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('page_title', 'login')</title>

    <link href="{{{ $uri['media.path'] }}}css/bootstrap.min.css" rel="stylesheet">
    <link href="{{{ $uri['media.path'] }}}font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="{{{ $uri['media.path'] }}}css/animate.css" rel="stylesheet">
    <link href="{{{ $uri['media.path'] }}}css/style.css" rel="stylesheet">
    <link href="{{{ $uri['media.path'] }}}css/user/bs3-fix.css" rel="stylesheet">
    <link href="{{{ $uri['media.path'] }}}css/special.css" rel="stylesheet">
</head>

<body class="gray-bg">

    @yield('main_content', 'Main Content')

    <!-- Mainly scripts -->
    <script src="{{{ $uri['media.path'] }}}js/jquery-2.1.1.js"></script>
    <script src="{{{ $uri['media.path'] }}}js/bootstrap.min.js"></script>

</body>

</html>
