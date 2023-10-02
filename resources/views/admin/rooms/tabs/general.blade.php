<!-- Set room as feature -->
@include('admin.partials.utils.radio_input', ['name'=> 'is_featured','label'=>'Set room as feature','desc'=>'ON: Set this room to be featured','item'=>$room ?? '','input' => ["On" => 1,"Off" => 0],'on_off_switch'=>true,'label_class'=>['off-switch','on-switch']])
 
 <!-- Booking Options -->
@include('admin.partials.utils.select_box', ['items' => $booking_options, 'name'=> 'st_booking_option_type','selected'=>$room->st_booking_option_type ?? "",'label'=>'Booking Options'])
<!-- room Gallery -->
@include('admin.partials.utils.media', ['name'=> 'gallery','label'=>'room Gallery','desc'=>"Upload room images to show to customers",'value'=>$room->detail->gallery ?? '','id' => ""])
<!-- room Zone Video -->
@include('admin.partials.utils.input', ['name'=> 'video','label'=>'room Zone Video','desc'=>"Input youtube/vimeo url here",'value'=>$room->detail->video ?? '','id' => "",'control'=>'url'])
 