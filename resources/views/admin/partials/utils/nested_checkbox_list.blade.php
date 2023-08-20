<ul class="checkbox-list">
    @foreach ($items as $item)
        <li>
            <label class="{{ $item['children'] ? 'parent' : 'child' }}">
                <input type="checkbox" name="{{$name}}[]" value="{{ $item['id'] }}"> {{ $item['name'] }}
            </label>
            @if (!empty($item['children']))
                <div class="indent">
                    @include('admin.partials.utils.nested_checkbox_list', ['items' => $item['children'], 'name'=> $name])
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
    margin-left: 20px; /* Adjust as needed for indentation */
}
</style>