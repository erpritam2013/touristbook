<div class="card  {{(count($deals) > 10)?'term-card':''}}">
    <div class="card-header border-bottom">
        <h4 class="card-title">Deal & Discounts</h4>
    </div>
    <div class="card-body">
        <div class="form-group row">
            @include('admin.partials.utils.nested_checkbox_list', ['items' => $deals, 'name'=> 'deals'])
        </div> 
    </div>
</div>