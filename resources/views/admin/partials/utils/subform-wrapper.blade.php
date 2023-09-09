<ul class="list-{{$type}} list-types"  index="{{(!empty($subformData) && !is_null($subformData) && is_array($subformData)) ? count($subformData) - 1 : -1}}">
    @if(is_array($subformData) && !empty($subformData))
        @foreach($subformData as $key => $typeData)
            @include('admin.partials.utils.subform', ['typeData'=> $typeData, 'type'=> $type, 'typeFields' => Config::get('subform.'.$type.'.fields'), 'key'=> $key ])
        @endforeach
    @endif

</ul>
<p>You can re-order with drag & drop, the order will update after saving.</p>
<a href="javascript:void(0);" class="btn btn-primary btn-add-subform" subform-type="{{$type}}" target-selector=".list-{{$type}}" >{{$btnTitle}}</a>
