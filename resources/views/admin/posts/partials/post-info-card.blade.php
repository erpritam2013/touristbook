<div class="card">
    <div class="card-header border-bottom">
        <h4 class="card-title">Information</h4>
    </div>
    <div class="card-body">

        <div class="row">
            <div class="col-xl-3">
                <div class="nav flex-column nav-pills">
                   <a href="#v-pills-information" data-toggle="pill" class="nav-link active show">Information</a>
                   <a href="#v-pills-post-sidebar-setting" data-toggle="pill" class="nav-link">Post Sidebar Setting</a>
               </div>
           </div>
           <div class="col-xl-9">
            <div class="tab-content">
             <div id="v-pills-information" class="tab-pane fade active show">
                @include('admin.posts.tabs.info-settings', ["post" => $post])
             </div>
             <div id="v-pills-post-sidebar-setting" class="tab-pane fade">

                @include('admin.posts.tabs.post-sidebar-setting', ["post" => $post])

            </div>

        </div>
    </div>
</div>


</div>
</div>
