<!DOCTYPE html>
<html lang="en">

<head>
 @include('admin.layouts.head')

</head>

<body>

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

            @include('admin.layouts.nav')
            @include('admin.layouts.header')
            @include('admin.layouts.sidebar')

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
            @include('admin.layouts.footer')

        <!--**********************************
           Support ticket button start
           ***********************************-->

        <!--**********************************
           Support ticket button end
           ***********************************-->


       </div>
    <!--**********************************
        Main wrapper end
        ***********************************-->
        @include('admin.layouts.foot')

    </body>

    </html>