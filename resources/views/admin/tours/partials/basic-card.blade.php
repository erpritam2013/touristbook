<div class="card">
    <div class="card-header border-bottom">
        <h4 class="card-title">Basic</h4>
    </div>

    <div class="card-body">

        <div class="form-group row">
            <label class="col-lg-2 col-form-label" for="name">Name
                <span class="text-danger">*</span>
            </label>
            <div class="col-lg-10">
                <input type="text" class="form-control" id="name" name="name" value="{{$tour->name ?? ''}}" placeholder="Enter a name..">

                {!! get_form_error_msg($errors, 'name') !!}
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-2 col-form-label" for="description">Description
            </label>
            <div class="col-lg-10">
                <textarea class="form-control tourist-editor" id="description" name="description" rows="5" placeholder="Enter Description..">{{$tour->description ?? ''}}</textarea>
            </div>
        </div>

        {{--<div class="form-group row">
            <label class="col-lg-2 col-form-label" for="external_link">
                Tour Link
            </label>
            <div class="col-lg-10">
                <input type="text" class="form-control" id="external_link" name="external_link" value="{{$tour->external_link ?? ''}}" >
            </div>
        </div>--}}

    </div>
</div>
