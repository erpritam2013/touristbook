<div class="list-policies" index="{{$tour ? count($tour->policies) : 0}}">
    @if($tour && $tour->policies)
        @foreach($tour->policies as $key => $policy)
            @include('admin.partials.utils.subform', ['typeData'=> $policy, 'type'=> 'policy', 'typeLabels' => Config::get('subform.policy.labels') ])
        @endforeach
    @endif

</div>
<a href="javascript:void(0);" class="btn btn-primary btn-add-subform" subform-type="policy" target-selector=".list-policies" >Add Policy</a>