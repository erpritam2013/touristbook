@if(!isset($control))
<div class="form-group row">
@php  
if(empty($id)){
   $id = $name;
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
    <div class="row">
        <div class="col-sm-9">
            <input type="range" min="{{$min ?? 0}}" max="{{$max ?? 5}}" step="{{$step ?? 0.1}}" class="form-control {{$class ?? ''}}" id="{{$id}}" name="{{$name}}" value="{{$value ?? ''}}" onchange="rangeValue(this)" oninput="{{$id}}_range_input_show.value=value">
        </div>
        <div class="col-lg-3">

      <input type="number" class="form-control " readonly="" id="{{$id}}_range_input_show" oninput="{{$id}}.value=value" value="{{$value ?? 0}}">
        </div>
        
    </div>

      
   
</div> 
</div>
@endif