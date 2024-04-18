<!-- type activity -->
@include('admin.partials.utils.select_box', ['items' => $type_activity, 'name'=> 'type_activity','selected'=>$activity->type_activity ?? "",'label'=>'Activity type','desc'=>'Activity Type'])
<!-- duration -->
@include('admin.partials.utils.input', ['name'=> 'duration','label'=>'Duration','desc'=>'The total time to take each activity package','value'=>$activity->duration ?? '','id' => ""])
<!-- Booking time period -->
@include('admin.partials.utils.range_input', ['name'=> 'activity_booking_period','label'=>'Booking period','desc'=>'Booking time period prior to arrival.','value'=>$activity->activity_booking_period ?? 0,'id' => "",'min' => 0,'max' => 30,'step' => 1])
<!-- Activity time -->
@include('admin.partials.utils.input', ['name'=> 'activity_time','label'=>'Activity time','desc'=>'The departure time of an activity','value'=>$activity->activity_time ?? '','id' => ""])
<!-- Min number of people -->
@include('admin.partials.utils.input', ['name'=> 'min_people','label'=>'Min number of people','desc'=>'Min number of people','value'=>$activity->min_people ?? '','id' => "",'type'=>'number'])
<!-- Max number of people -->
@include('admin.partials.utils.input', ['name'=> 'max_people','label'=>'Max number of people','desc'=>'Max number of people','value'=>$activity->max_people ?? '','id' => "",'type'=>'number'])
<!-- Venue facilities -->
@include('admin.partials.utils.input', ['name'=> 'venue_facilities','label'=>'Venue facilities','desc'=>'The facilities that customer may experience during activities','value'=>$activity->venue_facilities ?? '','id' => ""])
<!-- Activity Included -->
@include('admin.partials.utils.textarea', ['name'=> 'activity_include','label'=>'Activity Included','value'=>$activity->detail->activity_include ?? ''])
<!-- Activity Excluded -->
@include('admin.partials.utils.textarea', ['name'=> 'activity_exclude','label'=>'Activity Excluded','value'=>$activity->detail->activity_exclude ?? ''])
<!-- Activity Highlight -->
@include('admin.partials.utils.textarea', ['name'=> 'activity_highlight','label'=>'Activity Highlight','value'=>$activity->detail->activity_highlight ?? ''])
<!-- activity program style -->
@include('admin.partials.utils.select_box', ['items' => $activity_program_style, 'name'=> 'activity_program_style','selected'=>$activity->detail->activity_program_style ?? "",'label'=>'activity program style','first_empty_option'=>true,'option_attr'=>'data-target="activity-program"','class'=>'program-style-select'])


<div class="border p-2 mb-2 activity-program-style1 d-none">
    <h4>Activity Program</h4>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $activity->detail->activity_program ?? null, 'type' => 'activity_program', 'btnTitle' => 'Add New'])
</div>

<div class="border p-2 mb-2 activity-program-style2 d-none">
    <h4>Activity Program</h4>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $activity->detail->activity_program_bgr ?? null, 'type' => 'activity_program_bgr', 'btnTitle' => 'Add New'])
</div>

<div class="border p-2 mb-2 ">
    <h4>Activity FAQ</h4>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $activity->detail->activity_faq ?? null, 'type' => 'activity_faq', 'btnTitle' => 'Add New'])
</div>

