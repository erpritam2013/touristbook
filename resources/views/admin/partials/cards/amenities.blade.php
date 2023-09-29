<div class="card {{(count($amenities) > 5)?'term-card':'term-card-padding'}}">
    <div class="card-header border-bottom">
        <h4 class="card-title">Amenities</h4>
    </div>
    <div class="card-body">
        <div class="form-group row">
            @include('admin.partials.utils.nested_checkbox_list', ['items' => $amenities, 'name'=> 'amenities', 'selected' => $selected])
        </div>
    </div>
    <div class="card-footer term-footer">
   @include('admin.partials.utils.add_term', ['terms' => $amenities, 'field_name'=> 'amenities', 'term_id'=> 'amenity', 'term_type'=> 'amenity_type', 'term' => 'Amenity','post_type'=>$hotel])
        </div>
</div>
