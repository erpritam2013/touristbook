 <!-- Get To Know banner image -->
@include('admin.partials.utils.media', ['name'=> 'get_to_know_image','label'=>'Get To Know banner image','desc'=>"Upload Banner Image For Get To Know",'value'=>$location->locationMeta->get_to_know_image ?? '','id' => ""])


<div class="border p-2 mb-2">
    <h4>Get To Know</h4>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $location->locationMeta->get_to_know ?? null, 'type' => 'get_to_know', 'btnTitle' => 'Add New'])
</div>

<!-- Save Your Pocket Banner Image -->
@include('admin.partials.utils.media', ['name'=> 'save_your_pocket_image','label'=>'Save Your Pocket Banner Image','desc'=>"Upload Banner Image For Things to Take Care of",'value'=>$location->locationMeta->save_your_pocket_image ?? '','id' => ""])


<div class="border p-2 mb-2">
    <h4>Save Your Pocket</h4>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $location->locationMeta->save_your_pocket ?? null, 'type' => 'save_your_pocket', 'btnTitle' => 'Add New'])
</div>
<!-- Save The Environment Banner Image -->
@include('admin.partials.utils.media', ['name'=> 'save_your_environment_image','label'=>'Save The Environment Banner Image','desc'=>"Upload Banner Image For Save The Environment",'value'=>$location->locationMeta->save_your_environment_image ?? '','id' => ""])

<div class="border p-2 mb-2">
    <h4>Save The Environment</h4>
    <p>Save The Environment</p>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $location->locationMeta->save_your_environment ?? null, 'type' => 'save_your_environment', 'btnTitle' => 'Add New'])
</div>

<div class="border p-2 mb-2">
    <h4>FAQ's</h4>
    <p>FAQ's</p>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $location->locationMeta->faqs ?? null, 'type' => 'faqs', 'btnTitle' => 'Add New'])
</div>

