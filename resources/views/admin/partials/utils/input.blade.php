<div class="form-group row {{$hidden_class ?? ''}}">
@php  
if(empty($id)){
   $id = (isset($name))? str_replace('[]', '',str_replace('_', '-', $name)):$name;
} 
@endphp
@if(!isset($col))
   <div class="col-lg-12">
   @if(isset($label) && !empty($label))
   <label class="subform-card-label" for="{{$id}}">{{$label}}
   @if(isset($required) && $required)
   <span class="text-danger">*</span>
   @endif
   </label>
    @if(isset($desc) && !empty($desc))
  <p>{{$desc}}</p>
  @endif
   @endif
   @else
   @if(isset($label) && !empty($label))
   <label class="col-lg-2 col-form-label" for="{{$id}}">{{$label}}
   @if(isset($required) && $required)
   <span class="text-danger">*</span>
   @endif
   </label>
   @endif
   <div class="col-lg-10">
    @endif
    <input type="{{$control ?? 'text'}}" class="form-control {{$class ?? ''}}" id="{{$id}}" name="{{$name}}" value="{{$value ?? ''}}" placeholder="Enter a {{$label}}..">
   
</div> 
</div>