<div class="mb-left">
     <div class="mb-left-title">
  <label for="form_dealdiscount" class="form-label">Deals &amp; Discount</label>
    <i class="fa fa-angle-up" aria-hidden="true"></i>
    </div>
    <div class="form-group">
        @if(!empty($filterDealDiscount))
        <ul class="list-unstyled mb-0">
            @foreach($filterDealDiscount as $key=>$deal)
            <li class="{{ $key > 2 ? 'li-hide' : '' }}">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" id="dealdiscount_{{$key}}" name="deals[]"
                        class="custom-control-input filter-option filter-deal" value="{{$deal['id']}}">
                    <label for="dealdiscount_{{$key}}" class="custom-control-label">{!!$deal['name']!!}</label>
                </div>
            </li>
            @endforeach
        </ul>
        @if($filterDealDiscount->count() > 3)
        <a href="javascript:void(0)" class="more-li">More <i class="fa fa-caret-down"></i></a>
        @endif
        @endif


    </div>

</div>
