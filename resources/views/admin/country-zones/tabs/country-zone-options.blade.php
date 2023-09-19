@include('admin.partials.utils.input', ['name'=> 'sub_title','label'=>'Country Zone Title','value'=>$country_zone->sub_title ?? '','id' => ""])

@include('admin.partials.utils.select_box', ['items' => $countries, 'name'=> 'country','selected'=>$country_zone->country ?? "",'label'=>'Country'])

 <div class="form-group row">

    <div class="col-lg-12">
        <label class="subform-card-label" for="get_image">Country Zone Icon
        </label><p>Upload Icon Image For Country Zone</p>

        <div class="input-group mb-3">
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="get_image" name="icon" value="{{$country_zone->icon ?? ''}}" accept="image/jpeg" data-existed_value="{{$country_zone->icon ?? ''}}">
                <label class="custom-file-label">Choose Icon</label>
            </div>
            <div class="input-group-append">
                <span class="input-group-text">Upload</span>
            </div>
        </div>
        <img id="show_image" src="{{asset('admin-part\images\t-b-logo.png')}}" alt="your image" width="50" />
    </div>
</div>

 <div class="form-group row">

    <div class="col-lg-12">
        <label class="subform-card-label" for="get_image">Country Zone Banner Image
        </label><p>Upload Banner Image For Country Zone</p>

        <div class="input-group mb-3">
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="get_image" name="image" value="{{$country_zone->image ?? ''}}" accept="image/jpeg" data-existed_value="{{$country_zone->image ?? ''}}">
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
        <label class="subform-card-label" for="country-zone-disc">Description
        </label>
        <textarea class="form-control ckeditor" id="country-zone-dis" name="country_zone_description" rows="8" placeholder="Enter Description..">{!!$country_zone->country_zone_description ?? ''!!}</textarea>


    </div>
</div> 
<div class="border p-2 mb-2">
    <h4>Country Zone Section</h4>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $country_zone->country_zone_section ?? null, 'type' => 'country_zone_section', 'btnTitle' => 'Add New'])
</div>