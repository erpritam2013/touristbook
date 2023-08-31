<div class="form-group row">
    <label class="col-lg-5 col-form-label" for="location-as-feature">Set location as feature<br /><small>ON: Set this location to be featured</small></label>

    <div class="col-lg-7">
        <label class="col-form-label">
            <input type="radio" name="is_featured" value="1" {!!get_edit_select_check_pvr_old_value('is_featured', $location ?? "" ,'is_featured',1, 'checked' )!!}>&nbsp;On
        </label>
        <label class="col-form-label">
            <input type="radio" name="is_featured" {!!get_edit_select_check_pvr_old_value('status', $location ?? "" ,'is_featured',0, 'checked' )!!} value="0">&nbsp;Off
        </label>
    </div>
</div>

<div class="form-group row">
    <label class="col-lg-5 col-form-label" for="location_video">location video
        <br /><small>Enter YouTube/Vimeo URL here</small>
    </label>
    <div class="col-lg-7">
        <input type="text" class="form-control" id="location_video" name="location_video" value="{{$location->location_video ?? ''}}">
    </div>
</div>

<div class="form-group row">
    <label class="col-lg-5 col-form-label" for="rating">location rating standard </label>
    <div class="col-lg-7">
        <input type="range" min="0" max="5" step="0.1" class="form-control" id="rating" name="rating" value="{{$location->rating ?? ''}}">
    </div>
</div>

<div class="form-group row">
    <label class="col-lg-5 col-form-label" for="coupon_code">Coupon Code
    </label>
    <div class="col-lg-7">
        <input type="text" class="form-control" id="coupon_code" name="coupon_code" value="{{$location->coupon_code ?? ''}}">
    </div>
</div>


