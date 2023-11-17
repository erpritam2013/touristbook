<div class="mb-left" id="package_types_filter">
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
                        @if($packageType['button'] == 0)
                    <label for="package_{{$key}}" class="custom-control-label">{{$packageType['name']}}</label>
                    @else
                    <label for="package_{{$key}}" class="custom-control-label">
                        <span class="btn btn-default feature-btn">{{$packageType['name']}}</span>

                    </label>
                    <i class="fa fa-exclamation-circle icon-4x important-note-icon-tax" aria-hidden="true" style="color: #07509E;font-size: 23px;position: absolute;top: 7px;left: 215px;"><span class="TravelGo-opt-tooltip min-w-280px-fs-15fpx">{{$packageType['extra_data']['important_note']}}</span></i>
                    @endif
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
