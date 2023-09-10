<div class="card  {{(count($deals) > 5)?'term-card':'term-card-padding'}}">
    <div class="card-header border-bottom">
        <h4 class="card-title">Deal & Discounts</h4>
    </div>
    <div class="card-body">
        <div class="form-group row">
            @include('admin.partials.utils.nested_checkbox_list', ['items' => $deals, 'name'=> 'deals', 'selected' => $selected])
        </div>
    </div>
</div>
