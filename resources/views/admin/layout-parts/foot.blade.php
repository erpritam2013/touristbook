@section('admin_jscript')

@include('admin.layout-parts.js.all-js')

@if(Route::getRoutes()->match(request())->methods[0] == 'GET' && matchRouteNameMatch('show'))
@stack('global_js')
@else

@stack('global_js')
@stack('map_js')
@stack('ckeditor_js')
@stack('sortable_js')
@stack('asColorPicker-js')
@stack('touristbook-terms-custom-js')
@stack('tourist-lib-js')
@stack('all-min-js')
@stack('dataTable_js')
@stack('jquery_validation-js')
@stack('select2_js')
@endif

@show
