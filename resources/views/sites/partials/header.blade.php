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
                    <p class="small mt-2 mb-0"><strong>e.g.</strong>Template, TravelGo, WordPress </p>
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
                    <!-- Language -->
                    <div class="dropdown"> <a class="dropdown-toggle" href="#" role="button"
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
                    <!-- Top info -->
                    <ul class="nav list-unstyled ml-3">
                        <li class="nav-item mr-3"> <a class="navbar-link" href="#"><strong>Phone:</strong> (024)
                                123-1457</a> </li>
                        <li class="nav-item mr-3"> <a class="navbar-link" href="#"><strong>Email:</strong>
                                help@TravelGo.com</a> </li>
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
                    <!-- top social -->
                    <ul class="social-icons">
                        <li class="social-icons-item social-facebook m-0"> <a class="social-icons-link w-auto px-2"
                                href="#"><i class="fab fa-facebook-f"></i></a> </li>
                        <li class="social-icons-item social-instagram m-0"> <a class="social-icons-link w-auto px-2"
                                href="#"><i class="fab fa-twitter"></i></a> </li>
                        <li class="social-icons-item social-twitter m-0"> <a class="social-icons-link w-auto pl-2"
                                href="#"><i class="fab fa-instagram"></i></a> </li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
    <!-- Navbar top End-->

    <!-- Logo Nav Start -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="index-2.html"> <img src="{{asset('sites/images/tourist-book-logo-color.webp')}}" alt="travelgo"> </a>
            <!-- Menu opener button -->
            <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse"
                data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                aria-label="Toggle navigation"> <span class="navbar-toggler-icon"> </span> </button>
            <!-- Main Menu Start -->
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav ml-auto">
                    <!-- Menu item 1 Demos-->
                    <li class="nav-item dropdown active"> <a class="nav-link dropdown-toggle" href="#"
                            id="demosMenu" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">Home</a>
                        <ul class="dropdown-menu" aria-labelledby="homeMenu">
                            <li><a class="dropdown-item" href="index-2.html">Home Layout 1</a></li>
                            <li><a class="dropdown-item" href="homepage2.html">Home Layout 2</a></li>
                            <li><a class="dropdown-item" href="homepage3.html">Home Layout 3</a></li>
                            <li><a class="dropdown-item" href="homepage4.html">Home Layout 4</a></li>
                            <li><a class="dropdown-item" href="homepage5.html">Home Layout 5</a></li>
                            <li><a class="dropdown-item" href="homepage6.html">Home Layout 6</a></li>
                            <li class="dropdown-header">Header Style</li>
                            <li><a class="dropdown-item" href="header-1.html">Header Style 1</a></li>
                            <li><a class="dropdown-item" href="header-2.html">Header Style 2</a></li>
                            <li><a class="dropdown-item" href="header-3.html">Header Style 3</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" id="docMenu"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Hotels</a>
                        <ul class="dropdown-menu" aria-labelledby="docMenu">
                            <li><a class="dropdown-item" href="hotel-index.html">Home Hotels</a></li>
                            <li><a class="dropdown-item" href="hotel-list-view.html">List View</a></li>
                            <li><a class="dropdown-item" href="hotel-grid-view.html">Grid View</a></li>
                            <li><a class="dropdown-item" href="hotel-detailed.html">Detailed</a></li>
                            <li><a class="dropdown-item" href="hotel-booking.html">Booking</a></li>
                            <li><a class="dropdown-item" href="hotel-thankyou.html">Thank You</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" id="docMenu"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Flights</a>
                        <ul class="dropdown-menu" aria-labelledby="docMenu">
                            <li><a class="dropdown-item" href="flight-index.html">Home Flights</a></li>
                            <li><a class="dropdown-item" href="flight-list-view.html">List View</a></li>
                            <li><a class="dropdown-item" href="flight-grid-view.html">Grid View</a></li>
                            <li><a class="dropdown-item" href="flight-detailed.html">Detailed</a></li>
                            <li><a class="dropdown-item" href="flight-booking.html">Booking</a></li>
                            <li><a class="dropdown-item" href="flight-thankyou.html">Thank You</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" id="docMenu"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Cars</a>
                        <ul class="dropdown-menu" aria-labelledby="docMenu">
                            <li><a class="dropdown-item" href="car-index.html">Home Cars</a></li>
                            <li><a class="dropdown-item" href="car-list-view.html">List View</a></li>
                            <li><a class="dropdown-item" href="car-grid-view.html">Grid View</a></li>
                            <li><a class="dropdown-item" href="car-detailed.html">Detailed</a></li>
                            <li><a class="dropdown-item" href="car-booking.html">Booking</a></li>
                            <li><a class="dropdown-item" href="car-thankyou.html">Thank You</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" id="docMenu"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Cruises</a>
                        <ul class="dropdown-menu" aria-labelledby="docMenu">
                            <li><a class="dropdown-item" href="cruise-index.html">Home Cruises</a></li>
                            <li><a class="dropdown-item" href="cruise-list-view.html">List View</a></li>
                            <li><a class="dropdown-item" href="cruise-grid-view.html">Grid View</a></li>
                            <li><a class="dropdown-item" href="cruise-detailed.html">Detailed</a></li>
                            <li><a class="dropdown-item" href="cruise-booking.html">Booking</a></li>
                            <li><a class="dropdown-item" href="cruise-thankyou.html">Thank You</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" id="docMenu"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Tour</a>
                        <ul class="dropdown-menu" aria-labelledby="docMenu">
                            <li><a class="dropdown-item" href="tour-index.html">Home Tour</a></li>
                            <li><a class="dropdown-item" href="all_tours_list.html">All tours list</a></li>
                            <li><a class="dropdown-item" href="all_tours_grid.html">All tours grid</a></li>
                            <li><a class="dropdown-item" href="single_tour.html">Single tour page</a></li>
                            <li><a class="dropdown-item" href="single_tour_with_gallery.html">Single tour with
                                    gallery</a></li>
                            <li><a class="dropdown-item" href="payment.html">Single tour booking</a></li>
                        </ul>
                    </li>

                    <!-- Menu item 5 Elements-->
                    <li class="nav-item dropdown megamenu"> <a class="nav-link dropdown-toggle" href="#"
                            id="elementsMenu" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">Pages</a>
                        <div class="dropdown-menu" aria-labelledby="elementsMenu">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-6 col-lg-3">
                                        <ul class="list-unstyled">
                                            <li><a class="dropdown-item" href="pages-aboutus1.html">About Us</a></li>
                                            <li><a class="dropdown-item" href="pages-services1.html">Services</a></li>
                                            <li><a class="dropdown-item"
                                                    href="pages-photogallery-4column.html">Gallery 4 Column</a></li>
                                            <li><a class="dropdown-item"
                                                    href="pages-photogallery-3column.html">Gallery 3 Column</a></li>
                                            <li><a class="dropdown-item"
                                                    href="pages-photogallery-2column.html">Gallery 2 Column</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <ul class="list-unstyled">
                                            <li><a class="dropdown-item" href="pages-faq1.html">Faq 1</a></li>
                                            <li><a class="dropdown-item" href="pages-404-1.html">404 Page</a></li>
                                            <li><a class="dropdown-item" href="pages-coming-soon1.html">Coming
                                                    Soon</a></li>
                                            <li><a class="dropdown-item" href="pages-login1.html">Login </a></li>
                                            <li><a class="dropdown-item" href="pages-register.html">Registration </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <ul class="list-unstyled">
                                            <li><a class="dropdown-item" href="pages-layouts-twosidebar.html">Layouts
                                                    Two Sidebar</a></li>
                                            <li><a class="dropdown-item" href="pages-layouts-fullwidth.html">Layouts
                                                    Full Width</a></li>
                                            <li><a class="dropdown-item" href="#">Contact Us</a></li>
                                            <li><a class="dropdown-item"
                                                    href="pages-travelo-policies.html">Policies</a></li>
                                            <li><a class="dropdown-item" href="pages-sitemap.html">Site Map</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <ul class="list-unstyled">
                                            <li><a class="dropdown-item" href="pages-blog-rightsidebar.html">Blog
                                                    Right Sidebar</a></li>
                                            <li><a class="dropdown-item" href="pages-blog-leftsidebar.html">Blog Left
                                                    Sidebar</a></li>
                                            <li><a class="dropdown-item" href="pages-blog-fullwidth.html">Blog Full
                                                    Width</a></li>
                                            <li><a class="dropdown-item" href="pages-blog-read.html">Blog Details</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <!-- Menu item 6 Docs-->

                    <!-- Menu item 5 Elements-->
                    <li class="nav-item dropdown megamenu"> <a class="nav-link dropdown-toggle" href="#"
                            id="elementsMenu" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">Elements</a>
                        <div class="dropdown-menu" aria-labelledby="elementsMenu">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-6 col-lg-3">
                                        <ul class="list-unstyled">
                                            <li> <a class="dropdown-item" href="elements-accordion.html">Accordion</a>
                                            </li>
                                            <li> <a class="dropdown-item" href="elements-action-box.html">Action
                                                    box</a> </li>
                                            <li> <a class="dropdown-item" href="elements-alerts.html">Alerts</a> </li>
                                            <li> <a class="dropdown-item"
                                                    href="elements-animated-headlines.html">Animated Headlines</a>
                                            </li>
                                            <li> <a class="dropdown-item"
                                                    href="elements-blockquote.html">Blockquote</a> </li>
                                            <li> <a class="dropdown-item" href="elements-buttons.html">Buttons</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <ul class="list-unstyled">
                                            <li> <a class="dropdown-item" href="elements-clients.html">Clients</a>
                                            </li>
                                            <li> <a class="dropdown-item" href="elements-counter.html">Counter</a>
                                            </li>
                                            <li> <a class="dropdown-item" href="elements-divider.html">Divider</a>
                                            </li>
                                            <li> <a class="dropdown-item" href="elements-feature-box.html">Feature
                                                    box</a> </li>
                                            <li> <a class="dropdown-item" href="elements-forms.html">Forms</a> </li>
                                            <li> <a class="dropdown-item" href="elements-grid.html">Grid</a> </li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <ul class="list-unstyled">
                                            <li> <a class="dropdown-item" href="elements-list-styles.html">list
                                                    styles</a> </li>
                                            <li> <a class="dropdown-item" href="elements-map.html">Map</a> </li>
                                            <li> <a class="dropdown-item" href="elements-modal.html">Modal</a> </li>
                                            <li> <a class="dropdown-item" href="elements-skill.html">skill</a> </li>
                                            <li> <a class="dropdown-item" href="elements-social-icon.html">social
                                                    icon</a> </li>
                                            <li> <a class="dropdown-item" href="elements-tab.html">Tab</a> </li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <ul class="list-unstyled">
                                            <li> <a class="dropdown-item" href="elements-table.html">Table</a> </li>
                                            <li> <a class="dropdown-item" href="elements-team.html">Team</a> </li>
                                            <li> <a class="dropdown-item"
                                                    href="elements-typography.html">Typography</a> </li>
                                            <li> <a class="dropdown-item" href="elements-video.html">Video</a> </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <!-- Menu item 6 Docs-->

                </ul>
            </div>
            <!-- Main Menu End -->
            <!-- Header Extras Start-->
            <div class="navbar-nav">
                <!-- extra item Search-->
                <div class="nav-item search border-0 pl-3 pr-0 px-lg-2" id="search"> <a class="nav-link"
                        data-toggle="collapse" href="#search-open"><i class="fas fa-search"></i></a> </div>
                <!-- extra item Btn-->
                <div class="nav-item border-0 d-none d-lg-inline-block align-self-center"> <a href="#"
                        class=" btn btn-sm btn-grad text-white mb-0">Online Booking</a> </div>
            </div>
            <!-- Header Extras End-->
        </div>
    </nav>
    <!-- Logo Nav End -->
</header>
<!-- =======================
          header End-->
