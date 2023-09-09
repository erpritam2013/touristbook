<div class="card">
    <div class="card-header border-bottom">
        <h4 class="card-title">Food Dining</h4>
    </div>

    <div class="card-body">

        <div class="form-group row">
            <label class="col-lg-2 col-form-label" for="food-dining">Food Dining</label>
            <div class="col-lg-10">
                <textarea class="form-control tourist-editor" id="food-dining" name="food_dining" rows="5" placeholder="Food Dining..">{{$hotel->food_dining ?? ''}}</textarea>
            </div>
        </div>

    </div>
</div>
