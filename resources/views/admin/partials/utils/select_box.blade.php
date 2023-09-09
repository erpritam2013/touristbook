 @if(!empty($items))
 <div class="col-lg-12">
    <select class="form-control multi-select" id="{{$name}}" name="{{$name}}" >
        @foreach($items as $item)
            <option value="{{$item->id}}" {!!get_edit_select_post_types_old_value($item->id, $selected ?? "",'select')!!} >{{$item->name}}</option>
        @endforeach

    </select>
</div>
@endif
