<div class="card {{!empty($places)?'term-card':''}}">
    <div class="card-header border-bottom">
        <h4 class="card-title">Places</h4>
    </div>
    <div class="card-body">
        <div class="form-group row">
            @include('admin.partials.utils.nested_checkbox_list', ['items' => $places, 'name'=> 'places'])
        </div> 
    </div>
</div>