<div class="form-group row">
   

    <div class="col-lg-12">
         <label class="subform-card-label" for="location-as-feature">Coler</label>
         <div class="example">
         <p>Upload feature image for this location</p>
        <input type="text" class="form-control complex-colorpicker" name="color" value="{{$location->color ?? '#000000'}}">
        </div>
    </div>
</div>
<hr>
<div class="form-group row">
   
    <div class="col-lg-12">
         <label class="subform-card-label" for="attachment">Feature image</label>
         <p>Upload feature image for this location</p>

        <div class="input-group mb-3">
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="get_image"  value="{{$location->logo ?? ''}}" accept="image/jpeg" data-existed_value="{{$location->logo ?? ''}}">
                <label class="custom-file-label">Choose Feature Image</label>
            </div>
            <div class="input-group-append">
                <span class="input-group-text">Upload</span>
            </div>
        </div>
        <img id="show_image" src="{{asset('admin-part\images\t-b-logo.png')}}" alt="your image" width="120" />
    </div>
</div>
<hr>
<div class="form-group row">
   

    <div class="col-lg-12">
         <label class="subform-card-label" for="location-as-feature">Set location as feature</label>
         <p>ON: Set this location to be featured</p>
        <label class="col-form-label">
            <input type="radio" name="is_featured" value="1" {!!get_edit_select_check_pvr_old_value('is_featured', $location ?? "" ,'is_featured',1, 'checked' )!!} id="location-as-feature">&nbsp;On
        </label>
        <label class="col-form-label">
            <input type="radio" name="is_featured" {!!get_edit_select_check_pvr_old_value('status', $location ?? "" ,'is_featured',0, 'checked' )!!} value="0" id="location-as-feature">&nbsp;Off
        </label>
    </div>
</div>
<hr>
<div class="form-group row">
    
    <div class="col-lg-12">
        <label class="subform-card-label" for="country">Country</label>
        <select class="form-control multi-select" id="country" name="country" data-existed_parent_id="{{$location->country ?? ''}}">
            @isset($countries)
            <option value="">Select Country</option>
            @foreach($countries as $country)
            <option value="{{$country->code}}" {!!get_edit_select_post_types_old_value($country->code, $location->country ?? "",'select')!!} >{{$country->countryname}}</option>
            @endforeach
            @endisset
        </select>

    </div>
</div>
<hr>
<div class="form-group row">
    

    <div class="col-lg-12">
        <label class="subform-card-label" for="location-as-feature">Input zipcode</label>
        <p>This is the zipcode of this location</p>
        <input type="text" class="form-control" name="zipcode" value="{{$location->zipcode ?? ''}}">
        

    </div>
</div>
<hr>
@include('admin.locations.tabs.location', ["location" => $location])
                  


