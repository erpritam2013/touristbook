
<ul class="list-{{ $type }} list-types"
index="{{ !empty($subformData) && !is_null($subformData) && is_array($subformData) ? count($subformData) - 1 : -1 }}">

@php
$typeFields = Config::get('subform.' . $type . '.fields');
@endphp

@if (is_array($subformData) && !empty($subformData))
@foreach ($subformData as $key => $typeData)
{{-- @include('admin.partials.utils.subform', ['typeData'=> $typeData, 'type'=> $type, 'typeFields' => Config::get('subform.'.$type.'.fields'), 'key'=> $key ]) --}}

{{-- Start --}}

@if (!empty($typeData))
@php
$first_element = reset($typeData);
@endphp
<li class="subform-card">
  <div class="card">
    <div class="card-header border-bottom">
      <h4 class="card-title">
        <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
        <span class="card-title-text">{!!$typeData[$type.'-title'] ?? strip_tags(shortDescription($first_element,50))!!}</span>
        {{--<span class="card-title-text">{!! strip_tags(shortDescription($first_element,50)) !!}</span>--}}
      </h4>
      <div class="float-left">
        <a href="javascript:void(0);" class="edit-card"><i class="fa fa-edit"></i></a>
        <a href="javascript:void(0);" class="delete-card"><i class="fa fa-times-circle"></i></a>
      </div>
    </div>

    <div class="card-body" style="display: none;">

      @foreach ($typeData as $controlId => $value)
      @if (isset($typeFields[$controlId]))
      @php
      $elemClass = isset($typeFields[$controlId]['class']) ? $typeFields[$controlId]['class'] : '';
      $desc = isset($typeFields[$controlId]['desc']) ? $typeFields[$controlId]['desc'] : '';
      $rows = isset($typeFields[$controlId]['rows']) ? $typeFields[$controlId]['rows'] : 8;
      $cols = isset($typeFields[$controlId]['cols']) ? $typeFields[$controlId]['cols'] : '';
      @endphp
      @php
      $hideClass = isset($typeFields[$controlId]['hide']) ? $typeFields[$controlId]['hide'] : '';
      if (!empty($value)) {
        $hideClass = '';
      }
      @endphp
      <div class="form-group row {{ $hideClass }}">
        <div class="col-lg-12">
          <label
          class="subform-card-label">{{ $typeFields[$controlId]['label'] }}</label>
          @if (!empty($desc))
          <p>{{ $desc }}</p>
          @endif
          @if ($typeFields[$controlId]['control'] == 'text')
          <input type="text" class="form-control {{ $elemClass }} "
          name="{{ $type }}[{{ $key }}][{{ $controlId }}]"
          value="{{ $value ?? '' }}"
          id="{{ $type . '-tsign-' . $key . '-tsign-' . $controlId }}"
          placeholder="Enter {{ $typeFields[$controlId]['label'] }}...">
          @elseif($typeFields[$controlId]['control'] == 'url')
          <input type="url" class="form-control {{ $elemClass }} "
          name="{{ $type }}[{{ $key }}][{{ $controlId }}]"
          value="{{ $value ?? '' }}"
          id="{{ $type . '-tsign-' . $key . '-tsign-' . $controlId }}"
          placeholder="Enter {{ $typeFields[$controlId]['label'] }}...">
          @elseif($typeFields[$controlId]['control'] == 'textarea')
          <textarea class="form-control {{ $elemClass }} "
          name="{{ $type }}[{{ $key }}][{{ $controlId }}]"
          id="{{ $type . '-tsign-' . $key . '-tsign-' . $controlId }}"
          placeholder="Enter {{ $typeFields[$controlId]['label'] }}..." rows="{{$rows ?? 8}}" cols="{{$cols ?? ''}}">{{ $value ?? '' }}</textarea>
          @elseif($typeFields[$controlId]['control'] == 'media')
          <div class="media-controls ">
            <input type="hidden" class="form-control media-input {{ $elemClass ?? '' }} gallery-input " name="{{ $type }}[{{ $key }}][{{ $controlId }}]"
            value="{{ $value }}" />
            @php
            $parsedValue = !empty($value)?json_decode($value, true):'';
            @endphp

            <input type="url"
            class="form-control media-txt-only {{ $elemClass }}" readonly="true"
            value="@if(is_array($parsedValue) && isset($parsedValue[0]) && isset($parsedValue[0]['url'])  ){{$parsedValue[0]['url']}}@endif"
            id="{{ $type . '-tsign-' . $key . '-tsign-' . $controlId }}"
            placeholder="Enter {{ $typeFields[$controlId]['label'] }}..." />

            <button type="button" class="btn btn-primary mt-2 add-media-btn"
            smode="single" selectedImages="{{ $value ?? '' }}">+</button>
            <button type="button"
            class="btn btn-danger mt-2 remove-media-btn">-</button>
            <div class="media-preview">

             @if(is_array($parsedValue) && isset($parsedValue[0]) && isset($parsedValue[0]['url']) )
             <img src="{{$parsedValue[0]['url']}}"  class="img" height="100" width="100" />
             @endif
           </div>
         </div>

         @elseif($typeFields[$controlId]['control'] == 'gallery')
         <div class="gallery-controls">
          <input type="hidden" class="form-control gallery-input {{ $elemClass ?? '' }}" name="{{ $type }}[{{ $key }}][{{ $controlId }}]"
          value="{{ json_encode($value) ?? json_encode([]) }}" id="{{ $type . '-tsign-' . $key . '-tsign-' . $controlId }}" placeholder="Enter {{ $typeFields[$controlId]['label'] }}..." />

          <button type="button" class="btn btn-primary mt-2 add-gallery-btn" smode="{{ $smode ?? 'single' }}"
          selectedImages="{{ json_encode($value) ?? json_encode([]) }}">+</button>
          <div class="media-preview">
            @if($value)
            <div class="row">
              @foreach($value as $image)
              <div class="col-xl-3">
                <img src="{{$image['url']}}" class="img" height="100" width="100" id="image-path-{{$image['id']}}" />
              </div>
              @endforeach
            </div>
            @endif
          </div>
        </div>
        @elseif($typeFields[$controlId]['control'] == 'number')
        <input type="number" class="form-control {{ $elemClass }} "
        name="{{ $type }}[{{ $key }}][{{ $controlId }}]"
        value="{{ $value ?? '' }}"
        id="{{ $type . '-tsign-' . $key . '-tsign-' . $controlId }}"
        placeholder="Enter {{ $typeFields[$controlId]['label'] }}...">
        @elseif($typeFields[$controlId]['control'] == 'select')
        @php
        $elemOptions = isset($typeFields[$controlId]['options']) ? $typeFields[$controlId]['options'] : [];
        @endphp
        @if (is_array($elemOptions) && !empty($elemOptions))
        <select class="form-control {{ $elemClass }} "
        id="{{ $type . '-tsign-' . $key . '-tsign-' . $controlId }}"
        name="{{ $type }}[{{ $key }}][{{ $controlId }}]"
        placeholder="Enter {{ $typeFields[$controlId]['label'] }}...">
        <option value="">--Select--</option>
        @foreach ($elemOptions as $option)
        @php
        $selected = '';
        if (is_array($value)) {
          if (in_array($option['id'], $value)) {
            $selected = 'selected';
          }
        } else {
          if ($option['id'] == $value) {
            $selected = 'selected';
          }
        }
        @endphp
        <option value="{{ $option['id'] }}" {{ $selected }}>
        {{ $option['value'] }}</option>
        @endforeach

      </select>
      @endif
      @endif
    </div>
  </div>
  @endif
  @endforeach
</div>
</div>
</li>
@endif

{{-- End --}}
@endforeach
@endif

</ul>
<p>You can re-order with drag & drop, the order will update after saving.</p>
<div id="preloader_card_{{$type}}" class="preloader-card" style="display: none; z-index: 0;">
  <div class="sk-three-bounce">
    <div class="sk-child sk-bounce1"></div>
    <div class="sk-child sk-bounce2"></div>
    <div class="sk-child sk-bounce3"></div>
  </div>
</div>
<a href="javascript:void(0);" class="btn btn-primary btn-add-subform" subform-type="{{ $type }}"
target-selector=".list-{{ $type }}">{{ $btnTitle }}</a>
