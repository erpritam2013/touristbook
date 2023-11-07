@extends('sites.layouts.main')
@section('title',$title)
@section('content')


<section>
  <!-- Slider main container-->
  <div class="swiper-container detail-slider slider-gallery" style="height: 283px;">
    <!-- Additional required wrapper-->
    <div class="swiper-wrapper">
      <!-- Slides-->
  
      @if(!empty($location->images))
      @foreach($location->images as $gallery)
      <div class="swiper-slide"><a data-toggle="gallery-top" title="location gallery" style="width: 452px;height: 301px;" ><img
        src="{{ $gallery['url'] }}" alt="Our street" class="img-fluid" width="452" height="301"></a>
      </div>
      @endforeach
      @else
      <div class="swiper-slide"><a data-toggle="gallery-top" title="location gallery"><img
        src="{{ asset('sites/images/dummy/450x300.jpg') }}" alt="location gallery" class="img-fluid"></a>
      </div>
      <div class="swiper-slide"><a data-toggle="gallery-top" title="location gallery"><img
        src="{{ asset('sites/images/dummy/450x300.jpg') }}" alt="location gallery" class="img-fluid"></a>
      </div>
      <div class="swiper-slide"><a data-toggle="gallery-top" title="location gallery"><img
        src="{{ asset('sites/images/dummy/450x300.jpg') }}" alt="location gallery" class="img-fluid"></a>
      </div>
      @endif
     
      </div>
      <div class="swiper-pagination swiper-pagination-white"></div>
      <div class="swiper-button-prev swiper-button-white"></div>
      <div class="swiper-button-next swiper-button-white"></div>
    </div>
  </section>


  <section class="pt40 pb80 listingDetails Campaigns">
    <div class="container">
      <div class="row">

        <!-- Tab line -->
        <div class="col-lg-9 col-md-12 col-sm-12 ">
          @php 
          $l_route = route('locations').'?search='.$location->locations[0]->name.'&source_type=location&source_id='.$location->locations[0]->id
          @endphp
          @include('sites.partials.breadcrumb',['location_route'=>$l_route,'location_name'=>$location->locations[0]->name ?? '','post_name'=>ucwords($location->name)])
          <h1 class="st-heading">{{ $location->name }}</h1>
          <div class="sub-heading">
            <p class="mb-3">{!!getNewIcon('Ico_maps', '#666666', '16px', '16px', true)!!}{{ $location->detail->map_address }}
              <a href="javascript:void(0)" class="ml-2 text-secondary text-sm view-street-map" data-toggle="modal"
              data-target="#streetModal">View on map</a>
            </p>
          </div>
          <ul class="nav nav-tabs custom-tabs sticky-top" id="custom-tabs" style="top:120px;z-index:99;">
            <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#tab-about"> About </a>
            </li>
            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tab-facilities"> Facilities
            </a>
          </li>
          <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tab-offers"> Offer &
            Packages
          </a> </li>
          <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tab-food"> Food </a> </li>
          <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tab-complimentary">
            Complimentary
          </a> </li>
          <li class="nav-item" class="dropdown open"><a  data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="nav-link">More</a>
            <ul class="nav nav-tabs dropdown-menu">
              <li class="nav-item" class=""><a class="nav-link" href="#id-proofs-tab"
                aria-controls="id-proofs-tab" role="tab" data-toggle="tab"
                aria-expanded="true">Id Proofs</a>
              </li>
              <li class="nav-item" class=""><a class="nav-link" href="#policies-rules-tab" aria-controls="policies-rules-tab"
                role="tab" data-toggle="tab" aria-expanded="false">Policies &amp; Rules</a>
              </li>
              <li class="nav-item" class=""><a class="nav-link" href="#payment-mode-tab"
                aria-controls="payment-mode-tab" role="tab" data-toggle="tab"
                aria-expanded="false">Payment Mode</a>
              </li>
              <li class="nav-item" class=""><a class="nav-link" href="#save-the-environment-tab"
                aria-controls="save-the-environment-tab" role="tab" data-toggle="tab"
                aria-expanded="false">Save the environment</a>
              </li>
              <li class="nav-item"><a class="nav-link" href="#save-your-pocket-tab"
                aria-controls="save-your-pocket-tab" role="tab" data-toggle="tab"
                aria-expanded="false">Save your pocket</a>
              </li>
              <li class="nav-item"><a class="nav-link" href="#emergency-links-tab"
                aria-controls="emergency-links-tab" role="tab" data-toggle="tab"
                aria-expanded="false">Emergency Links</a>
              </li>
              <li class="nav-item"><a class="nav-link" href="#reviews-tab" aria-controls="reviews-tab"
                role="tab" data-toggle="tab" aria-expanded="false">Reviews</a>
              </li>
            </ul>
          </li>
        </ul>
        <div class="custom-content" id="custom-content">
            <h2 class="st-heading-section">Overview</h2>
          <div class="tab-pane show active" id="tab-about">
           @if(!empty($location->description))
           
           <div class="text-block NopaddingDetails">
            <p class="text-muted font-weight-light">
              {!! $location->description !!}
            </p>
          </div>
          @else
          <div class="alert alert-warning mt15">No Description found!.</div>
          @endif

        </div>
        <div class="tab-pane " id="tab-facilities">
          @if ($location->amenities->isNotEmpty())
          <div class="section terms-section" id="amenities-section">
            <h2 class="st-heading-section">Amenities</h2>
            <div class="row mt-3">
              @foreach ($location->amenities as $amenity)
              <div class="col-xs-6 col-sm-4 f-15">
                <div class="item-term">
                  <i class="fa fa-cogs mr-3"></i>
                  <span>{{ $amenity->name }}</span>
                </div>
              </div>
              @endforeach
            </div>
          </div>
          @endif

          @if ($location->medicare_assistances->isNotEmpty())
          <div class="section mt-4 terms-section" id="medicare-assistance-section">
            <h2 class="st-heading-section">Medicare Assistance</h2>
            <div class="row mt-3">
              @foreach ($location->medicare_assistances as $medicare)
              <div class="col-xs-6 col-sm-4 f-15">
                <div class="item-term">
                  <i class="fa fa-cogs mr-3"></i>
                  <span>{{ $medicare->name }}</span>
                </div>
              </div>
              @endforeach
            </div>
          </div>
          @endif

          @if ($location->propertyTypes->isNotEmpty())
          <div class="section mt-4 terms-section">
            <h2 class="st-heading-section">Property Type</h2>
            <div class="row mt-3">
              @foreach ($location->propertyTypes as $propertyType)
              <div class="col-xs-6 col-sm-4 f-15">
                <div class="item-term">
                  <i class="fa fa-cogs mr-3"></i>
                  <span>{{ $propertyType->name }}</span>

                </div>
              </div>
              @endforeach
            </div>
          </div>

          @endif
        </div>
        <div class="tab-pane" id="tab-offers">

          @if (!empty($location->detail->offers))
          <div class="section mt-4 detail-section">
            <h2 class="st-heading-section">Offer & Packages</h2>
            <div class="row mt-3">
              @foreach ($location->detail->offers as $offer)
              <div class="col-md-12 f-15">
                <h2 class="st-heading-section-short">{{ $offer['offers-title'] }}</h2>
                <div class="st-description-section">
                  {!! $offer['offers-description'] !!}
                </div>
              </div>
              @endforeach
            </div>
          </div>
          @else
          <div class="alert alert-warning mt15">No offer and packages found.</div>
          @endif



        </div>
        <div class="tab-pane" id="tab-food">
          @if (!empty($location->detail->foods))
          <div class="section mt-4 terms-section">
            <h2 class="st-heading-section">Food</h2>
            <div class="row mt-3">
              @foreach ($location->detail->foods as $food)
              <div class="col-md-4 f-15">
                <div class="item-term">
                  <i class="fa {{ $food['foods-icon'] ?? 'fa-cogs'}} mr-3"></i>
                  <span>{{ $food['foods-title'] }}</span>
                </div>
              </div>
              @endforeach

            </div>
          </div>
          @else
          <div class="alert alert-warning mt15">No Food information found.</div>
          @endif

        </div>
        <div class="tab-pane" id="tab-complimentary">
          @if (!empty($location->detail->complimentary))
          <div class="section mt-4 terms-section">
            <h2 class="st-heading-section">Complimentary</h2>
            <div class="row mt-3">
              @foreach ($location->detail->complimentary as $complimentary)
              <div class="col-md-4 f-15">
                <div class="item-term">
                  <i class="fa {{ $complimentary['complimentary-icon'] ?? 'fa-cogs' }} mr-3"></i>
                  <span>{{ $complimentary['complimentary-title'] }}</span>
                </div>
              </div>
              @endforeach

            </div>
          </div>
          @else
          <div class="alert alert-warning mt15">No Complimentary information found.</div>
          @endif
          
        </div>
        <div class="tab-pane" id="id-proofs-tab">

          @if (!empty($location->detail->id_proofs))
          <div class="section mt-5 bbpb">
            <h2 class="st-heading-section">ID Proofs</h2>
            <div class="row">

              @php 
              $id_proofs_arr = explode("\n",trim($location->detail->id_proofs));
              @endphp
              @foreach($id_proofs_arr as $k_idp => $v_idp)
              <div class="col-xs-6 col-sm-6" style="color:#000000"> <i class="fa fa-light fa-circle fa-xs" aria-hidden="true" style="    font-size: 7px;color: transparent;"></i> 
                <span>{!!$v_idp!!}</span>

              </div>
              @endforeach

            </div>

          </div>
          @else
          <div class="alert alert-warning mt15">No ID proofs required.</div>

          @endif
        </div>

        <div class="tab-pane" id="policies-rules-tab">

          <div class="section mt-5 bbpb">
            <h2 class="st-heading-section">Policies & Rules</h2>
            <div class="row mt-3">
              <div class="col-md-12">
                <table class="table policies-rules-table">
                  <tr>
                    <th>Check In</th>
                    <td>{{ $location->check_in }}</td>
                  </tr>
                  <tr>
                    <th>Check Out</th>
                    <td>{{ $location->check_out }}</td>
                  </tr>
                  <tr>
                    <th>location Policies</th>
                    <td>
                      @if (!empty($location->policies))
                      @foreach ($location->policies as $policy)
                      <strong>{{ $policy['policy-title'] }}</strong>

                      <div class="row">

                        @php 
                        $policy_description_arr = explode("\n",trim($policy['policy-description']));
                        @endphp
                        @foreach($policy_description_arr as $k_ipd => $v_ipd)
                        <div class="col-xs-12 col-sm-12" style="color:#000000"> <i class="fa fa-light fa-circle fa-xs" aria-hidden="true" style="    font-size: 7px;color: transparent;"></i> 
                          <span>{!!$v_ipd!!}</span>

                        </div>
                        @endforeach

                      </div>
                      @endforeach
                      @else
                      <div class="alert alert-warning mt15">No Policy/Rule found.</div>
                      @endif


                    </td>
                  </tr>
                </table>

              </div>


            </div>
          </div>



        </div>

        <div class="tab-pane" id="payment-mode-tab">
          @if (!empty($location->detail->payment_mode))
          <div class="section mt-4 bbpb">
            <h2 class="st-heading-section">Payment Mode</h2>
            <div class="row mt-3">

              @php 
              $payment_mode_arr = explode("\n",trim($location->detail->payment_mode));
              @endphp
              @foreach($payment_mode_arr as $k_ipm => $v_ipm)
              <div class="col-xs-6 col-sm-6" style="color:#000000"> <i class="fa fa-light fa-circle fa-xs" aria-hidden="true" style="    font-size: 7px;color: transparent;"></i> 
                <span>{!!$v_ipm!!}</span>

              </div>
              @endforeach

            </div>
          </div>
          @else
          <div class="alert alert-warning mt15">No payment details found.</div>
          @endif
        </div>

        <div class="tab-pane" id="save-the-environment-tab">
          @if (!empty($location->detail->save_environment))
          <div class="section mt-5 bbpb">
            <h2 class="st-heading-section">Save the Environment</h2>
            <div class="row mt-3">

              @php 
              $save_environment_arr = explode("\n",trim($location->detail->save_environment));
              @endphp
              @foreach($save_environment_arr as $k_ise => $v_ise)
              <div class="col-xs-6 col-sm-6" style="color:#000000"> <i class="fa fa-light fa-circle fa-xs" aria-hidden="true" style="    font-size: 7px;color: transparent;"></i> 
                <span>{!!$v_ise!!}</span>

              </div>
              @endforeach

            </div>
          </div>
          @else
          <div class="alert alert-warning mt15">No Environment Information provided.
          </div>
          @endif
        </div>

        <div class="tab-pane" id="save-your-pocket-tab">
          @if (!empty($location->detail->save_pocket))
          <div class="section mt-4 bbpb">
            <h2 class="st-heading-section">Save your pocket</h2>
            <div class="row mt-3">
             @php 
             $save_pocket_arr = explode("\n",trim($location->detail->save_pocket));
             @endphp
             @foreach($save_pocket_arr as $k_isp => $v_isp)
             <div class="col-xs-6 col-sm-6" style="color:#000000"> <i class="fa fa-light fa-circle fa-xs" aria-hidden="true" style="    font-size: 7px;color: transparent;"></i> 
              <span>{!!$v_isp!!}</span>

            </div>
            @endforeach

          </div>
        </div>
        @else
        <div class="alert alert-warning mt15">Not Available.</div>
        @endif
        @if (!empty($location->detail->pocketPDF))

        <div class="section mt-5 bbpb text-justify">
          <div align="center"><a data-toggle="collapse" href="#pocketPDFtab" role="button" aria-expanded="true" aria-controls="pocketPDFtab" style="text-decoration: none;" class="btn btn-grad">View Details...
          </a></div>
          <div class="row mt-3">
            <div class="col-md-12 paragraph-info collapse" id="pocketPDFtab">

              <ul class="nav nav-tabs custom-tabs-detail">
                @foreach($location->detail->pocketPDF as $key => $pocketPDF)
                <li class="nav-item"> <a class="nav-link {{($key == 0)?'active':''}}" data-toggle="tab" href="#{{touristbook_sanitize_title($pocketPDF['pocketPDF-title'])}}"> {!!$pocketPDF['pocketPDF-title']!!} </a> </li>
                @endforeach

              </ul>

              <div class="tab-content">
               @foreach($location->detail->pocketPDF as $key_2 => $pocketPDF_2)
               <div class="tab-pane {{($key_2 == 0)?'active':''}}" id="{{touristbook_sanitize_title($pocketPDF_2['pocketPDF-title'])}}">

                {!!$pocketPDF_2['pocketPDF-description']!!}

              </div>
              @endforeach

            </div>
          </div>

        </div>
      </div>

      @else
      <div class="alert alert-warning mt15">Not Available.</div>
      @endif


    </div>

    <div class="tab-pane text-justify" id="emergency-links-tab">

     @if (!empty($location->detail->emergencyLinks))
     <div class="section mt-4 detail-section">
      <h2 class="st-heading-section">Emergency Links</h2>
      <div class="row mt-3">
        @foreach ($location->detail->emergencyLinks as $emergencyLinks)
        <div class="col-md-12 f-15">
          <h2 class="st-heading-section-short">{{ $emergencyLinks['emergencyLinks-title'] }}</h2>
          <div class="st-description-section">
            {!! $emergencyLinks['emergencyLinks-description'] !!}
          </div>
        </div>
        @endforeach
      </div>
    </div>
    @else
    <div class="alert alert-warning mt15">No offer and packages found.</div>
    @endif
  </div>

</div>

<!-- Accomodation -->

<div class="accomodation listingDetails booking-search mt-4 ">
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <h5 class="mb-4 st-heading-section">Accomodation</h5>
    </div>

    @if ($location->rooms->isNotEmpty())
    @foreach ($location->rooms as $room)
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="listing-item ">

        <article class="TravelGo-category-listing fl-wrap">

          <div class="row">

            <div class="col-lg-4 col-md-6 col-sm-12 image-div">
              <div class="TravelGo-category-img TravelGo-category-list-img"> <a
                href="location-detailed.html"><img
                src="{{ $room->featured_image }}"
                alt=""></a>
                {{--<div class="TravelGo-category-opt">
                  <div class="listing-rating card-popup-rainingvis"
                  data-starrating2="5"><i class="fa fa-star"></i><i
                  class="fa fa-star"></i><i
                  class="fa fa-star"></i><i
                  class="fa fa-star"></i><i class="fa fa-star"></i>
                </div>
                <div class="rate-class-name">
                  <div class="score"><strong>Very Good</strong>27
                  Reviews </div>
                  <span>5.0</span>
                </div>
              </div>--}}
            </div>
          </div>
          <div class="col-lg-5 col-md-6 col-sm-12">
            <div class="TravelGo-category-content fl-wrap title-sin_item">
              <div class="TravelGo-category-content-title fl-wrap">
                <div class="TravelGo-category-content-title-item">
                  <h3 class="title-sin_map"><a
                    href="location-detailed.html">{{ $room->name }}</a>
                  </h3>
                  <div class="TravelGo-category-location fl-wrap"><a
                    href="javascript:void(0);" class="map-item"><i
                    class="fas fa-map-marker-alt"></i>
                    {{ $room->address }} </a>
                  </div>
                </div>
              </div>
              {!! $room->excerpt !!}
              <ul class="facilities-list fl-wrap">
                <li><i class="fas fa-wifi"></i><span>Free WiFi</span></li>
                <li><i class="fas fa-parking"></i><span>Parking</span></li>
                <li><i class="fas fa-smoking-ban"></i><span>Non-smoking
                Rooms</span></li>
                <li><i class="fas fa-utensils"></i><span> Restaurant</span>
                </li>
              </ul>
              {{--<div class="TravelGo-category-footer fl-wrap">
                <div class="TravelGo-category-price btn-grad"><span>2 days
                  3
                nights</span></div>
                <div class="TravelGo-opt-list"> <a href="#"
                  class="single-map-item"><i
                  class="fas fa-map-marker-alt"></i><span
                  class="TravelGo-opt-tooltip">On the
                map</span></a> <a href="#"
                class="TravelGo-js-favorite"><i
                class="fas fa-heart"></i><span
                class="TravelGo-opt-tooltip">Save</span></a> <a
                href="#" class="TravelGo-js-booking"><i
                class="fas fa-retweet"></i><span
                class="TravelGo-opt-tooltip">Find
              Directions</span></a>
            </div>
          </div>--}}
        </div>
      </div>

      <div class="col-lg-3 col-md-6 col-sm-12">
        <span class="location-price-avg" title="(i)price usually vary in nature and subject to change
        ">Average price per night INR ₹{!! $room->price !!}<i class="fa fa-exclamation-circle icon-4x important-note-icon-tax" aria-hidden="true" style="color: #07509E;font-size: 23px;margin-left: 3px;"></i></span> <br>


        <a href="#" class="btn btn-grad room-view-btn" onclick="window.open('{{$location->contact["website"]}}', '_blank');">View Details</a>
      </div>



    </div>

  </article>

</div>

</div>
@endforeach
@endif

</div>

</div>

{{-- Important Notes --}}

<div class="notices listingDetails booking-search mt-4 ">
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <h5 class="mb-4 st-heading-section">Important Notice</h5>
    </div>

    @if ($location->notices)
    @foreach ($location->notices as $notice)
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="listing-item">
        <article class="TravelGo-category-listing fl-wrap important-note-wraps">

          <div class="row fetch important-note-rooms mt-4 pl-lg-5 pr-lg-5 pb-5">
            <h1 class="st-heading-section col-md-12">{{ $notice['notice-title'] }}
            </h1>

            <div class="col-md-12 text-justify">
              {!! $notice['notice-description'] !!}
            </div>
          </div>


        </article>
      </div>


    </div>
    @endforeach
    @endif


  </div>

</div>


{{-- Book and Inquiry --}}

<div class="book-inquiry listingDetails booking-search mt-4 ">
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">



      <ul class="nav nav-tabs nav-justified">
        <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#book">
        Book </a> </li>
        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#inquiry"> Inquiry
        </a> </li>
      </ul>


      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="book" role="tabpanel"
        aria-labelledby="book-tab">

        <div class="row">
          <div class="col-md-4">
            <a href="#" class="btn btn-grad w-100 font-weight-bold">Booking on Call</a>
          </div>
          <div class="col-md-4">
            <a href="#" class="btn btn-grad w-100 font-weight-bold">Compare Prices</a>
          </div>
          <div class="col-md-4">
            <a href="javascript:void(0);" class="btn btn-grad w-100 font-weight-bold" id="tourism-zone-link">Tourism Zone</a>
          </div>
        </div>

      </div>
      <div class="tab-pane fade" id="inquiry" role="tabpanel"
      aria-labelledby="inquiry-tab">
      <div class="row">
        <div class="col-md-12">
         <form method="post" action="{{route('inquiry')}}" class="form-inquiry">
          {{ csrf_field() }}


          <!-- Name -->
          <div class="form-group row">
            <input type="hidden" name="location_id" value="{{$location->id}}">
            <div class="col-lg-6 {{(isMobileDevice())?'mb-4':''}}">
              <input class="form-control" name="name" type="text" placeholder="Name....">

            </div>
            <div class="col-lg-6">
             <input class="form-control" name="email" type="email" placeholder="Email....">

           </div>
         </div>
         <!-- Phone -->
         <div class="form-group">

          <input class="form-control" name="phone" type="number" placeholder="Phone....">
        </div>

        <!-- Textarea -->
        <div class="form-group">

          <textarea class="form-control" name="message" rows="5" placeholder="Message...."></textarea>
        </div>
        <div class="alert alert-success fade show form-success" role="alert" style="display:none;">
          <strong>Success : </strong> <span class="msg"></span>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          </button>
        </div>
        <div class="alert alert-danger fade show form-error" role="alert" style="display:none;">
          <strong>Error : </strong> <span class="msg"></span>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          </button>
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-grad">Submit</button>
        </div>
      </form>
    </div>

  </div>
</div>


</div>


</div>
</div>

</div>

{{-- Tourism zone --}}

<div class="row mt-5" id="tourism-zone-area" style="display: none;">

  <div class="col-md-12">
    <h2 class="st-heading-section">Tourism Zone</h2>
    @if($tourismZone)
    <div class="border {{(isMobileDevice())?'p-3':'p-5'}} mt-3">
      {!! $tourismZone->tourism_zone_description !!}
    </div>
    @endif
  </div>

  @if($tourismZone && !empty($tourismZone->tourism_zone))
  <div class="col-md-12 mt-3">



    <ul class="nav nav-tabs custom-tabs-detail" id="tourism-zone-area-pdf">
      @foreach($tourismZone->tourism_zone as $key => $tzone)
      <li class="nav-item"> <a class="nav-link {{($key == 0)?'active':''}}" data-toggle="tab" href="#{{touristbook_sanitize_title($tzone['tourism_zone-title'])}}"> {!!$tzone['tourism_zone-title']!!} </a> </li>
      @endforeach

    </ul>

    <div class="tab-content text-justify">
     @foreach($tourismZone->tourism_zone as $key => $tzone)
     <div class="tab-pane" id="{{touristbook_sanitize_title($tzone['tourism_zone-title'])}}">

      {!!$tzone['tourism_zone-description']!!}

    </div>
    @endforeach

  </div>


</div>


@endif
</div>
<div class="tab-pane text-justify" id="explore-location">
  @if(isset($location->locations) && !empty($location->locations))
  <div class="section mt-4">
    <div class="row bt1pxe9ecef">
      @foreach($location->locations as $explore_location)
      <div class="col-md-4 col-sm-4 col-xs-12">
        <h2 class="st-heading-section">Explore {!!ucwords($explore_location->name)!!}</h2>
        <div class="listroBox">
          <figure><a href="{{route('location',$explore_location->slug)}}"><img src="{{asset('sites/images/locations/room1.jpg')}}" class="img-fluid" alt="">
            <div class="read_more"><span>View Detail</span></div>
          </a> </figure>
        </div>
      </div>
      @endforeach
    </div>
  </div>
  @endif
</div>


<div class="tab-pane text-justify p-3 border" id="section-contact">

 @if(!empty($location->contact))
 <div class="section mt-4">
  <h2 class="st-heading-section">Contact Information</h2>
  <div class="row mt-3">
    <div class="col-md-12 f-15">
      <div class="st-contact-info lh-2-6">

        @php 

        $email = touristbook_string_explode($location->contact['email']);
        $website = touristbook_string_explode($location->contact['website']);
        $phone = touristbook_string_explode($location->contact['phone']);
        $fax = touristbook_string_explode($location->contact['fax']);

        $address = $location->address;

        if(!empty($location->location_attributes)){
          $st_location_corporate_address = $location->location_attributes['corporateAddress'];
        }else{
          $st_location_corporate_address = '';
        }
        @endphp

        @if(!empty($email) || !empty($website) || !empty($phone) || !empty($fax) || !empty($address) || !empty($st_location_corporate_address))
        @if(!empty($address))
        {!!getNewIcon('Ico_maps', '#5E6D77', '16px', '16px')!!}&nbsp;Address :- {!!$address!!}<br>
        @endif
        @if(!empty($st_location_corporate_address))
        {!!getNewIcon('Ico_maps', '#5E6D77', '16px', '16px')!!}&nbsp;Corporate Address :- {!!$st_location_corporate_address!!}<br>
        @endif
        @if(!empty($email))
        {!!getNewIcon('send-email-envelope', '#5E6D77', '16px', '16px')!!}&nbsp;
        @if(is_array($email))
        @foreach($email as $email_single)
        <a href="mailto:{{$email_single}}" style="text-decoration: none;">{{$email_single}}</a>
        @endforeach
        @else
        <a href="mailto:{{$email}}" style="text-decoration: none;">{{$email}}</a>
        <br>
        @endif
        @endif
        @if(!empty($website))
        {!!getNewIcon('website-build', '#5E6D77', '16px', '16px')!!}&nbsp;
        @if(is_array($website))
        @foreach($website as $webs)
        <a href="{{$webs}}" target="_blank" style="text-decoration: none;">{{$webs}}</a>
        @endforeach
        @else
        <a href="{{$website}}" target="_blank" style="text-decoration: none;">{{$website}}</a>
        @endif
        @endif
        @if(!empty($phone))
        <h4>
          {!!getNewIcon('phone', '#5E6D77', '16px', '16px')!!}&nbsp;
          @if(is_array($phone))
          @foreach($phone as $phones)
          <a href="tel:{{$phones}}" target="_blank" style="text-decoration: none;">{{$phones}}</a>
          @endforeach
          @else
          <a href="tel:{{$phone}}" target="_blank" style="text-decoration: none;">{{$phone}}</a>
          @endif
        </h4>
        @endif
        @if(!empty($fax))
        <h5>
          {!!getNewIcon('fax-phone', '#5E6D77', '16px', '16px')!!}&nbsp;
          @if(is_array($fax))
          @foreach($fax as $faxs)
          <a href="tel:{{$faxs}}" target="_blank" style="text-decoration: none;">{{$faxs}}</a>
          @endforeach
          @else
          <a href="tel:{{$fax}}" target="_blank" style="text-decoration: none;">{{$fax}}</a>
          @endif
        </h5>
        @endif
        @endif

        @if(!empty($location->detail->social_links))
        @php 

        $facebook_link = touristbook_string_explode($location->detail->social_links['facebook_custom_link']);

        $twitter_link = touristbook_string_explode($location->detail->social_links['twitter_custom_link']);

        $instagram_link = touristbook_string_explode($location->detail->social_links['instagram_custom_link']);

        $youtube_link = touristbook_string_explode($location->detail->social_links['you_tube_custom_link']);

        @endphp
        {{-- Facebook link --}}
        @if(!empty($facebook_link))
        &nbsp;
        @if(is_array($facebook_link))
        @foreach($facebook_link as $facebook)
        <a href="{{$facebook}}" target="_blank" style="text-decoration:none;font-size:24px;background:#f9f9f9;padding-left:10px;border-radius:20px;padding-right:0px;"><i class="fab fa-facebook-f" style="font-size: 1.2rem;"></i>&nbsp;</a>
        @endforeach
        @else
        <a href="{{$facebook_link}}" target="_blank" style="text-decoration:none;font-size:24px;background:#f9f9f9;padding-left:10px;border-radius:20px;padding-right:0px;"><i class="fab fa-facebook-f" style="font-size: 1.2rem;"></i>&nbsp;</a>
        @endif
        @endif
        {{-- Twitter link --}}
        @if(!empty($twitter_link))
        &nbsp;
        @if(is_array($twitter_link))
        @foreach($twitter_link as $twitter)
        <a href="{{$twitter}}" target="_blank" style="text-decoration:none;font-size:24px;background:#f9f9f9;padding-left:10px;border-radius:20px;padding-right:0px;"><i class="fab fa-twitter" style="font-size: 1.2rem;"></i>&nbsp;</a>
        @endforeach
        @else
        <a href="{{$twitter_link}}" target="_blank" style="text-decoration:none;font-size:24px;background:#f9f9f9;padding-left:10px;border-radius:20px;padding-right:0px;"><i class="fab fa-twitter" style="font-size: 1.2rem;"></i>&nbsp;</a>
        @endif
        @endif
        {{-- Instagram link --}}
        @if(!empty($instagram_link))
        &nbsp;
        @if(is_array($instagram_link))
        @foreach($instagram_link as $instagram)
        <a href="{{$instagram}}" target="_blank" style="text-decoration:none;font-size:24px;background:#f9f9f9;padding-left:10px;border-radius:20px;padding-right:0px;"><i class="fab fa-instagram" style="font-size: 1.2rem;"></i>&nbsp;</a>
        @endforeach
        @else
        <a href="{{$instagram_link}}" target="_blank" style="text-decoration:none;font-size:24px;background:#f9f9f9;padding-left:10px;border-radius:20px;padding-right:0px;"><i class="fab fa-instagram" style="font-size: 1.2rem;"></i>&nbsp;</a>
        @endif
        @endif
        {{-- Youtube link --}}
        @if(!empty($youtube_link))
        &nbsp;
        @if(is_array($youtube_link))
        @foreach($youtube_link as $youtube)
        <a href="{{$youtube}}" target="_blank" style="text-decoration:none;font-size:24px;background:#f9f9f9;padding-left:10px;border-radius:20px;padding-right:0px;"><i class="fab fa-youtube" style="font-size: 1.2rem;"></i>&nbsp;</a>
        @endforeach
        @else
        <a href="{{$youtube_link}}" target="_blank" style="text-decoration:none;font-size:24px;background:#f9f9f9;padding-left:10px;border-radius:20px;padding-right:0px;"><i class="fab fa-youtube" style="font-size: 1.2rem;"></i>&nbsp;</a>
        @endif
        @endif

        @endif {{-- main if end--}}
        

      </div>
    </div>
  </div>
</div>
@else
<div class="alert alert-warning mt15">No contact information found.</div>
@endif
</div>
<div class="tab-pane" id="reviews-tab">
  <div class="text-block">
    <p class="st-heading-section">Reviews </p>
    <h5 class="mb-4 st-heading-section-short">Listing Reviews </h5>
    <div class="media d-block d-sm-flex review">
      <div class="text-md-center mr-4 mr-xl-5"><img src="{{asset('sites/images/dummy-user.jpeg')}}" alt="Padmé Amidala" class="avatar avatar-xl p-2 mb-2"></div>
      <div class="media-body">
        <h6 class="mt-2 mb-1">Monu yadav</h6>
        <div class="mb-2"><i class="fa fa-xs fa-star text-primary"></i><i class="fa fa-xs fa-star text-primary"></i><i class="fa fa-xs fa-star text-primary"></i><i class="fa fa-xs fa-star text-primary"></i><i class="fa fa-xs fa-star text-primary"></i> </div>
        <p class="text-muted text-sm">Awesome experience...genuinely visit it..ur visit will be worth full....n u will enjoy the view,the food everything is perfect </p>
      </div>
    </div>
    <div class="media d-block d-sm-flex review">
      <div class="text-md-center mr-4 mr-xl-5"><img src="{{asset('sites/images/dummy-user.jpeg')}}" alt="Jabba Hut" class="avatar avatar-xl p-2 mb-2"></div>
      <div class="media-body">
        <h6 class="mt-2 mb-1">Kumar Sivaramakrishna</h6>
        <div class="mb-2"><i class="fa fa-xs fa-star text-primary"></i><i class="fa fa-xs fa-star text-primary"></i><i class="fa fa-xs fa-star text-primary"></i><i class="fa fa-xs fa-star text-primary"></i><i class="fa fa-xs fa-star text-primary"></i> </div>
        <p class="text-muted text-sm">Delighted with the service we got at the venue.. The workers were very responsive and we got a good service and good food too...cumulatively it was a good quality resort that too in budget price.</p>
      </div>
    </div>
    <div class="rebiew_section">
      <div id="leaveReview" class="mt-4 collapse show" style="">
        <h5 class="mb-4">Leave a review</h5>
        <form id="contact-form" method="get" action="#" class="form">
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <input type="text" name="name" id="name" placeholder="Enter your name" required class="form-control">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <select name="rating" id="rating" class="custom-select focus-shadow-0">
                  <option value="5">★★★★★ (5/5)</option>
                  <option value="4">★★★★☆ (4/5)</option>
                  <option value="3">★★★☆☆ (3/5)</option>
                  <option value="2">★★☆☆☆ (2/5)</option>
                  <option value="1">★☆☆☆☆ (1/5)</option>
                </select>
              </div>
            </div>
          </div>
          <div class="form-group">
            <input type="email" name="email" id="email" placeholder="Enter your  email" required class="form-control">
          </div>
          <div class="form-group">
            <textarea rows="4" name="review" id="review" placeholder="Enter your review" required class="form-control"></textarea>
          </div>
          <button type="submit" class="btn btn-grad">Submit Review</button>
        </form>
      </div>
    </div>
  </div>

</div>
</div>
<div class="col-lg-3 col-md-12 col-sm-12 right_Details">
  @if(!isMobileDevice())
  <div class="st-location-header">
    <div class="left"></div>
    <div class="right">
      <div class="review-score">
        <div class="head clearfix">
          <div class="left">
            @if($location->rating < 3)
            <span class="head-rating">Good</span>
            @else
            <span class="head-rating">Excellent</span>
            @endif
            <span class="text-rating">from 7 reviews</span>
          </div>
          <div class="score">
            {!! round($location->rating,2) ?? 0!!}<span>/5</span>
          </div>
        </div>
        <div class="foot">
          100% of guests recommend
        </div>
      </div>
    </div>
  </div>
  @endif
  <div class="ml-lg-4 sticky-top" style="top: 100px;">
    <div class="view-on-map widget-box rounded mb-lg-4 border-solid-d7dce3">
      <img src="https://touristbook.s3.ap-south-1.amazonaws.com/wp-content/uploads/2021/11/location-location-icon-4.jpg" height="200">
      <a href="" class="st-link font-medium view-street-map" id="view-map-location" data-toggle="modal" data-target="#streetModal"> View map</a>
    </div>


    <div class="view-important-note p-4 rounded border-solid-d7dce3" style="color: #000000;">
      <strong>IMPORTANT NOTES:-&nbsp;</strong><br>
      <p><span>We strongly recommend you</span></p>
      <ul>
        <li><span>To go through a location's Cancellation and Refund Policy before you confirm your booking.</span></li>
        <li><span>To notice single occupancy, double occupancy, and third Person policy/child policy.</span></li>
        <li><span>To Make sure that your personal data/ information must be safe while booking.</span></li>
        <li><span>To notice direct booking <strong>benefits, offers, discounts, complimentary and package details too.</strong></span></li>
        <li><span>To visit the <strong>social media linkages</strong> of the location to get more information/authenticity. </span></li>
      </ul>
    </div>

  </div>
</div>

<div class="col-lg-12 col-md-12 col-sm-12">
  @if(isset($nearBylocation) && !empty($nearBylocation))
  <section class="Categories pt10 locationsamilar">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <p class="mt-0 mb-0 nopadding st-heading-section">Similar locations</p>
          {{--<h1 class="paddtop1 font-weight lspace-sm">You may also like </h1>--}}
        </div>
        <div class="col-md-4 d-lg-flex align-items-center justify-content-end"><a href="{{route('locations')}}" class="blist text-sm ml-2"> See all locations<i class="fas fa-angle-double-right ml-2"></i></a></div>
      </div>
      <div class="row">
        @foreach($nearBylocation as $near_location)
        <div class="col-md-3 col-sm-3  col-xs-12">
          <div class="listroBox">
            <figure><a href="{{route('location',$near_location->slug)}}"><img src="{{asset('sites/images/locations/room1.jpg')}}" class="img-fluid" alt="">
              <div class="read_more"><span>View Detail</span></div>
            </a> </figure>
            <div class="listroBoxmain p-2">
              <h2 class="service-title"><a href="{{route('location',$near_location->slug)}}">{!!ucwords($near_location->name ?? '')!!}</a></h2>
              @php
                            $address = (!empty($near_location->address ))?$near_location->address:$near_location->location_attributes['corporateAddress'];
                            @endphp
              <p class="service-location">{!!getNewIcon('Ico_maps', '#666666', '15px', '15px', true)!!}<span>{!!shortDescription($address,50)!!}</span>@if(strlen($address) > 50)
                                &nbsp;<i class="fas fa-plus" data-toggle="modal" data-target="#showMoreData" onclick="showMoreData(this)" data-more_data="{{$address}}" data-more_data_label="Address" style="color:#fba009;"></i>
                            @endif</p></div>
              <ul>
                <li class="mt-0 mb-0">
                  <p class="card-text text-muted ">
                    <span class="h6 text-primary">
                      <span class="location-avg">
                       {!!getNewIcon('thunder', '#ffab53', '10px', '16px')!!}
                       Avg
                     </span>
                   {!!get_price($near_location)!!}</span> / per night</p>
                 </li>
                 <li class="mt-0 mb-0">
                  {{--<a href="{{route('location',$near_location->slug)}}" class="btn btn-grad text-white mt-0 mb-0 btn-sm">View Detail</a>--}}


                </li>
              </ul>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </section>

    @endif

    @if(isset($nearByTour) && !empty($nearByTour))
    <section class="Categories pt10 toursamilar">
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <p class="mt-0 mb-0 nopadding st-heading-section">Packages You May Like</p>
          </div>
          <div class="col-md-4 d-lg-flex align-items-center justify-content-end"><a href="{{route('our-packages')}}" class="blist text-sm ml-2"> See all our packages<i class="fas fa-angle-double-right ml-2"></i></a></div>
        </div>
        <div class="row">
          @foreach($nearByTour as $near_tour)
          <div class="col-md-3 col-sm-3  col-xs-12">
            <div class="listroBox">
              <figure><a href="{{route('tour',$near_tour->slug)}}"><img src="{{asset('sites/images/locations/room1.jpg')}}" class="img-fluid" alt="">
                <div class="read_more"><span>View Detail</span></div>
              </a> </figure>
              <div class="listroBoxmain p-2">
                <h2 class="service-title"><a href="{{route('tour',$near_tour->slug)}}">{!!ucwords($near_tour->name ?? '')!!}</a></h2>
                <p class="service-location">{!!getNewIcon('Ico_maps', '#666666', '15px', '15px', true)!!}<span>{!!shortDescription($near_tour->address ?? '',50)!!}</span>@if(strlen($near_tour->address) > 50)
                            &nbsp;<i class="fas fa-plus" data-toggle="modal" data-target="#showMoreData" onclick="showMoreData(this)" data-more_data="{{$near_tour->address}}" data-more_data_label="Address" style="color:#fba009;"></i>
                          @endif</p></div>
                <ul>
                 <li class="mt-0 mb-0">
                  {!!getNewIcon('time-clock-circle-1', '#5E6D77', '17px', '17px')!!}{!!$near_tour->duration_day!!}


                </li>
                <li class="mt-0 mb-0">
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
         </div>
       </div>
     </section>

     @endif
     @if(isset($nearByActivity) && !empty($nearByActivity))
     <section class="Categories pt10 activitysamilar">
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <p class="mt-0 mb-0 nopadding st-heading-section">Activity You May Like</p>
          </div>
          <div class="col-md-4 d-lg-flex align-items-center justify-content-end"><a href="{{route('activities')}}" class="blist text-sm ml-2"> See all activities<i class="fas fa-angle-double-right ml-2"></i></a></div>
        </div>
        <div class="row">
          @foreach($nearByActivity as $near_activity)
          <div class="col-md-3 col-sm-3  col-xs-12">
            <div class="listroBox">
              <figure><a href="{{route('activity',$near_activity->slug)}}"><img src="{{asset('sites/images/locations/room1.jpg')}}" class="img-fluid" alt="">
                <div class="read_more"><span>View Detail</span></div>
              </a> </figure>
              <div class="listroBoxmain p-2">
                <h2 class="service-title"><a href="{{route('activity',$near_activity->slug)}}">{!!ucwords($near_activity->name ?? '')!!}</a></h2>
                <p class="service-location">{!!getNewIcon('Ico_maps', '#666666', '15px', '15px', true)!!}<span>{!!shortDescription($near_activity->address ?? '',50)!!}</span>@if(strlen($near_activity->address) > 50)
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
          </div>
        </div>
      </section>
      @endif

      @if(isset($nearByLocation) && !empty($nearByLocation))
      <section class="Categories pt10 destinationsamilar">
        <div class="container">
          <div class="row">
            <div class="col-md-8">
              <p class="mt-0 mb-0 nopadding st-heading-section">Destination You May Like</p>
            </div>
            <div class="col-md-4 d-lg-flex align-items-center justify-content-end"><a href="{{route('destinations')}}" class="blist text-sm ml-2"> See all destinations<i class="fas fa-angle-double-right ml-2"></i></a></div>
          </div>
          <div class="row">
            @foreach($nearByLocation as $near_location)
            <div class="col-md-3 col-sm-3  col-xs-12">
              <div class="listroBox">
                <figure><a href="{{route('location',$near_location->slug)}}"><img src="{{asset('sites/images/locations/room1.jpg')}}" class="img-fluid" alt="">
                  <div class="read_more"><span>View Detail</span></div>
                </a> </figure>
                <div class="listroBoxmain p-2">
                  <h2 class="service-title"><a href="{{route('location',$near_location->slug)}}">{!!ucwords($near_location->name ?? '')!!}</a></h2>
                  <p class="service-location">{!!getNewIcon('Ico_maps', '#666666', '15px', '15px', true)!!}<span>{!!shortDescription($near_location->map_address ?? '',50)!!}</span>@if(strlen($near_location->map_address) > 50)
                                        &nbsp;<i class="fas fa-plus" data-toggle="modal" data-target="#showMoreData" onclick="showMoreData(this)" data-more_data="{{$near_location->map_address}}" data-more_data_label="Address" style="color:#fba009;"></i>
                                      @endif</p></div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </section>

        @endif

      </div>
    </div>
  </div>
</section>



{{-- Modal for Street Map --}}


<div class="modal fade" id="streetModal" tabindex="-1" role="dialog" aria-labelledby="streetLabel"
aria-hidden="true" style="z-index: 999999;">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="streetLabel">{{ $location->name }}</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <div id="map-street" style="height: 400px; width:100%" lat="{{ $location->detail->latitude }}"
        lng="{{ $location->detail->longitude }}" zoom_level="{{ $location->detail->zoom_level }}"></div>
      </div>
      <div class="modal-footer">

      </div>
    </div>
  </div>
</div>


@endsection