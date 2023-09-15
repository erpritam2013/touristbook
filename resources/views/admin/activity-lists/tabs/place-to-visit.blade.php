 <div class="form-group row">

    <div class="col-lg-12">
        <label class="subform-card-label" for="place-to-visit-disc">Place To Visit Description
        </label>
        <textarea class="form-control ckeditor" id="place-to-visit-disc" name="place_to_visit_description" rows="8" placeholder="Enter Description..">{!!$location->locationMeta->place_to_visit_description ?? ''!!}</textarea>


    </div>
</div> 
<div class="border p-2 mb-2">
    <h4>Place To Visit</h4>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $location->locationMeta->place_to_visit ?? null, 'type' => 'place_to_visit', 'btnTitle' => 'Add New'])
</div>
<div class="border p-2 mb-2">
    <h4>Best Time to Visit</h4>
    <p>Best Time to Visit</p>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $location->locationMeta->best_time_to_visit ?? null, 'type' => 'best_time_to_visit', 'btnTitle' => 'Add New'])
</div>
<div class="form-group row">

    <div class="col-lg-12">
        <label class="subform-card-label" for="best-time-to-visit-description">Best Time to Visit Description
        </label>
        <textarea class="form-control ckeditor" id="best-time-to-visit-description" name="best_time_to_visit_description" rows="8" placeholder="Enter Description..">{!!$location->locationMeta->best_time_to_visit_description ?? ''!!}</textarea>


    </div>
</div>
<div class="form-group row">

    <div class="col-lg-12">
        <label class="subform-card-label" for="how-to-reach-description">How to Reach Description
        </label>
        <textarea class="form-control ckeditor" id="how-to-reach-description" name="how_to_reach_description" rows="8" placeholder="Enter Description..">{!!$location->locationMeta->how_to_reach_description ?? ''!!}</textarea>


    </div>
</div>

<div class="border p-2 mb-2">
    <h4>How To Reach</h4>
    <p>How To Reach</p>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $location->locationMeta->how_to_reach ?? null, 'type' => 'how_to_reach', 'btnTitle' => 'Add New'])
</div>

<div class="form-group row">

    <div class="col-lg-12">
        <label class="subform-card-label" for="fair-and-festivals-description">Fair and Festivals Description
        </label>
        <textarea class="form-control ckeditor" id="fair-and-festivals-description" name="fair_and_festivals_description" rows="8" placeholder="Enter Description..">{!!$location->locationMeta->fair_and_festivals_description ?? ''!!}</textarea>


    </div>
</div>

<div class="form-group row">
    
    <div class="col-lg-12">
        <label class="subform-card-label" for="get_image">Fair and Festivals Banner Image
        </label><br/><p>Fair and Festivals Banner Image</p>

        <div class="input-group mb-3">
            <div class="custom-file">
                <input type="file" name="fair_and_festivals_image" class="custom-file-input" id="get_image"  value="{{$location->locationMeta->fair_and_festivals_image ?? ''}}" accept="image/jpeg" data-existed_value="{{$location->locationMeta->fair_and_festivals_image ?? ''}}">
                <label class="custom-file-label">Choose Image</label>
            </div>
            <div class="input-group-append">
                <span class="input-group-text">Upload</span>
            </div>
        </div>
        <img id="show_image" src="{{asset('admin-part\images\t-b-logo.png')}}" alt="your image" />
    </div>
</div>
<div class="border p-2 mb-2">
    <h4>Fair and Festivals</h4>
    <p>Fair and Festivals</p>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $location->locationMeta->fair_and_festivals ?? null, 'type' => 'fair_and_festivals', 'btnTitle' => 'Add New'])
</div>
<div class="form-group row">

    <div class="col-lg-12">
        <label class="subform-card-label" for="culinary-retreat-description">Culinary Retreat Description
        </label>
        <textarea class="form-control ckeditor" id="culinary-retreat-description" name="culinary_retreat_description" rows="8" placeholder="Enter Description..">{!!$location->locationMeta->culinary_retreat_description ?? ''!!}</textarea>


    </div>
</div>

<div class="border p-2 mb-2">
    <h4>Culinary Retreat</h4>
    <p>Culinary Retreat</p>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $location->locationMeta->culinary_retreat ?? null, 'type' => 'culinary_retreat', 'btnTitle' => 'Add New'])
</div>
<div class="form-group row">

    <div class="col-lg-12">
        <label class="subform-card-label" for="shopaholics-anonymous-description">Shopaholics Anonymous Description
        </label>
        <textarea class="form-control ckeditor" id="shopaholics-anonymous-description" name="shopaholics_anonymous_description" rows="8" placeholder="Enter Description..">{!!$location->locationMeta->shopaholics_anonymous_description ?? ''!!}</textarea>


    </div>
</div>
<div class="border p-2 mb-2">
    <h4>Shopaholics Anonymous</h4>
    <p>Shopaholics Anonymous</p>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $location->locationMeta->shopaholics_anonymous ?? null, 'type' => 'shopaholics_anonymous', 'btnTitle' => 'Add New'])
</div>
<div class="border p-2 mb-2">
    <h4>Weather</h4>
    <p>Weather</p>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $location->locationMeta->weather ?? null, 'type' => 'weather', 'btnTitle' => 'Add New'])
</div>
<div class="border p-2 mb-2">
    <h4>Location Map</h4>
    <p>Location Map</p>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $location->locationMeta->location_map ?? null, 'type' => 'location_map', 'btnTitle' => 'Add New'])
</div>