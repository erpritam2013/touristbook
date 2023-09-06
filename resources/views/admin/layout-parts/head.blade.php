
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tourist Book Admin :: @yield('title')</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{!! asset('admin-part/images/favicon-16x16.png') !!}">
    @section('admin_head_css')
    <link href="{!! asset('admin-part/vendor/jqvmap/css/jqvmap.min.css') !!}" rel="stylesheet">

    {{-- Sortable --}}
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

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

#show_image{
        border-radius: 0;
    max-width: 150px;
    height: auto;
}
#show_image{
        background: #fafafa;
  border: 1px solid #ccc;
  padding: 4px;
  display: block;
  float: left;
  /*max-width: 100%;
  height: auto;*/
  -ms-interpolation-mode: bicubic;
  -webkit-border-radius: 2px;
     -moz-border-radius: 2px;
          border-radius: 2px;
}
.main-card-tab{
    border: 1px solid rgba(0, 0, 0, 0.125);
}
label.subform-card-label {
    margin-bottom: 0.5rem;
    font-weight: 500;
    line-height: 1.2;
    color: #3d4465;
    font-size: 1.125rem;
}

    </style>
    @show



