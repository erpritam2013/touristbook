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
                <input type="hidden" class="form-control media-input {{ $class ?? '' }} gallery-input " name="{{ $name ?? '' }}"
                value="{{ $value ? json_encode($value) : '' }}" />

                {{--
                @if(is_array($value))
                @dd($value)
                @endif --}}

                <input type="text" class="form-control media-txt-only" readonly="true"  id="{{ $id ?? '' }}" placeholder="Enter {{ $label ?? '' }}..." value="@if(is_array($value) && isset($value[0]) && isset($value[0]['url'])  ){{$value[0]['url']}}@endif"   />

                <button type="button" class="btn btn-primary mt-2 add-media-btn" smode="{{ $smode ?? 'single' }}"
                selectedImages="{{ is_array($value) ? json_encode($value) : '' }}">+</button>
                <button type="button" class="btn btn-danger mt-2 remove-media-btn">-</button>
                <div class="media-preview">

                    @if(is_array($value) && isset($value[0]) && isset($value[0]['url']))
                    <img src="{{$value[0]['url']}}"  class="img" height="100" width="100" />
                    @endif

                </div>
            </div>
        </div>
    </div>


