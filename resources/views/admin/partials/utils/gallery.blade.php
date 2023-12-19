<div class="form-group row">
    @php
        if (empty($id)) {
            $id = isset($name) ? str_replace('[]', '', str_replace('_', '-', $name)) : $name;
        }
    @endphp
    @if (!isset($col))
        <div class="col-lg-12">
            @if (isset($label) && !empty($label))
                <label for="{{ $id }}" class="subform-card-label">{{ $label }}</label>
                @if (isset($desc) && !empty($desc))
                    <p>{{ $desc }}</p>
                @endif
            @endif
        @else
            @if (isset($label) && !empty($label))
                <label class="col-lg-2 col-form-label subform-card-label" for="{{ $id }}">{{ $label }}</label>
            @endif
            <div class="col-lg-10">
    @endif
    <div class="gallery-controls">
        <input type="hidden" class="form-control gallery-input {{ $class ?? '' }}" name="{{ $name ?? '' }}"
            value="{{ json_encode($value) ?? json_encode([]) }}" id="{{ $id ?? '' }}" placeholder="Enter {{ $label ?? '' }}..." />

        <button type="button" class="btn btn-primary mt-2 add-gallery-btn" smode="{{ $smode ?? 'single' }}"
            selectedImages="{{ json_encode($value) ?? json_encode([]) }}">+</button>
        <div class="media-preview">
         
            @if(!empty($value) && isset($value) && is_array($value))
                <div class="row">

                @foreach($value as $image)
                <div class="col-xl-3">
                    @if(is_array($image))
                    
                    <img src="{{$image['url'] ?? ''}}" class="img" height="100" width="100" id="image-path-{{$image['id']}}" />
                    @endif
                </div>
                @endforeach
                </div>
            @endif
        </div>
    </div>



</div>
</div>
