<div class="card">
    <div class="card-header border-bottom">
        <h4 class="card-title">Activity Zone Options</h4>
    </div>
    <div class="card-body">

        <div class="row">
            <div class="col-xl-3">
                <div class="nav flex-column nav-pills">
                    <a href="#v-pills-activity-zone-options" data-toggle="pill" class="nav-link active show">Activity Zone Tab</a>
                  
                </div>
            </div>
            <div class="col-xl-9">
                <div class="tab-content">
                    <div id="v-pills-activity-zone-options" class="tab-pane fade active show">
                        
                        @include('admin.activity-zones.tabs.activity-zone-options', ["activity_zone" => $activity_zone,'countries'=>$countries])

                    </div>
                </div>
            </div>
        </div>


    </div>
</div>