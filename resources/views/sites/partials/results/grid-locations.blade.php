<div class="row location-grid-view">
    @if ($locations->isNotEmpty())
    @foreach ($locations as $key => $location)
    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 mb-4">
        <div class="card shadow border-0 h-100 grid-list-item">
            {!!is_featured($location->is_featured)!!}
            @php $featured_image = (!empty($location->featured_image) && isset($location->featured_image[0]['id']))?getConversionUrl($location->featured_image[0]['id'],'270x200'):null;@endphp
            <a href="{{route('location',$location->slug)}}"><img
                src="{{$featured_image ?? asset('sites/images/dummy/350x250.jpg')}}" class="img-fluid" alt="">
                <div class="read_more"><span>{{$location->name}}</span></div>
            </a> 
        </div>
    </div>
    @endforeach
    @else
    <h2>No Result Found</h2>

    @endif


</div>
