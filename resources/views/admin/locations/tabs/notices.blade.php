<div class="card">
    <div class="card-header border-bottom">
        <h4 class="card-title">&nbsp;</h4>
    </div>

    <div class="card-body">

        <div class="form-group row">
            <div class="col-lg-12">
           <label class="subform-card-label" for="notices-title">Title</label>
                <input type="text" class="form-control" id="notices-title" name="notices[0][title]" value="{{$location->notices[0]->title ?? ''}}" >
            </div>
        </div>

        <div class="form-group row">
            <div class="col-lg-12">
           <label class="subform-card-label" for="notices-description">Description</label>
                <textarea class="form-control" id="notices-description" name="notices[0][description]" >{{$location->policies[0]->description ?? ''}}</textarea>
            </div>
        </div>

    </div>
</div>