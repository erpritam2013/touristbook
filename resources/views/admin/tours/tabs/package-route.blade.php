<div class="border p-2 mb-2" >
    <h4>Package Route</h4>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $tour->detail->package_route ?? null, 'type' => 'package_route', 'btnTitle' => 'Add New'])
</div>