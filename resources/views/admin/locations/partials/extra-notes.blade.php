<div class="card">
    <div class="card-header border-bottom">
        <h4 class="card-title">Extra Notes</h4>
    </div>

    <div class="card-body">


        <div class="form-group row">
            <div class="col-lg-12">
                <label class="subform-card-label" for="important-note">Activity Important Notes 
                </label>
                <textarea class="form-control" id="important-note" name="important_note" rows="8" placeholder="Enter Important Note..">{{ $location->locationMeta->important_note ?? $important_note}}</textarea>
            </div>
        </div>
        <hr>
        <div class="form-group row">
            <div class="col-lg-12">
                <label class="subform-card-label" for="sanstive-data">Sanstive Data 
                </label>
                <textarea class="form-control ckeditor" id="sanstive-data" name="sanstive_data" rows="8" placeholder="Enter Sanstive Data..">{{ $location->locationMeta->sanstive_data ?? ''}}</textarea>
            </div>
        </div>
        <hr>
        <div class="form-group row">
            <div class="col-lg-12">
                <label class="subform-card-label" for="helpful-facts">Helpful Facts
                </label>
                <textarea class="form-control" id="helpful-facts" name="helpful_facts" rows="8" placeholder="Enter Helpful Facts..">{{ $location->locationMeta->helpful_facts ?? $helpful_facts}}</textarea>
            </div>
        </div>

        

    </div>
</div>