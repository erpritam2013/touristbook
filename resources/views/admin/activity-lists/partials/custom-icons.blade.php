<div class="card">
    <div class="card-header border-bottom">
        <h4 class="card-title">Icon Activity List</h4>
    </div>
    <div class="card-body">

     
     <select class="form-control single-select-placeholder-touristbook" id="custom-icon" name="custom_icon" >
        <option value="">Custom Icon</option>
        @isset($custom_icons)
        @foreach($custom_icons as $custom_icon)
        <option value="{{$custom_icon->slug}}" {{ ($custom_icon->slug == $activity_list->custom_icon) ? 'selected' : ''  }}>{{$custom_icon->title}}</option>
        @endforeach
        @endisset
      </select>

    </div>
</div>