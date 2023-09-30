<div class="card">
    <div class="card-header border-bottom">
        <h4 class="card-title">tourism Zone State Options</h4>
    </div>

    <div class="card-body">


        <div class="row">
            <div class="col-xl-3">
                <div class="nav flex-column nav-pills">
                    <a href="#v-pills-tourism-zone-pdf-options" data-toggle="pill" class="nav-link active show">tourism Zone State Tab</a>
                </div>
            </div>
            <div class="col-xl-9">
                <div class="tab-content">
                    <div id="v-pills-tourism-zone-pdf-options" class="tab-pane fade active show">
                        
                        @include('admin.tourism-zones.tabs.tourism-zone-states', ["tourism_zone" => $tourism_zone])

                    </div>
                   
                </div>
            </div>
        </div>
        

    </div>
</div>