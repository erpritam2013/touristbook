<div class="row location-grid-view">
    @if ($locations->isNotEmpty())
    @foreach ($locations as $key => $location)
    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 mb-4">
        <div class="card shadow border-0 h-100 grid-list-item destination-item">
            <div class="image">
                @php $featured_image = (!empty($location->featured_image) && isset($location->featured_image[0]['id']))?getConversionUrl($location->featured_image[0]['id'],'270x200'):null;@endphp
                <a class="st-link" href="{{route('location',$location->slug)}}">

                    <img src="{{$featured_image ?? asset('sites/images/dummy/270x200.jpg')}}" class="img-responsive" alt="{{strtolower($location->name)}}-image">
                </a>
                <div class="content">
                    <h4 class="title">
                        <a href="{{route('location',$location->slug)}}">
                            {{$location->name}}
                        </a>
                    </h4>
                </div>
                <div class="desc multi"><a href="/destinations/?location_name=CHANDIGARH&amp;location_id=61226">0 Hotels</a><a href="https://test.thetouristbook.com/packages/?location_name=CHANDIGARH&amp;location_id=61226">0 Tours</a><a href="https://test.thetouristbook.com/activities/?location_name=CHANDIGARH&amp;location_id=61226">0 Activities</a></div>
            </div>
        </div>
    </div>
    @endforeach
    @else
    <h2>No Result Found</h2>

    @endif


</div>


