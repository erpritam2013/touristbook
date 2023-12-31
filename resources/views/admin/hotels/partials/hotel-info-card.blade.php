<div class="card">
    <div class="card-header border-bottom">
        <h4 class="card-title">Information</h4>
    </div>
    <div class="card-body">

        <div class="row">
            <div class="col-xl-3">
                <div class="nav flex-column nav-pills">
                    <a href="#v-pills-location" data-toggle="pill" class="nav-link active show">Location</a>
                    <a href="#v-pills-hotel-detail" data-toggle="pill" class="nav-link">Hotel Detail</a>
                    <a href="#v-pills-contact" data-toggle="pill" class="nav-link">Contact Information</a>
                    <a href="#v-pills-price" data-toggle="pill" class="nav-link">Price</a>
                    <a href="#v-pills-checkinout" data-toggle="pill" class="nav-link">Check in/out time</a>
                    <a href="#v-pills-otheroptions" data-toggle="pill" class="nav-link">Other Options</a>
                    <a href="#v-pills-policy" data-toggle="pill" class="nav-link">Hotel Policy</a>
                    <a href="#v-pills-notices" data-toggle="pill" class="nav-link">Important Notices</a>
                </div>
            </div>
            <div class="col-xl-9">
                <div class="tab-content">
                    <div id="v-pills-location" class="tab-pane fade active show">
                        @include('admin.hotels.tabs.location', ["hotel" => $hotel])
                    </div>
                    <div id="v-pills-hotel-detail" class="tab-pane fade">

                        @include('admin.hotels.tabs.hotel-detail', ["hotel" => $hotel])

                    </div>
                    <div id="v-pills-contact" class="tab-pane fade">
                        @include('admin.hotels.tabs.contact', ["hotel" => $hotel])
                    </div>
                    <div id="v-pills-price" class="tab-pane fade">
                        @include('admin.hotels.tabs.price', ["hotel" => $hotel])
                    </div>
                    <div id="v-pills-checkinout" class="tab-pane fade">
                        @include('admin.hotels.tabs.check-in-out', ["hotel" => $hotel])
                    </div>
                    <div id="v-pills-otheroptions" class="tab-pane fade">
                        @include('admin.hotels.tabs.other-options', ["hotel" => $hotel])
                    </div>
                   
                    <div id="v-pills-policy" class="tab-pane fade">
                        @include('admin.partials.utils.subform-wrapper', ["subformData" => $hotel->policies ?? null, 'type' => 'policies', 'btnTitle' => 'Add Policy'])
                    </div>
                    <div id="v-pills-notices" class="tab-pane fade">
                        @include('admin.partials.utils.subform-wrapper', ["subformData" => $hotel->notices ?? null, 'type' => 'notices', 'btnTitle' => 'Add New'])

                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
