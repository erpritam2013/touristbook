<div class="card">
    <div class="card-header border-bottom">
        <h4 class="card-title">Activity Options For Activity List</h4>
    </div>

    <div class="card-body">

<div class="form-group row">
    
    <div class="col-lg-12">
        <label class="subform-card-label" for="activity">Activity</label>
        <select class="form-control multi-select" id="activity" name="activity" data-existed_parent_id="{{$activity_package->activityPackageActivity->id ?? ''}}">
            @isset($activities)
            <option value="">Select Activity</option>
            @foreach($activities as $activity)
            <option value="{{$activity->id}}" {!!get_edit_select_post_types_old_value($activity->id, $activity_package->activity ?? "",'select')!!} >{{$activity->name}}</option>
            @endforeach
            @endisset
        </select>

    </div>
</div>
        

    </div>
</div>