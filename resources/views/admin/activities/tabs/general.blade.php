<div class="form-group row">
    <label class="col-lg-5 col-form-label" for="activity-as-feature">Set activity as feature<br /><small>ON: Set this activity to be featured</small></label>

    <div class="col-lg-7">
        <label class="col-form-label">
            <input type="radio" name="is_featured" value="1" {!!get_edit_select_check_pvr_old_value('is_featured', $activity ?? "" ,'is_featured',1, 'checked' )!!}>&nbsp;On
        </label>
        <label class="col-form-label">
            <input type="radio" name="is_featured" {!!get_edit_select_check_pvr_old_value('is_featured', $activity ?? "" ,'is_featured',0, 'checked' )!!} value="0">&nbsp;Off
        </label>
    </div>
</div>
 
 
  @include('admin.partials.utils.select_box', ['items' => $booking_options, 'name'=> 'st_booking_option_type','selected'=>$activity->st_booking_option_type ?? "",'lebal'=>'Booking Options'])

 @include('admin.partials.utils.media', ['name'=> 'gallery','label'=>'Activity Gallery','desc'=>"Upload activity images to show to customers",'value'=>$activity->gallery ?? '','id' => ""])

 @include('admin.partials.utils.input', ['name'=> 'video','label'=>'Activity Zone Video','desc'=>"Input youtube/vimeo url here",'value'=>$activity->video ?? '','id' => "",'control'=>'url'])
 