<div class="card {{(count($medicares) > 5)?'term-card':'term-card-padding'}}">
    <div class="card-header border-bottom">
        <h4 class="card-title">Medicare Assistance</h4>
        @php
            $items = $medicares;
            $name = 'medicares';

        @endphp
    </div>
    <div class="card-body">
        <div class="form-group row">
        {{-- @include('admin.partials.utils.nested_checkbox_list', ['items' => $medicares, 'name'=> 'medicares', 'selected' => $selected]) --}}

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

         @include('admin.partials.utils.add_term', ['terms' => $medicares, 'field_name'=> 'medicares', 'term_id'=> 'medicares', 'term_type'=> 'medicare_assistance_type', 'term' => 'MedicareAssistance','post_type'=>$hotel])
        </div>
</div>
