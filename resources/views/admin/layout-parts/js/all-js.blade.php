 <!--**********************************
        Scripts
        ***********************************-->
        @push('global_js')
        <!-- Required vendors -->
        <script src="{!! asset('admin-part/vendor/global/global.min.js') !!}"></script>
        <script src="{!! asset('admin-part/js/quixnav-init.js') !!}"></script>
        <script src="{!! asset('admin-part/js/custom.min.js') !!}"></script>
        @endpush
        @push('map_js')
        <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCF8MnYK1Ft-lPa3_B6rirg2IJzptB4m1Y&v=weekly&libraries=places&callback=Function.prototype"
        defer
        ></script>
        @endpush


        @if(Route::getRoutes()->match(request())->methods[0] == 'GET' && (matchRouteNameMatch('create') || matchRouteNameMatch('edit')))
        @push('ckeditor_js')<!-- ckediter -->
        <script src="{!! asset('admin-part/vendor/ckeditor/ckeditor.js') !!}"></script>
        <script src="{!! asset('admin-part/vendor/ckeditor/config.js') !!}"></script>
        @endpush
        @push('sortable_js')
        <!-- Sortable JS  -->
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
        @endpush
        @if(matchRouteNameMatch('locations'))

        @push('asColorPicker-js')
        <!-- asColorPicker -->
        <script src="{!! asset('admin-part/vendor/jquery-asColor/jquery-asColor.min.js') !!}"></script>
        <script src="{!! asset('admin-part/vendor/jquery-asGradient/jquery-asGradient.min.js') !!}"></script>
        <script src="{!! asset('admin-part/vendor/jquery-asColorPicker/js/jquery-asColorPicker.min.js') !!}"></script>
         <!-- asColorPicker init -->
        <script src="{!! asset('admin-part/js/plugins-init/jquery-asColorPicker.init.js') !!}"></script>
        @endpush
        @endif


        @endif
        @push('touristbook-terms-custom-js')
        <script src="{!! asset('admin-part/js/touristbook-terms-custom.js') !!}"></script>
        @endpush
        @push('tourist-lib-js')
        <script src="{!! asset('admin-part/js/tourist-lib.js') !!}"></script>
        @endpush
        @push('inline-custom-function')
        <script src="{!! asset('admin-part/js/inline-custom-function.js') !!}"></script>
        @endpush
        @push('all-min-js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
        @endpush
        @push('font-awesome-picker-js')
        <script src="{!! asset('admin-part/vendor/fontawesome-iconpicker/js/fontawesome-iconpicker.js') !!}"></script>
        <script src="{!! asset('admin-part/vendor/fontawesome-iconpicker/js/fontawesome-iconpicker-init.js') !!}"></script>
       
        @endpush
        <!-- For list or index page js -->
        @if(Route::getRoutes()->match(request())->methods[0] == 'GET' && matchRouteNameMatch('index'))
        @push('dataTable_js')
        <!-- Datatable -->
        <script src="{!! asset('admin-part/vendor/datatables/js/jquery.dataTables.min.js') !!}"></script>
        <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
        {!! $dataTable->scripts() !!}
        @endpush
        @endif
        <!-- For create and edit page js -->
        @if(Route::getRoutes()->match(request())->methods[0] == 'GET' && (matchRouteNameMatch('create') || matchRouteNameMatch('edit')))
        
        @push('jquery_validation-js')
        <!-- Jquery Validation -->
        <script src="{!! asset('admin-part/vendor/jquery-validation/jquery.validate.min.js') !!}"></script>
        <!-- Form validate init -->
        <script src="{!! asset('admin-part/js/plugins-init/jquery.validate-init.js') !!}"></script>
        @endpush
        @push('select2_js')
        <script src="{!! asset('admin-part/vendor/select2/js/select2.full.min.js') !!}"></script>
        <script src="{!! asset('admin-part/js/plugins-init/select2-init.js') !!}"></script>
        @endpush
        @endif