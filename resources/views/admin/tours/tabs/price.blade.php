
<!-- Avg Price -->
{!!inputTemplate(['name'=> 'price','label'=>'Price','value'=>$tour->price ?? '','id' => "",'control' => "number"])!!}
{{--
<!-- Adult Price -->
{!!inputTemplate(['name'=> 'adult_price','label'=>'Adult Price','desc'=>'Price per adult','value'=>$tour->adult_price ?? '','id' => "",'control' => "number"])!!}

<!-- Fields list discount by adult number booking -->
<div class="border p-2 mb-2">
    <h4>Fields list discount by adult number booking</h4>
    <p>Fields list discount by adult number booking</p>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $tour_zone->discount_by_adult ?? null, 'type' => 'discount_by_adult', 'btnTitle' => 'Add New'])
</div>
<!-- Child Price -->
{!!inputTemplate(['name'=> 'child_price','label'=>'Child Price','desc'=>'Price per child','value'=>$tour->child_price ?? '','id' => "",'control' => "number"])!!}

<!-- Fields list discount by adult number booking -->
<div class="border p-2 mb-2">
    <h4>Fields list discount by child number booking</h4>
    <p>Fields list discount by child number booking</p>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $tour_zone->discount_by_child ?? null, 'type' => 'discount_by_child', 'btnTitle' => 'Add New'])
</div>

<!-- Type of discount by people -->
{!!selectBoxTemplate(['items' => $discount_by_people_type, 'name'=> 'discount_by_people_type','selected'=>$tour->discount_by_people_type ?? "",'label'=>'Type of discount by people'])!!}
<!-- Type calculator of discount by people -->
{!!selectBoxTemplate(['items' => $calculator_discount_by_people_type, 'name'=> 'calculator_discount_by_people_type','selected'=>$tour->calculator_discount_by_people_type ?? "",'label'=>'Type of discount by people'])!!}

<!-- type tour -->
{!!selectBoxTemplate(['items' => $type_tour, 'name'=> 'type_tour','selected'=>$tour->type_tour ?? "",'label'=>'tour type','desc'=>'tour Type'])!!}
<!-- Infant Price -->
{!!inputTemplate(['name'=> 'infant_price','label'=>'Infant Price','desc'=>'Price per infant','value'=>$tour->infant_price ?? '','id' => "",'control' => "number"])!!}
<!-- Disable adult booking -->
{!!radioInputTemplate(['name'=> 'hide_adult_in_booking_form','label'=>'Disable adult booking','desc'=>'Hide No of adult in booking form','item'=>$tour ?? '','id' => "",'input' => ["On" => 1,"Off" => 0]])!!}
<!-- Disable children booking -->
{!!radioInputTemplate(['name'=> 'hide_children_in_booking_form','label'=>'Disable children booking','desc'=>'Hide No of child in booking form','item'=>$tour ?? '','id' => "",'input' => ["On" => 1,"Off" => 0]])!!}
<!-- Disable infant booking -->
{!!radioInputTemplate(['name'=> 'hide_infant_in_booking_form','label'=>'Disable infant booking','desc'=>'Hide No of infant in booking form','item'=>$tour ?? '','id' => "",'input' => ["On" => 1,"Off" => 0]])!!}
<!-- Disable "Adult Name Required" -->
{!!radioInputTemplate(['name'=> 'disable_adult_name','label'=>'Disable "Adult Name Required"','item'=>$tour ?? '','id' => "",'input' => ["On" => 1,"Off" => 0]])!!}
<!-- Disable "Children Name Required" -->
{!!radioInputTemplate(['name'=> 'disable_children_name','label'=>'Disable "Children Name Required"','item'=>$tour ?? '','id' => "",'input' => ["On" => 1,"Off" => 0]])!!}
<!-- Disable "Infant Name Required" -->
{!!radioInputTemplate(['name'=> 'disable_infant_name','label'=>'Disable "Infant Name Required"','item'=>$tour ?? '','id' => "",'input' => ["On" => 1,"Off" => 0]])!!}
<!-- Fields list discount by adult number booking -->
<div class="border p-2 mb-2">
    <h4>Extra price</h4>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $tour_zone->extra_price ?? null, 'type' => 'extra_price', 'btnTitle' => 'Add New'])
</div>
<!-- Discount -->
{!!inputTemplate(['name'=> 'discount','label'=>'Discount','desc'=>'Discount','value'=>$tour->discount ?? '','id' => "",'control' => "number"])!!}

<!-- discount_type -->
{!!selectBoxTemplate(['items' => $calculator_discount_by_people_type, 'name'=> 'discount_type','selected'=>$tour->discount_type ?? "",'label'=>'Type of discount'])!!}
<!-- Sale schedule -->
{!!radioInputTemplate(['name'=> 'is_sale_schedule','label'=>'Sale schedule','item'=>$tour ?? '','id' => "",'input' => ["On" => 1,"Off" => 0]])!!}
<!-- Sale price date from -->
{!!inputTemplate(['name'=> 'sale_price_from','label'=>'Sale price date from','desc'=>'Sale price date from','value'=>$tour->sale_price_from ?? '','id' => "",'class'=>'d-none'])!!}
<!-- Sale price date to -->
{!!inputTemplate(['name'=> 'sale_price_to','label'=>'Sale price date to','desc'=>'Sale price date to','value'=>$tour->sale_price_to ?? '','id' => "",'class'=>'d-none'])!!}
<!-- tour external booking -->
{!!radioInputTemplate(['name'=> 'st_tour_external_booking','label'=>'tour external booking','item'=>$tour ?? '','id' => "",'input' => ["On" => 1,"Off" => 0]])!!}
<!-- tour external booking -->
{!!inputTemplate(['name'=> 'st_tour_external_booking','label'=>'tour external booking','value'=>$tour->st_tour_external_booking ?? '','id' => "",'control'=>'url','class'=>'d-none'])!!}
<!-- tour external booking -->
{!!inputTemplate(['name'=> 'deposit_payment_amount','label'=>'tour external booking','value'=>$tour->deposit_payment_amount ?? '','id' => "",'control'=>'url','class'=>'d-none'])!!}

<!-- discount_type -->
{!!selectBoxTemplate(['items' => $calculator_discount_by_people_type, 'name'=> 'discount_type','selected'=>$tour->discount_type ?? "",'label'=>'Type of discount'])!!}

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



