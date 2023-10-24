<!-- Set hotel as feature -->
@include('admin.partials.utils.radio_input', [
    'name' => 'is_featured',
    'label' => 'Set hotel as feature',
    'desc' => 'ON: Set this hotel to be featured',
    'item' => $hotel ?? '',
    'id' => '',
    'input' => ['On' => 1, 'Off' => 0],
    'on_off_switch' => true,
    'label_class' => ['off-switch', 'on-switch'],
])

<!--hotel video -->

{!!inputTemplate(['name'=> 'hotel_video','label'=>'Hotel video','desc'=>'Enter YouTube/Vimeo URL here','value'=>$hotel->hotel_video ?? '','id' => "",'control' => "url"])!!}

@include('admin.partials.utils.input', [
    'name' => 'hotel_video',
    'label' => 'Hotel video',
    'desc' => 'Enter YouTube/Vimeo URL here',
    'value' => $hotel->hotel_video ?? '',
    'id' => '',
    'control' => 'url',
])

<!-- Hotel rating standard -->
@include('admin.partials.utils.range_input', [
    'name' => 'rating',
    'label' => 'Hotel rating standard',
    'value' => $hotel->rating ?? '',
    'id' => '',
    'min' => 0,
    'max' => 5,
    'step' => 0.1,
    'value' => $hotel->rating ?? 0,
])

<!--hotel report -->
@include('admin.partials.utils.textarea', ['name'=> 'hotel_report','label'=>'Report','value'=>$hotel->detail->hotel_report ?? '','id' => "",'rows'=>10])
<!--Coupon Code -->

@include('admin.partials.utils.input', [
    'name' => 'coupon_code',
    'label' => 'Coupon Code',
    'value' => $hotel->coupon_code ?? '',
    'id' => '',
])

{{-- Gallery --}}

<div class="form-group row ">
    <div class="col-lg-12">

        @include('admin.partials.utils.gallery', [
            'name' => 'images',
            'label' => 'Hotel Gallery',
            'value' => $hotel->images ?? [],
            'id' => 'hotel-gallery',
            'smode' => 'multiple',
        ])


        {{-- <label class="subform-card-label" for="hotel-gallery">Hotel Gallery</label> --}}


    </div>
</div>


{!!inputTemplate(['name'=> 'coupon_code','label'=>'Coupon Code','value'=>$hotel->coupon_code ?? '','id' => ""])!!}

@php
    $hotelDetail = $hotel->detail;

@endphp

<div class="border p-1 mb-2">
    <h4>Highlight</h4>
    @include('admin.partials.utils.subform-wrapper', [
        'subformData' => $hotelDetail->highlights ?? null,
        'type' => 'highlights',
        'btnTitle' => 'Add New',
    ])
</div>

<div class="border p-1 mb-2">
    <h4>Facilities/Amenities</h4>
    @include('admin.partials.utils.subform-wrapper', [
        'subformData' => $hotel->detail->facilityAmenities ?? null,
        'type' => 'facilityAmenities',
        'btnTitle' => 'Add New',
    ])
</div>

<div class="border p-1 mb-2">
    <h4>Foods</h4>
    @include('admin.partials.utils.subform-wrapper', [
        'subformData' => $hotelDetail->foods ?? null,
        'type' => 'foods',
        'btnTitle' => 'Add New',
    ])
</div>

<div class="border p-1 mb-2">
    <h4>Drink & Beverages</h4>
    @include('admin.partials.utils.subform-wrapper', [
        'subformData' => $hotelDetail->drinks ?? null,
        'type' => 'drinks',
        'btnTitle' => 'Add New',
    ])
</div>

<div class="border p-1 mb-2">
    <h4>Complimentary Inclusions</h4>
    @include('admin.partials.utils.subform-wrapper', [
        'subformData' => $hotelDetail->complimentary ?? null,
        'type' => 'complimentary',
        'btnTitle' => 'Add New',
    ])
</div>

<div class="border p-1 mb-2">
    <h4>Helpful facts</h4>
    @include('admin.partials.utils.subform-wrapper', [
        'subformData' => $hotelDetail->helpfulfacts ?? null,
        'type' => 'helpfulfacts',
        'btnTitle' => 'Add New',
    ])
</div>

<!-- Save Your Pocket -->
@include('admin.partials.utils.textarea', [
    'name' => 'save_pocket',
    'label' => 'Save Your Pocket',
    'value' => $hotelDetail->save_pocket ?? '',
])

<div class="border p-1 mb-2">
    <h4>Save Your Pocket PDF Data</h4>
    @include('admin.partials.utils.subform-wrapper', [
        'subformData' => $hotelDetail->pocketPDF ?? null,
        'type' => 'pocketPDF',
        'btnTitle' => 'Add New',
    ])
</div>
<!-- Save The Environment -->
@include('admin.partials.utils.textarea', [
    'name' => 'save_environment',
    'label' => 'Save The Environment',
    'value' => $hotelDetail->save_environment ?? '',
])

<div class="border p-1 mb-2">
    <h4>Land Mark</h4>
    @include('admin.partials.utils.subform-wrapper', [
        'subformData' => $hotelDetail->landmark ?? null,
        'type' => 'landmark',
        'btnTitle' => 'Add New',
    ])
</div>

<div class="border p-1 mb-2">
    <h4>Things To Do</h4>
    @include('admin.partials.utils.subform-wrapper', [
        'subformData' => $hotelDetail->todo ?? null,
        'type' => 'todo',
        'btnTitle' => 'Add New',
    ])
</div>

<div class="border p-1 mb-2">
    <h4>Offers & Packages</h4>
    @include('admin.partials.utils.subform-wrapper', [
        'subformData' => $hotelDetail->offers ?? null,
        'type' => 'offers',
        'btnTitle' => 'Add New',
    ])
</div>

<div class="border p-1 mb-2">
    <h4>Things To Do Video Link</h4>
    @include('admin.partials.utils.subform-wrapper', [
        'subformData' => $hotelDetail->todovideo ?? null,
        'type' => 'todovideo',
        'btnTitle' => 'Add New',
    ])
</div>

<div class="border p-1 mb-2">
    <h4>Events & Meetings</h4>
    @include('admin.partials.utils.subform-wrapper', [
        'subformData' => $hotelDetail->eventmeeting ?? null,
        'type' => 'eventmeeting',
        'btnTitle' => 'Add New',
    ])
</div>

{{-- <div class="form-group row">
    <label class="col-lg-5 col-form-label" for="tourism_zone">Tourism Zone
    </label>
    <div class="col-lg-7">
        <textarea class="form-control" id="tourism_zone" name="tourism_zone" >{{$hotelDetail->tourism_zone ?? ''}}</textarea>
    </div>
</div>

<div class="form-group row">
    <label class="col-lg-5 col-form-label" for="tourism_zone_heading">Tourism Zone Heading Description</label>
    <div class="col-lg-7">
        <textarea class="form-control tourist-editor" id="tourism_zone_heading" name="tourism_zone_heading" >{{$hotelDetail->tourism_zone_heading ?? ''}}</textarea>
    </div>
</div>

<div class="border p-1 mb-2">
    <h4>Tourism Zone PDF Data</h4>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $hotelDetail->tourismzonepdf ?? null, 'type' => 'tourismzonepdf', 'btnTitle' => 'Add New'])
</div> --}}

<div class="border p-1 mb-2">
    <h4>Activities</h4>
    @include('admin.partials.utils.subform-wrapper', [
        'subformData' => $hotelDetail->activities ?? null,
        'type' => 'activities',
        'btnTitle' => 'Add New',
    ])
</div>
<!-- Rooms Amenities -->
@include('admin.partials.utils.textarea', [
    'name' => 'room_amenities',
    'label' => 'Rooms Amenities',
    'value' => $hotelDetail->room_amenities ?? '',
    'rows' => 8,
])

<div class="border p-1 mb-2">
    <h4>Transport</h4>
    @include('admin.partials.utils.subform-wrapper', [
        'subformData' => $hotelDetail->transport ?? null,
        'type' => 'transport',
        'btnTitle' => 'Add New',
    ])
</div>

<!-- Payment mode -->
@include('admin.partials.utils.textarea', [
    'name' => 'payment_mode',
    'label' => 'Payment mode',
    'value' => $hotelDetail->payment_mode ?? '',
    'rows' => 5,
])
<!-- ID Proofs -->
@include('admin.partials.utils.textarea', [
    'name' => 'id_proofs',
    'label' => 'ID Proofs',
    'value' => $hotelDetail->id_proofs ?? '',
    'rows' => 5,
])

<div class="border p-1 mb-2">
    <h4>Emergency Links</h4>
    @include('admin.partials.utils.subform-wrapper', [
        'subformData' => $hotelDetail->emergencyLinks ?? null,
        'type' => 'emergencyLinks',
        'btnTitle' => 'Add New',
    ])
</div>
