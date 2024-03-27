<div class="form-group row">
   

    <div class="col-lg-12">
         <label class="subform-card-label" for="location-as-feature">Coler</label>
         <div class="example">
         <p>Upload feature image for this location</p>
        <input type="text" class="form-control complex-colorpicker" name="color" value="{{$location->color ?? '#000000'}}">
        </div>
    </div>
</div>
<hr>

@include('admin.partials.utils.media', ['name'=> 'logo','label'=>'Feature image','desc'=>"Upload feature image for this location",'value'=>$location->logo ?? '','id' => ""])

<hr>
<!-- Set location as feature -->
{!!radioInputTemplate(['name'=> 'is_featured','label'=>'Set location as feature','desc'=>'ON: Set this location to be featured','item'=>$location ?? '','id' => "",'input' => ["On" => 1,"Off" => 0],'on_off_switch'=>true,'label_class'=>['off-switch','on-switch']])!!}
<hr>
<div class="form-group row">
    
    <div class="col-lg-12">
        <label class="subform-card-label" for="country">Country</label>
        <select class="form-control multi-select" id="country" name="country" data-existed_parent_id="{{$location->country ?? ''}}">
            @isset($countries)
            <option value="">Select Country</option>
            @foreach($countries as $country)
            <option value="{{$country->code}}" {!!get_edit_select_post_types_old_value($country->code, $location->country ?? "",'select')!!} >{{$country->countryname}}</option>
            @endforeach
            @endisset
        </select>

    </div>
</div>
<hr>
<div class="form-group row">
    

    <div class="col-lg-12">
        <label class="subform-card-label" for="location-as-feature">Input zipcode</label>
        <p>This is the zipcode of this location</p>
        <input type="text" class="form-control" name="zipcode" value="{{$location->zipcode ?? ''}}">
        

    </div>
</div>
<hr>
@include('admin.locations.tabs.location', ["location" => $location])
                  


