<!-- Set tour as feature -->
@include('admin.partials.utils.radio_input', ['name'=> 'is_featured','label'=>'Set tour as feature','desc'=>'ON: Set this tour to be featured','item'=>$tour ?? '','input' => ["On" => 1,"Off" => 0],'on_off_switch'=>true,'label_class'=>['off-switch','on-switch']])
 
 <!-- Booking Options -->
@include('admin.partials.utils.select_box', ['items' => $booking_options, 'name'=> 'st_booking_option_type','selected'=>$tour->st_booking_option_type ?? "",'label'=>'Booking Options'])
<!-- tour Gallery -->
@include('admin.partials.utils.media', ['name'=> 'gallery','label'=>'tour Gallery','desc'=>"Upload tour images to show to customers",'value'=>$tour->detail->gallery ?? '','id' => ""])
<!-- tour Zone Video -->
@include('admin.partials.utils.input', ['name'=> 'video','label'=>'tour Zone Video','desc'=>"Input youtube/vimeo url here",'value'=>$tour->detail->video ?? '','id' => "",'control'=>'url'])
 