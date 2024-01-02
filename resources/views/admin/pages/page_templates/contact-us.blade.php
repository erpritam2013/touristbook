{!!mediaTemplate(['name'=>'extra_data[contact_info_bg_image]','label'=>'Background Image','value'=>json_decode($page->extra_data['contact_info_bg_image'] ?? '',true)])!!}


{!!inputTemplate(['name'=>'extra_data[contact_info_email]','label'=>'Email','value'=>$page->extra_data['contact_info_email'] ?? '','id'=>'contact-info-email','desc'=>'Value Add Comma Seprated like(email-1,email-2)'])!!}

{!!inputTemplate(['name'=>'extra_data[contact_info_phone]','label'=>'Phone','value'=>$page->extra_data['contact_info_phone'] ?? '','id'=>'contact-info-phone','desc'=>'Value Add Comma Seprated like(phone-1,phone-2)'])!!}

{!!textareaTemplate(['name'=>'extra_data[contact_info_address]','label'=>'Address','value'=>$page->extra_data['contact_info_address'] ?? '','id'=>'contact-info-address','rows'=>4])!!}
<div class="form-group row">
    <label class="col-lg-5 col-form-label" for="map_address">Map Address</label>
    <div class="col-lg-7">
        <input type="text" class="form-control" id="map_address" name="extra_data[map_address]" value="{{$page->extra_data['map_address'] ?? ''}}">
    </div>
</div>
<h3>Location on map</h3>
<div id="map" style="width: 100%; height:350px;"></div>

<div class="form-group row">
    <label class="col-lg-5 col-form-label" for="latitude">Latitude</label>
    <div class="col-lg-7">
        <input type="number" class="form-control" id="latitude" name="extra_data[latitude]" value="{{$page->extra_data['latitude'] ?? ''}}">
    </div>
</div>

<div class="form-group row">
    <label class="col-lg-5 col-form-label" for="longitude">Longitude</label>
    <div class="col-lg-7">
        <input type="number" class="form-control" id="longitude" name="extra_data[longitude]" value="{{$page->extra_data['longitude'] ?? ''}}">
    </div>
</div>

<div class="form-group row">
   <label class="col-lg-5 col-form-label" for="zoom_level">Zoom Level</label>
    <div class="col-lg-7">
        <input type="number" class="form-control" id="zoom_level" name="extra_data[zoom_level]" value="{{$page->extra_data['zoom_level'] ?? 1}}">
    </div>
</div>





