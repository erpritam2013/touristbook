@php $id = (isset($name))? str_replace('[]', '',str_replace('_', '-', $name)):$name;@endphp
@if(!isset($col))
<div class="col-lg-12">
   @if(isset($lebal) && !empty($lebal))
   <label class="subform-card-label" for="{{$id}}">Activity</label>
   @endif
   @else
   @if(isset($lebal) && !empty($lebal))
   <label class="col-lg-2 col-form-label" for="{{$id}}">Activity</label>
   @endif
   <div class="col-lg-10">
    @endif
    
    
    <select class="form-control multi-select" id="{{$id}}" name="{{$name}}" >
        @if(isset($lebal) && !empty($lebal))
        <option value="">Select {{ucwords($lebal)}}</option>
        @else
        <option value="">--Select--</option>
        @endif
        @if(!empty($items))
        @foreach($items as $item)
        @if(is_array($selected))
        <option value="{{$item->id}}" {{ in_array($item->id, $selected) ? 'selected' : ''  }} >{{$item->name}}</option>
        @else
        <option value="{{$item->id}}" {{ ($item->id == $selected) ? 'selected' : ''  }} >{{$item->name}}</option>
        @endif
        @endforeach
        @endif

    </select>
</div>

