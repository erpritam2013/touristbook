@section('setting_action', route('admin.settings.theme-settings.store','footer'))
<form class="form-valide" id="setting-form-footer" action="@yield('setting_action')" method="post">
    {{ csrf_field() }}
    @yield('setting_form_method')
 <div class="card mb-0">
 <div class="card-header border border-info p-3 ml-1 bg-secondary.bg-gradient">
        <h4 class="card-title">Footer</h4>
 </div>
    <div class="card-body">
    @php 
     $footer_logo = exploreJsonData(get_settings_option_value('footer_logo'));
    @endphp
    <div class="image-increase">
        
    {!!mediaTemplate(['name'=>'footer_logo','label'=>"Footer Logo",'value'=>$footer_logo])!!}
    <div class="row">
        <div class="col-md-6">{!!inputTemplate(['name'=>'footer_logo_width','label'=>"Footer Logo Width",'control'=>'number','value'=>get_settings_option_value('footer_logo_width'),'id'=>"footer-logo-width","desc"=>'(in pixel)'])!!}</div>
        <div class="col-md-6">{!!inputTemplate(['name'=>'footer_logo_height','label'=>"Footer Logo Height in pixel",'control'=>'number','value'=>get_settings_option_value('footer_logo_height'),'id'=>"footer-logo-height","desc"=>'(in pixel)'])!!}</div>
    </div>
    </div>
</div>

</div>
<div class="card mb-0">
 <div class="card-header border border-info p-3 ml-1 bg-secondary.bg-gradient">
        <h4 class="card-title">Bottum Bar</h4>
 </div>
    <div class="card-body">
    {!!inputTemplate(['name'=>'footer_email','label'=>"Footer Email",'control'=>'email','value'=>get_settings_option_value('footer_email'),'id'=>"footer-email"])!!}

    {!!inputTemplate(['name'=>'footer_phone','label'=>"Footer Phone",'value'=>get_settings_option_value('footer_phone'),'id'=>"footer-phone"])!!}

    {!!inputTemplate(['name'=>'footer_address','label'=>"Footer Address",'value'=>get_settings_option_value('footer_address'),'id'=>"footer-address"])!!}
    <div class="social-links">
        <h4>Social Links</h4>
        @php 
         $footer_social_link = get_settings_option_value('footer_social_link');

        
        @endphp
      {!!inputTemplate(['name'=>'footer_social_link[footer_facebook]','label'=>"Facebook",'control'=>'url','value'=>get_single_value_of_col_in_setting($footer_social_link,'footer_facebook'),'id'=>"footer-facebook"])!!}

      {!!inputTemplate(['name'=>'footer_social_link[footer_instagram]','label'=>"Instagram",'control'=>'url','value'=>get_single_value_of_col_in_setting($footer_social_link,'footer_instagram'),'id'=>"footer-instagram"])!!}

      {!!inputTemplate(['name'=>'footer_social_link[footer_twitter]','label'=>"Twitter",'control'=>'url','value'=>get_single_value_of_col_in_setting($footer_social_link,'footer_twitter'),'id'=>"footer-twitter"])!!}

      {!!inputTemplate(['name'=>'footer_social_link[footer_youtube]','label'=>"Youtube",'control'=>'url','value'=>get_single_value_of_col_in_setting($footer_social_link,'footer_youtube'),'id'=>"footer-youtube"])!!}
     
    </div>

</div>

</div>

   <button type="submit" class="btn btn-primary">Save</button>
</form> <!-- Form End -->
