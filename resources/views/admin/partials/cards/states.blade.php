<div class="card">
    <div class="card-header border-bottom">
        <h4 class="card-title">States</h4>
    </div>
    <div class="card-body">
        <div class="form-group row">
            @include('admin.partials.utils.nested_checkbox_list', ['items' => $states, 'name'=> 'states'])
        </div> 
    </div>
</div>