<div class="card">
    <div class="card-header border-bottom">
        <h4 class="card-title">Policies Section</h4>
    </div>

    <div class="card-body">
       <!-- Child Policy -->
       {!!textareaTemplate(['name'=> 'child_policy','label'=>'Child Policy','value'=>$activity->detail->child_policy ?? '','id' => "",'class'=>'ckeditor'])!!}
       <!-- Booking Policy -->
       {!!textareaTemplate(['name'=> 'booking_policy','label'=>'Booking Policy','value'=>$activity->detail->booking_policy ?? '','id' => "",'class'=>'ckeditor'])!!}
       <!-- Refund and Cancellation Policy  -->
       {!!textareaTemplate(['name'=> 'refund_and_cancellation_policy','label'=>'Refund and Cancellation Policy','value'=>$activity->detail->refund_and_cancellation_policy ?? '','id' => "",'class'=>'ckeditor'])!!}

   </div>
</div>
