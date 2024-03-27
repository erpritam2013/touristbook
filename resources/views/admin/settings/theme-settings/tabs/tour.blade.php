@section('setting_action_tour', route('admin.settings.theme-settings.store','tour'))
<form class="form-valide" id="setting-form-tour" action="@yield('setting_action_tour')" method="post"><!-- Form Start -->
  {{ csrf_field() }}
  @yield('setting_form_method')
  <div class="card mb-0">
   <div class="card-header border border-info p-3 ml-1 bg-secondary.bg-gradient">
    <h4 class="card-title">Tour Setting</h4>
  </div>
  <div class="card-body">
    <div class="form-group row">

      <div class="col-lg-12">
       <label class="col-lg- col-form-label" for="parent-id">Tour List Page
       </label>
       <select class="form-control single-select-placeholder-touristbook" id="tour-list-page" name="tour_list_page" >
        <option value="">Select Tour List Page</option>
        @isset($tours)
        @foreach($tours as $tour)
        <option value="{{$tour->id}}" {!!get_edit_select_post_types_old_value($tour->id,get_settings_option_value('tour_list_page'),'select')!!} >{{$tour->name}} ( #{{$tour->id}})</option>
        @endforeach
        @endisset
      </select>

    </div>
  </div>
  <div class="form-group row">
   
    <div class="col-lg-12">
     <label class="col-lg- col-form-label" for="parent-id">Tour Detail Page
     </label>
     <select class="form-control single-select-placeholder-touristbook" id="tour_detail-list-page" name="tour_detail_list_page" >
      <option value="">Select Tour Detail Page</option>
      @isset($tour_details)
      @foreach($tour_details as $tour_detail)
      <option value="{{$tour_detail->id}}" {!!get_edit_select_post_types_old_value($tour_detail->id,get_settings_option_value('tour_detail_list_page'),'select')!!} >{{$tour_detail->name}} ( #{{$tour_detail->id}})</option>
      @endforeach
      @endisset
    </select>

  </div>
</div>
</div>
</div>
<button type="submit" class="btn btn-primary">Save</button>
</form> <!-- Form End -->