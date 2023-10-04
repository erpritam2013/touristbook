<!-- room room_facility_preview -->
<!--  -->
<!-- number_room -->

{{--<input type="hidden" name="room_facility_preview_id" value="$room->detail->room_facility_preview_id ?? ''">--}}
@include('admin.partials.utils.media', ['name'=> 'room_facility_preview','label'=>'room_facility_preview','desc'=>"Upload images to make a room_facility_preview image for room",'value'=>$room->detail->room_facility_preview ?? '','id' => ""])
<!-- Number of adults -->
@include('admin.partials.utils.range_input', ['name'=> 'adult_number','label'=>'Number of adults','desc'=>'Number of adults in room','id' => "",'min' => 0,'max' => 50,'step' => 1,'value' => $room->adult_number ?? 0])
<!-- Number of children -->
@include('admin.partials.utils.range_input', ['name'=> 'children_number','label'=>'Number of children','desc'=>'Number of children in room','id' => "",'min' => 0,'max' => 50,'step' => 1,'value' => $room->children_number ?? 0])
<!-- Number of beds -->
@include('admin.partials.utils.input', ['name'=> 'bed_number','label'=>'Number of beds','desc'=>'Number of Beds in room','value'=>$room->detail->bed_number ?? ""])
<!-- Number of beds -->
@include('admin.partials.utils.input', ['name'=> 'room_footage','label'=>'Room footage ( square meters )','desc'=>'Room footage (square meters)
','value'=>$room->detail->room_footage ?? ""])


<!-- Room external booking -->
@include('admin.partials.utils.radio_input', ['name'=> 'st_room_external_booking','label'=>'Room external booking','desc'=>'It allows ON/OFF in booking by an external link','item'=>$room->detail ?? '','input' => ["On" => 1,"Off" => 0],'on_off_switch'=>true,'label_class'=>['off-switch','on-switch'],'class'=>'st_room_external_booking'])

<!-- Number of beds -->
@include('admin.partials.utils.input', ['name'=> 'st_room_external_booking_link','label'=>'Room external booking','desc'=>'Notice: Must be http://...
','value'=>$room->detail->st_room_external_booking_link ?? "",'hidden_class'=>'d-none st_room_external_booking_link','control'=>'url'])







