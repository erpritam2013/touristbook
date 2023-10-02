<div class="card">
    <div class="card-header border-bottom">
        <h4 class="card-title">Tourism Zone Options</h4>
    </div>
    <div class="card-body">

        <div class="row">
            <div class="col-xl-3">
                <div class="nav flex-column nav-pills">
                    <a href="#v-pills-tourism-zone-options" data-toggle="pill" class="nav-link active show">Tourism Zone Tab</a>
                  
                </div>
            </div>
            <div class="col-xl-9">
                <div class="tab-content">
                    <div id="v-pills-tourism-zone-options" class="tab-pane fade active show">
                        
                        @include('admin.tourism-zones.tabs.tourism-zone-options', ["tourism_zone" => $tourism_zone,'states'=>$states])

                    </div>
                </div>
            </div>
        </div>


    </div>
</div>