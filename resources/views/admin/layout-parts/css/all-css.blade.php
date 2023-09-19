@if(Route::getRoutes()->match(request())->methods[0] == 'GET' && (matchRouteNameMatch('create') || matchRouteNameMatch('edit')))
@push('select2_css')
<!-- select2 css -->
<link rel="stylesheet" href="{!! asset('admin-part/vendor/select2/css/select2.min.css') !!}">
@endpush
@if(matchRouteNameMatch('locations'))
@push('asColorPicker-min-css')
<!-- asColorPicker css -->
<link href="{!! asset('admin-part/vendor/jquery-asColorPicker/css/asColorPicker.min.css') !!}" rel="stylesheet">
@endpush
@endif
@endif
@push('jquery-ui.css')
<!-- Sortable -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
@endpush
@push('jqvmap-min-css')
<!-- global css -->
<link href="{!! asset('admin-part/vendor/jqvmap/css/jqvmap.min.css') !!}" rel="stylesheet">
@endpush
@push('style-css')
<link href="{!! asset('admin-part/css/style.css') !!}" rel="stylesheet">
@endpush
@push('font-awesome-css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
@endpush
@push('custom_style')
<!-- custom style css -->
<link href="{!! asset('admin-part/css/custom-style.css') !!}" rel="stylesheet">
@endpush
<!-- For List or Index page css -->
@if(Route::getRoutes()->match(request())->methods[0] == 'GET' && matchRouteNameMatch('index'))
@push('dataTable_css')
<!-- Datatable -->
<link href="{!! asset('admin-part/vendor/datatables/css/jquery.dataTables.min.css') !!}" rel="stylesheet">
{{--<link href="https://cdn.datatables.net/searchbuilder/1.5.0/css/searchBuilder.dataTables.min.css" rel="stylesheet">--}}
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endpush
@endif