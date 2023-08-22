<!--**********************************
            Sidebar start
        ***********************************-->

        <div class="quixnav">
            <div class="quixnav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label first">Main Menu</li>
                    <li class="{{matchRouteGroupName('dashboard','parent')}}"><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-single-04"></i><span class="nav-text">Dashboard</span></a>
                        <ul aria-expanded="false" class="{{matchRouteGroupName('dashboard','child')}}">
                            <li class="{{matchRouteName('admin.dashboard')}}"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                            {{--<li><a href="./index2.html">Dashboard 2</a></li>--}}
                        </ul>
                    </li>
                    <li class="{{matchRouteGroupName('terms','parent')}}"><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-layout-25"></i><span class="nav-text">Terms</span></a>
                        <ul aria-expanded="false" class="{{matchRouteGroupName('terms','child')}}">
                            <li class="{{matchRouteName('admin.terms.facilities.index')}}"><a href="{{route('admin.terms.facilities.index')}}">Facilities</a></li>
                            <li class="{{matchRouteName('admin.terms.amenities.index')}}"><a href="{{route('admin.terms.amenities.index')}}">Amenities</a></li>
                            <li class="{{matchRouteName('admin.terms.medicare-assistances.index')}}"><a href="{{route('admin.terms.medicare-assistances.index')}}">Medicare Assistances</a></li>
                            <li class="{{matchRouteName('admin.terms.top-services.index')}}"><a href="{{route('admin.terms.top-services.index')}}">Top Services</a></li>
                            <li class="{{matchRouteName('admin.terms.places.index')}}"><a href="{{route('admin.terms.places.index')}}">Places</a></li>
                            <li class="{{matchRouteName('admin.terms.accessibles.index')}}"><a href="{{route('admin.terms.accessibles.index')}}">Accessibles</a></li>
                            <li class="{{matchRouteName('admin.terms.property-types.index')}}"><a href="{{route('admin.terms.property-types.index')}}">Property Type</a></li>
                            <li class="{{matchRouteName('admin.terms.meeting-and-events.index')}}"><a href="{{route('admin.terms.meeting-and-events.index')}}">Meeting And Events</a></li>
                            <li class="{{matchRouteName('admin.terms.countries.index')}}"><a href="{{route('admin.terms.countries.index')}}">Countries</a></li>
                            <li class="{{matchRouteName('admin.terms.states.index')}}"><a href="{{route('admin.terms.states.index')}}">States</a></li>
                             <li class="{{matchRouteName('admin.terms.occupancies.index')}}"><a href="{{route('admin.terms.occupancies.index')}}">Occupancies</a></li>
                             <li class="{{matchRouteName('admin.terms.deal-discounts.index')}}"><a href="{{route('admin.terms.deal-discounts.index')}}">Deals Discount</a></li>
                             <li class="{{matchRouteName('admin.terms.term-activities.index')}}"><a href="{{route('admin.terms.term-activities.index')}}">Term Activities</a></li>
                        </ul>
                            {{--<li><a href="./app-profile.html">Profile</a></li>--}}

                       
                    </li>

                    <li class="{{matchRouteGroupName('hotels','parent')}}"><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-home-minimal"></i><span class="nav-text">Hotels</span></a>
                        <ul aria-expanded="false" class="{{matchRouteGroupName('hotels','child')}}">
                            <li class="{{matchRouteName('admin.hotels.index')}}"><a href="{{route('admin.hotels.index')}}">List</a></li>
                            <li class="{{matchRouteName('admin.hotels.create')}}"><a href="{{route('admin.hotels.create')}}">Add New</a></li>
                        </ul>
                    </li>

                    {{--<li class="nav-label">Apps</li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-app-store"></i><span class="nav-text">Apps</span></a>
                        <ul aria-expanded="false">
                            <li><a href="./app-profile.html">Profile</a></li>
                            <li><a href="./app-profile.html">Profile</a></li>
                            <li><a href="./app-profile.html">Profile</a></li>
                            <li><a href="./app-profile.html">Profile</a></li>
                            <li><a href="./app-profile.html">Profile</a></li>
                            <li><a href="./app-profile.html">Profile</a></li>
                            <li><a href="./app-profile.html">Profile</a></li>
                           
                        </ul>
                    </li>--}}
                       {{--<li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-chart-bar-33"></i><span class="nav-text">Charts</span></a>
                        <ul aria-expanded="false">
                            <li><a href="./chart-flot.html">Flot</a></li>
                            <li><a href="./chart-morris.html">Morris</a></li>
                            <li><a href="./chart-chartjs.html">Chartjs</a></li>
                            <li><a href="./chart-chartist.html">Chartist</a></li>
                            <li><a href="./chart-sparkline.html">Sparkline</a></li>
                            <li><a href="./chart-peity.html">Peity</a></li>
                        </ul>
                    </li>
                    <li class="nav-label">Components</li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-world-2"></i><span class="nav-text">Bootstrap</span></a>
                        <ul aria-expanded="false">
                            <li><a href="./ui-accordion.html">Accordion</a></li>
                            <li><a href="./ui-alert.html">Alert</a></li>
                            <li><a href="./ui-badge.html">Badge</a></li>
                            <li><a href="./ui-button.html">Button</a></li>
                            <li><a href="./ui-modal.html">Modal</a></li>
                            <li><a href="./ui-button-group.html">Button Group</a></li>
                            <li><a href="./ui-list-group.html">List Group</a></li>
                            <li><a href="./ui-media-object.html">Media Object</a></li>
                            <li><a href="./ui-card.html">Cards</a></li>
                            <li><a href="./ui-carousel.html">Carousel</a></li>
                            <li><a href="./ui-dropdown.html">Dropdown</a></li>
                            <li><a href="./ui-popover.html">Popover</a></li>
                            <li><a href="./ui-progressbar.html">Progressbar</a></li>
                            <li><a href="./ui-tab.html">Tab</a></li>
                            <li><a href="./ui-typography.html">Typography</a></li>
                            <li><a href="./ui-pagination.html">Pagination</a></li>
                            <li><a href="./ui-grid.html">Grid</a></li>

                        </ul>
                    </li>

                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-plug"></i><span class="nav-text">Plugins</span></a>
                        <ul aria-expanded="false">
                            <li><a href="./uc-select2.html">Select 2</a></li>
                            <li><a href="./uc-nestable.html">Nestedable</a></li>
                            <li><a href="./uc-noui-slider.html">Noui Slider</a></li>
                            <li><a href="./uc-sweetalert.html">Sweet Alert</a></li>
                            <li><a href="./uc-toastr.html">Toastr</a></li>
                            <li><a href="./map-jqvmap.html">Jqv Map</a></li>
                        </ul>
                    </li>
                    <li><a href="widget-basic.html" aria-expanded="false"><i class="icon icon-globe-2"></i><span
                                class="nav-text">Widget</span></a></li>
                    <li class="nav-label">Forms</li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-form"></i><span class="nav-text">Forms</span></a>
                        <ul aria-expanded="false">
                            <li><a href="./form-element.html">Form Elements</a></li>
                            <li><a href="./form-wizard.html">Wizard</a></li>
                            <li><a href="./form-editor-summernote.html">Summernote</a></li>
                            <li><a href="form-pickers.html">Pickers</a></li>
                            <li><a href="form-validation-jquery.html">Jquery Validate</a></li>
                        </ul>
                    </li>
                    <li class="nav-label">Table</li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-layout-25"></i><span class="nav-text">Table</span></a>
                        <ul aria-expanded="false">
                            <li><a href="table-bootstrap-basic.html">Bootstrap</a></li>
                            <li><a href="table-datatable-basic.html">Datatable</a></li>
                        </ul>
                    </li>

                    <li class="nav-label">Extra</li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-single-copy-06"></i><span class="nav-text">Pages</span></a>
                        <ul aria-expanded="false">
                            <li><a href="./page-register.html">Register</a></li>
                            <li><a href="./page-login.html">Login</a></li>
                            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Error</a>
                                <ul aria-expanded="false">
                                    <li><a href="./page-error-400.html">Error 400</a></li>
                                    <li><a href="./page-error-403.html">Error 403</a></li>
                                    <li><a href="./page-error-404.html">Error 404</a></li>
                                    <li><a href="./page-error-500.html">Error 500</a></li>
                                    <li><a href="./page-error-503.html">Error 503</a></li>
                                </ul>
                            </li>
                            <li><a href="./page-lock-screen.html">Lock Screen</a></li>
                        </ul>
                    </li>--}}
                </ul>
            </div>


        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->
