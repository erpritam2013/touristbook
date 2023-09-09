<div class="card {{(count($topServices) > 5)?'term-card':'term-card-padding'}}">
    <div class="card-header border-bottom">
        <h4 class="card-title">Top Services</h4>
    </div>
    <div class="card-body">
        <div class="form-group row">
            @include('admin.partials.utils.nested_checkbox_list', ['items' => $topServices, 'name'=> 'topServices', 'selected' => $selected])
        </div>
    </div>
</div>
