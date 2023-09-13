<div class="form-group row">

    <div class="col-lg-12">
        <label class="subform-card-label" for="stay">Stay
    </label>
        <select class="form-control" id="stay" name="stay" >

            @if(!empty($stays))
            <option value="">Select Stay</option>
            @foreach($stays as $stay)
            <option value="{{$stay}}" {!!get_edit_select_post_types_old_value($stay,$location->locationMeta->stay ?? "",'select')!!}>{{$stay}}</option>
            @endforeach
            @endif
        </select>

    </div>
</div>