<div class="form-group row">
    @php
    if (empty($id)) {
        $id = isset($name) ? str_replace('[]', '', str_replace('_', '-', $name)) : $name;
    }
    @endphp
    @if (!isset($col))
    <div class="col-lg-12">
        @if (isset($label) && !empty($label))
        <label class="subform-card-label" for="{{ $id }}">{{ $label }}</label>
        @if (isset($desc) && !empty($desc))
        <p>{{ $desc }}</p>
        @endif
        @endif
        @else
        @if (isset($label) && !empty($label))
        <label class="col-lg-2 col-form-label" for="{{ $id }}">{{ $label }}</label>
        @endif
        <div class="col-lg-10">
            @endif
            <div class="media-controls">
               
                <input type="{{(!isset($smode))?'text':'hidden'}}" class="form-control media-input {{ $class ?? '' }}" name="{{ $name ?? '' }}"
                value="{{ $value ?? '' }}" id="{{ $id ?? '' }}" placeholder="Enter {{ $label ?? '' }}..." />
            

                <button type="button" class="btn btn-primary mt-2 add-media-btn" smode="{{ $smode ?? 'single' }}"
                selectedImages="{{ $value ?? '' }}">+</button>
                <button type="button" class="btn btn-danger mt-2 remove-media-btn">-</button>
                <div class="media-preview">

                   @php
                   $imgSrc = $value ?? ''
                   @endphp
                   <img src="{{$imgSrc}}" class="img" height="150" width="auto" />

               </div>
           </div>



       </div>
   </div>


