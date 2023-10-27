<div class="form-group row">
    <label class="col-lg-5 col-form-label" for="contact_info">Contact Info
        <br /><small>Use contact info of people who upload hotel || Use contact info in hotel details</small>
    </label>
    <div class="col-lg-7">
        <select class="form-control form-select" id="contact_info" name="contact[info]">
            <option value="agent" {{(isset($hotel->contact['info']) && $hotel->contact['info'] == 'agent') ?'selected':''}}>Use Agent Contact Info</option>
            <option value="item" {{(isset($hotel->contact['info']) && $hotel->contact['info']) == 'item'?'selected':''}}>Use Item Info</option>
        </select>
    </div>
</div>

<div class="form-group row">
    <label class="col-lg-5 col-form-label" for="contact_email">Hotel Email
        <br /><small>This email will received notification when have booking order</small>
    </label>
    <div class="col-lg-7">
        <input type="text" class="form-control" id="contact_email" name="contact[email]" value="{{$hotel->contact['email'] ?? ''}}" />
    </div>
</div>

<div class="form-group row">
    <label class="col-lg-5 col-form-label" for="contact_website">Hotel Website
        <br /><small>Enter hotel website</small>
    </label>
    <div class="col-lg-7">
        <input type="text" class="form-control" id="contact_website" name="contact[website]" value="{{$hotel->contact['website'] ?? ''}}" />
    </div>
</div>

<div class="form-group row">
    <label class="col-lg-5 col-form-label" for="contact_phone">Hotel phone number
        <br /><small>Enter hotel phone number</small>
    </label>
    <div class="col-lg-7">
        <input type="text" class="form-control" id="contact_phone" name="contact[phone]" value="{{$hotel->contact['phone'] ?? ''}}"/>
    </div>
</div>

<div class="form-group row">
    <label class="col-lg-5 col-form-label" for="contact_fax">Hotel Fax
        <br /><small>Enter hotel fax number</small>
    </label>
    <div class="col-lg-7">
        <input type="text" class="form-control" id="contact_fax" name="contact[fax]" value="{{$hotel->contact['fax'] ?? ''}}"/>
    </div>
</div>


