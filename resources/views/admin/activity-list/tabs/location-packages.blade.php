<div class="border p-2 mb-2">
    <h4>By Aggregators</h4>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $location->locationMeta->by_aggregators ?? null, 'type' => 'by_aggregators', 'btnTitle' => 'Add New'])
</div>
<div class="border p-2 mb-2">
    <h4>By Govt. Subsidiaries</h4>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $location->locationMeta->b_govt_subsidiaries ?? null, 'type' => 'b_govt_subsidiaries', 'btnTitle' => 'Add New'])
</div>
<div class="border p-2 mb-2">
    <h4>By Hotels</h4>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $location->locationMeta->by_hotels ?? null, 'type' => 'by_hotels', 'btnTitle' => 'Add New'])
</div>