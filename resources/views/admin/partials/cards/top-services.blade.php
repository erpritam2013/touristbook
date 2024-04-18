<div class="card {{ count($topServices) > 5 ? 'term-card' : 'term-card-padding' }}">
    <div class="card-header border-bottom">
        <h4 class="card-title">Top Services</h4>
        @php
            $items = $topServices;
            $name = 'topServices';

        @endphp
    </div>
    <div class="card-body">
        <div class="form-group row">
            {{-- @include('admin.partials.utils.nested_checkbox_list', ['items' => $topServices, 'name'=> 'topServices', 'selected' => $selected]) --}}


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
            'terms' => $topServices,
            'field_name' => 'topServices',
            'term_id' => 'top-services',
            'term_type' => 'top_service_type',
            'term' => 'TopService',
            'post_type' => $hotel ?? '',
        ])
    </div>
</div>
