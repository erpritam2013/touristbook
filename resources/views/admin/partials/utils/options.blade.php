@foreach($items as $item)
<option value="{{$item['id']}}">{{$item['name']}}</option>

@if(!empty($item['children']))
@include('admin.partials.utils.options', ['items' => $item['children']])
@endif
@endforeach