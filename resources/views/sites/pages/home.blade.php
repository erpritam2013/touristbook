@extends('sites.layouts.main')
@section('title',$title)
@section('content')
@if(auth()->check())
@if(auth()->user()->isAdmin() || auth()->user()->isEditor())
@section('get_a_link')
@if(!isMobileDevice())
@php $top = 'top:32px;position:relative;';@endphp
@endif
{!!get_a_link($title,route('admin.pages.edit',$page->id ?? ''))!!}
@endsection
@endif 
@endif
@php
$banner_image = null;
if(isset($page)) {
  if(isJson($page->featured_image)){
    $page->featured_image = json_decode($page->featured_image,true);
  }
  $banner_image = (!empty($page->featured_image) && isset($page->featured_image[0]['id']))?getConversionUrl($page->featured_image[0]['id']):null;
}

@endphp
    <!-- =======================
     Main Banner -->
     <section class="p-0 height-475 parallax-bg"
     style="background:url({{$banner_image ?? asset('sites/images/dummy/1200x400.jpg')}}) no-repeat 65% 0%; background-size:110% 125%;{!! $top ?? ''!!}">
     <div class="container h-100">
      <div class="row justify-content-between align-items-center h-100">
        <div class="col-md-8 mb-7">
          <h3 class="white-text display-4 font-weight-bold">Hi There! </h3>
          <p class="white-text">Where would you like to go?</p>

          <section class=" mt-lg-5 pb-0 z-index-9 booking-search">
            <div class="container ">
              <div class="row border-radius-3">
                <div class="col-md-12 np">
                  <div class="feature-box h-100">
                    <div class="tab_container" data-tabs="5">
                      <input id="tab1" type="radio" name="tabs" checked data-index="1">
                      <label for="tab1"><i class="fas fa-utensils"></i><span>Hotels</span></label>
                      <input id="tab2" type="radio" name="tabs" data-index="2">
                      <label for="tab2"><i class="fas fa-map-marker"></i><span>Destination</span></label>
                      <input id="tab3" type="radio" name="tabs" data-index="3">
                      <label for="tab3"><i class="fas fa-hiking"></i><span>Activity</span></label>
                      {{--<input id="tab4" type="radio" name="tabs" data-index="4">
                      <label for="tab4"><i class="fas fa-ship"></i><span>Cruises</span></label>--}}
                      <input id="tab5" type="radio" name="tabs" data-index="5">
                      <label for="tab5"><i class="fas fa-route"></i><span>Tour Packages</span></label>
                      <section id="content1" class="tab-content">
                        <form action="{{route('hotels')}}" class="form" method="get" id="home-hotels-form">
                          <div class="row">
                            <div class="col-lg-10 col-md-6 col-sm-6 col-xs-12 padding8">
                              <div class="form-group"> <span class="fas fa-map-marker-alt"></span>
                                <input class="form-control input-search-box" type="text"
                                placeholder="Where are you going?" name="search" data-form_id="#home-hotels-form">
                                <div id="home-extra-input-field-1">

                                 <input type="hidden" name="source_type" value="" />
                                 <input type="hidden" name="source_id" value="" />

                               </div>
                             </div>
                           </div>
                           {{--<div class="col-lg-2 col-md-6 col-sm-6 col-xs-12 padding8">
                            <div class="form-group"> <span class="far fa-calendar-alt"></span>
                              <input class="form-control" type="text" id="datepicker" autocomplete="off"
                              placeholder="Check-in">
                            </div>
                          </div>
                          <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12 padding8">
                            <div class="form-group"> <span class="far fa-calendar-alt"></span>
                              <input class="form-control" type="text" id="datepicker-out"
                              autocomplete="off" placeholder="Check-out">
                            </div>
                          </div>
                          <div class="col-lg-1 col-md-6 col-sm-6 col-xs-12 padding8">
                            <div class="form-group">
                              <select class="custom-select select-big">
                                <option selected="">Rooms</option>
                                <option value="location1">01</option>
                                <option value="location2">02</option>
                                <option value="location3">03</option>
                                <option value="location4">04</option>
                                <option value="location5">05</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-lg-1 col-md-6 col-sm-6 col-xs-12 padding8">
                            <div class="form-group">
                              <select class="custom-select select-big">
                                <option selected="">Guests</option>
                                <option value="location1">01</option>
                                <option value="location2">02</option>
                                <option value="location3">03</option>
                                <option value="location4">04</option>
                                <option value="location5">05</option>
                              </select>
                            </div>
                          </div>--}}
                          <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12 padding8">
                            <div class="form-group">
                              <button class="btn btn-primary btn-lg btn-grad" type="submit">Search</button>
                            </div>
                          </div>
                        </div>
                      </form>
                    </section>
                    <section id="content2" class="tab-content">
                      <form action="{{route('destinations')}}" class="form" method="get" id="home-destinations-form">
                        <div class="row">
                          <div class="col-lg-10 col-md-6 col-sm-6 col-xs-12 padding8">
                            <div class="form-group"> <span class="fas fa-map-marker-alt"></span>
                              <input class="form-control input-search-box" type="text"
                              placeholder="Search Destination By Location...." name="search" data-form_id="#home-destinations-form">
                              <div id="home-extra-input-field-2">

                              </div>
                            </div>
                          </div>
                          {{--<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 padding8">
                            <div class="form-group"> <span class="fas fa-map-marker-alt"></span>
                              <input class="form-control" type="text"
                              placeholder="To : City, Airport, U.S. Zip">
                            </div>
                          </div>
                          <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12 padding8">
                            <div class="form-group"> <span class="far fa-calendar-alt"></span>
                              <input class="form-control" type="text" id="datepicker-1"
                              autocomplete="off" placeholder="Departing">
                            </div>
                          </div>
                          <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12 padding8">
                            <div class="form-group"> <span class="far fa-calendar-alt"></span>
                              <input class="form-control" type="text" id="datepicker-2"
                              autocomplete="off" placeholder="Returning">
                            </div>
                          </div>--}}
                          <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12 padding8">
                            <div class="form-group">
                              <button class="btn btn-primary btn-lg btn-grad" type="submit">Search</button>
                            </div>
                          </div>
                        </div>
                      </form>
                    </section>
                    <section id="content3" class="tab-content">
                      <form action="{{route('activities')}}" class="form" method="get" id="home-activities-form">
                        <div class="row">
                          <div class="col-lg-10 col-md-6 col-sm-6 col-xs-12 padding8">
                            <div class="form-group"> <span class="fas fa-map-marker-alt"></span>
                              <input class="form-control input-search-box" type="text" placeholder="Search Activity By Location...." name="search" data-form_id="#home-activities-form">
                              <div id="home-extra-input-field-3">

                              </div>
                            </div>
                          </div>
                          {{--<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 padding8">
                            <div class="form-group"> <span class="fas fa-map-marker-alt"></span>
                              <input class="form-control" type="text" placeholder="Drop-off Location">
                            </div>
                          </div>
                          <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12 padding8">
                            <div class="form-group"> <span class="far fa-calendar-alt"></span>
                              <input class="form-control" type="text" id="datepicker-3"
                              autocomplete="off" placeholder="Pick-up Date">
                            </div>
                          </div>
                          <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12 padding8">
                            <div class="form-group"> <span class="far fa-calendar-alt"></span>
                              <input class="form-control" type="text" id="datepicker-4"
                              autocomplete="off" placeholder="Drop-ff Date">
                            </div>
                          </div>--}}
                          <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12 padding8">
                            <div class="form-group">
                              <button class="btn btn-primary btn-lg btn-grad" type="submit">Search</button>
                            </div>
                          </div>
                        </div>
                      </form>
                    </section>
                    {{--<section id="content4" class="tab-content">
                      <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 padding8">
                          <div class="form-group"> <span class="fas fa-map-marker-alt"></span>
                            <input class="form-control" type="text"
                            placeholder="enter a destination or hotel name">
                          </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12 padding8">
                          <div class="form-group"> <span class="far fa-calendar-alt"></span>
                            <input class="form-control" type="text" id="datepicker-5"
                            autocomplete="off" placeholder="Departure Date">
                          </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12 padding8">
                          <div class="form-group">
                            <select class="custom-select select-big">
                              <option selected="">Cruise Length</option>
                              <option value="location1">1-2 Night</option>
                              <option value="location2">2-3 Night</option>
                              <option value="location3">3-4 Night</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12 padding8">
                          <div class="form-group">
                            <select class="custom-select select-big">
                              <option selected="">Cruise Line</option>
                              <option value="location1">Azamara Club Cruises</option>
                              <option value="location2">Celebrity Cruises</option>
                              <option value="location3">Cruise & Maritime</option>
                              <option value="location4">Oceania Cruises</option>
                              <option value="location5">Peter Deilmann Cruises</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12 padding8">
                          <div class="form-group">
                            <button class="btn btn-primary btn-lg btn-grad" type="submit">Search</button>
                          </div>
                        </div>
                      </div>
                    </section>--}}
                    <section id="content5" class="tab-content">
                      <form action="{{route('our-packages')}}" class="form" method="get" id="#home-our-packages-form">
                        <div class="row">
                          <div class="col-lg-10 col-md-6 col-sm-6 col-xs-12 padding8">
                            <div class="form-group"> <span class="fas fa-map-marker-alt"></span>
                              <input class="form-control input-search-box" type="text"
                              placeholder="Search Package By Location...." name="search" data-form_id="#home-our-packages-form">
                              <div id="home-extra-input-field-5">

                              </div>
                            </div>
                          </div>
                          {{--<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 padding8">
                            <div class="form-group"> <span class="fas fa-map-marker-alt"></span>
                              <input class="form-control" type="text"
                              placeholder="To : City, Airport, U.S. Zip">
                            </div>
                          </div>
                          <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12 padding8">
                            <div class="form-group"> <span class="far fa-calendar-alt"></span>
                              <input class="form-control" type="text" id="datepicker-6"
                              autocomplete="off" placeholder="Departing">
                            </div>
                          </div>
                          <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12 padding8">
                            <div class="form-group"> <span class="far fa-calendar-alt"></span>
                              <input class="form-control" type="text" id="datepicker-7"
                              autocomplete="off" placeholder="Returning">
                            </div>
                          </div>--}}
                          <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12 padding8">
                            <div class="form-group">
                              <button class="btn btn-primary btn-lg btn-grad" type="submit">Search</button>
                            </div>
                          </div>
                        </div>
                      </p>
                    </section>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div id="search-result-info"></div>
        </section>


      </div>
    </div>
  </div>
</section>
    <!-- =======================
      Main banner -->

      @php
      $pt = (!isMobileDevice() && auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isEditor()))?"pt60":"pt30";
      @endphp

      <section class="Categories {{$pt}} pb10">
        <div class="container">
          <div class="row mb-5">
            <div class="col-md-8">
              <p class="subtitle text-secondary nopadding">MOST POPULAR DESTINAITON</p>
              <h1 class="paddtop1 font-weight lspace-sm">Destination</h1>
            </div>
            <div class="col-md-4 d-lg-flex align-items-center justify-content-end"><a href="{{route('destinations')}}"
              class="blist text-sm ml-2"> See all destination<i class="fas fa-angle-double-right ml-2"></i></a></div>
            </div>
            <div class="row">
              @if($home_destinations->isNotEmpty())
              @php 
              $first_destination_image = null;
              if(isJson($home_destinations[0]->featured_image)){
                $home_destinations[0]->featured_image = json_decode($home_destinations[0]->featured_image,true);
              }
              $first_destination_image = (!empty($home_destinations[0]->featured_image) && isset($home_destinations[0]->featured_image[0]['id']))?getConversionUrl($home_destinations[0]->featured_image[0]['id']):null;
              @endphp
              <div class="col-md-6"> <a href="{{route('location',$home_destinations[0]->slug ?? '')}}">
                <div class="list-mig-like-com">
                  <div class="list-mig-lc-img"> <img src="{{$first_destination_image ?? asset('sites/images/dummy/1200x400.jpg')}}" alt="{{touristbook_sanitize_title($home_destinations[0]->name ?? "")}}-image" id="home-destination-image"> </div>
                  <div class="list-mig-lc-con">
                    <h5>{{$home_destinations[0]->name ?? ""}}</h5>
                    {{--<p>81 Cities </p>--}}
                  </div>
                </div>
              </a> </div>

              <div class="col-md-6">
                <div class="row">
                  @foreach($home_destinations as $d_key => $destination)
                  @if($d_key != 0)
                  @php 
                  $destination_image = null;
                  if(isJson($destination->featured_image)){
                    $destination->featured_image = json_decode($destination->featured_image,true);
                  }
                  $destination_image = (!empty($destination->featured_image) && isset($destination->featured_image[0]['id']))?getConversionUrl($destination->featured_image[0]['id']):null;
                  @endphp
                  <div class="col-md-6"> <a href="{{route('location',$destination->slug ?? '')}}">
                    <div class="list-mig-like-com">
                      <div class="list-mig-lc-img"> <img src="{{$destination_image ?? asset('sites/images/dummy/450x417.jpg')}}" alt="{{touristbook_sanitize_title($destination->name ?? "")}}-image"  class="home-destination-image"> </div>
                      <div class="list-mig-lc-con list-mig-lc-con2">
                        <h5>{{$destination->name ?? ""}}</h5>
                        {{--<p>81 Cities </p>--}}
                      </div>
                    </div>
                  </a> </div>
                  @endif
                  @endforeach
                </div>
              </div>
              @endif
            </div>
          </div>
        </section>
        {{--<section class="grayBG pt20 pb10">
          <div class="container ">
            <div class="row">
              <div class="col-md-8 mx-auto text-center mb-5">
                <h2 class="title text-center">Our Services</h2>
                <p>Sorem ipsum dolor sit amet, consectetur adipisicing Suscipit votas aperiam Sorem ipsum dolor
                consectur adipisicing elit.</p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="feature-box h-100 text-center px-4 py-5">
                  <div class="feature-box-icon"><img class="w-25" src="{{asset('sites/images/tour/check-mark.svg')}}"
                    alt=""></div>
                    <h3 class="feature-box-title">Hotel Booking</h3>
                    <p class="feature-box-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean
                    condimentum, eros eu tristique dictum, neque lorem laoreet purus</p>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="feature-box h-100 text-center all-text-white bg-grad px-4 py-5 border-radius-3">
                    <div class="feature-box-icon"><img class="w-25" src="{{asset('sites/images/tour/editor.svg')}}" alt="">
                    </div>
                    <h3 class="feature-box-title">Ticket Booking</h3>
                    <p class="feature-box-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean
                    condimentum, eros eu tristique dictum, neque lorem laoreet</p>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="feature-box h-100 text-center px-4 py-5">
                    <div class="feature-box-icon"><img class="w-25" src="{{asset('sites/images/tour/envelope.svg')}}" alt="">
                    </div>
                    <h3 class="feature-box-title">Amazing Tour</h3>
                    <p class="feature-box-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean
                    condimentum, eros eu tristique dictum, neque lorem laoreet </p>
                  </div>
                </div>
              </div>
            </div>
          </section>--}}


          <section class="Categories pt20 pb10 home-hotels">
            <div class="container">
              <div class="row mb-5">
                <div class="col-md-8">
                  <p class="subtitle text-secondary nopadding">Stay and Hotel</p>
                  <h1 class="paddtop1 font-weight lspace-sm">Hotels</h1>
                </div>
                <div class="col-md-4 d-lg-flex align-items-center justify-content-end"><a href="{{route('hotels')}}"
                  class="blist text-sm ml-2"> See all Hotels<i class="fas fa-angle-double-right ml-2"></i></a></div>
                </div>
                <div class="swiper-container guides-slider-popular swiper-container-horizontal">
                  <div class="swiper-wrapper">
                    @if($home_hotels->isNotEmpty())
                    @foreach($home_hotels as $home_hotel)
                    @php 
                    $home_hotel_image = null;
                    if(isJson($home_hotel->featured_image)){
                      $home_hotel->featured_image = json_decode($home_hotel->featured_image,true);
                    }
                    $home_hotel_image = (!empty($home_hotel->featured_image) && isset($home_hotel->featured_image[0]['id']))?getConversionUrl($home_hotel->featured_image[0]['id']):null;
                    @endphp
                    <div class="swiper-slide h-auto px-2">
                      <div class="listroBox">
                        <figure> {{--<a href="{{route('hotel',$home_hotel->slug ?? '')}}" class="wishlist_bt"></a>--}} <a
                          href="{{route('hotel',$home_hotel->slug ?? '')}}"><img src="{{$home_hotel_image ?? asset('sites/images/dummy/450x417.jpg')}}" class="img-fluid"
                          alt="">
                          <div class="read_more"><span>Hotel Detail</span></div>
                        </a> </figure>
                        <div class="listroBoxmain">
                          <h3 class="home-hotel-title"><a href="{{route('hotel',$home_hotel->slug ?? '')}}">{{$home_hotel->name ?? ''}}</a></h3>
                          @if(!empty($home_hotel->address))
                          <p>{!!getNewIcon('Ico_maps', '#666666', '15px', '15px', true)!!} {{$home_hotel->address ?? ''}}</p>
                          @endif
                          {{--<a class="address" href="#">Get directions</a>--}}
                        </div>
                        <ul>
                          <li>

                            <p class="card-text text-muted"><span class="hotel-avg">
                              {!!getNewIcon('thunder', '#ffab53', '10px', '16px')!!}
                              Avg
                            </span>

                            {!!get_price($home_hotel)!!}

                            <span class="unit">/per night</span></p>
                          </li>
                          <li class="mt-0">
                            <a href="{{route('hotel',$home_hotel->slug ?? '')}}" class="btn btn-grad btn-sm">Hotel Detail</a>
                          </li>
                        </ul>
                      </div>
                    </div>
                    @endforeach
                    @endif
                  </div>
                </div>
              </div>

            </section>


            
            <section class="Categories pt20 pb10 home-tours">
              <div class="container">
                <div class="row mb-5">
                  <div class="col-md-8">
                    <p class="subtitle text-secondary nopadding">Our Packages</p>
                    <h1 class="paddtop1 font-weight lspace-sm">Packages</h1>
                  </div>
                  <div class="col-md-4 d-lg-flex align-items-center justify-content-end"><a href="{{route('our-packages')}}"
                    class="blist text-sm ml-2"> See all Tours<i class="fas fa-angle-double-right ml-2"></i></a></div>
                  </div>
                  <div class="swiper-container guides-slider-popular swiper-container-horizontal">
                    <div class="swiper-wrapper">
                      @if($home_tours->isNotEmpty())
                      @foreach($home_tours as $home_tour)
                      @php 
                      $home_tour_image = null;
                      if(isJson($home_tour->featured_image)){
                        $home_tour->featured_image = json_decode($home_tour->featured_image,true);
                      }
                      $home_tour_image = (!empty($home_tour->featured_image) && isset($home_tour->featured_image[0]['id']))?getConversionUrl($home_tour->featured_image[0]['id']):null;
                      @endphp
                      <div class="swiper-slide h-auto px-2">
                        <div class="listroBox">
                          <figure> {{--<a href="{{route('tour',$home_tour->slug ?? '')}}" class="wishlist_bt"></a>--}} <a
                            href="{{route('tour',$home_tour->slug ?? '')}}"><img src="{{$home_tour_image ?? asset('sites/images/dummy/450x417.jpg')}}" class="img-fluid"
                            alt="">
                            <div class="read_more"><span>Tour Detail</span></div>
                          </a> </figure>
                          <div class="listroBoxmain">
                            <h3 class="home-tour-title"><a href="{{route('tour',$home_tour->slug ?? '')}}">{{$home_tour->name ?? ''}}</a></h3>
                            @if(!empty($home_tour->address))
                            <p>{!!getNewIcon('Ico_maps', '#666666', '15px', '15px', true)!!} {{$home_tour->address ?? $home_tour->detail->map_location}}</p>
                            @endif
                            {{--<a class="address" href="#">Get directions</a>--}}
                          </div>
                          <ul>
                            <li>
                              <p class="card-text text-muted"><span class="tour-avg">
                                {!!getNewIcon('thunder', '#ffab53', '10px', '16px')!!}
                                Avg
                              </span>
                              {!!get_price($home_tour)!!}
                              <span class="unit">/per night</span></p>
                            </li>
                            <li class="mt-0">
                              <a href="{{route('tour',$home_tour->slug ?? '')}}" class="btn btn-grad btn-sm">Tour Detail</a>
                            </li>
                          </ul>
                        </div>
                      </div>
                      @endforeach
                      @endif
                    </div>
                  </div>
                </div>

              </section>
        
            
             <section class="Categories pt20 pb10 home-activities">
                <div class="container">
                  <div class="row mb-5">
                    <div class="col-md-8">
                      <p class="subtitle text-secondary nopadding">Activities</p>
                      <h1 class="paddtop1 font-weight lspace-sm">Activities</h1>
                    </div>
                    <div class="col-md-4 d-lg-flex align-items-center justify-content-end"><a href="{{route('activities')}}"
                      class="blist text-sm ml-2"> See all Activities<i class="fas fa-angle-double-right ml-2"></i></a></div>
                    </div>
                    <div class="swiper-container guides-slider-popular swiper-container-horizontal">
                      <div class="swiper-wrapper">
                        @if($home_activities->isNotEmpty())
                        @foreach($home_activities as $home_activity)
                        @php 
                        $home_activity_image = null;
                        if(isJson($home_activity->featured_image)){
                          $home_activity->featured_image = json_decode($home_activity->featured_image,true);
                        }
                        $home_activity_image = (!empty($home_activity->featured_image) && isset($home_activity->featured_image[0]['id']))?getConversionUrl($home_activity->featured_image[0]['id']):null;
                        @endphp
                        <div class="swiper-slide h-auto px-2">
                          <div class="listroBox">
                            <figure> {{--<a href="{{route('activity',$home_activity->slug ?? '')}}" class="wishlist_bt"></a>--}} <a
                              href="{{route('activity',$home_activity->slug ?? '')}}"><img src="{{$home_activity_image ?? asset('sites/images/dummy/450x417.jpg')}}" class="img-fluid"
                              alt="">
                              <div class="read_more"><span>Activity Detail</span></div>
                            </a> </figure>
                            <div class="listroBoxmain">
                              <h3 class="home-activity-title"><a href="{{route('activity',$home_activity->slug ?? '')}}">{{$home_activity->name ?? ''}}</a></h3>
                              @if(!empty($home_activity->address))
                              <p>{!!getNewIcon('Ico_maps', '#666666', '15px', '15px', true)!!} {{$home_activity->address ?? $home_activity->detail->map_location}}</p>
                              @endif
                              {{--<a class="address" href="#">Get directions</a>--}}
                            </div>
                            <ul>
                              <li>
                                <p class="card-text text-muted"><span class="activity-avg">
                                  {!!getNewIcon('thunder', '#ffab53', '10px', '16px')!!}
                                  Avg
                                </span>
                                {!!get_price($home_activity)!!}</p>
                              </li>
                              <li class="mt-0">
                                <a href="{{route('activity',$home_activity->slug ?? '')}}" class="btn btn-grad btn-sm">Activity Detail</a>
                              </li>
                            </ul>
                          </div>
                        </div>
                        @endforeach
                        @endif
                      </div>
                    </div>
                  </div>

                </section>

                 <section class="Categories pt20 pb10 home-blogs">
  <div class="container">
    <div class="row mb-5">
      <div class="col-md-8">
        <p class="subtitle text-secondary nopadding">Blogs</p>
        <h1 class="paddtop1 font-weight lspace-sm">Blogs</h1>
      </div>
      <div class="col-md-4 d-lg-flex align-items-center justify-content-end"><a href="{{route('blogs')}}"
        class="blist text-sm ml-2"> See all Blogs<i class="fas fa-angle-double-right ml-2"></i></a></div>
      </div>

      <div class="row post-lists"> 

        @if($home_posts->isNotEmpty())
        <!-- blog item-->
        @foreach($home_posts as $home_post)
        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-4 post-item">
          <div class="card shadow  h-100"><a href="{{route('blog',$home_post->slug)}}">
           @php $featured_image = (!empty($home_post->featured_image) && isset($home_post->featured_image[0]['id']))?getConversionUrl($home_post->featured_image[0]['id'],'600x250'):null;@endphp
           <img src="{{$featured_image ?? asset('sites/images/dummy/600x250.jpg')}}" alt="post-image" class="post-image" width="768" height="368">               
         </a>
         <div class="card-body">
          <h5 class="my-2"><a href="{{route('blog',$home_post->slug)}}" class="post-title text-dark">{{shortDescription($home_post->name ?? '',35)}}</a></h5>
          <p class="text-gray-500 text-sm my-3 post-desc"><i class="far fa-clock mr-2"></i>{{date('M d, Y',strtotime($home_post->created_at))}}</p>
          {{--<p class="my-2 text-muted text-sm">{{shortDescription($home_post->excerpt ?? '',45)}}</p>--}}
          <a href="{{route('blog',$home_post->slug)}}" class="btn btn-link pl-0 post-read-more">Read more</a> </div>
        </div>
      </div>
      @endforeach
      @endif
      
    </div>
  </div>

</section>
    <!-- =======================
      service -->
      {{--<section class="service pt80 pb80 service-home">
        <div class="container">
          <div class="row">
            <div class="col-12 col-lg-8 mx-auto">
              <div class="title text-center">
                <h2>Did you know?</h2>
                <p class="mb-0">Mauris ullamcorper nibh quis leo ultrices in hendrerit velit tristiqueut augue in
                  nulla lacinia bibendum liberoras rutrum ac purus ut tristique. Nullam placerat lacinia dolor
                quis pretium. Phasellus vitae lacinia quam</p>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4 mt-30">
              <div class="featureBox icon-grad h-100">
                <div class="feature-box-icon"><i class="fas fa-route"></i></div>
                <h3 class="feature-box-title">Best Travel Agent</h3>
                <p class="feature-box-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua.</p>
                <a class="mt-3" href="#">See more!</a>
              </div>
            </div>
            <div class="col-md-4 mt-30">
              <div class="featureBox icon-grad h-100">
                <div class="feature-box-icon"><i class="fab fa-avianex"></i></div>
                <h3 class="feature-box-title">Trust & Safety</h3>
                <p class="feature-box-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua.</p>
                <a class="mt-3" href="#">See more!</a>
              </div>
            </div>
            <div class="col-md-4 mt-30">
              <div class="featureBox icon-grad h-100">
                <div class="feature-box-icon"><i class="fas fa-bullhorn"></i></div>
                <h3 class="feature-box-title">Best Price Guarantee</h3>
                <p class="feature-box-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua.</p>
                <a class="mt-3" href="#">See more!</a>
              </div>
            </div>
          </div>
        </div>
      </section>--}}
    <!-- =======================
      service -->

      {{--<section class="Categories pt80 pb60 Categories-home">
        <div class="container">
          <div class="row mb-5">
            <div class="col-md-8">
              <p class="subtitle text-secondary nopadding">Stay and eat like a local</p>
              <h1 class="paddtop1 font-weight lspace-sm">Latest Cruises</h1>
            </div>
            <div class="col-md-4 d-lg-flex align-items-center justify-content-end"><a href="#"
              class="blist text-sm ml-2"> See all Cruises<i class="fas fa-angle-double-right ml-2"></i></a>
            </div>
          </div>
          <div class="row">
            <div class="swiper-container guides-slider-home-cruises">
              <!-- Additional required wrapper-->
              <div class="swiper-wrapper">
                <!-- Slides-->

                <div class="swiper-slide h-auto px-2">
                  <div class="listing-item ">
                    <article class="TravelGo-category-listing fl-wrap">
                      <div class="TravelGo-category-img"> <a href="hotel-detailed.html"><img
                        src="{{asset('sites/images/cruises/1.jpg')}}" alt=""></a>
                        <div class="TravelGo-category-opt">
                          <div class="listing-rating card-popup-rainingvis" data-starrating2="5"><i
                            class="fa fa-star"></i><i class="fa fa-star"></i><i
                            class="fa fa-star"></i><i class="fa fa-star"></i><i
                            class="fa fa-star"></i></div>
                            <div class="rate-class-name">
                              <div class="score"><strong>Very Good</strong>27 Reviews </div>
                              <span>5.0</span>
                            </div>
                          </div>
                        </div>
                        <div class="TravelGo-category-content fl-wrap title-sin_item">
                          <div class="TravelGo-category-content-title fl-wrap">
                            <div class="TravelGo-category-content-title-item">
                              <h3 class="title-sin_map"><a href="hotel-detailed.html">Asia & African
                              Cruise</a></h3>
                              <div class="TravelGo-category-location fl-wrap"><a href="#"
                                class="map-item"><i class="fas fa-map-marker-alt"></i> 27th
                              Brooklyn New York, USA</a> <span>$ 200</span> </div>
                            </div>
                          </div>
                          <p>Sed interdum metus at nisi tempor laoreet. Integer gravida orci a justo sodales.
                          </p>
                          <ul class="facilities-list fl-wrap">
                            <li><i class="fas fa-wifi"></i><span>Free WiFi</span></li>
                            <li><i class="fas fa-parking"></i><span>Parking</span></li>
                            <li><i class="fas fa-smoking-ban"></i><span>Non-smoking Rooms</span></li>
                            <li><i class="fas fa-utensils"></i><span> Restaurant</span></li>
                          </ul>
                          <div class="TravelGo-category-footer fl-wrap">
                            <div class="TravelGo-category-price btn-grad"><span>2 days 3 nights</span>
                            </div>
                            <div class="TravelGo-opt-list"> <a href="#" class="single-map-item"><i
                              class="fas fa-map-marker-alt"></i><span
                              class="TravelGo-opt-tooltip">On the map</span></a> <a
                              href="#" class="TravelGo-js-favorite"><i
                              class="fas fa-heart"></i><span
                              class="TravelGo-opt-tooltip">Save</span></a> <a href="#"
                              class="TravelGo-js-booking"><i class="fas fa-retweet"></i><span
                              class="TravelGo-opt-tooltip">Find Directions</span></a> </div>
                            </div>
                          </div>
                        </article>
                      </div>
                    </div>
                    <div class="swiper-slide h-auto px-2">
                      <div class="listing-item ">
                        <article class="TravelGo-category-listing fl-wrap">
                          <div class="TravelGo-category-img"> <a href="hotel-detailed.html"><img
                            src="{{asset('sites/images/cruises/2.jpg')}}" alt=""></a>
                            <div class="TravelGo-category-opt">
                              <div class="listing-rating card-popup-rainingvis" data-starrating2="5"><i
                                class="fa fa-star"></i><i class="fa fa-star"></i><i
                                class="fa fa-star"></i><i class="fa fa-star"></i><i
                                class="fa fa-star"></i></div>
                                <div class="rate-class-name">
                                  <div class="score"><strong>Very Good</strong>27 Reviews </div>
                                  <span>5.0</span>
                                </div>
                              </div>
                            </div>
                            <div class="TravelGo-category-content fl-wrap title-sin_item">
                              <div class="TravelGo-category-content-title fl-wrap">
                                <div class="TravelGo-category-content-title-item">
                                  <h3 class="title-sin_map"><a href="hotel-detailed.html">Asia & African
                                  Cruise</a></h3>
                                  <div class="TravelGo-category-location fl-wrap"><a href="#"
                                    class="map-item"><i class="fas fa-map-marker-alt"></i> 27th
                                  Brooklyn New York, USA</a> <span>$ 200</span> </div>
                                </div>
                              </div>
                              <p>Sed interdum metus at nisi tempor laoreet. Integer gravida orci a justo sodales.
                              </p>
                              <ul class="facilities-list fl-wrap">
                                <li><i class="fas fa-wifi"></i><span>Free WiFi</span></li>
                                <li><i class="fas fa-parking"></i><span>Parking</span></li>
                                <li><i class="fas fa-smoking-ban"></i><span>Non-smoking Rooms</span></li>
                                <li><i class="fas fa-utensils"></i><span> Restaurant</span></li>
                              </ul>
                              <div class="TravelGo-category-footer fl-wrap">
                                <div class="TravelGo-category-price btn-grad"><span>2 days 3 nights</span>
                                </div>
                                <div class="TravelGo-opt-list"> <a href="#" class="single-map-item"><i
                                  class="fas fa-map-marker-alt"></i><span
                                  class="TravelGo-opt-tooltip">On the map</span></a> <a
                                  href="#" class="TravelGo-js-favorite"><i
                                  class="fas fa-heart"></i><span
                                  class="TravelGo-opt-tooltip">Save</span></a> <a href="#"
                                  class="TravelGo-js-booking"><i class="fas fa-retweet"></i><span
                                  class="TravelGo-opt-tooltip">Find Directions</span></a> </div>
                                </div>
                              </div>
                            </article>
                          </div>
                        </div>
                        <div class="swiper-slide h-auto px-2">
                          <div class="listing-item ">
                            <article class="TravelGo-category-listing fl-wrap">
                              <div class="TravelGo-category-img"> <a href="hotel-detailed.html"><img
                                src="{{asset('sites/images/cruises/3.jpg')}}" alt=""></a>
                                <div class="TravelGo-category-opt">
                                  <div class="listing-rating card-popup-rainingvis" data-starrating2="5"><i
                                    class="fa fa-star"></i><i class="fa fa-star"></i><i
                                    class="fa fa-star"></i><i class="fa fa-star"></i><i
                                    class="fa fa-star"></i></div>
                                    <div class="rate-class-name">
                                      <div class="score"><strong>Very Good</strong>27 Reviews </div>
                                      <span>5.0</span>
                                    </div>
                                  </div>
                                </div>
                                <div class="TravelGo-category-content fl-wrap title-sin_item">
                                  <div class="TravelGo-category-content-title fl-wrap">
                                    <div class="TravelGo-category-content-title-item">
                                      <h3 class="title-sin_map"><a href="hotel-detailed.html">Asia & African
                                      Cruise</a></h3>
                                      <div class="TravelGo-category-location fl-wrap"><a href="#"
                                        class="map-item"><i class="fas fa-map-marker-alt"></i> 27th
                                      Brooklyn New York, USA</a> <span>$ 200</span> </div>
                                    </div>
                                  </div>
                                  <p>Sed interdum metus at nisi tempor laoreet. Integer gravida orci a justo sodales.
                                  </p>
                                  <ul class="facilities-list fl-wrap">
                                    <li><i class="fas fa-wifi"></i><span>Free WiFi</span></li>
                                    <li><i class="fas fa-parking"></i><span>Parking</span></li>
                                    <li><i class="fas fa-smoking-ban"></i><span>Non-smoking Rooms</span></li>
                                    <li><i class="fas fa-utensils"></i><span> Restaurant</span></li>
                                  </ul>
                                  <div class="TravelGo-category-footer fl-wrap">
                                    <div class="TravelGo-category-price btn-grad"><span>2 days 3 nights</span>
                                    </div>
                                    <div class="TravelGo-opt-list"> <a href="#" class="single-map-item"><i
                                      class="fas fa-map-marker-alt"></i><span
                                      class="TravelGo-opt-tooltip">On the map</span></a> <a
                                      href="#" class="TravelGo-js-favorite"><i
                                      class="fas fa-heart"></i><span
                                      class="TravelGo-opt-tooltip">Save</span></a> <a href="#"
                                      class="TravelGo-js-booking"><i class="fas fa-retweet"></i><span
                                      class="TravelGo-opt-tooltip">Find Directions</span></a> </div>
                                    </div>
                                  </div>
                                </article>
                              </div>
                            </div>
                            <div class="swiper-slide h-auto px-2">
                              <div class="listing-item ">
                                <article class="TravelGo-category-listing fl-wrap">
                                  <div class="TravelGo-category-img"> <a href="hotel-detailed.html"><img
                                    src="{{asset('sites/images/cruises/4.jpg')}}" alt=""></a>
                                    <div class="TravelGo-category-opt">
                                      <div class="listing-rating card-popup-rainingvis" data-starrating2="5"><i
                                        class="fa fa-star"></i><i class="fa fa-star"></i><i
                                        class="fa fa-star"></i><i class="fa fa-star"></i><i
                                        class="fa fa-star"></i></div>
                                        <div class="rate-class-name">
                                          <div class="score"><strong>Very Good</strong>27 Reviews </div>
                                          <span>5.0</span>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="TravelGo-category-content fl-wrap title-sin_item">
                                      <div class="TravelGo-category-content-title fl-wrap">
                                        <div class="TravelGo-category-content-title-item">
                                          <h3 class="title-sin_map"><a href="hotel-detailed.html">Asia & African
                                          Cruise</a></h3>
                                          <div class="TravelGo-category-location fl-wrap"><a href="#"
                                            class="map-item"><i class="fas fa-map-marker-alt"></i> 27th
                                          Brooklyn New York, USA</a> <span>$ 200</span> </div>
                                        </div>
                                      </div>
                                      <p>Sed interdum metus at nisi tempor laoreet. Integer gravida orci a justo sodales.
                                      </p>
                                      <ul class="facilities-list fl-wrap">
                                        <li><i class="fas fa-wifi"></i><span>Free WiFi</span></li>
                                        <li><i class="fas fa-parking"></i><span>Parking</span></li>
                                        <li><i class="fas fa-smoking-ban"></i><span>Non-smoking Rooms</span></li>
                                        <li><i class="fas fa-utensils"></i><span> Restaurant</span></li>
                                      </ul>
                                      <div class="TravelGo-category-footer fl-wrap">
                                        <div class="TravelGo-category-price btn-grad"><span>2 days 3 nights</span>
                                        </div>
                                        <div class="TravelGo-opt-list"> <a href="#" class="single-map-item"><i
                                          class="fas fa-map-marker-alt"></i><span
                                          class="TravelGo-opt-tooltip">On the map</span></a> <a
                                          href="#" class="TravelGo-js-favorite"><i
                                          class="fas fa-heart"></i><span
                                          class="TravelGo-opt-tooltip">Save</span></a> <a href="#"
                                          class="TravelGo-js-booking"><i class="fas fa-retweet"></i><span
                                          class="TravelGo-opt-tooltip">Find Directions</span></a> </div>
                                        </div>
                                      </div>
                                    </article>
                                  </div>
                                </div>
                                <div class="swiper-slide h-auto px-2">
                                  <div class="listing-item ">
                                    <article class="TravelGo-category-listing fl-wrap">
                                      <div class="TravelGo-category-img"> <a href="hotel-detailed.html"><img
                                        src="{{asset('sites/images/cruises/5.jpg')}}" alt=""></a>
                                        <div class="TravelGo-category-opt">
                                          <div class="listing-rating card-popup-rainingvis" data-starrating2="5"><i
                                            class="fa fa-star"></i><i class="fa fa-star"></i><i
                                            class="fa fa-star"></i><i class="fa fa-star"></i><i
                                            class="fa fa-star"></i></div>
                                            <div class="rate-class-name">
                                              <div class="score"><strong>Very Good</strong>27 Reviews </div>
                                              <span>5.0</span>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="TravelGo-category-content fl-wrap title-sin_item">
                                          <div class="TravelGo-category-content-title fl-wrap">
                                            <div class="TravelGo-category-content-title-item">
                                              <h3 class="title-sin_map"><a href="hotel-detailed.html">Asia & African
                                              Cruise</a></h3>
                                              <div class="TravelGo-category-location fl-wrap"><a href="#"
                                                class="map-item"><i class="fas fa-map-marker-alt"></i> 27th
                                              Brooklyn New York, USA</a> <span>$ 200</span> </div>
                                            </div>
                                          </div>
                                          <p>Sed interdum metus at nisi tempor laoreet. Integer gravida orci a justo sodales.
                                          </p>
                                          <ul class="facilities-list fl-wrap">
                                            <li><i class="fas fa-wifi"></i><span>Free WiFi</span></li>
                                            <li><i class="fas fa-parking"></i><span>Parking</span></li>
                                            <li><i class="fas fa-smoking-ban"></i><span>Non-smoking Rooms</span></li>
                                            <li><i class="fas fa-utensils"></i><span> Restaurant</span></li>
                                          </ul>
                                          <div class="TravelGo-category-footer fl-wrap">
                                            <div class="TravelGo-category-price btn-grad"><span>2 days 3 nights</span>
                                            </div>
                                            <div class="TravelGo-opt-list"> <a href="#" class="single-map-item"><i
                                              class="fas fa-map-marker-alt"></i><span
                                              class="TravelGo-opt-tooltip">On the map</span></a> <a
                                              href="#" class="TravelGo-js-favorite"><i
                                              class="fas fa-heart"></i><span
                                              class="TravelGo-opt-tooltip">Save</span></a> <a href="#"
                                              class="TravelGo-js-booking"><i class="fas fa-retweet"></i><span
                                              class="TravelGo-opt-tooltip">Find Directions</span></a> </div>
                                            </div>
                                          </div>
                                        </article>
                                      </div>
                                    </div>
                                    <div class="swiper-slide h-auto px-2">
                                      <div class="listing-item ">
                                        <article class="TravelGo-category-listing fl-wrap">
                                          <div class="TravelGo-category-img"> <a href="hotel-detailed.html"><img
                                            src="{{asset('sites/images/cruises/6.jpg')}}" alt=""></a>
                                            <div class="TravelGo-category-opt">
                                              <div class="listing-rating card-popup-rainingvis" data-starrating2="5"><i
                                                class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                class="fa fa-star"></i></div>
                                                <div class="rate-class-name">
                                                  <div class="score"><strong>Very Good</strong>27 Reviews </div>
                                                  <span>5.0</span>
                                                </div>
                                              </div>
                                            </div>
                                            <div class="TravelGo-category-content fl-wrap title-sin_item">
                                              <div class="TravelGo-category-content-title fl-wrap">
                                                <div class="TravelGo-category-content-title-item">
                                                  <h3 class="title-sin_map"><a href="hotel-detailed.html">Asia & African
                                                  Cruise</a></h3>
                                                  <div class="TravelGo-category-location fl-wrap"><a href="#"
                                                    class="map-item"><i class="fas fa-map-marker-alt"></i> 27th
                                                  Brooklyn New York, USA</a> <span>$ 200</span> </div>
                                                </div>
                                              </div>
                                              <p>Sed interdum metus at nisi tempor laoreet. Integer gravida orci a justo sodales.
                                              </p>
                                              <ul class="facilities-list fl-wrap">
                                                <li><i class="fas fa-wifi"></i><span>Free WiFi</span></li>
                                                <li><i class="fas fa-parking"></i><span>Parking</span></li>
                                                <li><i class="fas fa-smoking-ban"></i><span>Non-smoking Rooms</span></li>
                                                <li><i class="fas fa-utensils"></i><span> Restaurant</span></li>
                                              </ul>
                                              <div class="TravelGo-category-footer fl-wrap">
                                                <div class="TravelGo-category-price btn-grad"><span>2 days 3 nights</span>
                                                </div>
                                                <div class="TravelGo-opt-list"> <a href="#" class="single-map-item"><i
                                                  class="fas fa-map-marker-alt"></i><span
                                                  class="TravelGo-opt-tooltip">On the map</span></a> <a
                                                  href="#" class="TravelGo-js-favorite"><i
                                                  class="fas fa-heart"></i><span
                                                  class="TravelGo-opt-tooltip">Save</span></a> <a href="#"
                                                  class="TravelGo-js-booking"><i class="fas fa-retweet"></i><span
                                                  class="TravelGo-opt-tooltip">Find Directions</span></a> </div>
                                                </div>
                                              </div>
                                            </article>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="swiper-pagination d-md-none"> </div>
                                    </div>
                                  </div>
                                </div>
                              </section>--}}




                              {{--<section class="bg-light pt80 pb60 solutions" style="background-color: #fff!important;">
                                <div class="container">
                                  <div class="row">
                                    <div class="col-md-8 mx-auto text-center mb-5">
                                      <h2 class="title text-center">Why Choose Us</h2>
                                      <p>Sorem ipsum dolor sit amet, consectetur adipisicing Suscipit votas aperiam Sorem ipsum dolor
                                      consectur adipisicing elit.</p>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-sm-6 col-lg-3 mb-4 mb-lg-0">
                                      <div class="shadow-hover h-100 bg-white px-5 pt-0 pb-5 text-center up-on-hover"> <span
                                        class="alt-font text-light-gray display-2 font-italic opacity-2">01</span> <span
                                        class="d-block mb-4"><i class="fas fa-road display-2 text-grad"></i></span> <a class="h5"
                                        href="#">Rail Booking</a> </div>
                                      </div>
                                      <div class="col-sm-6 col-lg-3 mb-4 mb-lg-0">
                                        <div class="shadow-hover h-100 bg-white px-5 pt-0 pb-5 text-center up-on-hover"> <span
                                          class="alt-font text-light-gray display-2 font-italic opacity-2">02</span> <span
                                          class="d-block mb-4"><i class="fas fa-utensils display-2 text-grad"></i></span> <a
                                          class="h5" href="#">Hotel Booking</a> </div>
                                        </div>
                                        <div class="col-sm-6 col-lg-3 mb-4 mb-lg-0">
                                          <div class="shadow-hover h-100 bg-white px-5 pt-0 pb-5 text-center up-on-hover"> <span
                                            class="alt-font text-light-gray display-2 font-italic opacity-2">03</span> <span
                                            class="d-block mb-4"><i class="fas fa-ticket-alt display-2 text-grad"></i></span> <a
                                            class="h5" href="#">Ticket Booking</a> </div>
                                          </div>
                                          <div class="col-sm-6 col-lg-3 mb-4 mb-lg-0">
                                            <div class="shadow-hover h-100 bg-white px-5 pt-0 pb-5 text-center up-on-hover"> <span
                                              class="alt-font text-light-gray display-2 font-italic opacity-2">04</span> <span
                                              class="d-block mb-4"><i class="fas fa-child display-2 text-grad"></i></span> <a
                                              class="h5" href="#">Amazing Tour</a> </div>
                                            </div>
                                          </div>
                                        </div>
                                      </section>--}}




                                      {{--<section class="pricing pricing-center whiteBG pb60">
                                        <div class="container">
                                          <div class="row">
                                            <div class="col-12 col-lg-8 mx-auto mb-5">
                                              <div class="title text-center">
                                                <h2> Pricing Packages</h2>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing Suscipit votas aperiam Sorem ipsum dolor
                                                consectur adipisicing elit.</p>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="row">
                                            <!-- pricing item -->
                                            <div class="col-md-4">
                                              <div class="pricing-box h-100">
                                                <h5>Honeymoon Package</h5>
                                                <div class="plan-price"> <span class="price text-grad"> <sup class="text-grad">$</sup>20 </span>
                                                / Day </div>
                                                <p>4 nights in Honeymoon Suite.<br>
                                                  Private luxury airport transfer.<br>
                                                Daily breakfast your suite.</p>
                                                <a class="btn btn-outline-light mt-4" href="#!">Order now!</a>
                                              </div>
                                            </div>
                                            <!-- pricing item -->
                                            <div class="col-md-4 ">
                                              <div class="pricing-box h-100 shadow no-border box">
                                                <div class="ribbon"><span>POPULAR</span></div>
                                                <h5>Family Package</h5>
                                                <div class="plan-price"> <span class="price text-grad"> <sup class="text-grad">$</sup>50 </span>
                                                / Day </div>
                                                <p>4 nights in Honeymoon Suite.<br>
                                                  Private luxury airport transfer.<br>
                                                Daily breakfast your suite.</p>
                                                <a class="btn btn-grad mt-4" href="#!">Order now!</a>
                                              </div>
                                            </div>
                                            <!-- pricing item -->
                                            <div class="col-md-4">
                                              <div class="pricing-box h-100">
                                                <h5>All Inclusive</h5>
                                                <div class="plan-price"> <span class="price text-grad"> <sup class="text-grad">$</sup>99 </span>
                                                / Day </div>
                                                <p>4 nights in Honeymoon Suite.<br>
                                                  Private luxury airport transfer.<br>
                                                Daily breakfast your suite.</p>
                                                <a class="btn btn-outline-light mt-4" href="#!">Order now!</a>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </section>--}}
                                      @endsection
