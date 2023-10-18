<div class="card {{(count($propertyTypes) > 5)?'term-card':'term-card-padding'}}">
    <div class="card-header border-bottom">
        <h4 class="card-title">Property Types</h4>
        @php
            $items = $propertyTypes;
            $name = 'propertyTypes';
        @endphp

    </div>
    <div class="card-body">
        <div class="form-group row">
            {{-- @include('admin.partials.utils.nested_checkbox_list', ['items' => $propertyTypes, 'name'=> 'propertyTypes', 'selected' => $selected]) --}}


             {{-- Start --}}

             <ul class="checkbox-list">
                @foreach ($items as $item)
                    <li>
                        <label class="{{ $item['children'] ? 'parent' : 'child' }}">
                            <input type="checkbox" name="{{ $name }}[]" value="{{ $item['id'] }}"
                                {{ in_array($item['id'], $selected) ? 'checked' : '' }}> {{ $item['name'] }}
                        </label>
                        @if (!empty($item['children']))
                            <div class="indent">
                                {{-- @include('admin.partials.utils.nested_checkbox_list', ['items' => $item['children'], 'name'=> $name, 'selected' => $selected]) --}}
                            </div>
                        @endif
                    </li>
                @endforeach
            </ul>

            {{-- End --}}

        </div>
    </div>
    <div class="card-footer term-footer">

      @include('admin.partials.utils.add_term', ['terms' => $propertyTypes, 'field_name'=> 'propertyTypes', 'term_id'=> 'propertyTypes', 'term_type'=> 'property_type_type', 'term' => 'PropertyType','post_type'=>$hotel ?? ""])
        </div>
</div>
