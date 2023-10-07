<!-- type tour -->

@include('admin.partials.utils.select_box', ['items' => $type_activity, 'name'=> 'type_tour','selected'=>$tour->type_tour ?? "",'label'=>'Tour Type','desc'=>'tour Type'])
<!-- duration_day -->
@include('admin.partials.utils.input', ['name'=> 'duration_day','label'=>'Duration Day','desc'=>'The total time to take each tour package','value'=>$tour->duration_day ?? '','id' => ""])

<!-- tours booking period -->
@include('admin.partials.utils.input', ['name'=> 'tours_booking_period','label'=>'Minimum days to book before departure','desc'=>'Minimum days to book before departure','value'=>$tour->tours_booking_period ?? '','id' => ""])

<!-- Set tour as feature -->
@include('admin.partials.utils.radio_input', ['name'=> 'st_tour_external_booking','label'=>'Allow external booking','desc'=>'You can set booking by an external link','item'=>$tour->detail ?? '','input' => ["On" => 1,"Off" => 0],'on_off_switch'=>true,'label_class'=>['off-switch','on-switch'],'attr'=>'data-target=".tour-detail-link"'])

<div class="tour-detail-link d-none">
    <!-- tour time -->
@include('admin.partials.utils.input', ['name'=> 'st_tour_external_booking_link','label'=>'Tour Detail link','desc'=>'Notice: Must be http://...','value'=>$tour->detail->st_tour_external_booking_link ?? '','id' => ""])
</div>
<!-- Min number of people -->
@include('admin.partials.utils.input', ['name'=> 'min_people','label'=>'Min number of people','desc'=>'Min number of people','value'=>$tour->min_people ?? '','id' => "",'control'=>'number'])
<!-- Max number of people -->
@include('admin.partials.utils.input', ['name'=> 'max_people','label'=>'Max number of people','desc'=>'Max number of people','value'=>$tour->max_people ?? '','id' => "",'control'=>'number'])
<!-- Coupon Code -->
@include('admin.partials.utils.input', ['name'=> 'tours_coupan','label'=>'Coupon Code','value'=>$tour->detail->tours_coupan ?? '','id' => ""])

<!-- tour Included -->
@include('admin.partials.utils.textarea', ['name'=> 'tours_include','label'=>'Tour Included','value'=>$tour->detail->tours_include ?? ''])
<!-- tour Excluded -->
@include('admin.partials.utils.textarea', ['name'=> 'tours_exclude','label'=>'Tour Excluded','value'=>$tour->detail->tours_exclude ?? ''])
<!-- tour Highlight -->
@include('admin.partials.utils.textarea', ['name'=> 'tours_highlight','label'=>'Tour Highlight','value'=>$tour->detail->tours_highlight ?? ''])

<!-- Tour Sponsored By -->
<div class="border p-2 mb-2 " data-layout="style1">
    <h4>Tour Sponsored By</h4>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $tour->detail->tour_sponsored_by ?? null, 'type' => 'tour_sponsored_by', 'btnTitle' => 'Add New'])
</div>

<div class="border p-2 mb-2 " data-layout="style1">
    <h4>Tour Destinations</h4>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $tour->detail->tours_destinations ?? null, 'type' => 'tours_destinations', 'btnTitle' => 'Add New'])
</div>

<div class="border p-2 mb-2 tour-program-style1 d-none" data-layout="style1">
    <h4>Tour Helpful Facts</h4>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $tour->detail->tour_helpful_facts ?? null, 'type' => 'tour_helpful_facts', 'btnTitle' => 'Add New'])
</div>
<!-- tour program style -->
@php 
$activity_program_style['style4'] = (object)["id"=>'style4',"value"=>'Background image with text'];
@endphp
@include('admin.partials.utils.select_box', ['items' => $activity_program_style, 'name'=> 'tour_program_style','selected'=>$tour->detail->tour_program_style ?? "",'label'=>'tour program style','first_empty_option'=>true,'option_attr'=>'data-target="tour-program"','class'=>'program-style-select'])


<div class="border p-2 mb-2 tour-program-style1 tour-program-style3 d-none">
    <h4>Tour Program</h4>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $tour->detail->tours_program ?? null, 'type' => 'tours_program', 'btnTitle' => 'Add New'])
</div>


<div class="border p-2 mb-2 tour-program-style2 d-none" >
    <h4>Tour Program</h4>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $tour->detail->tours_program_bgr ?? null, 'type' => 'tours_program_bgr', 'btnTitle' => 'Add New'])
</div>

<div class="border p-2 mb-2 tour-program-style4 d-none">
    <h4>Tour Program</h4>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $tour->detail->tours_program_style4 ?? null, 'type' => 'tours_program_style4', 'btnTitle' => 'Add New'])
</div>

<div class="border p-2 mb-2 ">
    <h4>Tour FAQ</h4>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $tour->detail->tours_faq ?? null, 'type' => 'tours_faq', 'btnTitle' => 'Add New'])
</div>

