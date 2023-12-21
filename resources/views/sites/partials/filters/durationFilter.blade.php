<div class="mb-left">
    <div class="mb-left-title">
    <label for="form_duration" class="form-label">Duration</label>
     <i class="fa fa-angle-up" aria-hidden="true"></i>
    </div>
    <div class="form-group">
        @if(!empty($filterDuration))
        <ul class="list-unstyled mb-0 duration-filter">
            @foreach($filterDuration as $key => $duration)
            <li>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" id="duration_day_{{$key}}" name="duration_day"
                        class="custom-control-input filter-option filter-duration" value="{{$duration['value']}}">
                    <label for="duration_day_{{$key}}" class="custom-control-label">{{$duration['label']}}</label>
                </div>
            </li>
            @endforeach
        </ul>
        @endif
    </div>

</div>
