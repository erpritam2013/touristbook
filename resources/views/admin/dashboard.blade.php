
@extends('admin.layouts.main')
@section('title','Dashboard')
@section('admin_head_css')
@parent
@endsection
@section('content')


  <div class="container-fluid">
               @include('admin.layout-parts.breadcrumbs')

      <div class="row">

                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-one card-body">
                                <div class="stat-icon d-inline-block" onclick="window.location.replace('{{route("admin.hotels.index")}}')">
                                    <i class="fas fa-hotel {{getIconColorClass()}} f-custom-css"></i>
                                </div>
                                <div class="stat-content d-inline-block">
                                    <div class="stat-text"  onclick="window.location.replace('{{route("admin.hotels.index")}}')">Hotels</div>
                                    <div class="stat-digit">{{$hotels}}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-one card-body">
                                <div class="stat-icon d-inline-block" onclick="window.location.replace('{{route("admin.rooms.index")}}')">
                                    <i class="fas fa-bed {{getIconColorClass()}} f-custom-css"></i>
                                </div>
                                <div class="stat-content d-inline-block">
                                    <div class="stat-text" onclick="window.location.replace('{{route("admin.rooms.index")}}')">Rooms</div>
                                    <div class="stat-digit">{{$rooms}}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-one card-body">
                                <div class="stat-icon d-inline-block" onclick="window.location.replace('{{route("admin.activities.index")}}')">
                                    <i class="fas fa-hiking {{getIconColorClass()}} f-custom-css"></i>
                                </div>
                                <div class="stat-content d-inline-block">
                                    <div class="stat-text" onclick="window.location.replace('{{route("admin.activities.index")}}')">Activities</div>
                                    <div class="stat-digit">{{$activities}}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-one card-body">
                                <div class="stat-icon d-inline-block" onclick="window.location.replace('{{route("admin.locations.index")}}')">
                                    <i class="fas fa-map-marker {{getIconColorClass()}} f-custom-css"></i>
                                </div>
                                <div class="stat-content d-inline-block">
                                    <div class="stat-text" onclick="window.location.replace('{{route("admin.locations.index")}}')">Locations</div>
                                    <div class="stat-digit">{{$locations}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-one card-body">
                                <div class="stat-icon d-inline-block" onclick="window.location.replace('{{route("admin.tours.index")}}')">
                                    <i class="fas fa-route {{getIconColorClass()}} f-custom-css"></i>
                                </div>
                                <div class="stat-content d-inline-block">
                                    <div class="stat-text" onclick="window.location.replace('{{route("admin.tours.index")}}')">Packages</div>
                                    <div class="stat-digit">{{$tours}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-one card-body">
                                <div class="stat-icon d-inline-block" onclick="window.location.replace('{{route("admin.pages.pageIndex")}}')">
                                    <i class="fas fa-file {{getIconColorClass()}} f-custom-css"></i>
                                </div>
                                <div class="stat-content d-inline-block">
                                    <div class="stat-text" onclick="window.location.replace('{{route("admin.pages.pageIndex")}}')">Pages</div>
                                    <div class="stat-digit">{{$pages}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-one card-body">
                                <div class="stat-icon d-inline-block" onclick="window.location.replace('{{route("admin.posts.index")}}')">
                                    <i class="fas fa-file {{getIconColorClass()}} f-custom-css"></i>
                                </div>
                                <div class="stat-content d-inline-block">
                                    <div class="stat-text" onclick="window.location.replace('{{route("admin.posts.index")}}')">Posts</div>
                                    <div class="stat-digit">{{$posts}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-one card-body">
                                <div class="stat-icon d-inline-block" onclick="window.location.replace('{{route("admin.activity-lists.index")}}')">
                                    <i class="fas fa-hiking {{getIconColorClass()}} f-custom-css"></i>
                                </div>
                                <div class="stat-content d-inline-block">
                                    <div class="stat-text" onclick="window.location.replace('{{route("admin.activity-lists.index")}}')">Activity list</div>
                                    <div class="stat-digit">{{$activity_lists}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-one card-body">
                                <div class="stat-icon d-inline-block" onclick="window.location.replace('{{route("admin.users.index")}}')">
                                    <i class="fas fa-users {{getIconColorClass()}} f-custom-css"></i>
                                </div>
                                <div class="stat-content d-inline-block">
                                    <div class="stat-text" onclick="window.location.replace('{{route("admin.users.index")}}')">users</div>
                                    <div class="stat-digit">{{$users}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-one card-body">
                                <div class="stat-icon d-inline-block" onclick="window.location.replace('{{route("admin.tourism-zones.index")}}')">
                                    <i class="fas fa-area-chart {{getIconColorClass()}} f-custom-css"></i>
                                </div>
                                <div class="stat-content d-inline-block">
                                    <div class="stat-text" onclick="window.location.replace('{{route("admin.tourism-zones.index")}}')">Tourism Zones</div>
                                    <div class="stat-digit">{{$tourism_zones}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-one card-body">
                                <div class="stat-icon d-inline-block" onclick="window.location.replace('{{route("admin.activity-zones.index")}}')">
                                    <i class="fas fa-area-chart {{getIconColorClass()}} f-custom-css"></i>
                                </div>
                                <div class="stat-content d-inline-block">
                                    <div class="stat-text" onclick="window.location.replace('{{route("admin.activity-zones.index")}}')">Activity Zones</div>
                                    <div class="stat-digit">{{$activity_zones}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-one card-body">
                                <div class="stat-icon d-inline-block" onclick="window.location.replace('{{route("admin.country-zones.index")}}')">
                                    <i class="fas fa-area-chart {{getIconColorClass()}} f-custom-css"></i>
                                </div>
                                <div class="stat-content d-inline-block">
                                    <div class="stat-text" onclick="window.location.replace('{{route("admin.country-zones.index")}}')">Country Zones</div>
                                    <div class="stat-digit">{{$country_zones}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                 
                </div>

            </div>
@endsection
@section('admin_jscript')

@parent

 <!-- Vectormap -->
     {{--<script src="{!! asset('admin-part/vendor/raphael/raphael.min.js') !!}"></script>
   <script src="{!! asset('admin-part/vendor/morris/morris.min.js') !!}"></script>


    <script src="{!! asset('admin-part/vendor/circle-progress/circle-progress.min.js') !!}"></script>
    <script src="{!! asset('admin-part/vendor/chart.js/Chart.bundle.min.js') !!}"></script>

    <script src="{!! asset('admin-part/vendor/gaugeJS/dist/gauge.min.js') !!}"></script>

    <!--  flot-chart js -->
    <script src="{!! asset('admin-part/vendor/flot/jquery.flot.js') !!}"></script>
    <script src="{!! asset('admin-part/vendor/flot/jquery.flot.resize.js') !!}"></script>

    <!-- Owl Carousel -->
    <script src="{!! asset('admin-part/vendor/owl-carousel/js/owl.carousel.min.js') !!}"></script>

    <!-- Counter Up -->
    <script src="{!! asset('admin-part/vendor/jqvmap/js/jquery.vmap.min.js') !!}"></script>
    <script src="{!! asset('admin-part/vendor/jqvmap/js/jquery.vmap.usa.js') !!}"></script>
    <script src="{!! asset('admin-part/vendor/jquery.counterup/jquery.counterup.min.js') !!}"></script>


    <script src="{!! asset('admin-part/js/dashboard/dashboard-1.js') !!}"></script>--}}
@endsection