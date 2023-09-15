<div class="border p-2 mb-2">
    <h4>Hotel Activities</h4>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $location->locationMeta->hotel_activities ?? null, 'type' => 'hotel_activities', 'btnTitle' => 'Add New'])
</div>