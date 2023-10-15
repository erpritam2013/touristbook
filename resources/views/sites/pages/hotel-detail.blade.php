@extends('sites.layouts.main')
@section('title',$title)
@section('content')


    <section>
        <!-- Slider main container-->
        <div class="swiper-container detail-slider slider-gallery">
            <!-- Additional required wrapper-->
            <div class="swiper-wrapper">
                <!-- Slides-->
                <div class="swiper-slide"><a data-toggle="gallery-top" title="Our street"><img
                            src="{{ asset('sites/images/hotels/room-details1.jpg') }}" alt="Our street" class="img-fluid"></a>
                </div>
                <div class="swiper-slide"><a data-toggle="gallery-top" title="Outside"><img
                            src="{{ asset('sites/images/hotels/room-details2.jpg') }}" alt="Outside" class="img-fluid"></a>
                </div>
                <div class="swiper-slide"><a data-toggle="gallery-top" title="Rear entrance"><img
                            src="{{ asset('sites/images/hotels/room-details3.jpg') }}" alt="Rear entrance"
                            class="img-fluid"></a></div>
                <div class="swiper-slide"><a data-toggle="gallery-top" title="Kitchen"><img
                            src="{{ asset('sites/images/hotels/room-details4.jpg') }}" alt="Kitchen" class="img-fluid"></a>
                </div>
                <div class="swiper-slide"><a data-toggle="gallery-top" title="Bedroom"><img
                            src="{{ asset('sites/images/hotels/room-details.jpg') }}" alt="Bedroom" class="img-fluid"></a>
                </div>
                <div class="swiper-slide"><a data-toggle="gallery-top" title="Bedroom"><img
                            src="{{ asset('sites/images/hotels/room-details2.jpg') }}" alt="Bedroom" class="img-fluid"></a>
                </div>
            </div>
            <div class="swiper-pagination swiper-pagination-white"></div>
            <div class="swiper-button-prev swiper-button-white"></div>
            <div class="swiper-button-next swiper-button-white"></div>
        </div>
    </section>


    <section class="pt80 pb80 listingDetails Campaigns">
        <div class="container">
            <div class="row">

                <!-- Tab line -->
                <div class="col-lg-8 col-md-12 col-sm-12 ">

                    <h1>{{ $hotel->name }}</h1>
                    <p class="mb-5"><i
                            class="fa fa-map-marker text-secondary w-1rem mr-3 text-center"></i>{{ $hotel->detail->map_address }}
                        <a href="javascript:void(0)" class="ml-2 text-secondary text-sm view-street-map" data-toggle="modal"
                            data-target="#streetModal">view map</a>
                    </p>



                    <ul class="navbar custom-tabs" id="custom-tabs">
                        <li class="nav-item"> <a class="nav-link btn active" data-toggle="tab" href="#tab-about"> About </a>
                        </li>
                        <li class="nav-item"> <a class="nav-link btn" data-toggle="tab" href="#tab-facilities"> Facilities
                            </a>
                        </li>
                        <li class="nav-item"> <a class="nav-link  btn" data-toggle="tab" href="#tab-offers"> Offer &
                                Packages
                            </a> </li>
                        <li class="nav-item"> <a class="nav-link  btn" data-toggle="tab" href="#tab-food"> Food </a> </li>
                        <li class="nav-item"> <a class="nav-link  btn" data-toggle="tab" href="#tab-complimentary">
                                Complimentary
                            </a> </li>
                        <li class="nav-item dropdown">
                            <a href="javascript: void(0);" class="nav-link  btn" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="true">More</a>
                            <ul class="dropdown-menu">
                                <li role="presentation" class="active "><a href="#id-proofs-tab"
                                        aria-controls="id-proofs-tab" role="tab" data-toggle="tab"
                                        aria-expanded="true">Id Proofs</a>
                                </li>
                                <li role="presentation" class=""><a href="#rules-tab" aria-controls="rules-tab"
                                        role="tab" data-toggle="tab" aria-expanded="false">Policies &amp; Rules</a>
                                </li>
                                <li role="presentation" class=""><a href="#payment-mode-tab"
                                        aria-controls="payment-mode-tab" role="tab" data-toggle="tab"
                                        aria-expanded="false">Payment Mode</a>
                                </li>
                                <li role="presentation" class=""><a href="#save-the-environment-tab"
                                        aria-controls="save-the-environment-tab" role="tab" data-toggle="tab"
                                        aria-expanded="false">Save the environment</a>
                                </li>
                                <li role="presentation"><a href="#save-your-pocket-tab"
                                        aria-controls="save-your-pocket-tab" role="tab" data-toggle="tab"
                                        aria-expanded="false">Save your pocket</a>
                                </li>
                                <li role="presentation"><a href="#emergency-links-tab"
                                        aria-controls="emergency-links-tab" role="tab" data-toggle="tab"
                                        aria-expanded="false">Emergency Links</a>
                                </li>
                                <li role="presentation"><a href="#reviews-tab" aria-controls="reviews-tab"
                                        role="tab" data-toggle="tab" aria-expanded="false">Reviews</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <div class="custom-content" id="custom-content">
                        <div class="tab-pane show active" id="tab-about">
                            <div class="text-block NopaddingDetails">
                                <p class="text-muted font-weight-light">
                                    {!! $hotel->description !!}
                                </p>
                            </div>

                        </div>
                        <div class="tab-pane " id="tab-facilities">
                            <div class="section">
                                <h2>Amenities</h2>
                                <div class="row mt-3">
                                    @if ($hotel->amenities->isNotEmpty())
                                        @foreach ($hotel->amenities as $amenity)
                                            <div class="col-md-4 f-15">
                                                <i class="fa fa-cogs mr-3"></i>
                                                <span>{{ $amenity->name }}</span>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="section mt-5">
                                <h2>Medicare Assistance</h2>
                                <div class="row mt-3">
                                    @if ($hotel->medicare_assistances->isNotEmpty())
                                        @foreach ($hotel->medicare_assistances as $medicare)
                                            <div class="col-md-4 f-15">
                                                <i class="fa fa-cogs mr-3"></i>
                                                <span>{{ $medicare->name }}</span>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="section mt-5">
                                <h2>Property Type</h2>
                                <div class="row mt-3">
                                    @if ($hotel->propertyTypes->isNotEmpty())
                                        @foreach ($hotel->propertyTypes as $propertyType)
                                            <div class="col-md-4 f-15">
                                                <i class="fa fa-cogs mr-3"></i>
                                                <span>{{ $propertyType->name }}</span>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane" id="tab-offers">

                            <div class="section mt-5">
                                <h2>Offer & Packages</h2>
                                <div class="row mt-3">
                                    @if (!empty($hotel->detail->offers))
                                        @foreach ($hotel->detail->offers as $offer)
                                            <div class="col-md-4 f-15">
                                                <i class="fa fa-cogs mr-3"></i>
                                                <span>{{ $offer['offers-title'] }}</span>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="alert alert-warning mt15">No offer and packages found.</div>
                                    @endif
                                </div>
                            </div>



                        </div>
                        <div class="tab-pane" id="tab-food">
                            <div class="section mt-5">
                                <h2>Food</h2>
                                <div class="row mt-3">
                                    @if (!empty($hotel->detail->foods))
                                        @foreach ($hotel->detail->foods as $food)
                                            <div class="col-md-4 f-15">
                                                <i class="fa {{ $food['foods-icon'] }} mr-3"></i>
                                                <span>{{ $food['foods-title'] }}</span>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="alert alert-warning mt15">No Food information found.</div>
                                    @endif

                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-complimentary">
                            <div class="section mt-5">
                                <h2>Complimentary</h2>
                                <div class="row mt-3">
                                    @if (!empty($hotel->detail->complimentary))
                                        @foreach ($hotel->detail->complimentary as $complimentary)
                                            <div class="col-md-4 f-15">
                                                <i class="fa {{ $complimentary['complimentary-icon'] }} mr-3"></i>
                                                <span>{{ $complimentary['complimentary-title'] }}</span>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="alert alert-warning mt15">No Complimentary information found.</div>
                                    @endif

                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="id-proofs-tab">

                            <div class="section mt-5">
                                <h2>ID Proofs</h2>
                                <div class="row">
                                    <div class="col-md-12 paragraph-info">
                                        @if (!empty($hotel->detail->id_proofs))
                                            {!! $hotel->detail->id_proofs !!}
                                        @else
                                            <div class="alert alert-warning mt15">No ID proofs required.</div>
                                        @endif
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="tab-pane" id="tab-policies">

                            <div class="section mt-5">
                                <h2>Policies & Rules</h2>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <table class="table">
                                            <tr>
                                                <th>Check In</th>
                                                <td>{{ $hotel->check_in }}</td>
                                            </tr>
                                            <tr>
                                                <th>Check Out</th>
                                                <td>{{ $hotel->check_out }}</td>
                                            </tr>
                                            <tr>
                                                <th>Hotel Policies</th>
                                                <td>
                                                    @if (!empty($hotel->policies))
                                                        @foreach ($hotel->policies as $policy)
                                                            <strong>{{ $policy['policy-title'] }}</strong>
                                                            <div>{!! $policy['policy-description'] !!}</div>
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

                        <div class="tab-pane" id="tab-payment">
                            <div class="section mt-5">
                                <h2>Payment Mode</h2>
                                <div class="row mt-3">
                                    <div class="col-md-12 paragraph-info">
                                        @if (!empty($hotel->detail->payment_mode))
                                            {!! $hotel->detail->payment_mode !!}
                                        @else
                                            <div class="alert alert-warning mt15">No payment details found.</div>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="tab-environment">
                            <div class="section mt-5">
                                <h2>Save the Environment</h2>
                                <div class="row mt-3">
                                    <div class="col-md-12 paragraph-info">
                                        @if (!empty($hotel->detail->save_environment))
                                            <div>{!! $hotel->detail->save_environment !!}</div>
                                        @else
                                            <div class="alert alert-warning mt15">No Environment Information provided.
                                            </div>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="tab-pocket">
                            <div class="section mt-5">
                                <h2>Save your pocket</h2>
                                <div class="row mt-3">
                                    <div class="col-md-12 paragraph-info">
                                        @if (!empty($hotel->detail->save_pocket))
                                            <div>{!! $hotel->detail->save_pocket !!}</div>
                                        @else
                                            <div class="alert alert-warning mt15">Not Available.</div>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="tab-emergency">
                            <div class="section mt-5">
                                <h2>Emergency Links</h2>
                                <div class="row mt-3">
                                    <div class="col-md-12 paragraph-info">
                                        @if (!empty($hotel->detail->emergencyLinks))
                                            <div>{!! $hotel->detail->emergencyLinks !!}</div>
                                        @else
                                            <div class="alert alert-warning mt15">Not Available.</div>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="tab-reviews">
                            <div class="section mt-5">
                                <h2>Reviews</h2>
                                <div class="row mt-3">
                                    <div class="col-md-12 paragraph-info">
                                        @if (!empty($hotel->rating))
                                            <h1>{!! $hotel->rating !!}/5</h1>
                                        @else
                                            <div class="alert alert-warning mt15">Not Available.</div>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>


                    </div>

                    <!-- Accomodation -->

                    <div class="accomodation listingDetails booking-search mt-4 ">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <h5 class="mb-4">Accomodation</h5>
                            </div>

                            @if ($hotel->rooms->isNotEmpty())
                                @foreach ($hotel->rooms as $room)
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="listing-item ">

                                            <article class="TravelGo-category-listing fl-wrap">

                                                <div class="row">

                                                    <div class="col-lg-5 col-md-6 col-sm-12">
                                                        <div class="TravelGo-category-img TravelGo-category-list-img"> <a
                                                                href="hotel-detailed.html"><img
                                                                    src="{{ asset('sites/images/hotels/room8.jpg') }}"
                                                                    alt=""></a>
                                                            <div class="TravelGo-category-opt">
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
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-7 col-md-6 col-sm-12">
                                                        <div class="TravelGo-category-content fl-wrap title-sin_item">
                                                            <div class="TravelGo-category-content-title fl-wrap">
                                                                <div class="TravelGo-category-content-title-item">
                                                                    <h3 class="title-sin_map"><a
                                                                            href="hotel-detailed.html">{{ $room->name }}</a>
                                                                    </h3>
                                                                    <div class="TravelGo-category-location fl-wrap"><a
                                                                            href="#" class="map-item"><i
                                                                                class="fas fa-map-marker-alt"></i>
                                                                            {{ $room->address }} </a>
                                                                        <span>{{ $room->price }}</span> </div>
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
                                                            <div class="TravelGo-category-footer fl-wrap">
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
                                                            </div>
                                                        </div>
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
                                <h5 class="mb-4">Important Notice</h5>
                            </div>

                            @if ($hotel->notices)
                                @foreach ($hotel->notices as $notice)
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="listing-item">
                                            <article class="TravelGo-category-listing fl-wrap">

                                                <div class="row fetch important-note-rooms mt-4 pl-lg-5 pr-lg-5 pb-5">
                                                    <h1 class="st-heading-section col-md-12">{{ $notice['notice-title'] }}
                                                    </h1>

                                                    <div class="div-desc col-md-12">
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

                                <ul class="nav nav-tabs tab-line">
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
                                                <a href="#" class="btn btn-primary">Booking on Call</a>
                                            </div>
                                            <div class="col-md-4">
                                                <a href="#" class="btn btn-primary">Compare Prices</a>
                                            </div>
                                            <div class="col-md-4">
                                                <a href="javascript:void(0);" class="btn btn-primary" id="tourism-zone-link">Tourism Zone</a>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="tab-pane fade" id="inquiry" role="tabpanel"
                                        aria-labelledby="inquiry-tab">
                                        <p>Form not found</p>
                                    </div>
                                </div>


                            </div>
                        </div>

                    </div>

                    {{-- Tourism zone --}}

                    <div class="row mt-5" id="tourism-zone-area" style="display: none;">

                        <div class="col-md-12">
                            <h2>Tourism Zone</h2>
                            @if($tourismZone)
                                <div class="border p-5 mt-3">
                                    {!! $tourismZone->tourism_zone_description !!}
                                </div>
                            @endif
                        </div>

                        @if($tourismZone && !empty($tourismZone->tourism_zone))

                        <div class="col-md-12 mt-3">

                            @foreach($tourismZone->tourism_zone as $key => $tzone)
                                <a href="javascript:void(0);" class="btn btn-primary tzone-link" targetdiv="#zone-{{$key}}" >{{$tzone['tourism_zone-title']}}</a>
                            @endforeach
                        </div>

                        <div class="col-md-12 mt-3">

                            @foreach($tourismZone->tourism_zone as $key => $tzone)
                                <div class="zone-data" id="zone-{{$key}}" style="display: none;">
                                    {!! $tzone['tourism_zone-description']  !!}
                                </div>
                            @endforeach

                        </div>


                        @endif




                    </div>







                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 right_Details">
                    <div class="p-4 shadow ml-lg-4 rounded sticky-top" style="top: 100px;">
                        <p class="text-muted"><span class="text-primary h2">$80</span> per night</p>
                        <hr class="my-4">
                        <form id="booking-form" method="get" action="#" autocomplete="off" class="form">
                            <div class="form-group">
                                <label for="bookingDate" class="form-label">Your stay *</label>
                                <div class="datepicker-container datepicker-container-right">
                                    <input type="text" name="bookingDate" id="bookingDate"
                                        placeholder="Choose your dates" required class="form-control">
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="guests" class="form-label">Guests *</label>
                                <select name="guests" id="guests" class="form-control">
                                    <option value="1">1 Guest</option>
                                    <option value="2">2 Guests</option>
                                    <option value="3">3 Guests</option>
                                    <option value="4">4 Guests</option>
                                    <option value="5">5 Guests</option>
                                </select>
                            </div>
                            <div class="form-group mb-4">
                                <label for="guests" class="form-label">Child *</label>
                                <select name="guests" id="guests" class="form-control">
                                    <option value="1">1 Child</option>
                                    <option value="2">2 Child</option>
                                    <option value="3">3 Child</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Confirm Booking</button>
                            </div>
                        </form>
                        <hr class="my-4">
                        <div class="text-center">
                            <p> <a href="#" class="text-secondary text-sm"> <i class="fa fa-heart"></i> Bookmark
                                    This Hotels</a></p>
                        </div>
                    </div>
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
                    <h5 class="modal-title" id="streetLabel">{{ $hotel->name }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="map-street" style="height: 400px; width:400px;" lat="{{ $hotel->detail->latitude }}"
                        lng="{{ $hotel->detail->longitude }}"></div>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>


@endsection
