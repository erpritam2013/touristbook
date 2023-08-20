<div class="card">
    <div class="card-header border-bottom">
        <h4 class="card-title">&nbsp;</h4>
    </div>

    <div class="card-body">

        <div class="form-group row">
            <label class="col-lg-3 col-form-label" for="policies-title">Title</label>
            <div class="col-lg-9">
                <input type="text" class="form-control" id="policies-title" name="policies[0][title]" value="{{$hotel->policies[0]->title ?? ''}}" >
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label" for="policies-description">Description</label>
            <div class="col-lg-9">
                <textarea class="form-control" id="policies-description" name="policies[0][description]" >{{$hotel->policies[0]->description ?? ''}}</textarea>
            </div>
        </div>

    </div>
</div>