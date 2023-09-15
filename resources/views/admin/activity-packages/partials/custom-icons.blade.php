<div class="card">
    <div class="card-header border-bottom">
        <h4 class="card-title">Extra fields Activities</h4>
    </div>
    <div class="card-body">
<div class="form-group row">
    
    <div class="col-lg-12">
        <label class="subform-card-label" for="custom-icon">Custom Icon</label>
        <select class="form-control multi-select" id="custom-icon" name="custom_icon" data-existed_parent_id="{{$activity_package->custom_icon ?? ''}}">
            @isset($custom_icons)
            <option value="">Select Custom Icon</option>
            @foreach($custom_icons as $custom_icon)
            <option value="{{$custom_icon->id}}" {!!get_edit_select_post_types_old_value($custom_icon->id, $activity_package->custom_icon ?? "",'select')!!} >{{$custom_icon->title}}</option>
            @endforeach
            @endisset
        </select>

    </div>
</div>


    </div>
</div>