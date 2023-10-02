<div class="mb-left">
     <div class="mb-left-title">
   <label for="form_medicares" class="form-label">Medicare Assistance</label>
    <i class="fa fa-angle-up" aria-hidden="true"></i>
    </div>
    <div class="form-group">
        @if(!empty($filterMedicare))
        <ul class="list-unstyled mb-0">
            @foreach($filterMedicare as $key=>$medicare)
            <li class="{{ $key > 2 ? 'li-hide' : '' }}">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" id="medicare_{{$key}}" name="medicares[]"
                        class="custom-control-input filter-option filter-medicare" value="{{$medicare['id']}}">
                    <label for="medicare_{{$key}}" class="custom-control-label">{{$medicare['name']}}</label>
                </div>
            </li>
            @endforeach
        </ul>
        @if($filterMedicare->count() > 3)
        <a href="javascript:void(0)" class="more-li">More <i class="fa fa-caret-down"></i></a>
        @endif
        @endif


    </div>

</div>
