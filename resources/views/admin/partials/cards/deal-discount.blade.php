<div class="card  {{(count($deals) > 5)?'term-card':'term-card-padding'}}">
    <div class="card-header border-bottom">
        <h4 class="card-title">Deal & Discounts</h4>
    </div>
    <div class="card-body">
        <div class="form-group row">
            @include('admin.partials.utils.nested_checkbox_list', ['items' => $deals, 'name'=> 'deals', 'selected' => $selected])
        </div>
    </div>
    <div class="card-footer term-footer">

       @include('admin.partials.utils.add_term', ['terms' => $deals, 'field_name'=> 'deals', 'term_id'=> 'deals', 'term_type'=> 'deals_discount_type', 'term' => 'DealsDiscount','post_type'=>$hotel])
        </div>
</div>
