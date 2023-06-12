<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>{{ page_title()->getTitle() }}</title>
    <meta name="author" content="SemiColonWeb"/>
    <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no"/>
    <meta name="robots" content="noindex, nofollow"/>
    <meta name="googlebot" content="noindex, nofollow"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fonts-->
    <!-- Fonts-->
    <link href="https://fonts.googleapis.com/css?family={{ urlencode('Open Sans') }}" rel="stylesheet" type="text/css">
    <!-- CSS Library-->
    <style>
        :root {
            --color-1st: '#bead8e';
            --primary-font: 'Open Sans', sans-serif;
        }
    </style>
    <!-- Stylesheets
    ============================================= -->
    <link rel="stylesheet" href="{!! asset('frontend/css/bootstrap.css') !!}" type="text/css"/>
    <link rel="stylesheet" href="{!! asset('frontend/css/style.css') !!}" type="text/css"/>
    <link rel="stylesheet" href="{!! asset('frontend/css/dark.css') !!}" type="text/css"/>
    <link rel="stylesheet" href="{!! asset('frontend/css/responsive.css') !!}" type="text/css"/>
    <link rel="stylesheet" href="{!! asset('frontend/css/components/datepicker.css') !!}"/>
    <link rel="stylesheet" href="{!! asset('frontend/static/css/font-icons.css') !!}" type="text/css"/>
    <link rel="stylesheet" href="{!! asset('frontend/static/css/swiper.css') !!}" type="text/css"/>
    <link rel="stylesheet" href="{!! asset('frontend/static/css/animate.css') !!}" type="text/css"/>
    <link rel="stylesheet" href="{!! asset('frontend/static/css/magnific-popup.css') !!}" type="text/css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css"/>
    <link rel="stylesheet" href="{!! asset('frontend/plugins/select2/css/select2.min.css') !!}">
    <!-- Vertical tabs CSS -->
    <link rel="stylesheet" href="{!! asset('frontend/static/css/b4vtabs.min.css') !!}"/>
    <link rel="stylesheet" href="{!! asset('css/custom.css') !!}"/>
</head>

<body class="stretched">
<!-- Document Wrapper
============================================= -->
<div id="wrapper" class="clearfix homepage">
    <noscript>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-danger" style="margin-top: 25px;">
                    <div class="panel-heading">
                        <h6 class="panel-title">Xin cẩn thận!</h6>
                    </div>
                    <div class="panel-body bg-warning">
                        Ứng dụng quản lý này có sử dụng Javascript. Vui lòng cấu hình lại trình duyệt của bạn và cho
                        phép sử
                        dụng Javascript. Bạn có thể tham khảo cách kích hoạt chế độ chạy Javascript tại <a
                            href="http://www.enable-javascript.com" target="_blank"><b>đây.</b></a>
                    </div>
                </div>
            </div>
        </div>
    </noscript>
    @include('frontend.layouts.header')
    @yield('content')
    @includeIf('frontend.layouts.footer')
</div>
<!-- #wrapper end -->
<!-- External JavaScripts ============================================= -->
<script src="{!! asset('frontend/js/jquery.js') !!}"></script>
<script src="{!! asset('frontend/js/w3data.js') !!}"></script>
<script src="{!! asset('frontend/js/plugins.js') !!}"></script>
<script src="{!! asset('frontend/js/components/moment.js') !!}"></script>
<script src="{!! asset('frontend/js/components/datepicker.js') !!}"></script>
<script src="{!! asset('frontend/js/components/validate/jquery.validate.min.js') !!}"></script>
<script src="{!! asset('frontend/plugins/inputmask/inputmask.bundle.js') !!}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
<!-- Footer Scripts ============================================= -->
<script src="{!! asset('js/app.js') !!}"></script>
<script src="{!! asset('frontend/js/functions.js') !!}"></script>
<script src="{!! asset('frontend/plugins/select2/js/select2.full.min.js') !!}"></script>
@yield('javascript')
</body>

</html>
