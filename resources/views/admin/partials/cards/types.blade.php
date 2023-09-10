<div class="card {{(count($types) > 5)?'term-card':'term-card-padding'}}">
    <div class="card-header border-bottom">
        <h4 class="card-title">Location Type</h4>
    </div>
    <div class="card-body">
        <div class="form-group row">
            @include('admin.partials.utils.nested_checkbox_list', ['items' => $types, 'name'=> 'location_type', 'selected' => $selected])
        </div>
    </div>
</div>
