<div class="card">
    <div class="card-header border-bottom">
        <h4 class="card-title">Activity Packages Section</h4>
    </div>
    <div class="card-body">
       <div class="form-group row">
           
            <div class="col-lg-12">
                 <label class="col-form-label" for="duration">Duration
            </label>
                <input type="text" class="form-control" id="duration" name="duration" value="{{$activity_package->duration ?? ''}}" placeholder="Enter a Duration..">

                
            </div>
        </div>


       <div class="form-group row">
           
            <div class="col-lg-12">
                 <label class="col-form-label" for="price">Price
            </label>
                <input type="number" class="form-control" id="price" name="price" value="{{$activity_package->price ?? ''}}" placeholder="Enter a Price..">

                
            </div>
        </div>
<div class="form-group row">
            <div class="col-lg-12">
            <label class="col-form-label" for="amenities">Amenities 
            </label>
                <textarea class="form-control" id="amenities" name="description" rows="8" placeholder="Enter Amenities..">{{$activity_package->amenities ?? ''}}</textarea>
            </div>
        </div>


    </div>
</div>