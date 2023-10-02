<div class="card {{(count($facilities) > 5)?'term-card':'term-card-padding'}}">
    <div class="card-header border-bottom">
        <h4 class="card-title">Facilities</h4>
    </div>
    <div class="card-body">
        <div class="form-group row">
            @include('admin.partials.utils.nested_checkbox_list', ['items' => $facilities, 'name'=> 'facilities', 'selected' => $selected])
        </div>
    </div>
    <div class="card-footer term-footer">

       @include('admin.partials.utils.add_term', ['terms' => $facilities, 'field_name'=> 'facilities', 'term_id'=> 'facilities', 'term_type'=> 'facility_type', 'term' => 'Facility','post_type'=>$hotel])
        </div>
</div>
