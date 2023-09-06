<div class="card {{!empty($accessibles)?'term-card':''}}">
    <div class="card-header border-bottom">
        <h4 class="card-title">Accessible</h4>
    </div>
    <div class="card-body">
        <div class="form-group row">
            @include('admin.partials.utils.nested_checkbox_list', ['items' => $accessibles, 'name'=> 'accessibles'])
        </div> 
    </div>
</div>