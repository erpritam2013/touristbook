<div class="mb-left">
     <div class="mb-left-title">
   <label for="form__types" class="form-label">{{$post_type ?? ''}} Type</label>
    <i class="fa fa-angle-up" aria-hidden="true"></i>
    </div>
    <div class="form-group">
        @if(!empty($filterTypes))
        <ul class="list-unstyled mb-0">
            @foreach($filterTypes as $key=>$type)
            <li class="{{ $key > 2 ? 'li-hide' : '' }}">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" id="_{{$key}}" name="types[]"
                        class="custom-control-input filter-option filter--types" value="{{$type['id']}}">
                    <label for="_{{$key}}" class="custom-control-label">{!!$type['name']!!}</label>
                </div>
            </li>
            @endforeach
        </ul>
        @if($filterTypes->count() > 3)
        <a href="javascript:void(0)" class="more-li">More <i class="fa fa-caret-down"></i></a>
        @endif
        @endif


    </div>

</div>
