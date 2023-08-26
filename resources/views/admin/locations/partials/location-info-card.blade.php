<div class="card">
    <div class="card-header border-bottom">
        <h4 class="card-title">Information</h4>
    </div>
    <div class="card-body">

        <div class="row">
            <div class="col-xl-3">
                <div class="nav flex-column nav-pills">
                    <a href="#v-pills-location" data-toggle="pill" class="nav-link active show">Location</a>
                    <a href="#v-pills-location-detail" data-toggle="pill" class="nav-link">Location Detail</a>
                    <a href="#v-pills-contact" data-toggle="pill" class="nav-link">Contact Information</a>
                    <a href="#v-pills-price" data-toggle="pill" class="nav-link">Price</a>
                    <a href="#v-pills-checkinout" data-toggle="pill" class="nav-link">Check in/out time</a>
                    <a href="#v-pills-otheroptions" data-toggle="pill" class="nav-link">Other Options</a>
                    <a href="#v-pills-policy" data-toggle="pill" class="nav-link">location Policy</a>
                    <a href="#v-pills-notices" data-toggle="pill" class="nav-link">Important Notices</a>
                </div>
            </div>
            <div class="col-xl-9">
                <div class="tab-content">
                    <div id="v-pills-location" class="tab-pane fade active show">
                        <p>Location - Coming Soon</p>
                    </div>
                    <div id="v-pills-location-detail" class="tab-pane fade">
                        
                        @include('admin.locations.tabs.location-detail', ["location" => $location])

                    </div>
                    <div id="v-pills-contact" class="tab-pane fade">
                        @include('admin.locations.tabs.contact', ["location" => $location])
                    </div>
                    <div id="v-pills-price" class="tab-pane fade">
                        @include('admin.locations.tabs.price', ["location" => $location])
                    </div>
                    <div id="v-pills-checkinout" class="tab-pane fade">
                        @include('admin.locations.tabs.check-in-out', ["location" => $location])
                    </div>
                    <div id="v-pills-otheroptions" class="tab-pane fade">
                        @include('admin.locations.tabs.other-options', ["location" => $location])
                    </div>
                    {{--<div id="v-pills-policy" class="tab-pane fade">
                        @include('admin.locations.tabs.policy.policies', ["location" => $location])
                    </div>
                    <div id="v-pills-notices" class="tab-pane fade">
                        @include('admin.locations.tabs.notices', ["location" => $location])
                    </div>--}}
                </div>
            </div>
        </div>


    </div>
</div>