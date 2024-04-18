<!-- Set activity as feature -->
@include('admin.partials.utils.radio_input', ['name'=> 'is_featured','label'=>'Set activity as feature','desc'=>'ON: Set this activity to be featured','item'=>$activity ?? '','input' => ["On" => 1,"Off" => 0],'on_off_switch'=>true,'label_class'=>['off-switch','on-switch']])
 
 <!-- Booking Options -->
@include('admin.partials.utils.select_box', ['items' => $booking_options, 'name'=> 'st_booking_option_type','selected'=>$activity->st_booking_option_type ?? "",'label'=>'Booking Options'])

{{-- Gallery --}}

  @include('admin.partials.utils.gallery', [
            'name' => 'gallery',
            'label' => 'Activity Gallery',
            'value' => $activity->detail->gallery ?? [],
            'id' => 'activity-gallery',
            'desc'=>"Upload activity images to show to customers",
            'smode' => 'multiple',
        ])
<!-- Activity Zone Video -->
@include('admin.partials.utils.input', ['name'=> 'video','label'=>'Activity Zone Video','desc'=>"Input youtube/vimeo url here",'value'=>$activity->detail->video ?? '','id' => "",'control'=>'url'])
 