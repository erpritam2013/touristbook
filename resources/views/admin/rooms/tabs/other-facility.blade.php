<div class="border p-2 mb-2 ">
    <h4>Add new facility</h4>
    <p>You can add unlimited facilities. This option can be used for only Single Hotel with Room Layout</p>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $room->detail->add_new_facility ?? null, 'type' => 'add_new_facility', 'btnTitle' => 'Add New'])
</div>

 @include('admin.partials.utils.textarea', ['name'=> 'room_description','label'=>'Room Description','rows'=>10,'value'=>$room->detail->room_description ?? '','id' => ""])