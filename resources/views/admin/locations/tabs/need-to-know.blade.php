 <div class="form-group row">

    <div class="col-lg-12">
        <label class="subform-card-label" for="get_image">Get To Know banner image
        </label><p>Upload Banner Image For Get To Know</p>

        <div class="input-group mb-3">
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="get_image" name="get_to_know_image" value="{{$location->locationMeta->get_to_know_image ?? ''}}" accept="image/jpeg" data-existed_value="{{$location->locationMeta->get_to_know_image ?? ''}}">
                <label class="custom-file-label">Choose Image</label>
            </div>
            <div class="input-group-append">
                <span class="input-group-text">Upload</span>
            </div>
        </div>
        <img id="show_image" src="{{asset('admin-part\images\t-b-logo.png')}}" alt="your image" width="120" />
    </div>
</div>


<div class="border p-2 mb-2">
    <h4>Get To Know</h4>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $location->locationMeta->get_to_know ?? null, 'type' => 'get_to_know', 'btnTitle' => 'Add New'])
</div>

 <div class="form-group row">

    <div class="col-lg-12">
        <label class="subform-card-label" for="get_image">Save Your Pocket Banner Image
        </label><p>Upload Banner Image For Things to Take Care of</p>

        <div class="input-group mb-3">
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="get_image" name="save_your_pocket_image" value="{{$location->locationMeta->save_your_pocket_image ?? ''}}" accept="image/jpeg" data-existed_value="{{$location->locationMeta->save_your_pocket_image ?? ''}}">
                <label class="custom-file-label">Choose Image</label>
            </div>
            <div class="input-group-append">
                <span class="input-group-text">Upload</span>
            </div>
        </div>
        <img id="show_image" src="{{asset('admin-part\images\t-b-logo.png')}}" alt="your image" width="120" />
    </div>
</div>

<div class="border p-2 mb-2">
    <h4>Save Your Pocket</h4>
    @include('admin.partials.utils.subform-wrapper', ["subformData" => $location->locationMeta->save_your_pocket ?? null, 'type' => 'save_your_pocket', 'btnTitle' => 'Add New'])
</div>

 <div class="form-group row">

    <div class="col-lg-12">
        <label class="subform-card-label" for="get_image">Save The Environment Banner Image
        </label><p>Upload Banner Image For Save The Environment</p>

        <div class="input-group mb-3">
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="get_image" name="save_your_environment_image" value="{{$location->locationMeta->save_your_environment_image ?? ''}}" accept="image/jpeg" data-existed_value="{{$location->locationMeta->save_your_environment_image ?? ''}}">
                <label class="custom-file-label">Choose Image</label>
            </div>
            <div class="input-group-append">
                <span class="input-group-text">Upload</span>
            </div>
        </div>
        <img id="show_image" src="{{asset('admin-part\images\t-b-logo.png')}}" alt="your image" width="120" />
    </div>
</div>
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

