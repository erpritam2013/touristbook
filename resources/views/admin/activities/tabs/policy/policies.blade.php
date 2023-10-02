<div class="list-policies" index="{{$activity ? count($activity->policies) : 0}}">
    @if($activity && $activity->policies)
        @foreach($activity->policies as $key => $policy)
            @include('admin.partials.utils.subform', ['typeData'=> $policy, 'type'=> 'policy', 'typeLabels' => Config::get('subform.policy.labels') ])
        @endforeach
    @endif

</div>
<a href="javascript:void(0);" class="btn btn-primary btn-add-subform" subform-type="policy" target-selector=".list-policies" >Add Policy</a>