<div class="card">
    <div class="card-header border-bottom">
        <h4 class="card-title">Theme Settings</h4>
    </div>
    <div class="card-body">

        <div class="row">
            <div class="col-xl-3">
                <div class="nav flex-column nav-pills">
                   <a href="#v-pills-header" data-toggle="pill" class="nav-link active show">Header</a>
                   <a href="#v-pills-footer" data-toggle="pill" class="nav-link">Footer</a>
                   <a href="#v-pills-page" data-toggle="pill" class="nav-link">Page</a>
                   <a href="#v-pills-hotel" data-toggle="pill" class="nav-link">Hotel</a>
                   <a href="#v-pills-tour" data-toggle="pill" class="nav-link">Tour</a>
                   <a href="#v-pills-location" data-toggle="pill" class="nav-link">Location</a>
                   <a href="#v-pills-activity" data-toggle="pill" class="nav-link">Activity</a>
                   <a href="#v-pills-post" data-toggle="pill" class="nav-link">Post</a>
                   <a href="#v-pills-gt-translate" data-toggle="pill" class="nav-link">GT Language</a>
                   <a href="#v-pills-google-setting" data-toggle="pill" class="nav-link">Google-Setting</a>
                   <a href="#v-pills-booking" data-toggle="pill" class="nav-link">Booking</a>
                   <a href="#v-pills-profile" data-toggle="pill" class="nav-link">Admin Profile</a>
                   <a href="#v-pills-payment" data-toggle="pill" class="nav-link">Payment</a>
               </div>
           </div>
           <div class="col-xl-9">
            <div class="tab-content">
             <div id="v-pills-header" class="tab-pane fade active show ">
                @include('admin.settings.theme-settings.tabs.header', ["settings" => $settings])
             </div>
             <div id="v-pills-footer" class="tab-pane fade ">
                @include('admin.settings.theme-settings.tabs.footer', ["settings" => $settings])
             </div>
             <div id="v-pills-page" class="tab-pane fade ">
                @include('admin.settings.theme-settings.tabs.page', ["settings" => $settings])
             </div>
             <div id="v-pills-hotel" class="tab-pane fade ">
                @include('admin.settings.theme-settings.tabs.hotel', ["settings" => $settings])
             </div>
             <div id="v-pills-tour" class="tab-pane fade">
                @include('admin.settings.theme-settings.tabs.tour', ["settings" => $settings])
             </div>
             <div id="v-pills-location" class="tab-pane fade ">
                @include('admin.settings.theme-settings.tabs.location', ["settings" => $settings])
             </div>
             <div id="v-pills-activity" class="tab-pane fade ">
                @include('admin.settings.theme-settings.tabs.activity', ["settings" => $settings])
             </div>
             <div id="v-pills-post" class="tab-pane fade ">
                @include('admin.settings.theme-settings.tabs.post', ["settings" => $settings])
             </div>
             <div id="v-pills-google-setting" class="tab-pane fade ">
                @include('admin.settings.theme-settings.tabs.google-setting', ["settings" => $settings])
             </div>
             <div id="v-pills-gt-translate" class="tab-pane fade ">
                @include('admin.settings.theme-settings.tabs.gt-translate', ["settings" => $settings])
             </div>
             <div id="v-pills-booking" class="tab-pane fade ">
                @include('admin.settings.theme-settings.tabs.booking', ["settings" => $settings])
             </div>
             <div id="v-pills-profile" class="tab-pane fade ">
                @include('admin.settings.theme-settings.tabs.profile', ["settings" => $settings])
             </div>
             <div id="v-pills-payment" class="tab-pane fade ">
                @include('admin.settings.theme-settings.tabs.payment', ["settings" => $settings])
             </div>
           

        </div>
    </div>
</div>


</div>
</div>
