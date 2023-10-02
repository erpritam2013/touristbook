<div class="mb-left">
     <div class="mb-left-title">
     <label for="form_meeting" class="form-label">Meetings and Events</label>
    <i class="fa fa-angle-up" aria-hidden="true"></i>
    </div>
    <div class="form-group">
        @if(!empty($filterMeetingEvents))
        <ul class="list-unstyled mb-0">
            @foreach($filterMeetingEvents as $key=>$meeting)
            <li class="{{ $key > 2 ? 'li-hide' : '' }}">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" id="meeting_{{$key}}" name="meetings[]"
                        class="custom-control-input filter-option filter-meeting" value="{{$meeting['id']}}">
                    <label for="meeting_{{$key}}" class="custom-control-label">{{$meeting['name']}}</label>
                </div>
            </li>
            @endforeach
        </ul>
        @if($filterMeetingEvents->count() > 3)
        <a href="javascript:void(0)" class="more-li">More <i class="fa fa-caret-down"></i></a>
        @endif
        @endif


    </div>

</div>
