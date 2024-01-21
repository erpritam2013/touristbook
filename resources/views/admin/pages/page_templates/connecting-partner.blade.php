<div class="border p-2 mb-2">
    <h4>Connecting Partner Information</h4>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $page->extra_data['connecting_partners'] ?? null, 'type' => 'connecting_partners', 'btnTitle' => 'Add New'])
</div>


