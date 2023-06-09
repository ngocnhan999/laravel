<!DOCTYPE html>
<html lang="{!! app()->getLocale() !!}">
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="description" content="Login">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
    <!-- Call App Mode on ios devices -->
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no">
    <!-- base css -->
    <link rel="stylesheet" media="screen, print" href="{!! asset('admin/css/vendors.bundle.css?v='.time()) !!}">
    <link rel="stylesheet" media="screen, print" href="{!! asset('admin/css/app.bundle.css?v='.time()) !!}">
    <!-- Place favicon.ico in the root directory -->
    <link rel="apple-touch-icon" sizes="180x180"
          href="{!! asset('admin/img/favicon/apple-touch-icon.png') !!}">
    <link rel="icon" type="image/png" sizes="32x32"
          href="{!! asset('admin/img/favicon/favicon-32x32.png') !!}">
    <link rel="mask-icon" href="{!! asset('admin/img/favicon/safari-pinned-tab.svg') !!}" color="#5bbad5">
    <!-- Optional: page related CSS-->
    <link rel="stylesheet" media="screen, print" href="{!! asset('admin/css/page-login.css?v='.time()) !!}">
</head>
<body>
@yield('auth_content')
@if(request()->route('access.login'))
    <div class="login-footer p-2">
        <div class="row">
            <div class="col col-sm-12 text-center">
                <i><strong>System Message:</strong> You were logged out from 198.164.246.1 on Saturday, March, 2017 at 10.56AM</i>
            </div>
        </div>
    </div>
@endif
<video poster="{!! asset('admin/img/backgrounds/clouds.png') !!}" id="bgvid" playsinline autoplay muted loop>
    <source src="{!! asset('admin/media/video/cc.webm') !!}" type="video/webm">
    <source src="{!! asset('admin/media/video/cc.mp4') !!}" type="video/mp4">
</video>
<script src="{!! asset('admin/js/vendors.bundle.js?v='.time()) !!}"></script>
<script src="{!! asset('admin/js/app.bundle.js?v='.time()) !!}"></script>
<!-- Page related scripts -->
</body>
</html>
