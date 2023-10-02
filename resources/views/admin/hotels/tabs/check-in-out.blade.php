<!-- Allowed full day booking -->
@include('admin.partials.utils.radio_input', ['name'=> 'is_allowed_full_day','label'=>'Allowed full day booking','desc'=>'You can book room with full day<br/>
    Eg: booking from 22 -23, then all days 22 and <br/>
    23 are full, other people cannot book','item'=>$hotel ?? '','id' => "",'input' => ["On" => 1,"Off" => 0],'on_off_switch'=>true,'label_class'=>['off-switch','on-switch']])



<div class="form-group row">
    <label class="col-lg-5 col-form-label" for="check_in">Time for check in
        <br /><small>Enter time for check in at hotel</small>
    </label>
    <div class="col-lg-7">
        <input type="text" class="form-control" id="check_in" name="check_in" />
    </div>
</div>

<div class="form-group row">
    <label class="col-lg-5 col-form-label" for="check_out">Time for check out
        <br /><small>Enter time for checkout at hotel</small>
    </label>
    <div class="col-lg-7">
        <input type="text" class="form-control" id="check_out" name="check_out" />
    </div>
</div>

