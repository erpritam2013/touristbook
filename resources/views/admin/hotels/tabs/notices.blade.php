<div class="card">
    <div class="card-header border-bottom">
        <h4 class="card-title">&nbsp;</h4>
    </div>

    <div class="card-body">

        <div class="form-group row">
            <label class="col-lg-3 col-form-label" for="notices-title">Title</label>
            <div class="col-lg-9">
                <input type="text" class="form-control" id="notices-title" name="notices[0][title]" value="{{$hotel->notices[0]->title ?? ''}}" >
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label" for="notices-description">Description</label>
            <div class="col-lg-9">
                <textarea class="form-control" id="notices-description" name="notices[0][description]" >{{$hotel->policies[0]->description ?? ''}}</textarea>
            </div>
        </div>

    </div>
</div>