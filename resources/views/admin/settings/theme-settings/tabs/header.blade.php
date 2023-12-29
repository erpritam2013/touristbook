@section('setting_action', route('admin.settings.theme-settings.store','header'))
<form class="form-valide" id="setting-form-header" action="@yield('setting_action')" method="post">
    {{ csrf_field() }}
    @yield('setting_form_method')
 <div class="card mb-0">
 <div class="card-header border border-info p-3 ml-1 bg-secondary.bg-gradient">
        <h4 class="card-title">Header</h4>
 </div>
    <div class="card-body">
    @php 
     $wep_logo = exploreJsonData(get_settings_option_value('web_logo'));
     $favicon = exploreJsonData(get_settings_option_value('favicon'));

    @endphp
    <div class="image-increase">
        
    {!!mediaTemplate(['name'=>'web_logo','label'=>"Website Logo",'value'=>$wep_logo])!!}
    <div class="row">
        <div class="col-md-6">{!!inputTemplate(['name'=>'header_logo_width','label'=>"Website Logo Width",'control'=>'number','value'=>get_settings_option_value('header_logo_width'),'id'=>"header-logo-width","desc"=>'(in pixel)'])!!}</div>
        <div class="col-md-6">{!!inputTemplate(['name'=>'header_logo_height','label'=>"Website Logo Height in pixel",'control'=>'number','value'=>get_settings_option_value('header_logo_height'),'id'=>"header-logo-height","desc"=>'(in pixel)'])!!}</div>
    </div>
    </div>

    {!!mediaTemplate(['name'=>'favicon','label'=>"FavIcon",'value'=>$favicon,'id'=>"favicon"])!!}

</div>

</div>
<div class="card mb-0">
 <div class="card-header border border-info p-3 ml-1 bg-secondary.bg-gradient">
        <h4 class="card-title">Top Bar</h4>
 </div>
    <div class="card-body">
    {!!inputTemplate(['name'=>'topbar_email','label'=>"Topbar Email",'control'=>'email','value'=>get_settings_option_value('topbar_email'),'id'=>"topbar-email"])!!}
    {!!inputTemplate(['name'=>'topbar_phone','label'=>"Topbar Phone",'value'=>get_settings_option_value('topbar_phone'),'id'=>"topbar-phone"])!!}
    {!!inputTemplate(['name'=>'topbar_address','label'=>"Topbar Address",'value'=>get_settings_option_value('topbar_address'),'id'=>"topbar-address"])!!}
    <div class="social-links">
        <h4>Social Links</h4>
        @php 
         $social_links = get_settings_option_value('topbar_social_link');

        
        @endphp
      {!!inputTemplate(['name'=>'topbar_social_link[topbar_facebook]','label'=>"Facebook",'control'=>'url','value'=>get_single_value_of_col_in_setting($social_links,'topbar_facebook'),'id'=>"topbar-facebook"])!!}

      {!!inputTemplate(['name'=>'topbar_social_link[topbar_instagram]','label'=>"Instagram",'control'=>'url','value'=>get_single_value_of_col_in_setting($social_links,'topbar_instagram'),'id'=>"topbar-instagram"])!!}

      {!!inputTemplate(['name'=>'topbar_social_link[topbar_twitter]','label'=>"Twitter",'control'=>'url','value'=>get_single_value_of_col_in_setting($social_links,'topbar_twitter'),'id'=>"topbar-twitter"])!!}

      {!!inputTemplate(['name'=>'topbar_social_link[topbar_youtube]','label'=>"Youtube",'control'=>'url','value'=>get_single_value_of_col_in_setting($social_links,'topbar_youtube'),'id'=>"topbar-youtube"])!!}
     
    </div>

</div>

</div>

   <button type="submit" class="btn btn-primary">Save</button>
</form> <!-- Form End -->
