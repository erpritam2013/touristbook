<div class="card">
    <div class="card-header border-bottom">
        <h4 class="card-title">Corporate Address</h4>
    </div>

    <div class="card-body">

        <div class="form-group row">
            <label class="col-lg-2 col-form-label" for="corporateAddress">Add Corporate Address</label>
            <div class="col-lg-10">
                <input type="text" class="form-control" id="corporateAddress" name="hotel_attributes[corporateAddress]" value="{{$hotel->hotel_attributes->corporateAddress ?? ''}}" >
            </div>
        </div>

    </div>
</div>
