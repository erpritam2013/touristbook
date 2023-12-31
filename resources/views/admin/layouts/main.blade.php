<!DOCTYPE html>
<html lang="en">

<head>
   @include('admin.layout-parts.head')

</head>

<body>
    <input type="hidden" id="base-admin-url" value="{{route('admin.dashboard')}}" />
    <!--*******************
        Preloader start
        ********************-->
        <div id="preloader">
            <div class="sk-three-bounce">
                <div class="sk-child sk-bounce1"></div>
                <div class="sk-child sk-bounce2"></div>
                <div class="sk-child sk-bounce3"></div>
            </div>
        </div>
    <!--*******************
        Preloader end
        ********************-->


    <!--**********************************
        Main wrapper start
        ***********************************-->
        <div id="main-wrapper">

            @include('admin.layout-parts.nav')
            @include('admin.layout-parts.header')
            @include('admin.layout-parts.sidebar')


        <!--**********************************
            Content body start
            ***********************************-->
            <div class="content-body">
                <!-- row -->

                @yield('content')

            </div>
        <!--**********************************
            Content body end
            ***********************************-->
            @include('admin.layout-parts.footer')

        <!--**********************************
           Include Modals
           ***********************************-->
           @include('admin.partials.modals.file')

        <!--**********************************
           Support ticket button end
           ***********************************-->


       </div>
    <!--**********************************
        Main wrapper end
        ***********************************-->
        @include('admin.layout-parts.foot')

        @include('admin.partials.modals.video')

</body>

</html>
