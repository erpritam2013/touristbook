<div class="card">
    <div class="card-header border-bottom">
        <h4 class="card-title">Information</h4>
    </div>
    <div class="card-body">

        <div class="row">
            <div class="col-xl-3">
                <div class="nav flex-column nav-pills">
                 <a href="#v-pills-location" data-toggle="pill" class="nav-link active show">Location</a>
                    <a href="#v-pills-general" data-toggle="pill" class="nav-link">General</a>
                    <a href="#v-pills-contact" data-toggle="pill" class="nav-link">Contact Information</a>
                    <a href="#v-pills-info-settings" data-toggle="pill" class="nav-link">Info Settings</a>
                    <a href="#v-pills-price" data-toggle="pill" class="nav-link">Price</a>
                    {{--<a href="#v-pills-checkinout" data-toggle="pill" class="nav-link">Check in/out time</a>
                    <a href="#v-pills-otheroptions" data-toggle="pill" class="nav-link">Other Options</a>
                    <a href="#v-pills-policy" data-toggle="pill" class="nav-link">Activity Policy</a>
                    <a href="#v-pills-notices" data-toggle="pill" class="nav-link">Important Notices</a>--}}
                </div>
            </div>
            <div class="col-xl-9">
                <div class="tab-content">
                   <div id="v-pills-location" class="tab-pane fade active show">
                       @include('admin.activities.tabs.location', ["activity" => $activity])
                                                            </div>
                    <div id="v-pills-general" class="tab-pane fade">

                        @include('admin.activities.tabs.general', ["activity" => $activity])

                    </div>
                    <div id="v-pills-contact" class="tab-pane fade">
                        @include('admin.activities.tabs.contact', ["activity" => $activity])
                    </div>
                    <div id="v-pills-info-settings" class="tab-pane fade">
                        @include('admin.activities.tabs.info-settings', ["activity" => $activity])
                    </div>
                    <div id="v-pills-price" class="tab-pane fade">
                        @include('admin.activities.tabs.price', ["activity" => $activity])
                    </div>
                    {{--<div id="v-pills-checkinout" class="tab-pane fade">
                        @include('admin.activities.tabs.check-in-out', ["activity" => $activity])
                    </div>
                    <div id="v-pills-otheroptions" class="tab-pane fade">
                        @include('admin.activities.tabs.other-options', ["activity" => $activity])
                    </div>
                    <div id="v-pills-policy" class="tab-pane fade">
                        @include('admin.partials.utils.subform-wrapper', ["subformData" => $activity->policies ?? null, 'type' => 'policy', 'btnTitle' => 'Add Policy'])
                    </div>
                    <div id="v-pills-notices" class="tab-pane fade">
                        @include('admin.partials.utils.subform-wrapper', ["subformData" => $activity->notices ?? null, 'type' => 'notices', 'btnTitle' => 'Add New'])

                    </div>--}}
                </div>
            </div>
        </div>


    </div>
</div>
