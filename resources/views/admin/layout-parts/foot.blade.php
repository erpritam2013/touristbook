  @section('admin_jscript')
  <!--**********************************
        Scripts
        ***********************************-->
        <!-- Required vendors -->
        <script src="{!! asset('admin-part/vendor/global/global.min.js') !!}"></script>
        <script src="{!! asset('admin-part/js/quixnav-init.js') !!}"></script>
        <script src="{!! asset('admin-part/js/custom.min.js') !!}"></script>

        <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCF8MnYK1Ft-lPa3_B6rirg2IJzptB4m1Y&v=weekly&libraries=places"
        defer
        ></script>

        <!-- ckediter -->
        <script src="{!! asset('admin-part/vendor/ckeditor/ckeditor.js') !!}"></script>
        <script src="{!! asset('admin-part/vendor/ckeditor/config.js') !!}"></script>

        {{-- Sortable JS --}}
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

        <script src="{!! asset('admin-part/js/touristbook-terms-custom.js') !!}"></script>
        <script src="{!! asset('admin-part/js/tourist-lib.js') !!}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
        <!-- For list or index page js -->
        @if(Route::getRoutes()->match(request())->methods[0] == 'GET' && matchRouteNameMatch('index'))
        <!-- Datatable -->
        <script src="{!! asset('admin-part/vendor/datatables/js/jquery.dataTables.min.js') !!}"></script>
        <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
        {!! $dataTable->scripts() !!}
        @endif
        <!-- For create and edit page js -->
        @if(Route::getRoutes()->match(request())->methods[0] == 'GET' && (matchRouteNameMatch('create') || matchRouteNameMatch('edit')))
        //no js
        @endif

        @show
