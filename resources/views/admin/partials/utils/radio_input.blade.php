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

        @if(!empty($input) && is_array($input))
        @isset($on_off_switch)
        <div class="on-off-switch">
            @endisset


            @foreach($input as $input_key => $input_value)
          
            @if(isset($item->{$name}))
            @if($item->{$name} == $input_value)
            @php $set_label_class = $label_class[$input_value].'-checked'; @endphp
            @else
            @php $set_label_class = $label_class[$input_value]; @endphp
            @endif
            @else
            @if($input_value == 0)
               @php $set_label_class = $label_class[$input_value].'-checked'; @endphp
               @else
                @php $set_label_class = $label_class[$input_value]; @endphp
            @endif
            @endif
            <label class="col-form-label {{$set_label_class ?? ''}}">
                <input type="radio" name="{{$name}}" value="{{$input_value}}" {!!get_edit_select_check_pvr_old_value($name, $item ?? "" ,$name,$input_value, 'checked' )!!} id="{{$name}}-{{$input_value}}" class="{{$class ?? ''}}">&nbsp;{{$input_key}}
            </label>
            @endforeach

            @isset($on_off_switch)
        </div>
        @endisset
        @endif


    </div> 
</div>