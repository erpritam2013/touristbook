<!-- tourism zone title -->
@include('admin.partials.utils.input', ['name'=> 'sub_title','label'=>'tourism Zone Title','value'=>$tourism_zone->sub_title ?? '','id' => ""])
<!-- tourism zone banner image -->
@include('admin.partials.utils.media', ['name'=> 'image','label'=>'tourism Zone Banner Image','desc'=>"Upload Banner Image For tourism Zone",'value'=>$tourism_zone->image ?? '','id' => ""])
 <!-- tourism zone description -->
@include('admin.partials.utils.textarea', ['name'=> 'tourism_zone_description','label'=>'Description','value'=>$tourism_zone->tourism_zone_description ?? '','id' => "tourism-zone-disc",'class' => "ckeditor"])
 <!-- tourism zone section -->
<div class="border p-2 mb-2">
    <h4>tourism Zone Section</h4>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $tourism_zone->tourism_zone ?? [], 'type' => 'tourism_zone', 'btnTitle' => 'Add New'])
</div>