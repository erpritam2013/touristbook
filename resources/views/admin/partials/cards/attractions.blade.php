<div class="card {{(count($attractions) > 5)?'term-card':'term-card-padding'}}">
    <div class="card-header border-bottom">
        <h4 class="card-title">Attraction</h4>
    </div>
    <div class="card-body">
        <div class="form-group row">
            @include('admin.partials.utils.nested_checkbox_list', ['items' => $attractions, 'name'=> 'attraction', 'selected' => $selected])
        </div>
    </div>
</div>