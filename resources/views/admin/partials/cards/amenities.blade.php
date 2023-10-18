<div class="card {{ count($amenities) > 5 ? 'term-card' : 'term-card-padding' }}">
    <div class="card-header border-bottom">
        <h4 class="card-title">Amenities</h4>
        @php
            $items = $amenities;
            $name = 'amenities';

        @endphp
    </div>
    <div class="card-body">
        <div class="form-group row">
            {{-- @include('admin.partials.utils.nested_checkbox_list', [
                'items' => $amenities,
                'name' => 'amenities',
                'selected' => $selected,
            ]) --}}

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

            <style>
                .parent {
                    font-weight: bold;
                }

                .child {
                    font-weight: normal;
                }

                .indent {
                    margin-left: 20px;
                    /* Adjust as needed for indentation */
                }
            </style>

            {{-- End --}}
        </div>
    </div>
    <div class="card-footer term-footer">
        @include('admin.partials.utils.add_term', [
            'terms' => $amenities,
            'field_name' => 'amenities',
            'term_id' => 'amenity',
            'term_type' => 'amenity_type',
            'term' => 'Amenity',
            'post_type' => $hotel,
        ])
    </div>
</div>
