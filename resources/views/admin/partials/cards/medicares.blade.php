<div class="card {{(count($medicares) > 5)?'term-card':'term-card-padding'}}">
    <div class="card-header border-bottom">
        <h4 class="card-title">Medicare Assistance</h4>
    </div>
    <div class="card-body">
        <div class="form-group row">
        @include('admin.partials.utils.nested_checkbox_list', ['items' => $medicares, 'name'=> 'medicares', 'selected' => $selected])
        </div>
    </div>
</div>
