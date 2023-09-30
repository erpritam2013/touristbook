<div class="card activity-extra-fields">
    <div class="card-header border-bottom">
        <h4 class="card-title">Extra Fields</h4>
    </div>

    <div class="card-body">

        <!-- Select Country -->
        @include('admin.partials.utils.select_box', ['items' => getCountries(), 'name'=> 'country','selected'=>$activity->detail->country ?? "",'label'=>'Select Country','attr'=>'onchange="showActivityZone()"'])

        <!-- Select Activity Zone -->
        @include('admin.partials.utils.select_box', ['items' => [], 'name'=> 'activity_zone_id','selected'=>$activity->activity_zone->pluck('id')->toArray() ?? [],'label'=>'Select Activity Zone','parent_class'=>'activity-zone-id-section d-none'])

        <!-- Extranal Link(official website link) -->
        @include('admin.partials.utils.input', ['name'=> 'st_activity_external_booking_link','label'=>'Extranal Link(official website link)','value'=>$activity->detail->st_activity_external_booking_link ?? '','id' => "",'control' => "url"])


        <div class="border p-2 mb-2">
            <h4>Zones Highlight</h4>
            <p>Enter Activity Zones</p>
            @include('admin.partials.utils.subform-wrapper', ["subformData" => $activity->detail->activity_zones ?? null, 'type' => 'activity_zones', 'btnTitle' => 'Add New'])
        </div>
         <!-- Corporate Address -->
         @include('admin.partials.utils.input', ['name'=> 'st_activity_corporate_address','label'=>'Corporate Address','value'=>$activity->detail->st_activity_corporate_address ?? '','id' => "",'desc' => "Add Corporate Address"])
<!--  -->
         @include('admin.partials.utils.input', ['name'=> 'st_activity_short_address','label'=>'Short Address','value'=>$activity->detail->st_activity_short_address ?? '','id' => "",'desc' => "Add Short Address"])


    </div>
</div>
