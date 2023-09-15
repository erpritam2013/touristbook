   {{--<div class="form-group row">

    <div class="col-lg-12">
        <label class="subform-card-label" for="loctaion-video">Video
    </label>
        <select class="form-control" id="loctaion-video" name="location_video" >
            @if(!empty($location_videos))
            <option value="">Select Video</option>
            @foreach($location_videos as $video)
            <option value="{{$video->title}}" {!!get_edit_select_post_video->titles_old_value($video,$location->locationMeta->location_video ?? "",'select')!!}>{{$video->title}}</option>
            @endforeach
            @endif
        </select>

    </div>
</div>--}}
