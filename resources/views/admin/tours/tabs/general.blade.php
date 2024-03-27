<!-- Set tour as feature -->
{!!radioInputTemplate(['name'=> 'is_featured','label'=>'Set tour as feature','desc'=>'ON: Set this tour to be featured','item'=>$tour ?? '','input' => ["On" => 1,"Off" => 0],'on_off_switch'=>true,'label_class'=>['off-switch','on-switch']])!!}
 
 <!-- Booking Options -->
{!!selectBoxTemplate(['items' => $booking_options, 'name'=> 'st_booking_option_type','selected'=>$tour->st_booking_option_type ?? "",'label'=>'Booking Options'])!!}

{{-- Gallery --}}

  @include('admin.partials.utils.gallery', [
            'name' => 'gallery',
            'label' => 'Tour Gallery',
            'value' => $tour->detail->gallery ?? [],
            'id' => 'tour-gallery',
            'smode' => 'multiple',
        ])

<!-- tour Zone Video -->
{!!inputTemplate(['name'=> 'video','label'=>'tour Zone Video','desc'=>"Input youtube/vimeo url here",'value'=>$tour->detail->video ?? '','id' => "",'control'=>'url'])!!}
 