<div class="card {{!empty($facilities)?'term-card':''}}">
    <div class="card-header border-bottom">
        <h4 class="card-title">Facilities</h4>
    </div>
    <div class="card-body">
        <div class="form-group row">
            @include('admin.partials.utils.nested_checkbox_list', ['items' => $facilities, 'name'=> 'facilities'])
        </div> 
    </div>
</div>