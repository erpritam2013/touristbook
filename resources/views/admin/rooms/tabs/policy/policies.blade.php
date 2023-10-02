<div class="list-policies" index="{{$room ? count($room->policies) : 0}}">
    @if($room && $room->policies)
        @foreach($room->policies as $key => $policy)
            @include('admin.partials.utils.subform', ['typeData'=> $policy, 'type'=> 'policy', 'typeLabels' => Config::get('subform.policy.labels') ])
        @endforeach
    @endif

</div>
<a href="javascript:void(0);" class="btn btn-primary btn-add-subform" subform-type="policy" target-selector=".list-policies" >Add Policy</a>