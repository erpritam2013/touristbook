<!-- =======================
 header Start-->
<header class="header-static navbar-sticky navbar-light shadow">
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
                    <p class="small mt-2 mb-0"><strong>e.g.</strong>Template, Tourist Book, WordPress </p>
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
                                href="#"><i class="fab fa-facebook-f"></i></a> </li>
                        <li class="social-icons-item social-instagram m-0"> <a class="social-icons-link w-auto px-2"
                                href="#"><i class="fab fa-twitter"></i></a> </li>
                        <li class="social-icons-item social-twitter m-0"> <a class="social-icons-link w-auto pl-2"
                                href="#"><i class="fab fa-instagram"></i></a> </li>
                    </ul>
                   
                    <!-- Top info -->
                    <ul class="nav list-unstyled ml-3">
                        <li class="nav-item mr-3"> <a class="navbar-link" href="javascript:void(0)"><i class="fas fa-phone"></i>&nbsp;+91 98177-02160, 61, 62, 63</a> </li>
                        <li class="nav-item mr-3"> <a class="navbar-link" href="mail:to"><i class="fas fa-envelope"></i>&nbsp;
                                touristbook77@gmail.com</a> </li>
                    </ul>
                </div>

                <!-- navbar top Right-->
                <div class="d-flex align-items-center">
                    <!-- Top Account -->
                    <div class="dropdown"> <a class="dropdown-toggle" href="#" role="button" id="dropdownAccount"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                class="far fa-user mr-2"></i>Account </a>
                        <div class="dropdown-menu mt-2 shadow" aria-labelledby="dropdownAccount"> <a
                                class="dropdown-item" href="sign-in.html">Log In</a> <a class="dropdown-item"
                                href="sign-up.html">Register</a> <a class="dropdown-item" href="#">Settings</a>
                        </div>
                    </div>
                    <!-- top link -->
                    <ul class="nav">
                        <li class="nav-item"> <a class="nav-link" href="#">Contact</a> </li>
                    </ul>
                  

                     <!-- Language -->
                    <div class="dropdown top-language"> <a class="dropdown-toggle" href="#" role="button"
                            id="dropdownLanguage" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="dropdown-item-icon" src="{{asset('sites/images/flag/uk.svg')}}" alt=""> English </a>
                        <div class="dropdown-menu mt-2 shadow" aria-labelledby="dropdownLanguage"> <span
                                class="dropdown-item-text">Select language</span>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#"><img class="dropdown-item-icon"
                                    src="{{asset('sites/images/flag/sp.svg')}}" alt=""> Español</a> <a class="dropdown-item"
                                href="#"><img class="dropdown-item-icon" src="{{asset('sites/images/flag/fr.svg')}}" alt="">
                                Français</a> <a class="dropdown-item" href="#"><img class="dropdown-item-icon"
                                    src="{{asset('sites/images/flag/gr.svg')}}" alt=""> Deutsch</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Navbar top End-->

    <!-- Logo Nav Start -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="/"> <img src="{{asset('sites/images/tourist-book-logo-color.webp')}}" alt="Tourist Book"> </a>
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
