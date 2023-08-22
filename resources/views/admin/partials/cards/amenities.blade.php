<div class="card">
    <div class="card-header border-bottom">
        <h4 class="card-title">Amenities</h4>
    </div>
    <div class="card-body">
        <div class="form-group row">
            @include('admin.partials.utils.nested_checkbox_list', ['items' => $amenities, 'name'=> 'amenities'])
        </div> 
    </div>
</div>