
 <!-- Booking Options -->
{!!selectBoxTemplate(['items' => $hotels, 'name'=> 'hotel_id','selected'=>$room->hotel_id ?? "",'label'=>'Hotel Room','desc'=>'Select a hotel for this type of room','first_option_text'=>'Select a hotel for this type of room'])!!}

<!-- number_room -->
{!!inputTemplate(['name'=> 'number_room','label'=>'Number of rooms','desc'=>'Number of available rooms for booking','value'=>$room->number_room ?? "",'control'=>'number'])!!}
 
 <!-- Booking Options -->
{!!selectBoxTemplate(['items' => $booking_options, 'name'=> 'st_booking_option_type','selected'=>$room->detail->st_booking_option_type ?? "",'label'=>'Booking Options'])!!}
<!-- room Gallery -->
{!!mediaTemplate(['name'=> 'gallery','label'=>'Gallery','desc'=>"Upload images to make a gallery image for room",'value'=>$room->detail->gallery ?? '','id' => "",'smode'=>'multiple'])!!}
<!-- Hotel Alone Room Layout -->
{!!radioInputTemplate(['name'=> 'hotel_alone_room_layout','label'=>'Hotel Alone Room Layout','item'=>$room->detail ?? '','input' => ["On" => 1,"Off" => 0],'on_off_switch'=>true,'label_class'=>['off-switch','on-switch']])!!}
<!-- Disable "Adult Name Required" -->
{!!radioInputTemplate(['name'=> 'disable_adult_name','label'=>'Disable "Adult Name Required"','item'=>$room->detail ?? '','input' => ["On" => 1,"Off" => 0],'on_off_switch'=>true,'label_class'=>['off-switch','on-switch']])!!}
<!-- Hotel Alone Room Layout -->
{!!radioInputTemplate(['name'=> 'disable_children_name','label'=>'Disable "Children Name Required"','item'=>$room->detail ?? '','input' => ["On" => 1,"Off" => 0],'on_off_switch'=>true,'label_class'=>['off-switch','on-switch']])!!}
 