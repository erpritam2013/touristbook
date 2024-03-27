@section('setting_action_page', route('admin.settings.theme-settings.store','page'))
<form class="form-valide" id="setting-form-page" action="@yield('setting_action_page')" method="post"><!-- Form Start -->
  {{ csrf_field() }}
  @yield('setting_form_method')
  <div class="card mb-0">
   <div class="card-header border border-info p-3 ml-1 bg-secondary.bg-gradient">
    <h4 class="card-title">Page Setting</h4>
  </div>
  <div class="card-body">
    <div class="form-group row">

      <div class="col-lg-12">
       <label class="col-lg- col-form-label" for="home-page">Home Page
       </label>
       <select class="form-control single-select-placeholder-touristbook" id="home-page" name="home_page" >
        <option value="">Select Home Page</option>
        @isset($homes)
        @foreach($homes as $home)
        <option value="{{$home->id}}" {!!get_edit_select_post_types_old_value($home->id,get_settings_option_value('home_page'),'select')!!} >{{$home->name}} ( #{{$home->id}})</option>
        @endforeach
        @endisset
      </select>

    </div>
  </div>
  <div class="form-group row">
   
    <div class="col-lg-12">
     <label class="col-lg- col-form-label" for="about-page">About Page
     </label>
     <select class="form-control single-select-placeholder-touristbook" id="about-page" name="about_page" >
      <option value="">Select About Page</option>
      @isset($abouts)
      @foreach($abouts as $about)
      <option value="{{$about->id}}" {!!get_edit_select_post_types_old_value($about->id,get_settings_option_value('about_page'),'select')!!} >{{$about->name}} ( #{{$about->id}})</option>
      @endforeach
      @endisset
    </select>

  </div>
</div>
  <div class="form-group row">
   
    <div class="col-lg-12">
     <label class="col-lg- col-form-label" for="wishlist-page">Wishlist Page
     </label>
     <select class="form-control single-select-placeholder-touristbook" id="wishlist-page" name="wishlist_page" >
      <option value="">Select Wishlist Page</option>
      @isset($wishlists)
      @foreach($wishlists as $wishlist)
      <option value="{{$wishlist->id}}" {!!get_edit_select_post_types_old_value($wishlist->id,get_settings_option_value('wishlist_page'),'select')!!} >{{$wishlist->name}} ( #{{$wishlist->id}})</option>
      @endforeach
      @endisset
    </select>

  </div>
</div>
  <div class="form-group row">
   
    <div class="col-lg-12">
     <label class="col-lg- col-form-label" for="connecting-partner-page">Connecting Partners Page
     </label>
     <select class="form-control single-select-placeholder-touristbook" id="connecting-partner-page" name="connecting_partner_page" >
      <option value="">Select Connecting Partners Page</option>
      @isset($connecting_partners)
      @foreach($connecting_partners as $connecting_partner)
      <option value="{{$connecting_partner->id}}" {!!get_edit_select_post_types_old_value($connecting_partner->id,get_settings_option_value('connecting_partner_page'),'select')!!} >{{$connecting_partner->name}} ( #{{$connecting_partner->id}})</option>
      @endforeach
      @endisset
    </select>

  </div>
</div>
  <div class="form-group row">
   
    <div class="col-lg-12">
     <label class="col-lg- col-form-label" for="contact-page">Contact Us Page
     </label>
     <select class="form-control single-select-placeholder-touristbook" id="contact-page" name="contact_page" >
      <option value="">Select Contact Us Page</option>
      @isset($contact_pages)
      @foreach($contact_pages as $contact_page)
      <option value="{{$contact_page->id}}" {!!get_edit_select_post_types_old_value($contact_page->id,get_settings_option_value('contact_page'),'select')!!} >{{$contact_page->name}} ( #{{$contact_page->id}})</option>
      @endforeach
      @endisset
    </select>

  </div>
</div>

</div>

</div>

<button type="submit" class="btn btn-primary">Save</button>
</form> <!-- Form End -->