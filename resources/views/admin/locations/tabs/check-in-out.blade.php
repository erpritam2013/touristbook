<div class="form-group row">
    <label class="col-lg-5 col-form-label" for="location-as-feature">Allowed full day booking<br /><small>
    You can book room with full day<br/>
    Eg: booking from 22 -23, then all days 22 and <br/>
    23 are full, other people cannot book
    </small></label>

    <div class="col-lg-7">
        <label class="col-form-label">
            <input type="radio" name="is_allowed_full_day" value="1" {!!get_edit_select_check_pvr_old_value('is_allowed_full_day', $location ?? "" ,'is_allowed_full_day',1, 'checked' )!!}>&nbsp;On
        </label>
        <label class="col-form-label">
            <input type="radio" name="is_allowed_full_day" {!!get_edit_select_check_pvr_old_value('status', $location ?? "" ,'is_allowed_full_day',0, 'checked' )!!} value="0">&nbsp;Off
        </label>
    </div>
</div>

<div class="form-group row">
    <label class="col-lg-5 col-form-label" for="check_in">Time for check in
        <br /><small>Enter time for check in at location</small>
    </label>
    <div class="col-lg-7">
        <input type="text" class="form-control" id="check_in" name="check_in" />
    </div>
</div>

<div class="form-group row">
    <label class="col-lg-5 col-form-label" for="check_out">Time for check out
        <br /><small>Enter time for checkout at location</small>
    </label>
    <div class="col-lg-7">
        <input type="text" class="form-control" id="check_out" name="check_out" />
    </div>
</div>

