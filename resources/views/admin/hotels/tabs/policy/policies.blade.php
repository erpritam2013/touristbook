<div class="list-policies" index="{{$hotel ? count($hotel->policies) : 0}}">
    @if($hotel && $hotel->policies)
        @foreach($hotel->policies as $key => $policy)
            @include('admin.partials.utils.subform', ['typeData'=> $policy, 'type'=> 'policy', 'typeLabels' => Config::get('subform.policy.labels') ])
        @endforeach
    @endif

</div>
<a href="javascript:void(0);" class="btn btn-primary btn-add-subform" subform-type="policy" target-selector=".list-policies" >Add Policy</a>