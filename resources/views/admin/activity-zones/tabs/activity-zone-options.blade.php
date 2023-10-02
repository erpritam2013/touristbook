<!-- Activity zone title -->
@include('admin.partials.utils.input', ['name'=> 'sub_title','label'=>'Activity Zone Title','value'=>$activity_zone->sub_title ?? '','id' => ""])
<!-- country -->
@include('admin.partials.utils.select_box', ['items' => $countries, 'name'=> 'country','selected'=>$activity_zone->country ?? "",'label'=>'Country'])
<!-- activity zone banner image -->
@include('admin.partials.utils.media', ['name'=> 'image','label'=>'Activity Zone Banner Image','desc'=>"Upload Banner Image For Activity Zone",'value'=>$activity_zone->image ?? '','id' => ""])
 <!-- activity zone description -->
@include('admin.partials.utils.textarea', ['name'=> 'activity_zone_description','label'=>'Description','value'=>$activity_zone->activity_zone_description ?? '','id' => "activity-zone-disc",'class' => "ckeditor"])
 <!-- activity zone section -->
<div class="border p-2 mb-2">
    <h4>Activity Zone Section</h4>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $activity_zone->activity_zone_section ?? null, 'type' => 'activity_zone_section', 'btnTitle' => 'Add New'])
</div>