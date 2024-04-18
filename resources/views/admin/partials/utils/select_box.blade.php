<div class="form-group row {{$parent_class ?? ''}}">
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
    <select class="form-control single-select-placeholder-touristbook {{$class ?? ''}}" id="{{$id}}" name="{{$name}}" {{$multiple}} {!!$attr ?? ""!!} selected_value="{{(empty($items) && !is_array($selected))?$selected:''}}">
        @if(!isset($first_empty_option))
        @if(isset($label) && !empty($label))
        <option value="" {!!$option_attr ?? ''!!}>Select {{$first_option_text ?? ucwords($label)}}</option>
        @else
        <option value="" {!!$option_attr ?? ''!!}>--Select--</option>
        @endif
        @endif
        @if(!empty($items))
        @foreach($items as $item)
        @if(is_array($selected))
        <option value="{{$item->id}}" {{ in_array($item->id, $selected) ? 'selected' : ''  }} {!!$option_attr ?? ''!!}>{!!$item->value!!}</option>
        @else
        <option value="{{$item->id}}" {{ ($item->id == $selected) ? 'selected' : ''  }} {!!$option_attr ?? ''!!}>{!!$item->value!!}</option>
        @endif
        @endforeach
        @endif

    </select>

    @isset($required)
        {!! get_form_error_msg($errors, $name) !!}
    @endisset
</div>
</div>



