<div class="mb-left">
    <div class="mb-left-title">
    <label for="form_prices" class="form-label">Filter Price</label>
     <i class="fa fa-angle-up" aria-hidden="true"></i>
    </div>
    <div class="form-group">
        @if(!empty($filtertourPriceRanges))
        <ul class="list-unstyled mb-0 price-filter">
            @foreach($filtertourPriceRanges as $key=>$priceRange)
            <li>
                <div class="custom-control custom-checkbox">
                    <input type="radio" id="price_{{$key}}" name="price"
                        class="custom-control-input" value="{{$priceRange['value']}}">
                    <label for="price_{{$key}}" class="custom-control-label">{!!$priceRange['label']!!}</label>
                </div>
            </li>
            @endforeach
        </ul>
        @endif

        <a href="javascript:void(0)" class="btn btn-sm btn-grad text-white mb-0 btn-filter-price">Apply</a>

    </div>

</div>
