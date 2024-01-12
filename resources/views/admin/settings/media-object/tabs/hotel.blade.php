@section('setting_action', route('admin.settings.theme-settings.store','hotel'))
<form class="form-valide" id="setting-form-hotel" action="@yield('setting_action')" method="post"><!-- Form Start -->
  {{ csrf_field() }}
  @yield('setting_form_method')
  <div class="card mb-0">
   <div class="card-header border border-info p-3 ml-1 bg-secondary.bg-gradient">
    <h4 class="card-title">Hotel Setting</h4>
  </div>
  <div class="card-body">
    <div class="form-group row">

      <div class="col-lg-12">
       <label class="col-lg- col-form-label" for="parent-id">Hotel List Page
       </label>
       <select class="form-control single-select-placeholder-touristbook" id="hotel-list-page" name="hotel_list_page" >
        <option value="">Select Hotel List Page</option>
        @isset($hotels)
        @foreach($hotels as $hotel)
        <option value="{{$hotel->id}}" {!!get_edit_select_post_types_old_value($hotel->id,get_settings_option_value('hotel_list_page'),'select')!!} >{{$hotel->name}} ( #{{$hotel->id}})</option>
        @endforeach
        @endisset
      </select>

    </div>
  </div>
  <div class="form-group row">
   
    <div class="col-lg-12">
     <label class="col-lg- col-form-label" for="parent-id">Hotel Detail Page
     </label>
     <select class="form-control single-select-placeholder-touristbook" id="hotel_detail-list-page" name="hotel_detail_list_page" >
      <option value="">Select Hotel Detail Page</option>
      @isset($hotel_details)
      @foreach($hotel_details as $hotel_detail)
      <option value="{{$hotel_detail->id}}" {!!get_edit_select_post_types_old_value($hotel_detail->id,get_settings_option_value('hotel_detail_list_page'),'select')!!} >{{$hotel_detail->name}} ( #{{$hotel_detail->id}})</option>
      @endforeach
      @endisset
    </select>

  </div>
</div>
@php 
$hotel_map_marker_image = exploreJsonData(get_settings_option_value('hotel_map_marker_image'));
@endphp
{!!mediaTemplate(['name'=>'hotel_map_marker_image','label'=>'Hotel Map Marker','value'=>$hotel_map_marker_image])!!}
</div>

</div>

<button type="submit" class="btn btn-primary">Save</button>
</form> <!-- Form End -->