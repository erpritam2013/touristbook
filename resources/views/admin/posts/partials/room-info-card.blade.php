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
                    
                    <a href="#v-pills-price" data-toggle="pill" class="nav-link">Room Price</a>
                    <a href="#v-pills-room-facility" data-toggle="pill" class="nav-link">Room Facility</a>
                    <a href="#v-pills-other-facility" data-toggle="pill" class="nav-link">Other Facility</a>

                    {{--<a href="#v-pills-checkinout" data-toggle="pill" class="nav-link">Check in/out time</a>
                    <a href="#v-pills-otheroptions" data-toggle="pill" class="nav-link">Other Options</a>
                    <a href="#v-pills-policy" data-toggle="pill" class="nav-link">Room Policy</a>
                    <a href="#v-pills-notices" data-toggle="pill" class="nav-link">Important Notices</a>--}}
                </div>
            </div>
            <div class="col-xl-9">
                <div class="tab-content">
                   <div id="v-pills-location" class="tab-pane fade active show">
                       @include('admin.rooms.tabs.location', ["room" => $room])
                                                            </div>
                    <div id="v-pills-general" class="tab-pane fade">

                        @include('admin.rooms.tabs.general', ["room" => $room])

                    </div>
                    <div id="v-pills-price" class="tab-pane fade">
                        @include('admin.rooms.tabs.price', ["room" => $room])
                    </div>
                    <div id="v-pills-room-facility" class="tab-pane fade">
                        @include('admin.rooms.tabs.room-facility', ["room" => $room])
                    </div>
                    <div id="v-pills-other-facility" class="tab-pane fade">
                        @include('admin.rooms.tabs.other-facility', ["room" => $room])
                    </div>
                    {{--<div id="v-pills-checkinout" class="tab-pane fade">
                        @include('admin.rooms.tabs.check-in-out', ["room" => $room])
                    </div>
                    <div id="v-pills-otheroptions" class="tab-pane fade">
                        @include('admin.rooms.tabs.other-options', ["room" => $room])
                    </div>
                    <div id="v-pills-policy" class="tab-pane fade">
                        @include('admin.partials.utils.subform-wrapper', ["subformData" => $room->policies ?? null, 'type' => 'policy', 'btnTitle' => 'Add Policy'])
                    </div>
                    <div id="v-pills-notices" class="tab-pane fade">
                        @include('admin.partials.utils.subform-wrapper', ["subformData" => $room->notices ?? null, 'type' => 'notices', 'btnTitle' => 'Add New'])

                    </div>--}}
                </div>
            </div>
        </div>


    </div>
</div>
