@if(!isset($control))
<div class="form-group row">
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
    <div class="row">
        <div class="col-sm-8">
            <input type="range" min="{{$min ?? 0}}" max="{{$max ?? 5}}" step="{{$step ?? 0.1}}" class="form-control {{$class ?? ''}}" id="{{$id}}" name="{{$name}}" value="{{$value ?? ''}}" onchange="rangeValue(this)">
        </div>
        <div class="col-lg-4">

      <input type="number" class="form-control " value="0" readonly="" id="show_range_input">
        </div>
        
    </div>

      
   
</div> 
</div>
@endif