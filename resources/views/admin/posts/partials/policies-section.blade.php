<div class="card">
    <div class="card-header border-bottom">
        <h4 class="card-title">Policies Section</h4>
    </div>

    <div class="card-body">
       <!-- Child Policy -->
       @include('admin.partials.utils.textarea', ['name'=> 'child_policy','label'=>'Child Policy','value'=>$room->detail->child_policy ?? '','id' => "",'class'=>'ckeditor'])
       <!-- Booking Policy -->
       @include('admin.partials.utils.textarea', ['name'=> 'booking_policy','label'=>'Booking Policy','value'=>$room->detail->booking_policy ?? '','id' => "",'class'=>'ckeditor'])
       <!-- Refund and Cancellation Policy  -->
       @include('admin.partials.utils.textarea', ['name'=> 'refund_and_cancellation_policy','label'=>'Refund and Cancellation Policy','value'=>$room->detail->refund_and_cancellation_policy ?? '','id' => "",'class'=>'ckeditor'])

   </div>
</div>
