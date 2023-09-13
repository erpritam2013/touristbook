<div class="form-group row">

    <div class="col-lg-12">
        <label class="subform-card-label" for="sub-title">Title
        </label>
        <input type="text" class="form-control" id="sub-title" name="sub_title"placeholder="Enter Activity Zone Title.." value="{{$activity_zone->sub_title ?? ''}}">

    </div>
</div> 

<div class="form-group row">
    
    <div class="col-lg-12">
        <label class="subform-card-label" for="country">Country</label>
        <select class="form-control multi-select" id="country" name="country" data-existed_parent_id="{{$activity_zone->country ?? ''}}">
            @isset($countries)
            <option value="">Select Country</option>
            @foreach($countries as $country)
            <option value="{{$country->code}}" {!!get_edit_select_post_types_old_value($country->code, $activity_zone->country ?? "",'select')!!} >{{$country->countryname}}</option>
            @endforeach
            @endisset
        </select>

    </div>
</div>

 <div class="form-group row">

    <div class="col-lg-12">
        <label class="subform-card-label" for="get_image">Activity Zone Banner Image
        </label><p>Upload Banner Image For Activity Zone</p>

        <div class="input-group mb-3">
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="get_image" name="image" value="{{$activity_zone->image ?? ''}}" accept="image/jpeg" data-existed_value="{{$activity_zone->image ?? ''}}">
                <label class="custom-file-label">Choose Image</label>
            </div>
            <div class="input-group-append">
                <span class="input-group-text">Upload</span>
            </div>
        </div>
        <img id="show_image" src="{{asset('admin-part\images\t-b-logo.png')}}" alt="your image" width="120" />
    </div>
</div>
 <div class="form-group row">

    <div class="col-lg-12">
        <label class="subform-card-label" for="activity-zone-disc">Description
        </label>
        <textarea class="form-control ckeditor" id="activity-zone-dis" name="activity_zone_description" rows="8" placeholder="Enter Description..">{!!$activity_zone->activity_zone_description ?? ''!!}</textarea>


    </div>
</div> 
<div class="border p-2 mb-2">
    <h4>Activity Zone Section</h4>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $activity_zone->activity_zone_section ?? null, 'type' => 'activity_zone_section', 'btnTitle' => 'Add New'])
</div>