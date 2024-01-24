@section('title',$title ?? '')
<!doctype html>
<html lang="en">

<!-- Mirrored from html.themefax.com/travelgo/ by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 23 Sep 2023 14:50:53 GMT -->

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" id="google-font-css-css" href="https://fonts.googleapis.com/css?family=Poppins:400,500,600&#038;ver=6.3" type="text/css" media="all" />
    <!-- Bootstrap CSS -->
    <link href="{{ asset('sites/css/style.css')}}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('sites/css/bootstrap-datepicker.css')}}" type="text/css" rel="stylesheet" />
    <!-- Favicon -->
    <!-- Favicon and Touch Icons -->
    <link rel="icon" type="image/png" sizes="16x16" href="{!! asset('admin-part/images/favicon-16x16.png') !!}">
    <title>Tourist Book :: @yield('title')</title>

    <style>
        a.btn-action {
            background: #222;
            color: #fff;
            padding: 9px 13px;
            margin: 0 0 0 15px;
        }
    </style>
    @isset($custom_icons)
      {!!getCustomIcons($custom_icons)!!}
    @endisset
    @if($body_class == 'activity-detail-page')
    <link rel="stylesheet" type="text/css" href="{{ asset('sites/css/activity-list.css')}}">
    @endif
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/cookie-consent/css/cookie-consent.css')}}">
</head>

<body class="{{touristbook_sanitize_title($body_class ?? '') ?? ''}}">

    <input type="hidden" id="base-url" value="{{route('home')}}" />

    @include('sites.partials.header')

    @yield('content')

    @include('sites.partials.newsletter')

    
    @include('sites.partials.footer')

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{asset('sites/js/jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('sites/js/popper.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('sites/js/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('sites/js/functions.js')}}" type="text/javascript"></script>
    <script src="{{asset('sites/js/owl.carousel.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('sites/js/slick.js')}}" type="text/javascript"></script>
    <script src="{{asset('sites/js/swiper.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('sites/js/main.js')}}" type="text/javascript"></script>
    <script src="{{asset('sites/js/jquery.fancybox.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('sites/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('sites/js/jquery-ui.min.js')}}" type="text/javascript"></script>



    <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCF8MnYK1Ft-lPa3_B6rirg2IJzptB4m1Y&v=weekly&libraries=places"
    defer
    ></script>
    <script src="{{asset('sites/js/common.js')}}" type="text/javascript" defer></script>
    @if(isset($body_class) && $body_class == 'destination-detail-page')
    <script src="{{asset('sites/js/fetchDestinaitonDetail.js')}}" type="text/javascript" defer></script>
    
    @endif

    {{-- <script src="{{asset('sites/js/map_infobox.js')}}" type="text/javascript" defer></script>
    <script src="{{asset('sites/js/markerclusterer.js')}}" type="text/javascript" defer></script>
    <script src="{{asset('sites/js/maps.js')}}" type="text/javascript" defer></script> --}}

    <button onclick="topScrollSite()" id="topScrollSite" title="Go to top"><i class="fa fa-arrow-up"></i></button>

    <div class="modal fade" id="showMoreData" tabindex="-1" role="dialog" aria-labelledby="streetLabel"
    aria-hidden="true" style="z-index: 999999;top: 100px;">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title service-title" id="showMoreDataLabel"></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body" id="showMoreDataBody">

    </div>

</div>
</div>
</div>
 <a href="javascript:void(0)" class="js-lcc-settings-toggle">@lang('cookie-consent::texts.alert_settings')</a>
</body>


</html>
