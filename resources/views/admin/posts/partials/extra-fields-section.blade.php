<div class="card room-extra-fields">
    <div class="card-header border-bottom">
        <h4 class="card-title">Extra Fields</h4>
    </div>

    <div class="card-body">

        <!-- Select Country -->
       {{--@include('admin.partials.utils.select_box', ['items' => getCountries(), 'name'=> 'country','selected'=>$room->detail->country ?? "",'label'=>'Select Country','attr'=>'onchange="showRoomZone()"'])--}} 

       {{-- <!-- Select room Zone -->
        @include('admin.partials.utils.select_box', ['items' => [], 'name'=> 'room_zone_id','selected'=>$room->room_zone->pluck('id')->toArray() ?? [],'label'=>'Select room Zone','parent_class'=>'room-zone-id-section d-none'])

        <!-- Extranal Link(official website link) -->
        @include('admin.partials.utils.input', ['name'=> 'st_room_external_booking_link','label'=>'Extranal Link(official website link)','value'=>$room->detail->st_room_external_booking_link ?? '','id' => "",'control' => "url"])


        <div class="border p-2 mb-2">
            <h4>Zones Highlight</h4>
            <p>Enter room Zones</p>
            @include('admin.partials.utils.subform-wrapper', ["subformData" => $room->detail->room_zones ?? null, 'type' => 'room_zones', 'btnTitle' => 'Add New'])
        </div>
         <!-- Corporate Address -->
         @include('admin.partials.utils.input', ['name'=> 'st_room_corporate_address','label'=>'Corporate Address','value'=>$room->detail->st_room_corporate_address ?? '','id' => "",'desc' => "Add Corporate Address"])
<!--  -->
         @include('admin.partials.utils.input', ['name'=> 'st_room_short_address','label'=>'Short Address','value'=>$room->detail->st_room_short_address ?? '','id' => "",'desc' => "Add Short Address"])--}}


    </div>
</div>
