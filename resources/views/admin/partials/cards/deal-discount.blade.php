<div class="card  {{ count($deals) > 5 ? 'term-card' : 'term-card-padding' }}">
    <div class="card-header border-bottom">
        <h4 class="card-title">Deal & Discounts</h4>
        @php
            $items = $deals;
            $name = 'deals';
        @endphp

    </div>
    <div class="card-body">
        <div class="form-group row">
            {{-- @include('admin.partials.utils.nested_checkbox_list', ['items' => $deals, 'name'=> 'deals', 'selected' => $selected]) --}}

            {{-- Star --}}

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
            'terms' => $deals,
            'field_name' => 'deals',
            'term_id' => 'deals',
            'term_type' => 'deals_discount_type',
            'term' => 'DealsDiscount',
            'post_type' => $hotel,
        ])
    </div>
</div>
