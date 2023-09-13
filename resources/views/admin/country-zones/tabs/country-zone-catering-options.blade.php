 <div class="form-group row">
    <div class="col-lg-12">
        <label class="subform-card-label" for="country-zone-section-title">Title
        </label>
        <input type="text" class="form-control" id="country-zone-section-title" name="country_zone_catering[title]" rows="8" placeholder="Enter Title.." value="{{$country_zone->country_zone_catering['title'] ?? ''}}">

    </div>
</div> 
 <div class="form-group row">

    <div class="col-lg-12">
        <label class="subform-card-label" for="country-zone-section-url">Custom Country Zone Catering URL
        </label>
        <p>please enter URL Like This (http://example.com or https://example.com)</p>
        <input type="url" class="form-control" id="country-zone-section-url" name="country_zone_catering[url]" rows="8" placeholder="Enter Url.." value="{{$country_zone->country_zone_catering['url'] ?? ''}}">

    </div>
</div> 


