<div class="card">
    <div class="card-header border-bottom">
        <h4 class="card-title">Occupancy</h4>
    </div>
    <div class="card-body">
        <div class="form-group row">
            @include('admin.partials.utils.nested_checkbox_list', ['items' => $occupancies, 'name'=> 'occupancies'])
        </div> 
    </div>
</div>