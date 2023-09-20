<div class="form-group row">
    @php 
    if(isset($multiple) && !empty($multiple)){
      $multiple = 'multiple="multiple"';
    }else{
      $multiple = "";
    }
if(empty($id)){
   $id = (isset($name))? str_replace('[]', '',str_replace('_', '-', $name)):$name;
} 
@endphp
@if(!isset($col))
<div class="col-lg-12">
 @if(isset($label) && !empty($label))
 <label class="subform-card-label" for="{{$id}}">{{$label}}</label>
  @if(isset($desc) && !empty($desc))
  <p>{{$desc}}</p>
  @endif
 @endif
 @else
 @if(isset($label) && !empty($label))
 <label class="col-lg-2 col-form-label" for="{{$id}}">{{$label}}</label>
  @if(isset($desc) && !empty($desc))
  <p>{{$desc}}</p>
  @endif
 @endif
 <div class="col-lg-10">
    @endif
    <select class="form-control single-select-placeholder-touristbook {{$class ?? ''}}" id="{{$id}}" name="{{$name}}" {{$multiple}}>
        @if(isset($label) && !empty($label))
        <option value="">Select {{ucwords($label)}}</option>
        @else
        <option value="">--Select--</option>
        @endif
        @if(!empty($items))
        @foreach($items as $item)
        @if(is_array($selected))
        <option value="{{$item->id}}" {{ in_array($item->id, $selected) ? 'selected' : ''  }} >{{$item->value}}</option>
        @else
        <option value="{{$item->id}}" {{ ($item->id == $selected) ? 'selected' : ''  }} >{{$item->value}}</option>
        @endif
        @endforeach
        @endif

    </select>
</div>
</div>

