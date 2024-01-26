
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Tourist Book Admin :: @yield('title')</title>
<!-- Favicon icon -->
<link rel="icon" type="image/png" sizes="16x16" href="{!! asset('admin-part/images/favicon-16x16.png') !!}">
@section('admin_head_css')
@include('admin.layout-parts.css.all-css')
@if(Route::getRoutes()->match(request())->methods[0] == 'GET' && matchRouteNameMatch('show'))
@stack('style-css')
@stack('font-awesome-css')
@else
@stack('select2_css') 
@stack('asColorPicker-min-css')
@stack('jquery-ui.css')
@stack('jqvmap-min-css')
@stack('style-css')
@stack('font-awesome-css')
@stack('font-awesome-picker-css')
@stack('dataTable_css')
@stack('custom_style')

@endif
@show




