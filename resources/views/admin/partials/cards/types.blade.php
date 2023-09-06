<div class="card {{!empty($types)?'term-card':''}}">
    <div class="card-header border-bottom">
        <h4 class="card-title">Location Type</h4>
    </div>
    <div class="card-body">
        <div class="form-group row">
            @include('admin.partials.utils.nested_checkbox_list', ['items' => $types, 'name'=> 'location_type'])
        </div> 
    </div>
</div>