<div class="card">
    <div class="card-header border-bottom">
        <h4 class="card-title">Basic</h4>
    </div>

    <div class="card-body">

        <div class="form-group row">
            <label class="col-lg-2 col-form-label" for="title">Title
                <span class="text-danger">*</span>
            </label>
            <div class="col-lg-10">
                <input type="text" class="form-control" id="title" name="title" value="{{$activity_list->title ?? ''}}" placeholder="Enter a title..">

                {!! get_form_error_msg($errors, 'title') !!}
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-2 col-form-label" for="description">Description 
            </label>
            <div class="col-lg-10">
                <textarea class="form-control ckeditor" id="description" name="description" rows="5" placeholder="Enter Description..">{{$activity_list->description ?? ''}}</textarea>
            </div>
        </div>
        {{--<div class="form-group row">
            <label class="col-lg-2 col-form-label" for="external_link">
                activity_list Link
            </label>
            <div class="col-lg-10">
                <input type="text" class="form-control" id="external_link" name="external_link" value="{{$activity_list->external_link ?? ''}}" >
            </div>
        </div>--}}

    </div>
</div>