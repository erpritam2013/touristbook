<div class="card {{ count($places) > 5 ? 'term-card' : 'term-card-padding' }}">
    <div class="card-header border-bottom">
        <h4 class="card-title">Places</h4>
        @php
            $items = $places;
            $name = 'places';

        @endphp
    </div>
    <div class="card-body">
        <div class="form-group row">
            {{-- @include('admin.partials.utils.nested_checkbox_list', ['items' => $places, 'name'=> 'places', 'selected' => $selected]) --}}

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
        @php $post = "";@endphp
        @isset($hotel)
            @php $post = $hotel;@endphp
        @endisset
        @isset($location)
            @php $post = $location;@endphp
        @endisset
        @isset($tour)
            @php $post = $tour;@endphp
        @endisset
        @isset($activity)
            @php $post = $activity;@endphp
        @endisset
        @include('admin.partials.utils.add_term', [
            'terms' => $places,
            'field_name' => 'places',
            'term_id' => 'places',
            'term_type' => '',
            'term' => 'Place',
            'post_type' => $post ?? '',
        ])
    </div>
</div>
