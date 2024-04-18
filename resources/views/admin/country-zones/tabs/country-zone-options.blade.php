<!-- Country Zone Title -->
@include('admin.partials.utils.input', ['name'=> 'sub_title','label'=>'Country Zone Title','value'=>$country_zone->sub_title ?? '','id' => ""])
<!-- country -->
@include('admin.partials.utils.select_box', ['items' => $countries, 'name'=> 'country','selected'=>$country_zone->country ?? "",'label'=>'Country'])
<!-- Country Zone Icon -->
{!!mediaTemplate(['name'=> 'icon','label'=>'Country Zone Icon','desc'=>"Upload Icon Image For Country Zone",'value'=>$country_zone->icon ?? '','id' => ""])!!}
<!-- Country Zone Banner Image -->
{!!mediaTemplate(['name'=> 'image','label'=>'Country Zone Banner Image','desc'=>"Upload Banner Image For Country Zone",'value'=>$country_zone->image ?? '','id' => ""])!!}

 <div class="form-group row">

    <div class="col-lg-12">
        <label class="subform-card-label" for="country-zone-disc">Description
        </label>
        <textarea class="form-control ckeditor" id="country-zone-dis" name="country_zone_description" rows="8" placeholder="Enter Description..">{!!$country_zone->country_zone_description ?? ''!!}</textarea>


    </div>
</div> 
<div class="border p-2 mb-2">
    <h4>Country Zone Section</h4>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $country_zone->country_zone_section ?? null, 'type' => 'country_zone_section', 'btnTitle' => 'Add New'])
</div>