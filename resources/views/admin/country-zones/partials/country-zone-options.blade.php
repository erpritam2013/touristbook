<div class="card">
    <div class="card-header border-bottom">
        <h4 class="card-title">Country Zone Options (Other Packages)</h4>
    </div>
    <div class="card-body">

        <div class="row">
            <div class="col-xl-3">
                <div class="nav flex-column nav-pills">
                    <a href="#v-pills-country-zone-options" data-toggle="pill" class="nav-link active show">Country Zone Tab</a>
                  
                </div>
            </div>
            <div class="col-xl-9">
                <div class="tab-content">
                    <div id="v-pills-country-zone-options" class="tab-pane fade active show">
                        
                        @include('admin.country-zones.tabs.country-zone-options', ["country_zone" => $country_zone,'countries'=>$countries])

                    </div>
                </div>
            </div>
        </div>


    </div>
</div>