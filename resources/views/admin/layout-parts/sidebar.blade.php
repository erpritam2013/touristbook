<!--**********************************
            Sidebar start
            ***********************************-->

            <div class="quixnav sidebar-touristbook">
                <div class="quixnav-scroll">
                    <ul class="metismenu" id="menu" style="{{$top_32_p_r ?? ''}}">
                        <li class="nav-label first">Main Menu</li>
                        <li class="{{matchRouteGroupName('dashboard','parent')}}"><a class="" href="{{route('admin.dashboard')}}" aria-expanded="false"><i
                            class="icon icon-single-04"></i><span class="nav-text">Dashboard</span></a>
                            {{--<ul aria-expanded="false" class="{{matchRouteGroupName('dashboard','child')}}">
                                <li class="{{matchRouteName('admin.dashboard')}}"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                               <li><a href="./index2.html">Dashboard 2</a></li>
                            </ul>--}}
                        </li>

                           <li class="{{matchRouteGroupName('posts','parent')}}"><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                            class="fas fa-laptop sidebar-icon-touristbook"></i><span class="nav-text">Posts</span></a>
                            <ul aria-expanded="false" class="{{matchRouteGroupName('posts','child')}}">
                                <li class="{{matchRouteName('admin.posts.index')}}"><a href="{{route('admin.posts.index')}}">List</a></li>
                                <li class="{{matchRouteName('admin.posts.create')}}"><a href="{{route('admin.posts.create')}}">Add New</a></li>
                                  <li class="{{matchRouteName('admin.terms.categories.index')}}"><a href="{{route('admin.terms.categories.index')}}">Categories</a></li>
                                <li class="{{matchRouteName('admin.terms.tags.index')}}"><a href="{{route('admin.terms.tags.index')}}">Tags</a></li>

                            </ul>
                        </li>
                           <li class="{{matchRouteGroupName('pages','parent')}}"><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                            class="fas fa-file sidebar-icon-touristbook"></i><span class="nav-text">Pages</span></a>
                            <ul aria-expanded="false" class="{{matchRouteGroupName('pages','child')}}">
                                <li class="{{matchRouteName('admin.pages.index')}}"><a href="{{route('admin.pages.pageIndex')}}">List</a></li>
                                <li class="{{matchRouteName('admin.pages.create')}}"><a href="{{route('admin.pages.create')}}">Add New</a></li>

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
                                <li class="{{matchRouteName('admin.terms.property-types.index')}}"><a href="{{route('admin.terms.property-types.index')}}">Property Types</a></li>
                                <li class="{{matchRouteName('admin.terms.package-types.index')}}"><a href="{{route('admin.terms.package-types.index')}}">Package Types</a></li>
                                <li class="{{matchRouteName('admin.terms.other-packages.index')}}"><a href="{{route('admin.terms.other-packages.index')}}">Other Packages</a></li>
                                <li class="{{matchRouteName('admin.terms.meeting-and-events.index')}}"><a href="{{route('admin.terms.meeting-and-events.index')}}">Meeting And Events</a></li>
                                <li class="{{matchRouteName('admin.terms.countries.index')}}"><a href="{{route('admin.terms.countries.index')}}">Countries</a></li>
                                <li class="{{matchRouteName('admin.terms.states.index')}}"><a href="{{route('admin.terms.states.index')}}">States</a></li>
                                <li class="{{matchRouteName('admin.terms.occupancies.index')}}"><a href="{{route('admin.terms.occupancies.index')}}">Occupancies</a></li>
                                <li class="{{matchRouteName('admin.terms.deal-discounts.index')}}"><a href="{{route('admin.terms.deal-discounts.index')}}">Deals Discount</a></li>
                                <li class="{{matchRouteName('admin.terms.term-activities.index')}}"><a href="{{route('admin.terms.term-activities.index')}}">Term Activities</a></li>
                                <li class="{{matchRouteName('admin.terms.languages.index')}}"><a href="{{route('admin.terms.languages.index')}}">Languages</a></li>
                                <li class="{{matchRouteName('admin.terms.attractions.index')}}"><a href="{{route('admin.terms.attractions.index')}}">Attractions</a></li>
                                <li class="{{matchRouteName('admin.terms.term-activity-lists.index')}}"><a href="{{route('admin.terms.term-activity-lists.index')}}">Term Activity Lists</a></li>
                                <li class="{{matchRouteName('admin.terms.categories.index')}}"><a href="{{route('admin.terms.categories.index')}}">Categories</a></li>
                                <li class="{{matchRouteName('admin.terms.types.index')}}"><a href="{{route('admin.terms.types.index')}}">Types</a></li>
                                <li class="{{matchRouteName('admin.terms.tags.index')}}"><a href="{{route('admin.terms.tags.index')}}">Tags</a></li>

                            </ul>
                            {{--<li><a href="./app-profile.html">Profile</a></li>--}}


                        </li>

                        <li class="{{matchRouteGroupName('hotels','parent')}}"><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                            class="fas fa-hotel sidebar-icon-touristbook"></i><span class="nav-text">Hotels</span></a>
                            <ul aria-expanded="false" class="{{matchRouteGroupName('hotels','child')}}">
                                <li class="{{matchRouteName('admin.hotels.index')}}"><a href="{{route('admin.hotels.index')}}">List</a></li>
                                <li class="{{matchRouteName('admin.hotels.create')}}"><a href="{{route('admin.hotels.create')}}">Add New</a></li>
                                 <li class="{{matchRouteGroupName('rooms','parent')}}"><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                            class="fas fa-bed sidebar-icon-touristbook"></i><span class="nav-text">Rooms</span></a>
                            <ul aria-expanded="false" class="{{matchRouteGroupName('rooms','child')}}">
                                <li class="{{matchRouteName('admin.rooms.index')}}"><a href="{{route('admin.rooms.index')}}">List</a></li>
                                <li class="{{matchRouteName('admin.rooms.create')}}"><a href="{{route('admin.rooms.create')}}">Add New</a></li>
                            </ul>
                        </li>
                            </ul>
                        </li>


                        <li class="{{matchRouteGroupName('activities','parent')}}"><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                            class="fas fa-hiking sidebar-icon-touristbook"></i><span class="nav-text">Activities</span></a>
                            <ul aria-expanded="false" class="{{matchRouteGroupName('activities','child')}}">
                                <li class="{{matchRouteName('admin.activities.index')}}"><a href="{{route('admin.activities.index')}}">List</a></li>
                                <li class="{{matchRouteName('admin.activities.create')}}"><a href="{{route('admin.activities.create')}}">Add New</a></li>
                            </ul>
                        </li>

                        @if( auth()->user()->isAdmin() )
                        <li class="{{matchRouteGroupName('users','parent')}}"><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                            class="fas fa-users sidebar-icon-touristbook"></i><span class="nav-text">User</span></a>
                            <ul aria-expanded="false" class="{{matchRouteGroupName('users','child')}}">
                                <li class="{{matchRouteName('admin.users.index')}}"><a href="{{route('admin.users.index')}}">List</a></li>
                                <li class="{{matchRouteName('admin.users.create')}}"><a href="{{route('admin.users.create')}}">Add New</a></li>
                            </ul>
                        </li>
                        @endif

                        <li class="{{matchRouteGroupName('tours','parent')}}"><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                            class="fas fa-route sidebar-icon-touristbook"></i><span class="nav-text">Tours</span></a>
                            <ul aria-expanded="false" class="{{matchRouteGroupName('tours','child')}}">
                                <li class="{{matchRouteName('admin.tours.index')}}"><a href="{{route('admin.tours.index')}}">List</a></li>
                                <li class="{{matchRouteName('admin.tours.create')}}"><a href="{{route('admin.tours.create')}}">Add New</a></li>
                            </ul>
                        </li>

                        <li class="{{matchRouteGroupName('locations','parent')}}"><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                            class="fas fa-map-marker sidebar-icon-touristbook"></i><span class="nav-text">Locations</span></a>
                            <ul aria-expanded="false" class="{{matchRouteGroupName('locations','child')}}">
                                <li class="{{matchRouteName('admin.locations.index')}}"><a href="{{route('admin.locations.index')}}">List</a></li>
                                <li class="{{matchRouteName('admin.locations.create')}}"><a href="{{route('admin.locations.create')}}">Add New</a></li>
                            </ul>
                        </li>

                          <li class="{{matchRouteGroupName('zone','parent') ?? matchRouteGroupName('activity-lists','parent') ?? matchRouteGroupName('activity-packages','parent')}}"><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                            class="icon icon-marker-3 sidebar-icon-touristbook"></i><span class="nav-text">Zones</span></a>
                            <ul aria-expanded="false" class="{{matchRouteGroupName('zone','child') ?? matchRouteGroupName('activity-lists','child') ?? matchRouteGroupName('activity-packages','child')}}">

                                  <li class="{{matchRouteGroupName('country-zones','parent')}}"><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                            class="icon icon-marker-3"></i><span class="nav-text">Country Zones</span></a>
                            <ul aria-expanded="false" class="{{matchRouteGroupName('country-zones','child')}}">
                                <li class="{{matchRouteName('admin.country-zones.index')}}"><a href="{{route('admin.country-zones.index')}}">List</a></li>
                                <li class="{{matchRouteName('admin.country-zones.create')}}"><a href="{{route('admin.country-zones.create')}}">Add New</a></li>
                            </ul>
                        </li>
                        <li class="{{matchRouteGroupName('activity-zones','parent')}}"><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                            class="icon icon-marker-3"></i><span class="nav-text">Activity Zones</span></a>
                            <ul aria-expanded="false" class="{{matchRouteGroupName('activity-zones','child')}}">
                                <li class="{{matchRouteName('admin.activity-zones.index')}}"><a href="{{route('admin.activity-zones.index')}}">List</a></li>
                                <li class="{{matchRouteName('admin.activity-zones.create')}}"><a href="{{route('admin.activity-zones.create')}}">Add New</a></li>
                            </ul>
                        </li>
                        <li class="{{matchRouteGroupName('activity-lists','parent')}}"><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                            class="icon icon-marker-3"></i><span class="nav-text">Activity List</span></a>
                            <ul aria-expanded="false" class="{{matchRouteGroupName('activity-lists','child')}}">
                                <li class="{{matchRouteName('admin.activity-lists.index')}}"><a href="{{route('admin.activity-lists.index')}}">List</a></li>
                                <li class="{{matchRouteName('admin.activity-lists.create')}}"><a href="{{route('admin.activity-lists.create')}}">Add New</a></li>
                            </ul>
                        </li>

                        <li class="{{matchRouteGroupName('activity-packages','parent')}}"><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                            class="icon icon-marker-3"></i><span class="nav-text">Activity Packages</span></a>
                            <ul aria-expanded="false" class="{{matchRouteGroupName('activity-packages','child')}}">
                                <li class="{{matchRouteName('admin.activity-packages.index')}}"><a href="{{route('admin.activity-packages.index')}}">List</a></li>
                                <li class="{{matchRouteName('admin.activity-packages.create')}}"><a href="{{route('admin.activity-packages.create')}}">Add New</a></li>
                            </ul>
                        </li>
                        <li class="{{matchRouteGroupName('tourism-zones','parent')}}"><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                            class="icon icon-marker-3"></i><span class="nav-text">Tourism Zones</span></a>
                            <ul aria-expanded="false" class="{{matchRouteGroupName('tourism-zones','child')}}">
                                <li class="{{matchRouteName('admin.tourism-zones.index')}}"><a href="{{route('admin.tourism-zones.index')}}">List</a></li>
                                <li class="{{matchRouteName('admin.tourism-zones.create')}}"><a href="{{route('admin.tourism-zones.create')}}">Add New</a></li>
                            </ul>
                        </li>

                            </ul>
                        </li>


                       <li class="nav-label">Settings</li>
                        <li><a class="has-arrow {{matchRouteGroupName('settings','parent')}}" href="javascript:void()" aria-expanded="false"><i
                            class="fas fa-cog sidebar-icon-touristbook"></i><span class="nav-text">Settings</span></a>
                            <ul aria-expanded="false" class="{{matchRouteGroupName('settings','child')}}">
                                <li><a href="{{route('admin.settings.custom-icons.index')}}" class="{{matchRouteName('admin.settings.custom-icons.index')}}">Custom Icon Upload</a></li>
                                <li><a href="{{route('admin.settings.video-galleries.index')}}" class="{{matchRouteName('admin.settings.video-galleries.index')}}">Video Gallery</a></li>
                                <li><a href="{{route('admin.settings.theme-settings.index')}}" class="{{matchRouteName('admin.settings.theme-settings.index')}}">Theme Settings</a></li>
                                <li><a href="{{route('admin.settings.media-object.index')}}" class="{{matchRouteName('admin.settings.media-object.index')}}">Media List</a></li>
                                {{--<li><a href="./app-profile.html">Profile</a></li>
                                <li><a href="./app-profile.html">Profile</a></li>
                                <li><a href="./app-profile.html">Profile</a></li>
                                <li><a href="./app-profile.html">Profile</a></li>
                                <li><a href="./app-profile.html">Profile</a></li>--}}

                            </ul>
                        </li>
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

                            <li class="{{matchRouteGroupName('conversions','parent')}}"><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="fas fa-currency sidebar-icon-touristbook"></i><span class="nav-text">Currency Conversions</span></a>
                                <ul aria-expanded="false" class="{{matchRouteGroupName('conversions','child')}}">
                                    <li class="{{matchRouteName('admin.conversions.index')}}"><a href="{{route('admin.conversions.index')}}">List</a></li>
                                    <li class="{{matchRouteName('admin.conversions.create')}}"><a href="{{route('admin.conversions.create')}}">Add Currency</a></li>
                                </ul>
                            </li>


                        </ul>
                    </div>


                </div>
        <!--**********************************
            Sidebar end
            ***********************************-->
