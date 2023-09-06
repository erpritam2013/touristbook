<div class="card">
    <div class="card-header border-bottom">
        <h4 class="card-title">Location Setting</h4>
    </div>
    <div class="card-body">

        <div class="row">
            <div class="col-xl-3">
                <div class="nav flex-column nav-pills">
                    {{--<a href="#v-pills-location" data-toggle="pill" class="nav-link active show">Hotel Near By Location Select</a>--}}
                    <a href="#v-pills-location-filter-add" data-toggle="pill" class="nav-link active show">Location Filter Add</a>
                    <a href="#v-pills-location-setting" data-toggle="pill" class="nav-link">Location Settings</a>
                    <a href="#v-pills-location-content" data-toggle="pill" class="nav-link">Location Content</a>
                    <a href="#v-pills-child-tabs" data-toggle="pill" class="nav-link">Child Tabs</a>
                    <a href="#v-pills-place-to-visit" data-toggle="pill" class="nav-link">Place To Visit</a>
                    <a href="#v-pills-what-to-do" data-toggle="pill" class="nav-link">What To Do</a>
                       <a href="#v-pills-stay" data-toggle="pill" class="nav-link">Stay</a>
                    <a href="#v-pills-packages" data-toggle="pill" class="nav-link">Packages</a>
                    <a href="#v-pills-need-to-know" data-toggle="pill" class="nav-link">Need To Know</a>
                    <a href="#v-pills-gallery" data-toggle="pill" class="nav-link">Gallery</a>
                    <a href="#v-pills-video" data-toggle="pill" class="nav-link">Video</a>
                 
                    <a href="#v-pills-hotels-activities" data-toggle="pill" class="nav-link">Hotels Activities Enter</a>
                    <a href="#v-pills-location-packages" data-toggle="pill" class="nav-link">Location Packages</a>
                </div>
            </div>
            <div class="col-xl-9">
                <div class="tab-content">
                    {{--<div id="v-pills-location" class="tab-pane fade active show">
                        <p>Location - Coming Soon</p>
                    </div>--}}
                    <div id="v-pills-location-filter-add" class="tab-pane fade active show">
                        
                        @include('admin.locations.tabs.location-filter-add', ["location" => $location])

                    </div>
                    <div id="v-pills-location-setting" class="tab-pane fade">
                        
                        @include('admin.locations.tabs.location-setting', ["location" => $location,'countries'=>$countries])

                    </div>
                    <div id="v-pills-location-content" class="tab-pane fade">
                        
                        @include('admin.locations.tabs.location-content', ["location" => $location])

                    </div>
                    <div id="v-pills-child-tabs" class="tab-pane fade">
                        
                        @include('admin.locations.tabs.child-tabs', ["location" => $location])

                    </div>
                    <div id="v-pills-place-to-visit" class="tab-pane fade">
                        @include('admin.locations.tabs.place-to-visit', ["location" => $location])
                    </div>
                    <div id="v-pills-what-to-do" class="tab-pane fade">
                        @include('admin.locations.tabs.what-to-do', ["location" => $location])
                    </div>
                     <div id="v-pills-stay" class="tab-pane fade">
                        @include('admin.locations.tabs.stay', ["location" => $location])
                    </div>
                    <div id="v-pills-packages" class="tab-pane fade">
                        @include('admin.locations.tabs.packages', ["location" => $location])
                    </div>
                    <div id="v-pills-need-to-know" class="tab-pane fade">
                        @include('admin.locations.tabs.need-to-know', ["location" => $location])
                    </div>
                   
                    <div id="v-pills-gallery" class="tab-pane fade">
                        @include('admin.locations.tabs.gallery', ["location" => $location])
                    </div>
                    <div id="v-pills-video" class="tab-pane fade">
                        @include('admin.locations.tabs.video', ["location" => $location])
                    </div>
                    <div id="v-pills-hotels-activities" class="tab-pane fade">
                        @include('admin.locations.tabs.hotels-activities', ["location" => $location])
                    </div>
                    <div id="v-pills-location-packages" class="tab-pane fade">
                        @include('admin.locations.tabs.location-packages', ["location" => $location])
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>