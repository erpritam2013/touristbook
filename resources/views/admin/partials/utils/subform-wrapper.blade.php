<ul class="list-{{$type}} list-types"  index="{{$subformData ? count($subformData) - 1 : -1}}">
    @if($subformData)
        @foreach($subformData as $key => $typeData)
            @include('admin.partials.utils.subform', ['typeData'=> $typeData, 'type'=> $type, 'typeFields' => Config::get('subform.'.$type.'.fields') ])
        @endforeach
    @endif
</div>
<p>You can re-order with drag & drop, the order will update after saving.</p>
</ul>
<a href="javascript:void(0);" class="btn btn-primary btn-add-subform" subform-type="{{$type}}" target-selector=".list-{{$type}}" >{{$btnTitle}}</a>
