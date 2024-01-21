@extends('sites.layouts.main')
@section('title',$title)
@section('content')

@php $featured_image = (!empty($location->featured_image) && isset($location->featured_image[0]['id']))?getConversionUrl($location->featured_image[0]['id'],'450x350'):null;@endphp
@if(empty($featured_image))
@php $featured_image = asset('sites/images/dummy/1350x500.jpg'); @endphp
@endif

@include('sites.partials.banner', [
'bannerUrl' => $featured_image,
'bannerTitle' => strtoupper($location->name),
'bannerSubTitle' => '',
])


<section class="pt20 pb80 listingDetails Campaigns">
  <div class="container">
    <div class="map-content-loading">
      <div class="st-loader"></div>
    </div>
    <div class="row">

      <!-- Tab line -->
      <div class="col-lg-12 col-md-12 col-sm-12 destination-all-content" data-location_id="{{$location->id}}">
        {{--@php 
        $l_route = route('locations').'?search='.$location->locations[0]->name.'&source_type=location&source_id='.$location->locations[0]->id
        @endphp
        @include('sites.partials.breadcrumb',['location_route'=>$l_route,'location_name'=>$location->locations[0]->name ?? '','post_name'=>ucwords($location->name)])--}}
        {{--<h1 class="st-heading">{{ $location->name }}</h1>--}}
        <!-- sticky-top class style="top:120px;z-index:99;" -->
        <ul class="nav nav-tabs location-tabs" id="location-tabs">
          <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#tab-place_to_visit"> Place To Visit </a>
          </li>
          <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tab-stay" onclick="fetchDestinaitonDetail(this)" data-target_element="hotels"> Stay
          </a>
        </li>
        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tab-packages-activities" onclick="fetchDestinaitonDetail(this)" data-target_element="packages-activities">Packages & Activities</a> </li>
        {{--<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tab-what_to_do"> What To Do </a> </li>--}}
        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tab-need_to_know">
          Nead To Know
        </a> </li>
        {{--<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tab-images">
          Images
        </a> </li>--}}
        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tab-videos" onclick="fetchDestinaitonDetail(this)" data-target_element="videos">
          Videos
        </a> </li>
      </ul>
      <!-- custom-content start -->
      <!-- custom-content end -->
      <div class="tab-content pt-1" id="location-content">
        <!-- place to visit start -->

        <div class="tab-pane show active" id="tab-place_to_visit">
          <ul class="nav nav-tabs" id="place_to_visit_child_tab">
            <li class="nav-item active"><a class="nav-link active" href="#places"  data-toggle="tab" onclick="fetchDestinaitonDetail(this)" data-target_element="places">Places</a></li>

            <li class="nav-item"><a class="nav-link" href="#best_time_to_visit"  data-toggle="tab" onclick="fetchDestinaitonDetail(this)" data-target_element="best-time-to-visit">Best Time to Visit</a></li>

            <li class="nav-item"><a class="nav-link" href="#how_to_reach"  data-toggle="tab" onclick="fetchDestinaitonDetail(this)" data-target_element="how-to-reach">How to Reach</a></li>

            <li class="nav-item"><a class="nav-link" href="#fair_and_festivals" data-toggle="tab" onclick="fetchDestinaitonDetail(this)" data-target_element="fair-and-festivals">Fair and Festivals</a></li>

            <li class="nav-item"><a class="nav-link" href="#culinary_retreat" data-toggle="tab" onclick="fetchDestinaitonDetail(this)" data-target_element="culinary-retreat">Culinary Retreat</a></li>

            <li class="nav-item"><a class="nav-link" href="#shopaholics_anonymous" data-toggle="tab" onclick="fetchDestinaitonDetail(this)" data-target_element="shopaholics-anonymous">Shopaholic Anonymous</a></li>

            <li class="nav-item"><a class="nav-link" href="#weather"  data-toggle="tab" onclick="fetchWeather(this)" data-lat="{{$location->latitude ?? ''}}" data-long="{{$location->longitude ?? ''}}" data-address="{{$location->map_address ?? ''}}" data-name="{{$location->name ?? ''}}">Weather</a></li>

            <li  class="nav-item"><a class="nav-link" data-toggle="tab" href="#location" >Location</a></li>

          </ul>

          <div class="tab-content">
           <!-- places start -->
           <div class="tab-pane active" id="places">

           </div>
           <!-- places end -->
         
           <!-- best time to visit start -->
           <div class="tab-pane" id="best_time_to_visit">

           </div>
           <!-- best time to visit end -->
           <!-- how to reach start -->
           <div class="tab-pane" id="how_to_reach">

           </div>
           <!-- how to reach end -->
           <!-- fair and festivals start -->
           <div class="tab-pane" id="fair_and_festivals">

           </div>
           <!-- fair and festivals end -->
           <!-- culinary retreat start -->
           <div class="tab-pane" id="culinary_retreat">

           </div>
           <!-- culinary retreat end -->
           <!-- shopaholics anonymous start -->
           <div class="tab-pane" id="shopaholics_anonymous">

           </div>
           <!-- shopaholics anonymous end -->
           <!-- weather start -->
           <div class="tab-pane" id="weather">

           </div>
           <!-- weather end -->
           <!-- location start -->
           <div class="tab-pane" id="location">
            <div id="map-street" style="height: 600px; width:100%" lat="{{ $location->latitude }}"
              lng="{{ $location->longitude }}" zoom_level="{{ $location->zoom_level }}">
            </div>
          </div>
          <!-- location end -->
        </div>

      </div>
      <!-- place to visit end -->

        <!--stay start -->
           <div class="tab-pane" id="tab-stay">

           </div>
           <!-- stay end -->
           <!-- package and activity start -->
           <div class="tab-pane" id="tab-packages-activities">

           </div>
           <!-- package and activity end -->
      <!-- need_to_know start -->
      <div class="tab-pane" id="tab-need_to_know">
        <ul class="nav nav-tabs" id="need_to_know_child_tab">
          <li  class="nav-item"><a class="nav-link" href="#tab-get_to_know" data-toggle="tab" onclick="fetchDestinaitonDetail(this)" data-target_element="get-to-know">Get To Know </a></li>
          <li class="nav-item"><a class="nav-link" href="#tab-tourism_zone" data-toggle="tab" onclick="fetchDestinaitonDetail(this)" data-target_element="tourism-zone">Tourism Zone</a></li>
          <li class="nav-item"><a class="nav-link" href="#tab-save_your_pocket" data-toggle="tab" onclick="fetchDestinaitonDetail(this)" data-target_element="save-your-pocket">Save Your Pocket</a></li>
          <li class="nav-item"><a class="nav-link" href="#tab-save_the_environment" data-toggle="tab" onclick="fetchDestinaitonDetail(this)" data-target_element="save-the-environment">Save The Environment</a></li>
          <li class="nav-item"><a class="nav-link" href="#tab-faqs" data-toggle="tab" onclick="fetchDestinaitonDetail(this)" data-target_element="faqs">FAQ’s</a></li>
        </ul>
        <div class="tab-content">
         <!-- get_to_know start -->
         <div class="tab-pane" id="tab-get_to_know" >

         </div>
         <!-- get_to_know end -->
         <!-- tourism_zone start -->
         <div class="tab-pane" id="tab-tourism_zone">

         </div>
         <!-- tourism_zone end -->
         <!-- save_your_pocket start -->
         <div class="tab-pane" id="tab-save_your_pocket">

         </div>
         <!-- save_your_pocket end -->
         <!-- video start -->
         <div class="tab-pane" id="tab-video">

         </div>
         <!-- save_the_environment end -->
         <!-- save_the_environment start -->
         <div class="tab-pane" id="tab-save_the_environment">

         </div>
         <!-- save_the_environment end -->
         <!-- faqs start -->
         <div class="tab-pane" id="tab-faqs">
          
         </div>
         <!-- faqs end -->

       </div>
     </div>
     <!-- need_to_know end -->
     <!-- video start -->
     <div class="tab-pane" id="tab-videos">

     </div>
     <!-- video end -->

   </div>


 </div>
 <div class="col-lg-12 col-md-12 col-sm-12 border-top">
  <!-- market purpose -->
  <div class="market-purpose">
    <section class="Categories pt10 locationsamilar">
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <p class="mt-0 mb-0 nopadding st-heading-section">Similar Destination</p>
            <h4 class="paddtop1 font-weight lspace-sm">You may also like </h4>
          </div>
          <div class="col-md-4 d-lg-flex align-items-center justify-content-end"><a href="{{route('destinations')}}" class="blist text-sm ml-2"> See all locations<i class="fas fa-angle-double-right ml-2"></i></a></div>
        </div>
        <div class="row">
          @if($nearByLocation->count() != 0)
          @foreach($nearByLocation as $near_location)
          <div class="col-md-3 col-sm-3  col-xs-12">
            <div class="listroBox">
             @php $featured_image = (!empty($near_location->featured_image) && isset($near_location->featured_image[0]['id']))?getConversionUrl($near_location->featured_image[0]['id'],'270x200'):null;@endphp
             <figure><a href="{{route('location',$near_location->slug)}}"><img src="{{$featured_image ?? asset('sites/images/dummy/270x200.jpg')}}" class="img-fluid" alt="">
              <div class="read_more"><span>{!!ucwords($near_location->name ?? '')!!}</span></div>
            </a> </figure>
            <div class="listroBoxmain p-2">
              <h2 class="service-title"><a href="{{route('location',$near_location->slug)}}">{!!ucwords($near_location->name ?? '')!!}</a></h2>
              @php
              $address = (!empty($near_location->address ))?$near_location->address:"";
              @endphp
              @if($address)<p class="service-location">{!!getNewIcon('Ico_maps', '#666666', '15px', '15px', true)!!}<span>{!!shortDescription($address,50)!!}</span>@if(strlen($address) > 50)
                &nbsp;<i class="fas fa-plus" data-toggle="modal" data-target="#showMoreData" onclick="showMoreData(this)" data-more_data="{{$address}}" data-more_data_label="Address" style="color:#fba009;"></i>
              @endif</p>@endif
            </div>
            </div>
          </div>
          @endforeach
          @else
          <div class="col-md-8 col-sm-8 col-xs-12 alert alert-warning mt15">No Near By Location found.</div>
          @endif
        </div>
      </div>
    </section>

    <section class="Categories pt10 hotel-samilar">
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <p class="mt-0 mb-0 nopadding st-heading-section">Hotel You May Like</p>
          </div>
          <div class="col-md-4 d-lg-flex align-items-center justify-content-end"><a href="{{route('hotels')}}" class="blist text-sm ml-2"> See all our hotel<i class="fas fa-angle-double-right ml-2"></i></a></div>
        </div>
        <div class="row">
          @if($nearByHotel->count() != 0)
          @foreach($nearByHotel as $near_hotel)
          <div class="col-md-3 col-sm-3  col-xs-12">
            <div class="listroBox">
              @php $featured_image = (!empty($near_hotel->featured_image) && isset($near_hotel->featured_image[0]['id']))?getConversionUrl($near_hotel->featured_image[0]['id'],'270x200'):null;@endphp
              <figure><a href="{{route('location',$near_location->slug)}}"><img src="{{$featured_image ?? asset('sites/images/dummy/270x200.jpg')}}" class="img-fluid" alt="location image">
                <div class="read_more"><span>{!!ucwords($near_hotel->name ?? '')!!}</span></div>
              </a> </figure>
              <div class="listroBoxmain p-2">
                <h2 class="service-title"><a href="{{route('hotel',$near_hotel->slug)}}">{!!ucwords($near_hotel->name ?? '')!!}</a></h2>
                @php
                $address = (!empty($near_hotel->address ))?$near_hotel->address:$near_hotel->hotel_attributes['corporateAddress'];
                @endphp
                <p class="service-location">{!!getNewIcon('Ico_maps', '#666666', '15px', '15px', true)!!}<span>{!!shortDescription($address,30)!!}</span>@if(strlen($address) > 30)
                  &nbsp;<i class="fas fa-plus" data-toggle="modal" data-target="#showMoreData" onclick="showMoreData(this)" data-more_data="{{$address}}" data-more_data_label="Address" style="color:#fba009;"></i>
                @endif</p>@if(!empty($near_hotel->duration_day))
                <p>{!!getNewIcon('time-clock-circle-1', '#5E6D77', '17px', '17px')!!}{!!$near_hotel->duration_day!!}</p>
              @endif</div>
              <ul class="near-price-block">
                <li class="mt-0 mb-0 near-price-block-1">
                  <p class="card-text text-muted ">
                    <span class="h6 text-primary">
                      <span class="hotel-avg">
                        {!!getNewIcon('thunder', '#ffab53', '10px', '16px')!!}
                        Avg
                      </span>
                    {!!get_price($near_hotel)!!}</span> / per night</p>
                  </li>
                </ul>
              </div>
            </div>
            @endforeach
            @else
            <div class="col-md-8 col-sm-8 col-xs-12 alert alert-warning mt15">No Near By Hotels found.</div>
            @endif
          </div>
        </div>
      </section>

      <section class="Categories pt10 toursamilar">
        <div class="container">
          <div class="row">
            <div class="col-md-8">
              <p class="mt-0 mb-0 nopadding st-heading-section">Packages You May Like</p>
            </div>
            <div class="col-md-4 d-lg-flex align-items-center justify-content-end"><a href="{{route('our-packages')}}" class="blist text-sm ml-2"> See all our packages<i class="fas fa-angle-double-right ml-2"></i></a></div>
          </div>
          <div class="row">
            @if($nearByTour->count() != 0)
            @foreach($nearByTour as $near_tour)
            <div class="col-md-3 col-sm-3  col-xs-12">
              <div class="listroBox">
               @php $featured_image = (!empty($near_tour->featured_image) && isset($near_tour->featured_image[0]['id']))?getConversionUrl($near_tour->featured_image[0]['id'],'270x200'):null;@endphp
               <figure><a href="{{route('tour',$near_tour->slug)}}"><img src="{{$featured_image ?? asset('sites/images/dummy/270x200.jpg')}}" class="img-fluid" alt="tour image">
                <div class="read_more"><span>{!!ucwords($near_tour->name ?? '')!!}</span></div>
              </a> </figure>
              <div class="listroBoxmain p-2">
                <h2 class="service-title"><a href="{{route('tour',$near_tour->slug)}}">{!!ucwords($near_tour->name ?? '')!!}</a></h2>
                <p class="service-location">{!!getNewIcon('Ico_maps', '#666666', '15px', '15px', true)!!}<span>{!!shortDescription($near_tour->address ?? '',30)!!}</span>@if(strlen($near_tour->address) > 30)
                  &nbsp;<i class="fas fa-plus" data-toggle="modal" data-target="#showMoreData" onclick="showMoreData(this)" data-more_data="{{$near_tour->address}}" data-more_data_label="Address" style="color:#fba009;"></i>
                @endif</p>
                @if(!empty($near_tour->duration_day))
                <p>{!!getNewIcon('time-clock-circle-1', '#5E6D77', '17px', '17px')!!}{!!$near_tour->duration_day!!}</p>
                @endif

              </div>
              <ul class="near-price-block">
                <li class="mt-0 mb-0 near-price-block-1">
                  <p class="card-text text-muted ">
                    <span class="h6 text-primary">
                      <span class="location-avg">
                        {!!getNewIcon('thunder', '#ffab53', '10px', '16px')!!}
                        Avg
                      </span>
                    {!!get_price($near_tour)!!}</span> / per night</p>
                  </li>
                </ul>
              </div>
            </div>
            @endforeach
            @else
            <div class="col-md-8 col-sm-8 col-xs-12 alert alert-warning mt15">No Near By Packages found.</div>
            @endif
          </div>
        </div>
      </section>

      <section class="Categories pt10 activitysamilar">
        <div class="container">
          <div class="row">
            <div class="col-md-8">
              <p class="mt-0 mb-0 nopadding st-heading-section">Activity You May Like</p>
            </div>
            <div class="col-md-4 d-lg-flex align-items-center justify-content-end"><a href="{{route('activities')}}" class="blist text-sm ml-2"> See all activities<i class="fas fa-angle-double-right ml-2"></i></a></div>
          </div>
          <div class="row">
           @if($nearByActivity->count() != 0)
           @foreach($nearByActivity as $near_activity)
           <div class="col-md-3 col-sm-3  col-xs-12">
            <div class="listroBox">
             @php $featured_image = (!empty($near_activity->featured_image) && isset($near_activity->featured_image[0]['id']))?getConversionUrl($near_activity->featured_image[0]['id'],'270x200'):null;@endphp
             <figure><a href="{{route('activity',$near_activity->slug)}}"><img src="{{$featured_image ?? asset('sites/images/dummy/270x200.jpg')}}" class="img-fluid" alt="activity image">
              <div class="read_more"><span>{!!ucwords($near_activity->name ?? '')!!}</span></div>
            </a> </figure>
            <div class="listroBoxmain p-2">
              <h2 class="service-title"><a href="{{route('activity',$near_activity->slug)}}">{!!ucwords($near_activity->name ?? '')!!}</a></h2>
              <p class="service-location">{!!getNewIcon('Ico_maps', '#666666', '15px', '15px', true)!!}<span>{!!shortDescription($near_activity->address ?? '',30)!!}</span>@if(strlen($near_activity->address) > 30)
                &nbsp;<i class="fas fa-plus" data-toggle="modal" data-target="#showMoreData" onclick="showMoreData(this)" data-more_data="{{$near_activity->address}}" data-more_data_label="Address" style="color:#fba009;"></i>
              @endif</p></div>
              <ul>
                <li class="mt-0 mb-0">
                  <p class="card-text text-muted ">
                    <span class="h6 text-primary">
                      <span class="location-avg">
                       {!!getNewIcon('thunder', '#ffab53', '10px', '16px')!!}
                       Avg
                     </span>
                   {!!get_price($near_activity)!!}</span></p>
                 </li>
                 <li class="mt-0 mb-0">
                  {{--<a href="{{route('activity',$near_activity->slug)}}" class="btn btn-grad text-white mt-0 mb-0 btn-sm">View Detail</a>--}}

                </li>
              </ul>
            </div>
          </div>
          @endforeach
          @else
          <div class="col-md-8 col-sm-8 col-xs-12 alert alert-warning mt15">No Near By Activities found.</div>
          @endif
        </div>
      </div>
    </section>

  </div>

</div>
</div>
</div>

</section>

@endsection
