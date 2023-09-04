<div class="form-group row">

    <div class="col-lg-12">
        <label class="subform-card-label" for="packages">Packages
    </label>
        <select class="form-control" id="packages" name="packages" >

            @if(!empty($stays))
            <option value="">Select Package</option>
            @foreach($stays as $stay)
            <option value="{{$stay}}" {!!get_edit_select_post_types_old_value($stay,$location->locationMeta->packages ?? "",'select')!!}>{{$stay}}</option>
            @endforeach
            @endif
        </select>

    </div>
</div>