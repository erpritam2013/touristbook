<div class="form-group row">
    <label class="col-lg-5 col-form-label" for="hotel-as-feature">Set hotel as feature<br /><small>ON: Set this hotel to be featured</small></label>

    <div class="col-lg-7">
        <label class="col-form-label">
            <input type="radio" name="is_featured_hotel" value="1" {!!get_edit_select_check_pvr_old_value('is_featured_hotel', $hotel ?? "" ,'is_featured_hotel',1, 'checked' )!!}>&nbsp;On
        </label>
        <label class="col-form-label">
            <input type="radio" name="is_featured_hotel" {!!get_edit_select_check_pvr_old_value('status', $hotel ?? "" ,'is_featured_hotel',0, 'checked' )!!} value="0">&nbsp;Off
        </label>
    </div>
</div>

<div class="form-group row">
    <label class="col-lg-5 col-form-label" for="hotel_video">Hotel video
        <br /><small>Enter YouTube/Vimeo URL here</small>
    </label>
    <div class="col-lg-7">
        <input type="text" class="form-control" id="hotel_video" name="hotel_video" value="{{$hotel->hotel_video ?? ''}}">
    </div>
</div>

<div class="form-group row">
    <label class="col-lg-5 col-form-label" for="rating">Hotel rating standard </label>
    <div class="col-lg-7">
        <input type="range" min="0" max="5" step="0.1" class="form-control" id="rating" name="rating" value="{{$hotel->rating ?? ''}}">
    </div>
</div>

<div class="form-group row">
    <label class="col-lg-5 col-form-label" for="coupon_code">Coupon Code
    </label>
    <div class="col-lg-7">
        <input type="text" class="form-control" id="coupon_code" name="coupon_code" value="{{$hotel->coupon_code ?? ''}}">
    </div>
</div>