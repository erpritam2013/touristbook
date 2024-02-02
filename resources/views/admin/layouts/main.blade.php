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
        @if(!isMobileDevice())
     @if(auth()->check())
    @if(auth()->user()->isAdmin() || auth()->user()->isEditor())
    @php
     $top_32_p_r = 'top:32px;position:relative;';
     $top_32 = 'top:32px;';
     @endphp
    @include('admin.adminbar')
    @endif 
    @endif
    @endif

    <!--**********************************
        Main wrapper start
        ***********************************-->
        <div id="main-wrapper" style="{{$top_32 ?? ''}}">
        
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
           @include('admin.partials.modals.gallery_sort')
           @include('admin.partials.modals.login-modal')

        <!--**********************************
           Support ticket button end
           ***********************************-->
       <!-- cookies template -->
          

       </div>
       
    <!--**********************************
        Main wrapper end
        ***********************************-->
        @include('admin.layout-parts.foot')

        @include('admin.partials.modals.video')

</body>

</html>
