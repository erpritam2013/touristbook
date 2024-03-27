@section('setting_action_activity', route('admin.settings.theme-settings.store','activity'))
<form class="form-valide" id="setting-form-activity" action="@yield('setting_action_activity')" method="post"><!-- Form Start -->
  {{ csrf_field() }}
  @yield('setting_form_method')
  <div class="card mb-0">
   <div class="card-header border border-info p-3 ml-1 bg-secondary.bg-gradient">
    <h4 class="card-title">Activity Setting</h4>
  </div>
  <div class="card-body">
    <div class="form-group row">

      <div class="col-lg-12">
       <label class="col-lg- col-form-label" for="parent-id">Activity List Page
       </label>
       <select class="form-control single-select-placeholder-touristbook" id="activity-list-page" name="activity_list_page" >
        <option value="">Select Activity List Page</option>
        @isset($activities)
        @foreach($activities as $activity)
        <option value="{{$activity->id}}" {!!get_edit_select_post_types_old_value($activity->id,get_settings_option_value('activity_list_page'),'select')!!} >{{$activity->name}} ( #{{$activity->id}})</option>
        @endforeach
        @endisset
      </select>

    </div>
  </div>
  <div class="form-group row">
   
    <div class="col-lg-12">
     <label class="col-lg- col-form-label" for="parent-id">Activity Detail Page
     </label>
     <select class="form-control single-select-placeholder-touristbook" id="activity_detail-list-page" name="activity_detail_list_page" >
      <option value="">Select Activity Detail Page</option>
      @isset($activity_details)
      @foreach($activity_details as $activity_detail)
      <option value="{{$activity_detail->id}}" {!!get_edit_select_post_types_old_value($activity_detail->id,get_settings_option_value('activity_detail_list_page'),'select')!!} >{{$activity_detail->name}} ( #{{$activity_detail->id}})</option>
      @endforeach
      @endisset
    </select>
  </div>
</div>
</div>
</div>
<button type="submit" class="btn btn-primary">Save</button>
</form> <!-- Form End -->