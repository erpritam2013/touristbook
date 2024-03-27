<!-- =======================
 header Start-->
 <header class="header-static navbar-sticky navbar-light shadow" {!!(!isMobileDevice() && auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isEditor()))?"style='top:32px;'":""!!}>
  <!-- Search -->
  <div class="top-search collapse bg-light" id="search-open" data-parent="#search">
    <div class="container">
      <div class="row position-relative">
        <div class="col-md-8 mx-auto py-5">
          <form>
            <div class="input-group">
              <input class="form-control border-radius-right-0 border-right-0" type="text" name="search"
              autofocus placeholder="What are you looking for?">
              <button type="button" class="btn btn-grad border-radius-left-0 mb-0">Search</button>
            </div>
          </form>
          <p class="small mt-2 mb-0"><strong>e.g.</strong>Template, Tourist Book</p>
        </div>
        <a class="position-absolute top-0 right-0 mt-3 mr-3" data-toggle="collapse" href="#search-open"><i
          class="fas fa-window-close"></i></a>
        </div>
      </div>
    </div>
    <!-- End Search -->

    <!-- Navbar top start-->
    <div class="navbar-top d-none d-lg-block">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center">
          <!-- navbar top Left-->
          <div class="d-flex align-items-center">

            <!-- top social -->
            <ul class="social-icons">
              <li class="social-icons-item social-facebook m-0"> <a class="social-icons-link w-auto px-2"
                href="{{get_single_value_of_col_in_setting(get_settings_option_value('topbar_social_link'),'topbar_facebook')}}"><i class="fab fa-facebook-f"></i></a> </li>
                  <li class="social-icons-item social-twitter m-0"> <a class="social-icons-link w-auto pl-2"
                    href="{{get_single_value_of_col_in_setting(get_settings_option_value('topbar_social_link'),'topbar_twitter')}}"><i class="fab fa-twitter"></i></a> </li>
                <li class="social-icons-item social-instagram m-0"> <a class="social-icons-link w-auto px-2"
                  href="{{get_single_value_of_col_in_setting(get_settings_option_value('topbar_social_link'),'topbar_instagram')}}"><i class="fab fa-instagram"></i></a> </li>
                  </ul>
                  <div class="vl-3"></div>

                  <!-- Top info -->
                  <ul class="nav list-unstyled">
                    <li class="nav-item mr-3"> <a class="navbar-link" href="mail:to"><i class="fas fa-envelope"></i>&nbsp;
                    {{get_settings_option_value('topbar_email')}}</a> </li>
                  </ul>
                </div>

                <!-- navbar top Right-->
                <div class="d-flex align-items-center">

                    <!-- top link -->
                    <ul class="nav">
                      <li class="nav-item"> <a class="nav-link" href="{{route('contact')}}">Contact us</a> </li>
                    </ul>
                      <div class="vl"></div>
                    <ul class="nav ">
                      <li class="nav-item"> <a class="navbar-link" href="javascript:void(0)"><i class="fas fa-phone mr-2"></i>{{get_settings_option_value('topbar_phone')}}</a></li>
                    </ul>
                    <div class="vl-2"></div>
                  <!-- Top Account -->
                      @if(auth()->check())
                 <div class="dropdown"> <a class="dropdown-toggle" href="#" role="button" id="dropdownAccount"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                    class="far fa-user mr-2"></i>{{ucwords(auth()->user()->name)}}</a>
                    <div class="dropdown-menu mt-2 shadow" aria-labelledby="dropdownAccount"> 
                       @if(auth()->user()->isAdmin() || auth()->user()->isEditor())
                      <a class="dropdown-item" href="{{route('admin.dashboard')}}">Dashboard</a>
                       <a class="dropdown-item" href="{{route('wishlists')}}">Wishlist</a>

                       @else
                      <a class="dropdown-item" href="{{route('wishlists')}}">Wishlist</a>
                      <a class="dropdown-item" href="#">Settings</a>

                       @endif
                    </div>
                  </div> 
                  <div class="vl-2"></div>
                      @endif
                     @if(!auth()->check())
                    <ul class="nav">
                      <li class="nav-item"> <a class="navbar-link" href="{{route('login')}}">Login</a> </li>
                    </ul>
                      <div class="vl-2"></div>
                    <ul class="nav ">
                      <li class="nav-item"> <a class="navbar-link" href="{{route('register')}}">Sign Up</a> </li>
                    </ul>
                    <div class="vl-2"></div>
                    @endif
                  <!-- Currency -->
                  <div class="dropdown">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownCurrency" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="dropdown-item-icon" src="https://touristbook.s3.ap-south-1.amazonaws.com/wp-content/uploads/currency/flags/{{strtolower(session('country_code', 'in'))}}.png" alt="currency-flag">{{session('currency', 'INR')}}</a>
                      <div class="dropdown-menu shadow" aria-labelledby="dropdownAccount" id="currency-dropdown">

                        @if($currency_list)
                        @foreach($currency_list as $currencyItem)
                        <a class="dropdown-item" href="#" data-value="{{$currencyItem->currency_name}}">
                          <img class="dropdown-item-icon" src="https://touristbook.s3.ap-south-1.amazonaws.com/wp-content/uploads/currency/flags/{{strtolower($currencyItem->country_code)}}.png" alt="currency-flag">
                          {{$currencyItem->currency_name}}
                        </a>
                        @endforeach
                        @endif

                      </div>
                    </div>
                   <div class="vl-4"></div>
                    <ul class="nav">
                      <li class="nav-item"> <a class="nav-link" href="{{route('blogs')}}">Blogs</a> </li>
                    </ul>
                    

                      <div class="vl"></div>

                      @php 

                      $languages = config('gt-languages');


                      $gt_translate_setting = exploreJsonData(get_settings_option_value('gtranslate_setting'));
                      if(!empty($gt_translate_setting)){
                        $languages = touristbook_array_filter_by_keys($languages,$gt_translate_setting,true);

                      }
                     
                      @endphp
                    <!-- Language -->
                    <div class="dropdown top-language"> <a class="dropdown-toggle" href="#" role="button"
                      id="dropdownLanguage" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-default_lang="en">
                      <img class="dropdown-item-icon" src="{{session('img_src',asset('sites/images/flag/en.svg'))}}" alt=""> {{session('languageText', 'English')}} </a>
                      <div class="dropdown-menu mt-2 shadow translation-links" aria-labelledby="dropdownLanguage" id="languageChange"> <span
                        class="dropdown-item-text">Select language</span>
                        <div class="dropdown-divider"></div>
                        @foreach($languages as $l_key => $language)
                        <a class="dropdown-item" href="#" data-lang="{{$l_key}}"  data-text="{{$language}}"><img class="dropdown-item-icon"
                          src="{{asset('sites/images/flag/'.$l_key.'.svg')}}" alt="">{{$language}}</a> 
                          @endforeach

                        {{--<a class="dropdown-item" href="#" data-lang="fr"><img class="dropdown-item-icon" src="{{asset('sites/images/flag/fr.svg')}}" alt="">
                        Franch</a> 
                        <a class="dropdown-item" href="#" data-lang="hi"><img class="dropdown-item-icon"
                          src="{{asset('sites/images/flag/hi.svg')}}" alt=""> Hindi</a>--}}
                        </div>
                      </div>
                       <div id="google_translate_element" ></div>

                    </div>
                  </div>
                </div>
              </div>
              <!-- Navbar top End-->

              <!-- Logo Nav Start -->
              <nav class="navbar navbar-expand-lg">
                <div class="container">
                  <!-- Logo -->
                  <a class="navbar-brand" href="/"> <img src="{{get_image_url(get_settings_option_value('web_logo'),0) ?? ''}}" alt="Tourist Book" class="web-logo" width="{{(!isMobileDevice())?get_settings_option_value('header_logo_width'):200}}" height="{{get_settings_option_value('header_logo_height')}}"> </a>
                  <!-- Menu opener button -->
                  <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse"
                  data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                  aria-label="Toggle navigation"> <span class="navbar-toggler-icon"> </span> </button>
                  <!-- Main Menu Start -->
                  <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav ml-auto">
                      <!-- Menu item 1 Demos-->
                      <li class="nav-item {{matchSiteRouteName('home')}}"> <a class="nav-link " href="{{route('home')}}"
                        id="demosMenu" aria-haspopup="true"
                        aria-expanded="false">Home</a>
                      </li>
                      <li class="nav-item {{matchSiteRouteName('hotels')}}"> <a class="nav-link" href="{{route('hotels')}}" id="docMenu" aria-haspopup="true" aria-expanded="false">Hotels</a>
                      </li>

                      <li class="nav-item dropdown {{matchSiteRouteName('about')}}"> <a class="nav-link dropdown-toggle" href="#" id="docMenu"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">About</a>
                        <ul class="dropdown-menu" aria-labelledby="docMenu">
                          <li><a class="dropdown-item" href="{{route('about')}}">About Us</a></li>
                          <li><a class="dropdown-item" href="{{route('connecting-partners')}}">Connecting Partners</a></li>

                        </ul>
                      </li>
                      <li class="nav-item {{matchSiteRouteName('our-packages')}}"> <a class="nav-link" href="{{route('our-packages')}}" id="docMenu" aria-haspopup="true" aria-expanded="false">Our Packages</a>
                      </li>

                      <li class="nav-item  {{matchSiteRouteName('destinations')}}"> <a class="nav-link" href="{{route('destinations')}}" id="docMenu" aria-haspopup="true" aria-expanded="false">Destinations</a>
                      </li>

                      <li class="nav-item {{matchSiteRouteName('home')}}"> <a class="nav-link" href="https://job.thetouristbook.com/" id="docMenu" aria-haspopup="true" aria-expanded="false">Jobs</a>
                      </li>

                      <li class="nav-item {{matchSiteRouteName('activities')}}"> <a class="nav-link" href="{{route('activities')}}" id="docMenu" aria-haspopup="true" aria-expanded="false">Activities</a>
                      </li>



                    </ul>
                  </div>
                  <!-- Main Menu End -->
                </div>
              </nav>
              <!-- Logo Nav End -->
            </header>
<!-- =======================
  header End-->
