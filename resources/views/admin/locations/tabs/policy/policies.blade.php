<div class="list-policies">
    @if($hotel && $hotel->policies)
        @foreach($hotel->policies as $key => $policy)
            @include('admin.hotels.tabs.policy.policy', ['i'=> $key, 'policy'=> $policy ])
        @endforeach
    @endif

</div>
<a href="javascript:void(0);" class="btn btn-primary">Add Policy</a>