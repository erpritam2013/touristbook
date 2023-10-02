<div class="card">
    <div class="card-header border-bottom">
        <h4 class="card-title">Publish</h4>
    </div>
    <div class="card-body">
        <div class="form-group row">
            <label class="col-lg-4 col-form-label" for="status">Status</label>
            <div class="col-lg-8 {{setCheckboxActiveInactiveStyle(null,null,null,null, 'chacked','active-inactive')}}">

                <label class="col-form-label {{setCheckboxActiveInactiveStyle('status', $hotel ?? "",'status',1, 'chacked','active')}}">
                    <input type="radio" name="status" value="1" {!!get_edit_select_check_pvr_old_value('status', $hotel ?? "",'status',1, 'chacked')!!}>&nbsp;Active
                </label>
                <label class="col-form-label {{setCheckboxActiveInactiveStyle('status', $hotel ?? "",'status',0, 'chacked','inactive')}}">
                    <input type="radio" name="status" {!!get_edit_select_check_pvr_old_value('status', $hotel ?? "",'status',0, 'chacked')!!} value="0">&nbsp;Inactive
                </label>
            </div>
        </div> 
    </div>
</div>

