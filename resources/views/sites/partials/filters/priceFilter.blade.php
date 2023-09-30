<div class="mb-left">
    <label for="form_prices" class="form-label">Filter Price</label>
    <div class="form-group">
        @if(!empty($filterPriceRanges))
        <ul class="list-unstyled mb-0">
            @foreach($filterPriceRanges as $key=>$priceRange)
            <li>
                <div class="custom-control custom-checkbox">
                    <input type="radio" id="price_{{$key}}" name="price"
                        class="custom-control-input" value="{{$priceRange['value']}}">
                    <label for="price_{{$key}}" class="custom-control-label">{{$priceRange['label']}}</label>
                </div>
            </li>
            @endforeach
        </ul>
        @endif

        <a href="javascript:void(0)" class="btn btn-outline-dark button btn-filter-price">Apply</a>

    </div>

</div>
