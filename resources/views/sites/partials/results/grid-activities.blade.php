<div class="row activity-grid-view">
    @if ($activities->isNotEmpty())
    @foreach ($activities as $key => $activity)
    <div class="col-md-4 col-sm-4 col-xs-12">
        <div class="listroBox" latitude="{{$activity->latitude}}" longitude="{{$activity->longitude}}">
            <figure> {{--<a href="{{route('activity',$activity->slug)}}" class="wishlist_bt"></a>--}}
                {!!is_featured($activity->is_featured)!!}
                @php $featured_image = (!empty($activity->featured_image) && isset($activity->featured_image[0]['id']))?getConversionUrl($activity->featured_image[0]['id'],'270x200'):null;@endphp
                <a href="{{route('activity',$activity->slug)}}"><img
                    src="{{$featured_image ?? asset('sites/images/dummy/350x250.jpg')}}" class="img-fluid" alt="">
                    {{--<div class="read_more"><span>Read more</span></div>--}}
                </a> </figure>
                <div class="listroBoxmain">
                    <h4 class="service-title"><a href="{{route('activity',$activity->slug)}}">{{ $activity->name }}</a></h4>
                    <p class="service-location">{!!getNewIcon('Ico_maps', '#666666', '15px', '15px', true)!!}{{$activity->address ?? $activity->activity_attributes['corporateAddress']}}</p>
                    {{--<a class="address" href="#">Get directions</a>--}}
                </div>
                <ul>
                    <li>
                        <p class="card-text text-muted service-price"><span class="activity-avg">
                            {!!getNewIcon('thunder', '#ffab53', '10px', '16px')!!}
                            Avg
                        </span>
                        {!!get_price($activity)!!}

                        <span class="unit">/per night</span></p>
                    </li>
                    <li>
                       <div class="social-link-list"> 
                        {{--<a href="#" class="single-map-item"><i class="fas fa-map-marker-alt"></i><span class="TravelGo-opt-tooltip">On the map</span></a> --}}
                        <a href="#" class="TravelGo-js-favorite"><i class="fas fa-heart"></i><span class="TravelGo-opt-tooltip">Save</span></a> 
                        <a data-toggle="collapse" href="#activity-social-links-{{ $activity->id }}" role="button" aria-expanded="false" aria-controls="activity-social-links-{{ $activity->id }}"  class="TravelGo-js-booking"><i class="fa fa-share"></i><span class="TravelGo-opt-tooltip">Find Directions</span></a> 
                    </div>
                </li>
                <li>
                   <div class="activity-social-links collapse fl-wrap" id="activity-social-links-{{$activity->id}}">

                    <a href="#" class="TravelGo-js-favorite"><i class="fas fa-heart"></i><span class="TravelGo-opt-tooltip">Save</span></a> 
                    <a href="#" class="TravelGo-js-favorite"><i class="fas fa-heart"></i><span class="TravelGo-opt-tooltip">Save</span></a> 
                    <a href="#" class="TravelGo-js-favorite"><i class="fas fa-heart"></i><span class="TravelGo-opt-tooltip">Save</span></a> 
                    <a href="#" class="TravelGo-js-favorite"><i class="fas fa-heart"></i><span class="TravelGo-opt-tooltip">Save</span></a> 
                </div>
            </li>
        </ul>
    </div>
</div>
@endforeach
@else
<h2>No Result Found</h2>

@endif


</div>
