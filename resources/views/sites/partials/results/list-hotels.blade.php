<div class="row">

    @if ($hotels->isNotEmpty())

    @foreach ($hotels as $key => $hotel)
    <div class="col-lg-12 col-md-12 col-sm-12 hotel-list-page">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="row listroBox" latitude="{{$hotel->latitude}}" longitude="{{$hotel->longitude}}">
                    <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12 Nopadding">
                        <figure> 
                            {{--<a href="hotel-detailed.html" class="wishlist_bt"></a>--}}
                            {!!is_featured($hotel->is_featured)!!}
                           @php $featured_image = (!empty($hotel->featured_image) && isset($hotel->featured_image[0]['id']))?getConversionUrl($hotel->featured_image[0]['id'],'270x200'):null;@endphp
                            <a
                            href="{{route('hotel',$hotel->slug)}}"><img src="{{$featured_image ?? asset('sites/images/dummy/350x250.jpg')}}"
                            class="img-fluid" alt="">
                            {{--<div class="read_more"><span>Read more</span></div>--}}
                        </a> </figure>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12 Nopadding hotel-content">
                        <div class="listroBoxmain">
                            <h4 class="service-title"><a href="{{route('hotel',$hotel->slug)}}">{{ $hotel->name }}</a></h4>
                            @php
                            $address = (!empty($hotel->address ))?$hotel->address:$hotel->hotel_attributes['corporateAddress'];
                            @endphp
                            <p class="service-location">{!!getNewIcon('Ico_maps', '#666666', '15px', '15px', true)!!}{{shortDescription($address,50)}}@if(strlen($address) > 50)
                                &nbsp;<i class="fas fa-plus" data-toggle="modal" data-target="#showMoreData" onclick="showMoreData(this)" data-more_data="{{$address}}" data-more_data_label="Address" style="color:#fba009;"></i>
                            @endif</p>
                            
                            <div class="row">
                               <div class="col-sm-12">
                                @if($hotel->amenities->count())
                                <div class="st-report-info">
                                    <ul>
                                        @foreach($hotel->amenities as $key => $amenity)
                                        @if($key <=4)
                                        <li>{{$amenity->name}}
                                          @if($key == 4 && $hotel->amenities->count() > 4)
                                          &nbsp;<i class="fas fa-plus" data-toggle="modal" data-target="#showMoreData" onclick="showMoreData(this)" data-more_data="{{json_encode($hotel->amenities()->get(['name']))}}" data-more_data_label="Amenities" style="color:#fba009;"></i>
                                          @endif
                                      </li>
                                      @endif
                                      @endforeach
                                      
                                  </ul>


                              </div>
                              @endif



                          </div>
                          <div class="col-sm-12">
                            @if(!empty($hotel->detail->highlights))

                            <div class="st-highlight-info">
                               <ul> 
                                @foreach($hotel->detail->highlights as $key => $highlights)
                                @if($key <=1)
                                @php   $url_add = $highlights['highlights-url']; @endphp

                                @if(!empty($highlights['highlights-file']))
                                @php 

                                $url_add = $highlights['highlights-file'];

                                @endphp
                                @endif

                                @if(empty($url_add) || $url_add == "")
                                @php 

                                $url_add = "#";

                                @endphp
                                @endif

                                @if(touristbook_sanitize_title($highlights['highlights-title']) == touristbook_sanitize_title('Tourism Zone') || touristbook_sanitize_title($highlights['highlights-title']) == touristbook_sanitize_title('Govt. Official Site (District)'))
                                @if(touristbook_sanitize_title($highlights['highlights-title']) == touristbook_sanitize_title('Govt. Official Site (District)'))
                                <li><a href="{{$url_add}}" target="_blank">{{$highlights['highlights-title']}}</a></li>
                                @else
                                <li><a href="{{$url_add}}" target="_blank">{{$highlights['highlights-title']}}</a></li>
                                @endif


                                @endif
                                @endif
      
                                @endforeach
                            </ul>

                        </div>
                        @endif

                    </div>
                </div>

                {{--<a class="address" href="#">Get directions</a>--}}
            </div>
            <div class="TravelGo-category-footer fl-wrap">

                <div class="TravelGo-category-price btn-grad">
                    <a data-toggle="collapse" href="#st-hotel-content-{{ $hotel->id }}" role="button" aria-expanded="false" aria-controls="st-hotel-content-{{ $hotel->id }}" style="text-decoration: none;" >More Info...
                        <i class="fa fa-angle-down"></i>
                    </a>
                </div>

                <div class="TravelGo-opt-list"> 
                    {{--<a href="#" class="single-map-item"><i class="fas fa-map-marker-alt"></i><span class="TravelGo-opt-tooltip">On the map</span></a> --}}
                    <a href="#" class="TravelGo-js-favorite"><i class="fas fa-heart"></i><span class="TravelGo-opt-tooltip">Save</span></a> 
                    <a data-toggle="collapse" href="#hotel-social-links-{{ $hotel->id }}" role="button" aria-expanded="false" aria-controls="hotel-social-links-{{ $hotel->id }}"  class="TravelGo-js-booking"><i class="fa fa-share"></i><span class="TravelGo-opt-tooltip">Show Social Links</span></a> 
                </div>

            </div>
            <div class="hotel-social-links collapse fl-wrap" id="hotel-social-links-{{$hotel->id}}">

                <a class="TravelGo-js-favorite"

                href="https://www.facebook.com/sharer/sharer.php?u={{route('hotel',$hotel->slug)}}&title={{$hotel->name}}"

                target="_blank" ><i

                class="fab fa-facebook-f"></i><span class="TravelGo-opt-tooltip">Facebook Share</span></a>

                <a class="twitter"

                href="https://twitter.com/share?url={{route('hotel',$hotel->slug)}}&title={{$hotel->name}}"

                target="_blank" rel="noopener" original-title="Twitter"><i

                class="fab fa-twitter"></i><span class="TravelGo-opt-tooltip">Twitter Share</span></a>

                <a class="google"

                href="https://plus.google.com/share?url={{route('hotel',$hotel->slug)}}&title={{$hotel->name}}"

                target="_blank" rel="noopener" original-title="Google+"><i

                class="fab fa-google-plus "></i><span class="TravelGo-opt-tooltip">Google Plus Share</span></a>

                <a class="no-open pinterest"

                href="https://www.pinterest.com/pin/create/button/?url={{route('hotel',$hotel->slug)}}&amp;description={{$hotel->name}}"

                target="_blank" rel="noopener" original-title="Pinterest"><i

                class="fab fa-pinterest "></i><span class="TravelGo-opt-tooltip">Pinterest Share</span></a>

                <a class="linkedin"

                href="https://www.linkedin.com/shareArticle?mini=true&url={{route('hotel',$hotel->slug)}}&title={{$hotel->name}}"

                target="_blank" rel="noopener" original-title="LinkedIn"><i

                class="fab fa-linkedin "></i><span class="TravelGo-opt-tooltip">Linkedin Share</span></a>
                <a class="whatsapp"

                href="https://api.whatsapp.com/send?text={{$hotel->name}} {{route('hotel',$hotel->slug)}}"

                target="_blank" rel="noopener" original-title="whatsapp"><i

                class="fab fa-whatsapp "></i><span class="TravelGo-opt-tooltip">Whatsapp Share</span></a>




            </div>

        </div>
        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 Nopadding section-footer">
           <div class="view-hotel-btn"><a href="{{route('hotel',$hotel->slug)}}" class="btn btn-sm btn-grad text-white mb-0 padding">VIEW HOTEL</a></div>
           <div class="hotel-service-price">

            <span class="hotel-avg">
                {!!getNewIcon('thunder', '#ffab53', '10px', '16px')!!}
                Avg
            </span>

            {!!get_price($hotel)!!}

            <span class="unit">/per night<span class="price-ex"><i class="fa fa-exclamation-circle icon-4x important-note-icon-tax" aria-hidden="true" style="color: #07509E;font-size: 23px;position: absolute;top: -3px;"><span class="TravelGo-opt-tooltip min-w-500px-fs-14fpx">Price usually vary or subject to change please visit website to view the best deal.</span></i></span></span>


        </div>


    </div>
    <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12 Nopadding st-more-information collapse" id="st-hotel-content-{{ $hotel->id }}">

     @if($hotel->facilities()->count())

     <div class="st-report">

        <h3 class="st-section-title">Facilities</h3>

        <div class="row" >
           @foreach($hotel->facilities()->get() as $key => $facility)

           <div class="col-xs-6 col-sm-6" style="color:#000000;"> <i class="fa fa-light fa-circle fa-xs" aria-hidden="true" style="font-size: 7px;color:transparent;"></i>&nbsp;{{ucwords($facility->name)}}</div>

           @endforeach

       </div>

   </div>

   @endif

   @if(!empty($hotel->detail->highlights))

   <div class="st-highlight-info">
    <h3 class="st-section-title">Highlights</h3>
    <div class="row" >
        @foreach($hotel->detail->highlights as $key => $highlights)
        @php   $url_add = $highlights['highlights-url']; @endphp

        @if(!empty($highlights['highlights-file']))
        @php 

        $url_add = $highlights['highlights-file'];

        @endphp
        @endif

        @if(empty($url_add) || $url_add == "")
        @php 

        $url_add = "#";

        @endphp
        @endif

        @if(touristbook_sanitize_title($highlights['highlights-title']) == touristbook_sanitize_title('Tourism Zone') || touristbook_sanitize_title($highlights['highlights-title']) == touristbook_sanitize_title('Govt. Official Site (District)'))
        @if(touristbook_sanitize_title($highlights['highlights-title']) == touristbook_sanitize_title('Govt. Official Site (District)'))
        <div class="col-xs-6 col-sm-6" style="color:#5e6d77;"> <i class="fa fa-light fa-circle fa-xs" aria-hidden="true" style="font-size: 7px;color: transparent;"></i>&nbsp;<a href="{{$url_add}}" target="_blank">{{$highlights['highlights-title']}}</a></div>
        @else
        <div class="col-xs-6 col-sm-6" style="color:#5e6d77;"> <i class="fa fa-light fa-circle fa-xs" aria-hidden="true" style="font-size: 7px;color: transparent;"></i>&nbsp;<a href="{{$url_add}}" target="_blank">{{$highlights['highlights-title']}}</a></div>

        @endif


        @endif

        @endforeach
    </div>

</div>
@endif



</div>
</div>
</div>
</div>
</div>
@endforeach
@else
<h2>No Result Found</h2>

@endif

</div>
