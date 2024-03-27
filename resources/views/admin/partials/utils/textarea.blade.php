<div class="form-group row">
   @php  
if(empty($id)){
   $id = (isset($name))? str_replace('[]', '',str_replace('_', '-', $name)):$name;
} 
@endphp
@if(!isset($col))
<div class="col-lg-12">
  @if(isset($label) && !empty($label))
  <label class="subform-card-label" for="{{$id}}">{{$label}}</label>
  @endif
  @else
  @if(isset($label) && !empty($label))
  <label class="col-lg-2 col-form-label" for="{{$id}}">{{$label}}</label>
  @endif
  <div class="col-lg-10">
     @endif
     <textarea class="form-control {{$class ?? ''}}" id="{{$id}}" name="{{$name}}" rows="{{$rows ?? 8}}" placeholder="Enter {{$label}}..">{!!$value ?? ''!!}</textarea>

  </div>
</div>
