@php 
$footer_social_links = get_settings_option_value('footer_social_link');
@endphp
@if(!isMobileDevice())
<!-- =======================
 footer  -->
 <footer class="footer footer-light pt-6 position-relative">
    <div class="footer-content">
        <div class="container">
            <div class="row">
                <!-- Footer widget 1 -->
                <div class="col-md-3 col-sm-6 order-sm-1">
                    @php 
                    $footer_logo_arr = (!empty(get_settings_option_value('footer_logo')))?json_decode(get_settings_option_value('footer_logo'),true):[];
                    $footer_logo = (!empty($footer_logo_arr) && isset($footer_logo_arr[0]['id']))?getConversionUrl($footer_logo_arr[0]['id'],'400x417'):null;
                    @endphp
                   
                    <div class="widget address"> <a href="index-2.html" class="footer-logo mb-3 d-block">
                        <!-- SVG Logo Start -->
                        <img src="{{$footer_logo}}" style="background-color:#fff;">
                        <!-- SVG Logo End -->
                    </a>
                    <p></p>
                </div>
                <div class="wpb_text_column wpb_content_element  vc_custom_1629705719473">
                    <div class="wpb_wrapper">
                        <p><span style="color: #000; font-weight: 600; margin-bottom: 5px;">Follow Us<br>
                        </span><br>
                        <a style="margin-right: 20px;" href="{{get_single_value_of_col_in_setting($footer_social_links,'footer_facebook')}}"><i class="fab fa-facebook-f" style="font-size: 1.2rem;"></i>
                        </a>
                        <a style="margin-right: 20px;" href="{{get_single_value_of_col_in_setting($footer_social_links,'footer_twitter')}}">
                            <i class="fab fa-twitter" style="font-size: 1.2rem;"></i>
                        </a>
                        <a style="margin-right: 20px;" href="{{get_single_value_of_col_in_setting($footer_social_links,'footer_instagram')}}">
                         <i class="fab fa-instagram" style="font-size: 1.2rem;"></i>
                     </a>
                 </p>
             </div>
         </div>
     </div>
     <!-- Footer widget 2 -->
     <div class="col-md-2 col-sm-4 order-sm-3">
        <div class="widget">
            <h6>FOREWORD</h6>
            <div class="vc_separator"></div>
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link" href="{{route('about')}}">About</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('contact')}}">Contact</a></li>
                <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('blogs')}}">Blog</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('connecting-partners')}}">Connecting Partners</a></li>
            </ul>
        </div>
    </div>
    <!-- Footer widget 3 -->
    <div class="col-md-2 col-sm-4 order-sm-4">
        <div class="widget">
            <h6>DESTINATIONS</h6>
            <div class="vc_separator"></div>
            @php $destinations = footer_destinations(); @endphp
            <ul class="nav flex-column primary-hover">
                @if($destinations->isNotEmpty())
                @foreach($destinations as $destination)
                <li class="nav-item"><a class="nav-link" href="{{route('location',$destination->slug)}}">{{purify_string(ucwords($destination->name))}}</a></li>
                @endforeach
                @endif
            </ul>
        </div>

    </div>
    <!-- Footer widget 4 -->
    <div class="col-md-2 col-sm-4 order-sm-5">
        <div class="widget">
            <h6>PRODUCTS</h6>
            <div class="vc_separator"></div>
            <ul class="nav flex-column primary-hover">
                <li class="nav-item"><a class="nav-link" href="{{route('hotels')}}">Hotels</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('our-packages')}}">Packages</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('destinations')}}">Destination</a></li>
                <li class="nav-item"><a class="nav-link" href="{{get_settings_option_value('footer_jobs_link')}}">Jobs</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('activities')}}">Activities</a></li>
            </ul>
        </div>
    </div>
    <!-- Footer widget 5 -->
    <div class="col-md-3 col-sm-6 order-sm-2">
        <div class="widget address">
            <ul class="list-unstyled">
                <li class="media mb-3"><i class="fas fa-map-marked-alt mr-3 display-8"></i>{{get_settings_option_value('footer_address')}}</li>
                <li class="media mb-3"><i class="mr-3 display-8 fas fa-headphones-alt"></i> {{get_settings_option_value('footer_phone')}}
                </li>
                <li class="media mb-3"><i class="mr-3 display-8 far fa-envelope"></i> {{get_settings_option_value('footer_email')}}</li>
                {{--<li class="media mb-3"><i class="mr-3 display-8 far fa-clock"></i>
                    <p>Mon - Fri: <strong>09:00 - 21:00</strong> <br>
                        Sat & Sun: <strong>Closed</strong></p>
                    </li>--}}
                </ul>
            </div>
        </div>
    </div>
</div>
</div>
<div class="divider mt-3"></div>
<!--footer copyright -->
<div class="footer-light-copyright footer-copyright py-3">
    <div class="container">
        <div class="d-md-flex justify-content-between align-items-center py-3 text-center text-md-left">
            <!-- copyright text -->
            <div class="copyright-text">©{{date('Y')}} All Rights Reserved by <a href="/">{{get_settings_option_value('footer_copyrights')}}.</a></div>
            <!-- copyright links-->

        </div>
    </div>
</div>
</footer>
<!-- =======================
  footer  -->

  @else

  <!-- Footer -->
  <footer class="text-center text-white mobile-footer" style="background-color: #07509e">
    <!-- Grid container -->
    <div class="container">
      <!-- Section: Links -->
      <section class="">
        <!-- Grid row-->
        <div class="row text-center touristbook-d-flex justify-content-center pt-2">
          <!-- Grid column -->
          <div class="col-md-6">
            <h6 class="text-footer-link font-weight-bold">
              <a href="{{route('about')}}" class="text-white">About</a>
          </h6>
      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-md-6">
        <h6 class="text-footer-link font-weight-bold">
          <a href="{{route('connecting-partners')}}" class="text-white">Connecting Partners</a>
      </h6>
  </div>
  <!-- Grid column -->


  <!-- Grid column -->
  <div class="col-md-6">
    <h6 class="text-footer-link font-weight-bold">
      <a href="{{route('about')}}" class="text-white">Contact</a>
  </h6>
</div>
<!-- Grid column -->
</div>
<!-- Grid row-->
</section>
<!-- Section: Links -->

<hr class="my-3" style="background: #fba009;" />

<!-- Section: Text -->
<section class="">
    <div class="row d-flex justify-content-center">
      <div class="col-lg-12">
       <ul class="list-unstyled">
        <li class="media mb-3"><i class="fas fa-map-marked-alt mr-3 display-8"></i>{{get_settings_option_value('footer_address')}}</li>
        <li class="media mb-3"><i class="mr-3 display-8 fas fa-headphones-alt"></i> {{get_settings_option_value('footer_phone')}}
        </li>
        <li class="media mb-3"><i class="mr-3 display-8 far fa-envelope"></i> {{get_settings_option_value('footer_email')}}</li>
        {{--<li class="media mb-3"><i class="mr-3 display-8 far fa-clock"></i>
            <p>Mon - Fri: <strong>09:00 - 21:00</strong> <br>
                Sat & Sun: <strong>Closed</strong></p>
            </li>--}}
        </ul>

    </div>
</div>
</section>
<!-- Section: Text -->

<!-- Section: Social -->
<section class="text-center mb-1">
    <a href="{{get_single_value_of_col_in_setting($footer_social_links,'footer_facebook')}}" class="text-white me-4">
      <i class="fab fa-facebook-f"></i>
  </a>
  <a href="{{get_single_value_of_col_in_setting($footer_social_links,'footer_twitter')}}" class="text-white me-4">
      <i class="fab fa-twitter"></i>
  </a>
  {{--<a href="" class="text-white me-4">
      <i class="fab fa-google"></i>
  </a>--}}
  <a href="{{get_single_value_of_col_in_setting($footer_social_links,'footer_instagram')}}" class="text-white me-4">
      <i class="fab fa-instagram"></i>
  </a>
  {{--<a href="" class="text-white me-4">
      <i class="fab fa-linkedin"></i>
  </a>
  <a href="" class="text-white me-4">
      <i class="fab fa-github"></i>
  </a>--}}
</section>
<!-- Section: Social -->
</div>
<!-- Grid container -->

<!-- Copyright -->
<div class="text-center p-3" style="background-color: #07509e;border-top: 5px solid #fba009;"
>©{{date('Y')}} All Rights Reserved by <br>
<a class="text-white" href="/"
>{{get_settings_option_value('footer_copyrights')}}.</a
>
</div>
<!-- Copyright -->
</footer>
<!-- Footer -->

@endif


