@section('setting_action', route('admin.settings.theme-settings.store','post'))
<form class="form-valide" id="setting-form-post" action="@yield('setting_action')" method="post"><!-- Form Start -->
  {{ csrf_field() }}
  @yield('setting_form_method')
  <div class="card mb-0">
   <div class="card-header border border-info p-3 ml-1 bg-secondary.bg-gradient">
    <h4 class="card-title">Post Setting</h4>
  </div>
  <div class="card-body">
    <div class="form-group row">

      <div class="col-lg-12">
       <label class="col-lg- col-form-label" for="parent-id">Post List Page
       </label>
       <select class="form-control single-select-placeholder-touristbook" id="post-list-page" name="post_list_page" >
        <option value="">Select Post List Page</option>
        @isset($blogs)
        @foreach($blogs as $blog)
        <option value="{{$blog->id}}" {!!get_edit_select_post_types_old_value($blog->id,get_settings_option_value('post_list_page'),'select')!!} >{{$blog->name}} ( #{{$blog->id}})</option>
        @endforeach
        @endisset
      </select>

    </div>
  </div>
  <div class="form-group row">
   
    <div class="col-lg-12">
     <label class="col-lg- col-form-label" for="parent-id">Post Detail Page
     </label>
     <select class="form-control single-select-placeholder-touristbook" id="post_detail-list-page" name="post_detail_list_page" >
      <option value="">Select Post Detail Page</option>
      @isset($post_details)
      @foreach($post_details as $post_detail)
      <option value="{{$post_detail->id}}" {!!get_edit_select_post_types_old_value($post_detail->id,get_settings_option_value('post_detail_list_page'),'select')!!} >{{$post_detail->name}} ( #{{$post_detail->id}})</option>
      @endforeach
      @endisset
    </select>
  </div>
</div>
</div>
</div>
<button type="submit" class="btn btn-primary">Save</button>
</form> <!-- Form End -->