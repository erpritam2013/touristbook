<div class="card {{(count($term_activity_lists) > 5)?'term-card':'term-card-padding'}}">
    <div class="card-header border-bottom">
        <h4 class="card-title">Term Activity List</h4>
    </div>
    <div class="card-body">
        <div class="form-group row">
            @include('admin.partials.utils.nested_checkbox_list', ['items' => $term_activity_lists, 'name'=> 'term_activity_list', 'selected' => $selected])
        </div>
    </div>
    <div class="card-footer term-footer">
@include('admin.partials.utils.add_term', ['terms' => $term_activity_lists, 'field_name'=> 'term_activity_list', 'term_id'=> 'term_activity_lists', 'term_type'=> '', 'term' => 'TermActivityList','post_type'=>$activity ?? ""])
        </div>
</div>