@section('setting_action', route('admin.settings.theme-settings.store','google_setting'))
 <div class="card">
    <div class="card-header">
        <h4 class="card-title">Google Setting</h4>
    </div>
    <div class="card-body">
        <div class="gt-translate-form">
            <form class="form-valide" id="setting-form-gtranslate" action="@yield('google_setting')" method="post">
                 {{ csrf_field() }}
            @yield('setting_form_method')
                  
               {!!inputTemplate(['name'=>'google_map_api_key','value'=>get_settings_option_value('google_map_api_key'),'id'=>'google-map-api-key','label'=>'Google Map Api'])!!}
              
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>
</div>