<div class="mb-left">
     <div class="mb-left-title">
   <label for="form_property_types" class="form-label">Property Type</label>
    <i class="fa fa-angle-up" aria-hidden="true"></i>
    </div>
    <div class="form-group">
        @if(!empty($filterPropertyTypes))
        <ul class="list-unstyled mb-0">
            @foreach($filterPropertyTypes as $key=>$propertyType)
            <li class="{{ $key > 2 ? 'li-hide' : '' }}">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" id="property_{{$key}}" name="propertyTypes[]"
                        class="custom-control-input filter-option filter-property-types" value="{{$propertyType['id']}}">
                    <label for="property_{{$key}}" class="custom-control-label">{!!$propertyType['name']!!}</label>
                </div>
            </li>
            @endforeach
        </ul>
        @if($filterPropertyTypes->count() > 3)
        <a href="javascript:void(0)" class="more-li">More <i class="fa fa-caret-down"></i></a>
        @endif
        @endif


    </div>

</div>
