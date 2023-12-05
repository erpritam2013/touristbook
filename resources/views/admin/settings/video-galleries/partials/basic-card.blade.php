<div class="card">
    <div class="card-header border-bottom">
        <h4 class="card-title">Basic</h4>
    </div>

    <div class="card-body">

        <div class="form-group row">
            <label class="col-lg-3 col-form-label" for="vg-name">Name
                <span class="text-danger">*</span>
            </label>
            <div class="col-lg-9">
                <input type="text" class="form-control" id="vg-name" name="name" value="{{$video_gallery->name ?? ''}}" placeholder="Enter a name..">

                {!! get_form_error_msg($errors, 'name') !!}
            </div>
        </div>

        <!-- Location -->
        {!!selectBoxTemplate(['items' => $locations, 'name'=> 'location_id','selected'=>$video_gallery->location_id ?? "",'label'=>'Location','col'=>'col-lg-3','id'=>'vg-location-id','col_s' => 'col-lg-9'])!!}

        
        {{--<div class="form-group row">
            <label class="col-lg-3 col-form-label" for="description">Description
            </label>
            <div class="col-lg-9">
                <textarea class="form-control tourist-editor" id="description" name="description" rows="5" placeholder="Enter Description..">{{$post->description ?? ''}}</textarea>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-3 col-form-label" for="external_link">
                post Link
            </label>
            <div class="col-lg-9">
                <input type="text" class="form-control" id="external_link" name="external_link" value="{{$post->external_link ?? ''}}" >
            </div>
        </div>--}}

    </div>
</div>
