
<!-- Avg Price -->
@include('admin.partials.utils.input', ['name'=> 'price','label'=>'Price (₹)','value'=>$room->price ?? '','id' => "",'control' => "number"])
{{--
<!-- Adult Price -->
@include('admin.partials.utils.input', ['name'=> 'adult_price','label'=>'Adult Price (₹)','desc'=>'Price per adult','value'=>$room->adult_price ?? '','id' => "",'control' => "number"])

<!-- Fields list discount by adult number booking -->
<div class="border p-2 mb-2">
    <h4>Fields list discount by adult number booking</h4>
    <p>Fields list discount by adult number booking</p>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $room_zone->discount_by_adult ?? null, 'type' => 'discount_by_adult', 'btnTitle' => 'Add New'])
</div>
<!-- Child Price -->
@include('admin.partials.utils.input', ['name'=> 'child_price','label'=>'Child Price (₹)','desc'=>'Price per child','value'=>$room->child_price ?? '','id' => "",'control' => "number"])

<!-- Fields list discount by adult number booking -->
<div class="border p-2 mb-2">
    <h4>Fields list discount by child number booking</h4>
    <p>Fields list discount by child number booking</p>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $room_zone->discount_by_child ?? null, 'type' => 'discount_by_child', 'btnTitle' => 'Add New'])
</div>

<!-- Type of discount by people -->
@include('admin.partials.utils.select_box', ['items' => $discount_by_people_type, 'name'=> 'discount_by_people_type','selected'=>$room->discount_by_people_type ?? "",'label'=>'Type of discount by people'])
<!-- Type calculator of discount by people -->
@include('admin.partials.utils.select_box', ['items' => $calculator_discount_by_people_type, 'name'=> 'calculator_discount_by_people_type','selected'=>$room->calculator_discount_by_people_type ?? "",'label'=>'Type of discount by people'])

<!-- type room -->
@include('admin.partials.utils.select_box', ['items' => $type_room, 'name'=> 'type_room','selected'=>$room->type_room ?? "",'label'=>'room type','desc'=>'room Type'])
<!-- Infant Price -->
@include('admin.partials.utils.input', ['name'=> 'infant_price','label'=>'Infant Price (₹)','desc'=>'Price per infant','value'=>$room->infant_price ?? '','id' => "",'control' => "number"])
<!-- Disable adult booking -->
@include('admin.partials.utils.radio_input', ['name'=> 'hide_adult_in_booking_form','label'=>'Disable adult booking','desc'=>'Hide No of adult in booking form','item'=>$room ?? '','id' => "",'input' => ["On" => 1,"Off" => 0]])
<!-- Disable children booking -->
@include('admin.partials.utils.radio_input', ['name'=> 'hide_children_in_booking_form','label'=>'Disable children booking','desc'=>'Hide No of child in booking form','item'=>$room ?? '','id' => "",'input' => ["On" => 1,"Off" => 0]])
<!-- Disable infant booking -->
@include('admin.partials.utils.radio_input', ['name'=> 'hide_infant_in_booking_form','label'=>'Disable infant booking','desc'=>'Hide No of infant in booking form','item'=>$room ?? '','id' => "",'input' => ["On" => 1,"Off" => 0]])
<!-- Disable "Adult Name Required" -->
@include('admin.partials.utils.radio_input', ['name'=> 'disable_adult_name','label'=>'Disable "Adult Name Required"','item'=>$room ?? '','id' => "",'input' => ["On" => 1,"Off" => 0]])
<!-- Disable "Children Name Required" -->
@include('admin.partials.utils.radio_input', ['name'=> 'disable_children_name','label'=>'Disable "Children Name Required"','item'=>$room ?? '','id' => "",'input' => ["On" => 1,"Off" => 0]])
<!-- Disable "Infant Name Required" -->
@include('admin.partials.utils.radio_input', ['name'=> 'disable_infant_name','label'=>'Disable "Infant Name Required"','item'=>$room ?? '','id' => "",'input' => ["On" => 1,"Off" => 0]])
<!-- Fields list discount by adult number booking -->
<div class="border p-2 mb-2">
    <h4>Extra price</h4>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $room_zone->extra_price ?? null, 'type' => 'extra_price', 'btnTitle' => 'Add New'])
</div>
<!-- Discount -->
@include('admin.partials.utils.input', ['name'=> 'discount','label'=>'Discount','desc'=>'Discount','value'=>$room->discount ?? '','id' => "",'control' => "number"])

<!-- discount_type -->
@include('admin.partials.utils.select_box', ['items' => $calculator_discount_by_people_type, 'name'=> 'discount_type','selected'=>$room->discount_type ?? "",'label'=>'Type of discount'])
<!-- Sale schedule -->
@include('admin.partials.utils.radio_input', ['name'=> 'is_sale_schedule','label'=>'Sale schedule','item'=>$room ?? '','id' => "",'input' => ["On" => 1,"Off" => 0]])
<!-- Sale price date from -->
@include('admin.partials.utils.input', ['name'=> 'sale_price_from','label'=>'Sale price date from','desc'=>'Sale price date from','value'=>$room->sale_price_from ?? '','id' => "",'class'=>'d-none'])
<!-- Sale price date to -->
@include('admin.partials.utils.input', ['name'=> 'sale_price_to','label'=>'Sale price date to','desc'=>'Sale price date to','value'=>$room->sale_price_to ?? '','id' => "",'class'=>'d-none'])
<!-- room external booking -->
@include('admin.partials.utils.radio_input', ['name'=> 'st_room_external_booking','label'=>'room external booking','item'=>$room ?? '','id' => "",'input' => ["On" => 1,"Off" => 0]])
<!-- room external booking -->
@include('admin.partials.utils.input', ['name'=> 'st_room_external_booking','label'=>'room external booking','value'=>$room->st_room_external_booking ?? '','id' => "",'control'=>'url','class'=>'d-none'])
<!-- room external booking -->
@include('admin.partials.utils.input', ['name'=> 'deposit_payment_amount','label'=>'room external booking','value'=>$room->deposit_payment_amount ?? '','id' => "",'control'=>'url','class'=>'d-none'])

<!-- discount_type -->
@include('admin.partials.utils.select_box', ['items' => $calculator_discount_by_people_type, 'name'=> 'discount_type','selected'=>$room->discount_type ?? "",'label'=>'Type of discount'])

<div class="form-group row">
 <div class="col-lg-12">
  <label class="col-lg-2 col-form-label" for="deposit_payment_status">Deposit payment options</label>
  <p>You can select Disallow Deposit, Deposit by percent</p>
  <select class="form-control single-select-placeholder-touristbook js-states" id="deposit-payment-status" name="deposit_payment_status">

    <option value selected="selected">Disallow deposit</option>
    <option value="percent">Deposit by percent</option>
</select>
</div>
</div>
--}}



