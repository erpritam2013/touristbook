<div class="card {{(count($topServices) > 5)?'term-card':'term-card-padding'}}">
    <div class="card-header border-bottom">
        <h4 class="card-title">Top Services</h4>
    </div>
    <div class="card-body">
        <div class="form-group row">
            @include('admin.partials.utils.nested_checkbox_list', ['items' => $topServices, 'name'=> 'topServices', 'selected' => $selected])
        </div>
    </div>
    <div class="card-footer term-footer">
       @include('admin.partials.utils.add_term', ['terms' => $topServices, 'field_name'=> 'topServices', 'term_id'=> 'top-services', 'term_type'=> 'top_service_type', 'term' => 'TopService','post_type'=>$hotel ?? ""])
        </div>
</div>
