<div class="card {{ count($occupancies) > 5 ? 'term-card' : 'term-card-padding' }}">
    <div class="card-header border-bottom">
        <h4 class="card-title">Occupancy</h4>
        @php
            $items = $occupancies;
            $name = 'occupancies';
        @endphp
    </div>
    <div class="card-body">
        <div class="form-group row">
            {{-- @include('admin.partials.utils.nested_checkbox_list', ['items' => $occupancies, 'name'=> 'occupancies', 'selected' => $selected]) --}}

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
        @include('admin.partials.utils.add_term', [
            'terms' => $occupancies,
            'field_name' => 'occupancies',
            'term_id' => 'occupancies',
            'term_type' => 'occupancy_type',
            'term' => 'Occupancy',
            'post_type' => $hotel,
        ])
    </div>
</div>
