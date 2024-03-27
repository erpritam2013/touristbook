<!-- type activity -->
{!!selectBoxTemplate(['items' => $type_activity, 'name'=> 'type_activity','selected'=>$activity->type_activity ?? "",'label'=>'Activity type','desc'=>'Activity Type'])!!}
<!-- duration -->
{!!inputTemplate(['name'=> 'duration','label'=>'Duration','desc'=>'The total time to take each activity package','value'=>$activity->duration ?? '','id' => ""])!!}
<!-- Booking time period -->
{!!inputTemplate(['name'=> 'activity_booking_period','label'=>'Booking period','desc'=>'Booking time period prior to arrival.','value'=>$activity->activity_booking_period ?? 0,'id' => "",'min' => 0,'max' => 30,'step' => 1])!!}
<!-- Activity time -->
{!!inputTemplate(['name'=> 'activity_time','label'=>'Activity time','desc'=>'The departure time of an activity','value'=>$activity->activity_time ?? '','id' => ""])!!}
<!-- Min number of people -->
{!!inputTemplate(['name'=> 'min_people','label'=>'Min number of people','desc'=>'Min number of people','value'=>$activity->min_people ?? '','id' => "",'type'=>'number'])!!}
<!-- Max number of people -->
{!!inputTemplate(['name'=> 'max_people','label'=>'Max number of people','desc'=>'Max number of people','value'=>$activity->max_people ?? '','id' => "",'type'=>'number'])!!}
<!-- Venue facilities -->
{!!inputTemplate(['name'=> 'venue_facilities','label'=>'Venue facilities','desc'=>'The facilities that customer may experience during activities','value'=>$activity->venue_facilities ?? '','id' => ""])!!}
<!-- Activity Included -->
{!!inputTemplate(['name'=> 'activity_include','label'=>'Activity Included','value'=>$activity->detail->activity_include ?? ''])!!}
<!-- Activity Excluded -->
{!!inputTemplate(['name'=> 'activity_exclude','label'=>'Activity Excluded','value'=>$activity->detail->activity_exclude ?? ''])!!}
<!-- Activity Highlight -->
{!!inputTemplate(['name'=> 'activity_highlight','label'=>'Activity Highlight','value'=>$activity->detail->activity_highlight ?? ''])!!}
<!-- activity program style -->
{!!selectBoxTemplate(['items' => $activity_program_style, 'name'=> 'activity_program_style','selected'=>$activity->detail->activity_program_style ?? "",'label'=>'activity program style','first_empty_option'=>true,'option_attr'=>'data-target="activity-program"','class'=>'program-style-select'])!!}


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

