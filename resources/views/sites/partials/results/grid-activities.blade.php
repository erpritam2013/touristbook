<div class="row tour-grid-view">
    @if ($activities->isNotEmpty())
        @foreach ($activities as $key => $activity)
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="listroBox" latitude="{{$activity->latitude}}" longitude="{{$activity->longitude}}">
                    <figure> {{--<a href="{{route('activity',$activity->slug)}}" class="wishlist_bt"></a>--}}
                    {!!is_featured($activity->is_featured)!!}
                     <a href="{{route('activity',$activity->slug)}}"><img
                                src="/sites/images/activities/room6.jpg" class="img-fluid" alt="">
                            <div class="read_more"><span>Read more</span></div>
                        </a> </figure>
                    <div class="listroBoxmain">
                        <h4 class="service-title"><a href="{{route('activity',$activity->slug)}}">{{ $activity->name }}</a></h4>
                         <p class="service-location">{!!getNewIcon('Ico_maps', '#666666', '15px', '15px', true)!!}{{$activity->address ?? $activity->tour_attributes['corporateAddress']}}</p>
                        {{--<a class="address" href="#">Get directions</a>--}}
                    </div>
                    <ul>
                        <li>
                            <p class="card-text text-muted service-price"><span class="tour-avg">
                    {!!getNewIcon('thunder', '#ffab53', '10px', '16px')!!}

                    <?php //if(STtour::is_show_min_price()): ?>

                    <?php// _e("From", ST_TEXTDOMAIN) ?>

                    <?php //else:?>

                    <?php //_e("Avg", ST_TEXTDOMAIN) ?>

                    <?php //endif;?>
                    Avg
                </span>

                <span class="price">

                    <?php

                    //$price = STtour::get_price();

                    //echo TravelHelper::format_money($price);

                    ?>
                    4700
                </span>

                <span class="unit"><?php// echo __('per night', ST_TEXTDOMAIN); ?>  /per night</span></p>
                        </li>
                        <li>
                             <div class="social-link-list"> 
                        {{--<a href="#" class="single-map-item"><i class="fas fa-map-marker-alt"></i><span class="TravelGo-opt-tooltip">On the map</span></a> --}}
                        <a href="#" class="TravelGo-js-favorite"><i class="fas fa-heart"></i><span class="TravelGo-opt-tooltip">Save</span></a> 
                        <a data-toggle="collapse" href="#tour-social-links-{{ $activity->id }}" role="button" aria-expanded="false" aria-controls="tour-social-links-{{ $activity->id }}"  class="TravelGo-js-booking"><i class="fa fa-share"></i><span class="TravelGo-opt-tooltip">Find Directions</span></a> 
                    </div>
                        </li>
                        <li>
                            
                             <div class="tour-social-links collapse fl-wrap" id="tour-social-links-{{$activity->id}}">

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
