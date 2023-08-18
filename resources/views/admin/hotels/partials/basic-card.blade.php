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
                <input type="text" class="form-control" id="name" name="name" value="{{$hotel->name ?? ''}}" placeholder="Enter a name..">

                {!! get_form_error_msg($errors, 'name') !!}
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-2 col-form-label" for="description">Description 
            </label>
            <div class="col-lg-10">
                <textarea class="form-control" id="description" name="description" rows="5" placeholder="Enter Description..">{{$hotel->description ?? ''}}</textarea>
            </div>
        </div>

    </div>
</div>