<div class="card">
    <div class="card-header border-bottom">
        <h4 class="card-title">Information</h4>
    </div>
    <div class="card-body">

        <div class="row">
            <div class="col-xl-3">
                <div class="nav flex-column nav-pills">
                   <a href="#v-pills-information" data-toggle="pill" class="nav-link active show">Information</a>
                   <a href="#v-pills-page-sidebar-setting" data-toggle="pill" class="nav-link">Page Sidebar Setting</a>
               </div>
           </div>
           <div class="col-xl-9">
            <div class="tab-content">
             <div id="v-pills-information" class="tab-pane fade active show">
                @include('admin.pages.tabs.info-settings', ["page" => $page])
             </div>
             <div id="v-pills-page-sidebar-setting" class="tab-pane fade">

                @include('admin.pages.tabs.page-sidebar-setting', ["page" => $page])

            </div>

        </div>
    </div>
</div>


</div>
</div>
