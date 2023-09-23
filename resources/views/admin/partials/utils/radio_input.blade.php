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
  @else
  <br>
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

    @if(!empty($input) && is_array($input))

         @foreach($input as $input_key => $input_value)
         <label class="col-form-label">
            <input type="radio" name="{{$name}}" value="{{$input_value}}" {!!get_edit_select_check_pvr_old_value($name, $item ?? "" ,'is_featured',(int)$input_key, 'checked' )!!} id="{{$name}}-{{$input_value}}">&nbsp;{{$input_key}}
        </label>
        @endforeach

    @endif
   
</div> 
</div>