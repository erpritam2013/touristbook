
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tourist Book Admin :: @yield('title')</title>
    <!-- Favicon icon -->
    @section('admin_head_css')
    <link rel="icon" type="image/png" sizes="16x16" href="{!! asset('admin-part/images/favicon-16x16.png') !!}">
    <link rel="stylesheet" href="{!! asset('admin-part/vendor/owl-carousel/css/owl.carousel.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('admin-part/vendor/owl-carousel/css/owl.theme.default.min.css') !!}">
    <link href="{!! asset('admin-part/vendor/jqvmap/css/jqvmap.min.css') !!}" rel="stylesheet">
    <link href="{!! asset('admin-part/css/style.css') !!}" rel="stylesheet">
    <style type="text/css">
        
        .nav-header .logo-abbr {
   max-width: 70px;
}
.nav-header .brand-title {
    margin-left: -21px;
    margin-top: 4px;
    max-width: 180px;
}
    </style>
    @show



