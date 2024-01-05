<div class="mb-left">
     <div class="mb-left-title">
    <label for="form_amenities_types" class="form-label">Amenities</label>
    <i class="fa fa-angle-up" aria-hidden="true"></i>
    </div>
    <div class="form-group">
        @if(!empty($filterAmenities))
        <ul class="list-unstyled mb-0">
            @foreach($filterAmenities as $key=>$amenity)
            <li class="{{ $key > 2 ? 'li-hide' : '' }}">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" id="amenities_{{$key}}" name="amenities[]"
                        class="custom-control-input filter-option filter-amenities" value="{{$amenity['id']}}">
                    <label for="amenities_{{$key}}" class="custom-control-label">{!!$amenity['name']!!}</label>
                </div>
            </li>
            @endforeach
        </ul>
        @if($filterAmenities->count() > 3)
        <a href="javascript:void(0)" class="more-li">More <i class="fa fa-caret-down"></i></a>
        @endif
        @endif


    </div>

</div>
