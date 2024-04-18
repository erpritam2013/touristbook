<div class="mb-left">
    <div class="mb-left-title">
    <label for="form_activity" class="form-label">Activities</label>
    <i class="fa fa-angle-up" aria-hidden="true"></i>
    </div>
    <div class="form-group">
        @if(!empty($filterTermActivity))
        <ul class="list-unstyled mb-0">
            @foreach($filterTermActivity as $key=>$activity)
            <li class="{{ $key > 2 ? 'li-hide' : '' }}">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" id="activity_{{$key}}" name="activites[]"
                        class="custom-control-input filter-option filter-activities" value="{{$activity['id']}}">
                    <label for="activity_{{$key}}" class="custom-control-label">{!!$activity['name']!!}</label>
                </div>
            </li>
            @endforeach
        </ul>
        @if($filterTermActivity->count() > 3)
        <a href="javascript:void(0)" class="more-li">More <i class="fa fa-caret-down"></i></a>
        @endif
        @endif


    </div>

</div>
