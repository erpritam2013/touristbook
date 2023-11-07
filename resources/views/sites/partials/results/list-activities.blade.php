<div class="row">

    @if ($activities->isNotEmpty())
    @foreach ($activities as $key => $activity)
    
    <div class="col-lg-12 col-md-12 col-sm-12 activity-list-page">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="row listroBox" latitude="{{$activity->latitude}}" longitude="{{$activity->longitude}}">
                    <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12 Nopadding">
                        <figure> 
                            {{--<a href="tour-detailed.html" class="wishlist_bt"></a>--}}
                            {!!is_featured($activity->is_featured,'Featured')!!}

                           @php $featured_image = (!empty($activity->featured_image) && isset($activity->featured_image[0]['id']))?getConversionUrl($activity->featured_image[0]['id'],'270x200'):null;@endphp
                            <a
                            href="{{route('activity',$activity->slug)}}"><img src="{{$featured_image ?? asset('sites/images/dummy/350x250.jpg')}}"
                            class="img-fluid" alt="">
                            {{--<div class="read_more"><span>Read more</span></div>--}}
                        </a> </figure>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12 Nopadding tour-content">
                        <div class="listroBoxmain">
                             
                            <p class="service-location">{!!getNewIcon('Ico_maps', '#666666', '15px', '15px', true)!!}{{shortDescription($activity->address,50) ?? ''}}@if(strlen($activity->address) > 50)
                                &nbsp;<i class="fas fa-plus" data-toggle="modal" data-target="#showMoreData" onclick="showMoreData(this)" data-more_data="{{$activity->address}}" data-more_data_label="Address" style="color:#fba009;"></i>
                            @endif</p>
                            <h4 class="service-title"><a href="{{route('activity',$activity->slug)}}">{{ $activity->name }}</a></h4>
                          
                            <div class="row">
                               <div class="col-sm-12">
                                @if($activity->term_activity_lists->count())
                                <div class="st-report-info">
                                    <ul>
                                        @foreach($activity->term_activity_lists as $key => $term_activity_lists)
                                        @if($key <=4)
                                        <li>{{$term_activity_lists->name}}
                                          @if($key == 4 && $activity->term_activity_lists->count() > 4)
                                          &nbsp;<i class="fas fa-plus" data-toggle="modal" data-target="#showMoreData" onclick="showMoreData(this)" data-more_data="{{json_encode($activity->term_activity_lists)}}" data-more_data_label="Activity List" style="color:#fba009;"></i>
                                          @endif
                                      </li>
                                      @endif
                                      @endforeach
                                      
                                  </ul>


                              </div>
                              @endif



                          </div>
                          <div class="col-sm-12">
                          
                            @if(!empty($activity->detail->activity_zones))

                            <div class="st-highlight-info">
                               <ul> 
                                @foreach($activity->detail->activity_zones as $key => $activity_zones)

                                @if($key <=1)

                                @if($activity_zones['activity_zones-url_link_status'] == 'slug')
                                <li><a href="{{route('activity',$activity->slug)}}?link={{$activity_zones['activity_zones-slug']}}" target="_blank">{{$activity_zones['activity_zones-title']}}</a></li>
                                @elseif($activity_zones['activity_zones-url_link_status'] == 'web-link')
                                <li><a href="{{$activity_zones['activity_zones-web_link']}}" target="_blank">{{$activity_zones['activity_zones-title']}}</a></li>

                                @else
                                <li><a href="{{$activity_zones['activity_zones-file']}}" target="_blank">{{$activity_zones['activity_zones-title']}}</a></li>
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
                        <a data-toggle="collapse" href="#st-tour-content-{{ $activity->id }}" role="button" aria-expanded="false" aria-controls="st-tour-content-{{ $activity->id }}" style="text-decoration: none;" >More Info...
                            <i class="fa fa-angle-down"></i>
                        </a>
                    </div>

                    <div class="TravelGo-opt-list"> 
                        {{--<a href="#" class="single-map-item"><i class="fas fa-map-marker-alt"></i><span class="TravelGo-opt-tooltip">On the map</span></a> --}}
                        <a href="#" class="TravelGo-js-favorite"><i class="fas fa-heart"></i><span class="TravelGo-opt-tooltip">Save</span></a> 
                        <a data-toggle="collapse" href="#tour-social-links-{{ $activity->id }}" role="button" aria-expanded="false" aria-controls="tour-social-links-{{ $activity->id }}"  class="TravelGo-js-booking"><i class="fa fa-share"></i><span class="TravelGo-opt-tooltip">Show Social Links</span></a> 
                    </div>

                </div>
                <div class="activity-social-links collapse fl-wrap" id="tour-social-links-{{$activity->id}}">

                    <a class="TravelGo-js-favorite"

                    href="https://www.facebook.com/sharer/sharer.php?u={{route('activity',$activity->slug)}}&title={{$activity->name}}"

                    target="_blank" ><i

                    class="fab fa-facebook-f"></i><span class="TravelGo-opt-tooltip">Facebook Share</span></a>

                    <a class="twitter"

                    href="https://twitter.com/share?url={{route('activity',$activity->slug)}}&title={{$activity->name}}"

                    target="_blank" rel="noopener" original-title="Twitter"><i

                    class="fab fa-twitter"></i><span class="TravelGo-opt-tooltip">Twitter Share</span></a>

                    <a class="google"

                    href="https://plus.google.com/share?url={{route('activity',$activity->slug)}}&title={{$activity->name}}"

                    target="_blank" rel="noopener" original-title="Google+"><i

                    class="fab fa-google-plus "></i><span class="TravelGo-opt-tooltip">Google Plus Share</span></a>

                    <a class="no-open pinterest"

                    href="https://www.pinterest.com/pin/create/button/?url={{route('activity',$activity->slug)}}&amp;description={{$activity->name}}"

                    target="_blank" rel="noopener" original-title="Pinterest"><i

                    class="fab fa-pinterest "></i><span class="TravelGo-opt-tooltip">Pinterest Share</span></a>

                    <a class="linkedin"

                    href="https://www.linkedin.com/shareArticle?mini=true&url={{route('activity',$activity->slug)}}&title={{$activity->name}}"

                    target="_blank" rel="noopener" original-title="LinkedIn"><i

                    class="fab fa-linkedin "></i><span class="TravelGo-opt-tooltip">Linkedin Share</span></a>
                    <a class="whatsapp"

                    href="https://api.whatsapp.com/send?text={{$activity->name}} {{route('activity',$activity->slug)}}"

                    target="_blank" rel="noopener" original-title="whatsapp"><i

                    class="fab fa-whatsapp "></i><span class="TravelGo-opt-tooltip">Whatsapp Share</span></a>




                </div>

            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 Nopadding section-footer">

               <div class="tour-service-price">

                <span class="tour-avg">
                    {!!getNewIcon('thunder', '#ffab53', '10px', '16px')!!}
                    Avg
                </span>

                {!!get_price($activity,'₹')!!}

                <span class="unit"><span class="price-ex"><i class="fa fa-exclamation-circle icon-4x important-note-icon-tax" aria-hidden="true" style="color: #07509E;font-size: 23px;position: absolute;top: -3px;"><span class="TravelGo-opt-tooltip min-w-500px-fs-14fpx">Price usually vary or subject to change please visit website to view the best deal.</span></i></span></span>


            </div>

            <div class="view-tour-btn"><a href="{{route('activity',$activity->slug)}}" class="btn btn-sm btn-grad text-white pt-2 pb-2 text-capitalize">VIEW ACTIVITY</a></div>


        </div>
        <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12 Nopadding st-more-information collapse" id="st-tour-content-{{ $activity->id }}">

           @if(!empty($activity->detail->activity_zones))

           <div class="st-highlight-info p-3">
            <h3 class="st-section-title font-weight-bold">Highlight</h3>
            <div class="row" >
                @foreach($activity->detail->activity_zones as $key => $activity_zones_2)
               

                @if($activity_zones_2['activity_zones-url_link_status'] == 'slug')
                <div class="col-xs-6 col-sm-6" style="color:#5e6d77;"> <i class="fa fa-light fa-circle fa-xs" aria-hidden="true" style="font-size: 7px;color: transparent;"></i>&nbsp;<a href="{{route('activity',$activity->slug)}}?link={{$activity_zones_2['activity_zones-slug']}}" target="_blank">{{$activity_zones_2['activity_zones-title']}}</a></div>
                @elseif($activity_zones_2['activity_zones-url_link_status'] == 'web-link')
                <div class="col-xs-6 col-sm-6" style="color:#5e6d77;"> <i class="fa fa-light fa-circle fa-xs" aria-hidden="true" style="font-size: 7px;color: transparent;"></i>&nbsp;<a href="{{$activity_zones_2['activity_zones-web_link']}}" target="_blank">{{$activity_zones_2['activity_zones-title']}}</a></div>

                 @else
                  <div class="col-xs-6 col-sm-6" style="color:#5e6d77;"> <i class="fa fa-light fa-circle fa-xs" aria-hidden="true" style="font-size: 7px;color: transparent;"></i>&nbsp;<a href="{{$activity_zones_2['activity_zones-file']}}" target="_blank">{{$activity_zones_2['activity_zones-title']}}</a></div>

                @endif

                @endforeach
            </div>

        </div>
        @endif
        @php 
        $include = $activity->detail->activity_include ?? '';
        $exclude = $activity->detail->activity_exclude ?? '';

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
                    <h3 class="st-section-title font-weight-bold">Exclusions</h3>
                    @if(!empty($include_arr))
                    <ul class="exclude p-0" style="list-style:none;line-height: 2;">
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
