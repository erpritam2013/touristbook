<div class="border p-2 mb-2">
    <h4>About Information</h4>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $page->extra_data['about_info'] ?? null, 'type' => 'about_info', 'btnTitle' => 'Add New'])
</div>
<div class="border p-2 mb-2">
    <h4>Team Information</h4>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $page->extra_data['about_team'] ?? null, 'type' => 'about_team', 'btnTitle' => 'Add New'])
</div>

