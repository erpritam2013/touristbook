<div class="mb-left">
     <div class="mb-left-title">
   <label for="form_package_types" class="form-label">Package Type</label>
    <i class="fa fa-angle-up" aria-hidden="true"></i>
    </div>
    <div class="form-group">
        @if(!empty($filterpackageTypes))
        <ul class="list-unstyled mb-0">
            @foreach($filterpackageTypes as $key => $packageType)
            <li class="{{ $key > 2 ? 'li-hide' : '' }}">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" id="package_{{$key}}" name="package_types[]"
                        class="custom-control-input filter-option filter-package-types" value="{{$packageType['id']}}">
                    <label for="package_{{$key}}" class="custom-control-label">{{$packageType['name']}}</label>
                </div>
            </li>
            @endforeach
        </ul>
        @if($filterpackageTypes->count() > 3)
        <a href="javascript:void(0)" class="more-li">More <i class="fa fa-caret-down"></i></a>
        @endif
        @endif


    </div>

</div>
