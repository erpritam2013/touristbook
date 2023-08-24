<div class="card">
    <div class="card-header border-bottom">
        <h4 class="card-title">Activities</h4>
    </div>
    <div class="card-body">
        <div class="form-group row">
            @include('admin.partials.utils.nested_checkbox_list', ['items' => $activities, 'name'=> 'activities'])
        </div> 
    </div>
</div>