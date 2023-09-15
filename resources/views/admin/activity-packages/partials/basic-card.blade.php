<div class="card">
    <div class="card-header border-bottom">
        <h4 class="card-title">Basic</h4>
    </div>

    <div class="card-body">
         @include('admin.partials.utils.input', ['name'=> 'title','label'=>'Title','value'=>$activity_package->title ?? '','id' => "",'required' => true,'col'=>true])

         @include('admin.partials.utils.textarea', ['name'=> 'description','label'=>'Description','value'=>$activity_package->description ?? '','id' => "",'col'=>true,'class'=>'ckeditor'])
        
        {{--<div class="form-group row">
            <label class="col-lg-2 col-form-label" for="external_link">
                activity_package Link
            </label>
            <div class="col-lg-10">
                <input type="text" class="form-control" id="external_link" name="external_link" value="{{$activity_package->external_link ?? ''}}" >
            </div>
        </div>--}}

    </div>
</div>