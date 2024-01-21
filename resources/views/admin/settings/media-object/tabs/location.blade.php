@section('setting_action', route('admin.settings.theme-settings.store','location'))
<form class="form-valide" id="setting-form-location" action="@yield('setting_action')" method="post"><!-- Form Start -->
  {{ csrf_field() }}
  @yield('setting_form_method')
  <div class="card mb-0">
   <div class="card-header border border-info p-3 ml-1 bg-secondary.bg-gradient">
    <h4 class="card-title">Location Setting</h4>
  </div>
  <div class="card-body">
    <div class="form-group row">

      <div class="col-lg-12">
       <label class="col-lg- col-form-label" for="parent-id">Location List Page
       </label>
       <select class="form-control single-select-placeholder-touristbook" id="location-list-page" name="location_list_page" >
        <option value="">Select Location List Page</option>
        @isset($locations)
        @foreach($locations as $location)
        <option value="{{$location->id}}" {!!get_edit_select_post_types_old_value($location->id,get_settings_option_value('location_list_page'),'select')!!} >{{$location->name}} ( #{{$location->id}})</option>
        @endforeach
        @endisset
      </select>

    </div>
  </div>
  <div class="form-group row">
   
    <div class="col-lg-12">
     <label class="col-lg- col-form-label" for="parent-id">Location Detail Page
     </label>
     <select class="form-control single-select-placeholder-touristbook" id="location_detail-list-page" name="location_detail_list_page" >
      <option value="">Select Location Detail Page</option>
      @isset($location_details)
      @foreach($location_details as $location_detail)
      <option value="{{$location_detail->id}}" {!!get_edit_select_post_types_old_value($location_detail->id,get_settings_option_value('location_detail_list_page'),'select')!!} >{{$location_detail->name}} ( #{{$location_detail->id}})</option>
      @endforeach
      @endisset
    </select>

  </div>
</div>
</div>
</div>
<button type="submit" class="btn btn-primary">Save</button>
</form> <!-- Form End -->