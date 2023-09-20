<div class="card">
    <div class="card-header border-bottom">
        <h4 class="card-title">Publish</h4>
    </div>
    <div class="card-body">
        <div class="form-group row">
            <label class="col-lg-4 col-form-label" for="status">Status</label>
            <div class="col-lg-8">

                <label class="col-form-label">
                    <input type="radio" name="status" value="1" {!!get_edit_select_check_pvr_old_value('status', $activity ?? "",'status',1, 'chacked')!!}>&nbsp;Active
                </label>
                <label class="col-form-label">
                    <input type="radio" name="status" {!!get_edit_select_check_pvr_old_value('status', $activity ?? "",'status',0, 'chacked')!!} value="0">&nbsp;Inactive
                </label>
            </div>
        </div> 
    </div>
</div>