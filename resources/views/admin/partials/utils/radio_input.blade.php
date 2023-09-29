<div class="form-group row">
@php  
if(empty($id)){
   $id = (isset($name))? str_replace('[]', '',str_replace('_', '-', $name)):$name;
} 
$set_label_class = "";
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
  <p>{!!$desc!!}</p>
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
    @isset($on_off_switch)
    <div class="on-off-switch">
    @endisset
    @if(!empty($input) && is_array($input))

        @foreach($input as $input_key => $input_value)
        @isset($label_class)
        @if(isset($item->is_featured) && $item->is_featured == $input_value)
        @php 
         $set_label_class = $label_class[$input_value].'-checked';
        @endphp
        @else
        @if($input_value == 0)
        @php 
         $set_label_class = $label_class[$input_value].'-checked';
        @endphp
        @else
         @php 
         $set_label_class = $label_class[$input_value];
        @endphp
        @endif
        @php 
        @endphp
        @endif
        @endisset
       
         <label class="col-form-label {{$set_label_class}}">
            <input type="radio" name="{{$name}}" value="{{$input_value}}" {!!get_edit_select_check_pvr_old_value($name, $item ?? "" ,'is_featured',(int)$input_key, 'checked' )!!} id="{{$name}}-{{$input_value}}">&nbsp;{{$input_key}}
        </label>
        @endforeach

    @endif

     @isset($on_off_switch)
    </div>
    @endisset
   
</div> 
</div>