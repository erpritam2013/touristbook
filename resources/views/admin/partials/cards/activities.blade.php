<div class="card {{(count($activities) > 5)?'term-card':'term-card-padding'}}">
    <div class="card-header border-bottom">
        <h4 class="card-title">Activities</h4>
    </div>
    <div class="card-body">
        <div class="form-group row">
            @include('admin.partials.utils.nested_checkbox_list', ['items' => $activities, 'name'=> 'activitiescard', 'selected' => $selected])
        </div>
    </div>
    <div class="card-footer term-footer">

@include('admin.partials.utils.add_term', ['terms' => $activities, 'field_name'=> 'activitiescard', 'term_id'=> 'activity', 'term_type'=> 'term_activity_type', 'term' => 'TermActivity','post_type'=>$hotel])
    
        </div>
</div>
