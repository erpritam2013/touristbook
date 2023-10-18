<div class="row">

    @if ($tours->isNotEmpty())
    @foreach ($tours as $key => $tour)
    <div class="col-lg-12 col-md-12 col-sm-12 tour-list-page">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="row listroBox" latitude="{{$tour->latitude}}" longitude="{{$tour->longitude}}">
                    <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12 Nopadding">
                        <figure> 
                            {{--<a href="tour-detailed.html" class="wishlist_bt"></a>--}}
                            {!!is_featured($tour->is_featured,'Featured Tour')!!}
                            <a
                            href="{{route('tour',$tour->slug)}}"><img src="{{asset('sites/images/hotels/room6.jpg')}}"
                            class="img-fluid" alt="">
                            <div class="read_more"><span>Read more</span></div>
                        </a> </figure>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12 Nopadding tour-content">
                        <div class="listroBoxmain">

                            <p class="service-location">{!!getNewIcon('Ico_maps', '#666666', '15px', '15px', true)!!}{{$tour->address ?? ''}}</p>
                            <h4 class="service-title"><a href="{{route('tour',$tour->slug)}}">{{ $tour->name }}</a></h4>
                          
                          <div class="row">

                                  @if(!empty($tour->detail->package_route))
                             <div class="col-md-12 col-xs-12 tour-routes">
                          
                                <ul>
                                  <li>
                                      @php 

                                           $package_route = (!empty($tour->detail->package_route))?implode('-',array_column($tour->detail->package_route,'package_route-title')):'';
                                      @endphp
                                      <span class="tour-route-span">{{touristbook_sanitize_title($package_route) ?? ''}}</span>

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
                                $sponsored_title = $tour->detail->sponsored['title'];
                                $sponsored_description = $tour->detail->sponsored['description'];

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
                                @php 
                                 $sponsored_desc_arr =  explode("\n", trim($sponsored_description));
                                @endphp
                                <ul>
                                    @foreach($sponsored_desc_arr as $k => $v)
                                    @if($k <=3)
                                    <li>{{$v}}</li>
                                    @endif
                                    @endforeach
                                </ul>

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
                        {{--<a href="#" class="single-map-item"><i class="fas fa-map-marker-alt"></i><span class="TravelGo-opt-tooltip">On the map</span></a> --}}
                        <a href="#" class="TravelGo-js-favorite"><i class="fas fa-heart"></i><span class="TravelGo-opt-tooltip">Save</span></a> 
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
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 Nopadding section-footer">

               <div class="tour-service-price" title="Price usually vary or subject to change please visit website to view the best deal.">

                <span class="tour-avg">
                    {!!getNewIcon('thunder', '#ffab53', '10px', '16px')!!}

                    <?php //if(STtour::is_show_min_price()): ?>

                    <?php// _e("From", ST_TEXTDOMAIN) ?>

                    <?php //else:?>

                    <?php //_e("Avg", ST_TEXTDOMAIN) ?>

                    <?php //endif;?>
                    Avg
                </span>

                {!!get_price($tour,'₹')!!}

                <span class="unit"><span class="price-ex"><i class="fa fa-exclamation-circle icon-4x important-note-icon-tax" aria-hidden="true" style="color: #07509E;font-size: 23px;position: absolute;top: -3px;"></i></span></span>


            </div>

            <div class="view-tour-btn"><a href="#" class="btn btn-sm btn-grad text-white mb-0 padding">VIEW tour</a></div>


        </div>
        <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12 Nopadding st-more-information collapse" id="st-tour-content-{{ $tour->id }}">
           @if(!empty($tour->detail->highlights))

           <div class="st-highlight-info">
            <h3 class="st-section-title">Highlights</h3>
            <div class="row" >
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
                <div class="col-xs-6 col-sm-6" style="color:#5e6d77;"> <i class="fa fa-light fa-circle fa-xs" aria-hidden="true" style="font-size: 7px;color: transparent;"></i>&nbsp;<a href="{{$url_add}}" target="_blank">{{$highlights['highlights-title']}}</a></div>
                @else
                <div class="col-xs-6 col-sm-6" style="color:#5e6d77;"> <i class="fa fa-light fa-circle fa-xs" aria-hidden="true" style="font-size: 7px;color: transparent;"></i>&nbsp;<a href="{{$url_add}}" target="_blank">{{$highlights['highlights-title']}}</a></div>

                @endif


                @endif

                @endforeach
            </div>

        </div>
        @endif
        @php 
        $include = $tour->detail->tours_include ?? '';
        $exclude = $tour->detail->tours_exclude ?? '';

        @endphp
        @if(!empty($include) || !empty($exclude))
        <div class="row">  
            <div class="col-xs-6 col-sm-6">
                @if(!empty($include))
                @php $include_arr = explode("\n", $include); @endphp
                <div class="st-include">
                    @if(!empty($include_arr))
                    <ul class="include" style="list-style:none;">
                        @foreach($include_arr as $in_k => $in_v)
                        <li style="color:#000;">
                            {!!getNewIcon('check-1', '#2ECC71', '14px', '14px', false)!!}
                            {{$in_v}}
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
                    @if(!empty($include_arr))
                    <ul class="exclude" style="list-style:none;">
                        @foreach($exclude_arr as $ex_k => $ex_v)
                        <li style="color:#000;">
                            {!!getNewIcon('remove', '#ff0000', '14px', '14px', false)!!}
                            {{$ex_v}}
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
@endforeach
@else
<h2>No Result Found</h2>

@endif

</div>