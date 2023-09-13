 @if(!empty($items))
 <div class="col-lg-12">
    <select class="form-control multi-select" id="{{$name}}" name="{{$name}}" >
        <option value="">--Select--</option>
        @foreach($items as $item)

            <option value="{{$item->id}}" {{ in_array($item->id, $selected) ? 'selected' : ''  }} >{{$item->name}}</option>
        @endforeach

    </select>
</div>
@endif
