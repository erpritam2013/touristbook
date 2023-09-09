<div class="form-group row">
    <label class="col-lg-5 col-form-label" for="hotel-as-feature">Set hotel as feature<br /><small>ON: Set this hotel to be featured</small></label>

    <div class="col-lg-7">
        <label class="col-form-label">
            <input type="radio" name="is_featured" value="1" {!!get_edit_select_check_pvr_old_value('is_featured', $hotel ?? "" ,'is_featured',1, 'checked' )!!}>&nbsp;On
        </label>
        <label class="col-form-label">
            <input type="radio" name="is_featured" {!!get_edit_select_check_pvr_old_value('status', $hotel ?? "" ,'is_featured',0, 'checked' )!!} value="0">&nbsp;Off
        </label>
    </div>
</div>

<div class="form-group row">
    <label class="col-lg-5 col-form-label" for="hotel_video">Hotel video
        <br /><small>Enter YouTube/Vimeo URL here</small>
    </label>
    <div class="col-lg-7">
        <input type="text" class="form-control" id="hotel_video" name="hotel_video" value="{{$hotel->hotel_video ?? ''}}">
    </div>
</div>

<div class="form-group row">
    <label class="col-lg-5 col-form-label" for="rating">Hotel rating standard </label>
    <div class="col-lg-7">
        <input type="range" min="0" max="5" step="0.1" class="form-control" id="rating" name="rating" value="{{$hotel->rating ?? ''}}">
    </div>
</div>

<div class="form-group row">
    <label class="col-lg-5 col-form-label" for="coupon_code">Coupon Code
    </label>
    <div class="col-lg-7">
        <input type="text" class="form-control" id="coupon_code" name="coupon_code" value="{{$hotel->coupon_code ?? ''}}">
    </div>
</div>

<div class="border p-2 mb-2">
    <h4>Highlight</h4>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $hotel->highlights ?? null, 'type' => 'highlights', 'btnTitle' => 'Add New'])
</div>

<div class="border p-2 mb-2">
    <h4>Facilities/Amenities</h4>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $hotel->facilityAmenities ?? null, 'type' => 'facilityAmenities', 'btnTitle' => 'Add New'])
</div>

<div class="border p-2 mb-2">
    <h4>Foods</h4>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $hotel->foods ?? null, 'type' => 'foods', 'btnTitle' => 'Add New'])
</div>

<div class="border p-2 mb-2">
    <h4>Drink & Beverages</h4>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $hotel->drinks ?? null, 'type' => 'drinks', 'btnTitle' => 'Add New'])
</div>

<div class="border p-2 mb-2">
    <h4>Complimentary Inclusions</h4>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $hotel->complimentary ?? null, 'type' => 'complimentary', 'btnTitle' => 'Add New'])
</div>

<div class="border p-2 mb-2">
    <h4>Helpful facts</h4>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $hotel->helpfulfacts ?? null, 'type' => 'helpfulfacts', 'btnTitle' => 'Add New'])
</div>


<div class="form-group row">
    <label class="col-lg-5 col-form-label" for="save_pocket">Save Your Pocket
    </label>
    <div class="col-lg-7">
        <textarea class="form-control" id="save_pocket" name="save_pocket" >{{$hotel->save_pocket ?? ''}}</textarea>
    </div>
</div>


<div class="border p-2 mb-2">
    <h4>Save Your Pocket PDF Data</h4>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $hotel->pocketPDF ?? null, 'type' => 'pocketPDF', 'btnTitle' => 'Add New'])
</div>

<div class="form-group row">
    <label class="col-lg-5 col-form-label" for="save_environment">Save The Environment
    </label>
    <div class="col-lg-7">
        <textarea class="form-control" id="save_environment" name="save_environment" >{{$hotel->save_environment ?? ''}}</textarea>
    </div>
</div>

<div class="border p-2 mb-2">
    <h4>Land Mark</h4>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $hotel->landmark ?? null, 'type' => 'landmark', 'btnTitle' => 'Add New'])
</div>

<div class="border p-2 mb-2">
    <h4>Things To Do</h4>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $hotel->todo ?? null, 'type' => 'todo', 'btnTitle' => 'Add New'])
</div>

<div class="border p-2 mb-2">
    <h4>Offers & Packages</h4>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $hotel->offers ?? null, 'type' => 'offers', 'btnTitle' => 'Add New'])
</div>

<div class="border p-2 mb-2">
    <h4>Things To Do Video Link</h4>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $hotel->todovideo ?? null, 'type' => 'todovideo', 'btnTitle' => 'Add New'])
</div>

<div class="border p-2 mb-2">
    <h4>Events & Meetings</h4>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $hotel->eventmeeting ?? null, 'type' => 'eventmeeting', 'btnTitle' => 'Add New'])
</div>

<div class="form-group row">
    <label class="col-lg-5 col-form-label" for="tourism_zone">Tourism Zone
    </label>
    <div class="col-lg-7">
        <textarea class="form-control" id="tourism_zone" name="tourism_zone" >{{$hotel->tourism_zone ?? ''}}</textarea>
    </div>
</div>

<div class="form-group row">
    <label class="col-lg-5 col-form-label" for="tourism_zone_heading">Tourism Zone Heading Description</label>
    <div class="col-lg-7">
        <textarea class="form-control tourist-editor" id="tourism_zone_heading" name="tourism_zone_heading" >{{$hotel->tourism_zone_heading ?? ''}}</textarea>
    </div>
</div>

<div class="border p-2 mb-2">
    <h4>Tourism Zone PDF Data</h4>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $hotel->tourismzonepdf ?? null, 'type' => 'tourismzonepdf', 'btnTitle' => 'Add New'])
</div>

<div class="border p-2 mb-2">
    <h4>Activities</h4>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $hotel->activities ?? null, 'type' => 'activities', 'btnTitle' => 'Add New'])
</div>

<div class="form-group row">
    <label class="col-lg-5 col-form-label" for="room_amenities">Rooms Amenities</label>
    <div class="col-lg-7">
        <textarea class="form-control" id="room_amenities" name="room_amenities" >{{$hotel->room_amenities ?? ''}}</textarea>
    </div>
</div>

<div class="border p-2 mb-2">
    <h4>Transport</h4>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $hotel->transport ?? null, 'type' => 'transport', 'btnTitle' => 'Add New'])
</div>


<div class="form-group row">
    <label class="col-lg-5 col-form-label" for="payment_mode">Payment mode</label>
    <div class="col-lg-7">
        <textarea class="form-control" id="payment_mode" name="payment_mode" >{{$hotel->payment_mode ?? ''}}</textarea>
    </div>
</div>


<div class="form-group row">
    <label class="col-lg-5 col-form-label" for="id_proofs">ID Proofs</label>
    <div class="col-lg-7">
        <textarea class="form-control" id="id_proofs" name="id_proofs" >{{$hotel->id_proofs ?? ''}}</textarea>
    </div>
</div>


<div class="border p-2 mb-2">
    <h4>Emergency Links</h4>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $hotel->emergencyLinks ?? null, 'type' => 'emergencyLinks', 'btnTitle' => 'Add New'])
</div>
