<div class="row">

    @if ($tours->isNotEmpty())
    @foreach ($tours as $key => $tour)
    <div class="col-lg-12 col-md-12 col-sm-12 tour-list-page">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="row listroBox" latitude="{{$tour->latitude}}" longitude="{{$tour->longitude}}">
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 Nopadding">
                        <figure> 
                            {{--<a href="tour-detailed.html" class="wishlist_bt"></a>--}}
                            {!!is_featured($tour->is_featured,'Featured Tour')!!}
                            @php $featured_image = (!empty($tour->featured_image) && isset($tour->featured_image[0]['id']))?getConversionUrl($tour->featured_image[0]['id'],'450x417'):null;@endphp
                            <a
                            href="{{route('tour',$tour->slug)}}"><img src="{{$featured_image ?? asset('sites/images/dummy/450x417.jpg')}}"
                            class="img-fluid" alt="">
                            {{--<div class="read_more"><span>Read more</span></div>--}}
                        </a> </figure>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12 Nopadding tour-content">
                        <div class="listroBoxmain">

                            <p class="service-location">{!!getNewIcon('Ico_maps', '#666666', '15px', '15px', true)!!}{{$tour->address ?? ''}}</p>
                            <h4 class="service-title pb-1"><a href="{{route('tour',$tour->slug)}}">{{ $tour->name }}</a></h4>

                            <div class="row">

                              @if(!empty($tour->detail->package_route))
                              <div class="col-md-12 col-xs-12 tour-routes">

                                <ul>
                                  <li>
                                  
                                      @php 

                                      $package_route = (!empty($tour->detail->package_route))?current($tour->detail->package_route):'';
                                      @endphp
                                      <span class="tour-route-span">{!!getNewIcon('Ico_maps', '#666666', '15px', '15px', true)!!}{{$package_route['package_route-title'] ?? ''}}</span>

                                  </li>

                              </ul>

                          </div>
                          @endif
                          <div class="col-md-6 col-xs-6 duration-day pt5">
                            <div class="service-duration">

                                {!!getNewIcon('time-clock-circle-1', '#5E6D77', '17px', '17px')!!}
                                {{$tour->duration_day}}

                            </div>

                        </div>

                        <div class="col-md-6 col-xs-6 sponsored-by pt5">
                            @if(!empty($tour->detail->sponsored))
                            @php 
                            $sponsored_by = $tour->detail->sponsored['sponsored_by'];
                            $sponsored_title = $tour->detail->sponsored['sponsored_title'];
                            $sponsored_description = $tour->detail->sponsored['sponsored_description'];

                            @endphp
                            <div class="st-sponsored-by">

                                <strong>Sponsored By : </strong>
                                <span>


                                    <a href="{{$sponsored_by ?? '#'}}">{{$sponsored_title}}</a>

                                </span>

                            </div>
                            @endif
                        </div>
                        <div class="col-md-12 col-xs-12 sponsored-description pt5">
                            @if(!empty($sponsored_description))
                            <p>{{shortDescription($sponsored_description,50) ?? ''}}@if(strlen($sponsored_description) > 50)
                                &nbsp;<i class="fas fa-plus" data-toggle="modal" data-target="#showMoreData" onclick="showMoreData(this)" data-more_data="{{$sponsored_description}}" data-more_data_label="Sponsored Description" style="color:#fba009;"></i>
                            @endif</p>
                            @endif
                        </div>
                        <div class="col-md-6 col-xs-6 pt5"></div>
                        <div class="col-md-6 col-xs-6 pt5"><strong>
                        </strong></div>
                        <div class="col-md-12 col-xs-12 highlights-info pt5">

                            @if(!empty($tour->detail->highlights))

                            <div class="st-highlight-info" style="padding: 5px 0px;">
                               <ul> 
                                @foreach($tour->detail->highlights as $key => $highlights)
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
                    <a data-toggle="collapse" href="#st-tour-content-{{ $tour->id }}" role="button" aria-expanded="false" aria-controls="st-tour-content-{{ $tour->id }}" style="text-decoration: none;" >More Info...
                        <i class="fa fa-angle-down"></i>
                    </a>
                </div>

                <div class="TravelGo-opt-list"> 
                    @php 

                     $wishlist_status = (wishlist_model('Tour',$tour->id))?true:false;

                    @endphp
                    {{--<a href="#" class="single-map-item"><i class="fas fa-map-marker-alt"></i><span class="TravelGo-opt-tooltip">On the map</span></a> --}}
                    <a href="#" class="TravelGo-js-favorite wishlist_btn {{(!auth()->check())?'disabled-link':''}}" data-model_type="Tour" data-model_id="{{$tour->id}}" data-status="{{($wishlist_status)?1:0}}" title="{{(!auth()->check())?'Please Login User Wish tour':''}}"><i class="fas fa-heart" style="{{($wishlist_status)?'color:#000;':''}}"></i><span class="TravelGo-opt-tooltip" id="wishlist-title-{{$tour->id}}">{{($wishlist_status)?'saved':'save'}}</span></a>
                    <a data-toggle="collapse" href="#tour-social-links-{{ $tour->id }}" role="button" aria-expanded="false" aria-controls="tour-social-links-{{ $tour->id }}"  class="TravelGo-js-booking"><i class="fa fa-share"></i><span class="TravelGo-opt-tooltip">Show Social Links</span></a> 
                </div>

            </div>
            <div class="tour-social-links collapse fl-wrap" id="tour-social-links-{{$tour->id}}">

                <a class="TravelGo-js-favorite"

                href="https://www.facebook.com/sharer/sharer.php?u={{route('tour',$tour->slug)}}&title={{$tour->name}}"

                target="_blank" ><i

                class="fab fa-facebook-f"></i><span class="TravelGo-opt-tooltip">Facebook Share</span></a>

                <a class="twitter"

                href="https://twitter.com/share?url={{route('tour',$tour->slug)}}&title={{$tour->name}}"

                target="_blank" rel="noopener" original-title="Twitter"><i

                class="fab fa-twitter"></i><span class="TravelGo-opt-tooltip">Twitter Share</span></a>

                <a class="google"

                href="https://plus.google.com/share?url={{route('tour',$tour->slug)}}&title={{$tour->name}}"

                target="_blank" rel="noopener" original-title="Google+"><i

                class="fab fa-google-plus "></i><span class="TravelGo-opt-tooltip">Google Plus Share</span></a>

                <a class="no-open pinterest"

                href="https://www.pinterest.com/pin/create/button/?url={{route('tour',$tour->slug)}}&amp;description={{$tour->name}}"

                target="_blank" rel="noopener" original-title="Pinterest"><i

                class="fab fa-pinterest "></i><span class="TravelGo-opt-tooltip">Pinterest Share</span></a>

                <a class="linkedin"

                href="https://www.linkedin.com/shareArticle?mini=true&url={{route('tour',$tour->slug)}}&title={{$tour->name}}"

                target="_blank" rel="noopener" original-title="LinkedIn"><i

                class="fab fa-linkedin "></i><span class="TravelGo-opt-tooltip">Linkedin Share</span></a>
                <a class="whatsapp"

                href="https://api.whatsapp.com/send?text={{$tour->name}} {{route('tour',$tour->slug)}}"

                target="_blank" rel="noopener" original-title="whatsapp"><i

                class="fab fa-whatsapp "></i><span class="TravelGo-opt-tooltip">Whatsapp Share</span></a>




            </div>

        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 Nopadding section-footer">

           <div class="tour-service-price" >
              @php $tour_price = get_price($tour);@endphp
           @if($tour_price == 0)
            Price On Request
            <span class="unit"><span class="price-ex"><i class="fa fa-exclamation-circle icon-4x important-note-icon-tax" aria-hidden="true" style="color: #07509E;font-size: 23px;position: absolute;top: -3px;"><span class="TravelGo-opt-tooltip min-w-690px-fs-15fpx">Price usually vary or subject to change please visit website to view the best deal.</span></i></span></span>
           @else
            <span class="tour-avg">
                {!!getNewIcon('thunder', '#ffab53', '10px', '16px')!!}
                Avg
            </span>

            {!!$tour_price!!}

            <span class="unit"><span class="price-ex"><i class="fa fa-exclamation-circle icon-4x important-note-icon-tax" aria-hidden="true" style="color: #07509E;font-size: 23px;position: absolute;top: -3px;"><span class="TravelGo-opt-tooltip min-w-690px-fs-15fpx">Price usually vary or subject to change please visit website to view the best deal.</span></i></span></span>
           @endif


        </div>

        <div class="view-tour-btn"><a href="{{route('tour',$tour->slug)}}" class="btn btn-sm btn-grad text-white mb-0 padding">VIEW tour</a></div>


    </div>
    <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12 Nopadding st-more-information collapse" id="st-tour-content-{{ $tour->id }}">
    <div class="row">
        <div class="col-sm-12">  
         @if(!empty($tour->detail->tours_highlight))

       <div class="st-highlight p-3">
        <h3 class="st-section-title font-weight-bold">Highlights</h3>

        <div class="st-highlight-info" style="padding: 5px 0px;">
           <ul> 
            @php  $arr_highlight = explode("\n", trim($tour->detail->tours_highlight)); @endphp
            @foreach($arr_highlight as $k => $v)

            <li>{{$v}}</li>

            @endforeach
        </ul>

    </div>
</div>
@endif
</div>
        <div class="col-sm-12">
@php 
$include = $tour->detail->tours_include ?? '';
$exclude = $tour->detail->tours_exclude ?? '';
@endphp
@if(!empty($include) || !empty($exclude))
<div class="row p-3" id="st-include-exclude">  
    <div class="col-xs-6 col-sm-6">
        @if(!empty($include))
        @php $include_arr = explode("\n", $include); @endphp
        <div class="st-include">
         <h3 class="st-section-title font-weight-bold">Inclusions</h3>
         @if(!empty($include_arr))
         <ul class="include p-0" style="list-style:none;line-height: 2;">
            @foreach($include_arr as $in_k => $in_v)
            <li style="color:#000;">
                {!!getNewIcon('check-1', '#2ECC71', '14px', '14px', false)!!}
                {!!$in_v!!}
            </li>
            @endforeach
        </ul>

        @endif
    </div>
    @endif
</div>
<div class="col-xs-6 col-sm-6">
    @if(!empty($exclude))
    @php $exclude_arr = explode("\n", $exclude); @endphp
    <div class="st-exclude">
       <h3 class="st-section-title font-weight-bold">Exclusions</h3>
       @if(!empty($include_arr))
       <ul class="exclude p-0" style="list-style:none;line-height: 2;">
        @foreach($exclude_arr as $ex_k => $ex_v)
        <li style="color:#000;">
            {!!getNewIcon('remove', '#ff0000', '14px', '14px', false)!!}
            {!!$ex_v!!}
        </li>
        @endforeach
    </ul>

    @endif
</div>
@endif

</div>
</div>

@endif
        </div>
    </div>




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
