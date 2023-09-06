<div class="border p-2 mb-2">
    <h4>What To Do</h4>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $location->locationMeta->what_to_do ?? null, 'type' => 'what_to_do', 'btnTitle' => 'Add New'])
</div>