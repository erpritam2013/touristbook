<div class="row hotel-grid-view">
    @if ($hotels->isNotEmpty())
    @foreach ($hotels as $key => $hotel)
    <div class="col-md-4 col-sm-4 col-xs-12">
        <div class="listroBox" latitude="{{$hotel->latitude}}" longitude="{{$hotel->longitude}}">
            <figure> {{--<a href="{{route('hotel',$hotel->slug)}}" class="wishlist_bt"></a>--}}
                {!!is_featured($hotel->is_featured)!!}
                @php $featured_image = (!empty($hotel->featured_image) && isset($hotel->featured_image[0]['id']))?getConversionUrl($hotel->featured_image[0]['id'],'450x417'):null;@endphp
                <a href="{{route('hotel',$hotel->slug)}}"><img
                    src="{{$featured_image ?? asset('sites/images/dummy/450x417.jpg')}}" class="img-fluid" alt="">
                    <div class="read_more"><span>Read more</span></div>
                </a> </figure>
                <div class="listroBoxmain">
                    <h4 class="service-title"><a href="{{route('hotel',$hotel->slug)}}">{{ $hotel->name }}</a></h4>
                    <p class="service-location">{!!getNewIcon('Ico_maps', '#666666', '15px', '15px', true)!!}{{$hotel->address ?? $hotel->hotel_attributes['corporateAddress']}}</p>
                    {{--<a class="address" href="#">Get directions</a>--}}
                </div>
                <ul>
                    <li>
                     @php $hotel_price = get_price($hotel);@endphp
                     <p class="card-text text-muted service-price">
                         @if($hotel_price == 0)
                         Price On Request
                         @else
                         <span class="hotel-avg">
                            {!!getNewIcon('thunder', '#ffab53', '10px', '16px')!!}
                            Avg
                        </span>

                        {!!$hotel_price!!}

                        <span class="unit">/per night</span>
                        @endif
                    </p>
                </li>
                <li>
                 <div class="social-link-list"> 
                    {{--<a href="#" class="single-map-item"><i class="fas fa-map-marker-alt"></i><span class="TravelGo-opt-tooltip">On the map</span></a> --}}
                    @php 

                    $wishlist_status = (wishlist_model('Hotel',$hotel->id))?true:false;

                    @endphp
                    <a href="#" class="TravelGo-js-favorite wishlist_btn {{(!auth()->check())?'disabled-link':''}}" data-model_type="Hotel" data-model_id="{{$hotel->id}}" data-status="{{( $wishlist_status)?1:0}}" title="{{(!auth()->check())?'Please Login User Wish Hotel':''}}"><i class="fas fa-heart" style="{{( $wishlist_status)?'color:#000;':''}}"></i><span class="TravelGo-opt-tooltip" id="wishlist-title-{{$hotel->id}}">{{( $wishlist_status)?'saved':'save'}}</span></a> 
                    <a data-toggle="collapse" href="#hotel-social-links-{{ $hotel->id }}" role="button" aria-expanded="false" aria-controls="hotel-social-links-{{ $hotel->id }}"  class="TravelGo-js-booking"><i class="fa fa-share"></i><span class="TravelGo-opt-tooltip">Find Directions</span></a> 
                </div>
            </li>
            <li>
                
             <div class="hotel-social-links collapse fl-wrap" id="hotel-social-links-{{$hotel->id}}">

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
