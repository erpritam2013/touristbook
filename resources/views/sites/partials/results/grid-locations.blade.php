<div class="row location-grid-view">
    @if ($locations->isNotEmpty())
    @foreach ($locations as $key => $location)
    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 mb-4">
        <div class="card shadow border-0 h-100 grid-list-item destination-item">
            @php $featured_image = (!empty($location->featured_image) && isset($location->featured_image[0]['id']))?getConversionUrl($location->featured_image[0]['id'],'270x200'):null;
            @endphp
            <div class="image">
                <a class="st-link" href="{{route('location',$location->slug)}}">
                    <img src="{{$featured_image ?? asset('sites/images/dummy/270x200.jpg')}}" class="img-responsive">
                </a>
                <div class="content">
                    <h4 class="title">
                        <a href="{{route('location',$location->slug)}}">
                            {{$location->name}}
                        </a>
                    </h4>
                </div>
                <div class="desc multi">
                    <a href="{{route('hotels')}}/?search={{$location->name}}&source_type=location&source_id={{$location->id}}" target="_blank">{{$location->hotel_count[0]->count}} Hotels</a>
                    <a href="{{route('our-packages')}}/?search={{$location->name}}&source_type=location&source_id={{$location->id}}" target="_blank">{{$location->tour_count[0]->count}} Tours</a>
                    <a href="{{route('activities')}}/?search={{$location->name}}&source_type=location&source_id={{$location->id}}" target="_blank">{{$location->activity_count[0]->count}} Activities</a>
                </div>
            </div>

        </div>
    </div>
    @endforeach
    @else
    <h2>No Result Found</h2>
    @endif
</div>



