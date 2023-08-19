
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tourist Book Admin :: @yield('title')</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{!! asset('admin-part/images/favicon-16x16.png') !!}">
    @section('admin_head_css')
    <link href="{!! asset('admin-part/vendor/jqvmap/css/jqvmap.min.css') !!}" rel="stylesheet">
    <link href="{!! asset('admin-part/css/style.css') !!}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
   <style type="text/css">
        
        .nav-header .logo-abbr {
   max-width: 60px;
}
.nav-header .brand-title {
    margin-left: -21px;
    margin-top: 4px;
    max-width: 180px;
}

@media (min-width: 768px)
.form-inline .form-control {
    display: inline-block;
    width: auto;
    vertical-align: middle;
}
.extra-data{
    padding: 15px;
    border: 5px solid #dddddd;
    border-radius: 25px;
    margin: 15px 0px;
}
    </style>
    @show



