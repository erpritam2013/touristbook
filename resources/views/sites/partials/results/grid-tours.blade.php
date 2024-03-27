<div class="row tour-grid-view">
    @if ($tours->isNotEmpty())
    @foreach ($tours as $key => $tour)
    <div class="col-md-4 col-sm-4 col-xs-12">
        <div class="listroBox" latitude="{{$tour->latitude}}" longitude="{{$tour->longitude}}">
            <figure> {{--<a href="{{route('tour',$tour->slug)}}" class="wishlist_bt"></a>--}}
                {!!is_featured($tour->is_featured)!!}
                @php $featured_image = (!empty($tour->featured_image) && isset($tour->featured_image[0]['id']))?getConversionUrl($tour->featured_image[0]['id'],'450x417'):null;@endphp
                <a href="{{route('tour',$tour->slug)}}"><img
                    src="{{$featured_image ?? asset('sites/images/dummy/450x417.jpg')}}" class="img-fluid" alt="">
                    {{--<div class="read_more"><span>Read more</span></div>--}}
                </a> </figure>
                <div class="listroBoxmain">
                    <h4 class="service-title"><a href="{{route('tour',$tour->slug)}}">{{ $tour->name }}</a></h4>
                    <p class="service-location">{!!getNewIcon('Ico_maps', '#666666', '15px', '15px', true)!!}{{$tour->address ?? $tour->tour_attributes['corporateAddress']}}</p>
                    {{--<a class="address" href="#">Get directions</a>--}}
                </div>
                <ul>
                    <li>

                       @php $tour_price = get_price($tour);@endphp
                       <p class="card-text text-muted service-price">
                         @if($tour_price == 0)
                         Price On Request
                         @else
                         <span class="tour-avg">
                            {!!getNewIcon('thunder', '#ffab53', '10px', '16px')!!}
                            Avg
                        </span>
                        {!!$tour_price!!}
                        <span class="unit">/per night</span>
                        @endif
                    </p>
                </li>
                <li>
                 <div class="social-link-list"> 
                    {{--<a href="#" class="single-map-item"><i class="fas fa-map-marker-alt"></i><span class="TravelGo-opt-tooltip">On the map</span></a> --}}
                    @php 

                    $wishlist_status = (wishlist_model('Tour',$tour->id))?true:false;

                    @endphp
                    {{--<a href="#" class="single-map-item"><i class="fas fa-map-marker-alt"></i><span class="TravelGo-opt-tooltip">On the map</span></a> --}}
                    <a href="#" class="TravelGo-js-favorite wishlist_btn {{(!auth()->check())?'disabled-link':''}}" data-model_type="Tour" data-model_id="{{$tour->id}}" data-status="{{($wishlist_status)?1:0}}" title="{{(!auth()->check())?'Please Login User Wish tour':''}}"><i class="fas fa-heart" style="{{($wishlist_status)?'color:#000;':''}}"></i><span class="TravelGo-opt-tooltip" id="wishlist-title-{{$tour->id}}">{{($wishlist_status)?'saved':'save'}}</span></a>
                    <a data-toggle="collapse" href="#tour-social-links-{{ $tour->id }}" role="button" aria-expanded="false" aria-controls="tour-social-links-{{ $tour->id }}"  class="TravelGo-js-booking"><i class="fa fa-share"></i><span class="TravelGo-opt-tooltip">Find Directions</span></a> 
                </div>
            </li>
            <li>

             <div class="tour-social-links collapse fl-wrap" id="tour-social-links-{{$tour->id}}">

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
