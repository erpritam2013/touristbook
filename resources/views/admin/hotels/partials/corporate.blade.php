<ul id="sortable">
    <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 1</li>
    <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 2</li>
    <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 3</li>
    <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 4</li>
    <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 5</li>
    <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 6</li>
    <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 7</li>
  </ul>


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
