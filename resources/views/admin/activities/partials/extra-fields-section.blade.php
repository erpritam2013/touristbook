<div class="card">
    <div class="card-header border-bottom">
        <h4 class="card-title">Food Dining</h4>
    </div>

    <div class="card-body">

        <!-- Select Country -->
        @include('admin.partials.utils.select_box', ['items' => getCountries(), 'name'=> 'country','selected'=>$activity->details->country ?? "",'label'=>'Type of discount by people'])

        <!-- Extranal Link(official website link) -->
        @include('admin.partials.utils.input', ['name'=> 'st_activity_external_booking_link','label'=>'Extranal Link(official website link)','value'=>$activity->details->st_activity_external_booking_link ?? '','id' => "",'control' => "url"])


        <div class="border p-2 mb-2">
            <h4>Zones Highlight</h4>
            <p>Enter Activity Zones</p>
            @include('admin.partials.utils.subform-wrapper', ["subformData" => $activity_zone->details->activity_zones ?? null, 'type' => 'activity_zones', 'btnTitle' => 'Add New'])
        </div>


    </div>
</div>
