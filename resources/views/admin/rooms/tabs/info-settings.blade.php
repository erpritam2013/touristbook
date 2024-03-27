{{--<!-- type room -->
{!!selectBoxTemplate(['items' => $type_room, 'name'=> 'type_room','selected'=>$room->type_room ?? "",'label'=>'room type','desc'=>'room Type'])!!}
<!-- duration -->
{!!inputTemplate(['name'=> 'duration','label'=>'Duration','desc'=>'The total time to take each room package','value'=>$room->duration ?? '','id' => ""])!!}
<!-- Booking time period -->
{!!rangeInputTemplate(['name'=> 'room_booking_period','label'=>'Booking period','desc'=>'Booking time period prior to arrival.','value'=>$room->room_booking_period ?? 0,'id' => "",'min' => 0,'max' => 30,'step' => 1])!!}
<!-- room time -->
{!!inputTemplate(['name'=> 'room_time','label'=>'room time','desc'=>'The departure time of an room','value'=>$room->room_time ?? '','id' => ""])!!}
<!-- Min number of people -->
{!!inputTemplate(['name'=> 'min_people','label'=>'Min number of people','desc'=>'Min number of people','value'=>$room->min_people ?? '','id' => "",'type'=>'number'])!!}
<!-- Max number of people -->
{!!inputTemplate(['name'=> 'max_people','label'=>'Max number of people','desc'=>'Max number of people','value'=>$room->max_people ?? '','id' => "",'type'=>'number'])!!}
<!-- Venue facilities -->
{!!inputTemplate(['name'=> 'venue_facilities','label'=>'Venue facilities','desc'=>'The facilities that customer may experience during activities','value'=>$room->venue_facilities ?? '','id' => ""])!!}
<!-- room Included -->
{!!textareaTemplate(['name'=> 'room_include','label'=>'room Excluded','value'=>$room->detail->room_include ?? ''])!!}
<!-- room Excluded -->
{!!textareaTemplate(['name'=> 'room_exclude','label'=>'room Included','value'=>$room->detail->room_exclude ?? ''])!!}
<!-- room Highlight -->
{!!textareaTemplate(['name'=> 'room_highlight','label'=>'room Included','value'=>$room->detail->room_highlight ?? ''])!!}
<!-- room program style -->
{!!selectBoxTemplate(['items' => $room_program_style, 'name'=> 'room_program_style','selected'=>$room->detail->room_program_style ?? "",'label'=>'room program style','first_empty_option'=>true,'option_attr'=>'data-target="room-program"','class'=>'program-style-select'])!!}


<div class="border p-2 mb-2 room-program-style1 d-none">
    <h4>Room Program</h4>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $room->detail->room_program ?? null, 'type' => 'room_program', 'btnTitle' => 'Add New'])
</div>

<div class="border p-2 mb-2 room-program-style2 d-none">
    <h4>Room Program</h4>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $room->detail->room_program_bgr ?? null, 'type' => 'room_program_bgr', 'btnTitle' => 'Add New'])
</div>

<div class="border p-2 mb-2 ">
    <h4>Room FAQ</h4>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $room->detail->room_faq ?? null, 'type' => 'room_faq', 'btnTitle' => 'Add New'])
</div>--}}

