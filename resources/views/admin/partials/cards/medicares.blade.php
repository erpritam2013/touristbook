<div class="card {{!empty($medicares)?'term-card':''}}">
    <div class="card-header border-bottom">
        <h4 class="card-title">Medicare Assistance</h4>
    </div>
    <div class="card-body">
        <div class="form-group row">
        @include('admin.partials.utils.nested_checkbox_list', ['items' => $medicares, 'name'=> 'medicares'])
        </div> 
    </div>
</div>