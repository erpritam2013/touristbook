@extends('sites.layouts.main')

@section('content')


    <section class="pt80 pb80 listingDetails Campaigns">
        <div class="container">
            <div class="row">

                <!-- Tab line -->
                <div class="col-lg-8 col-md-12 col-sm-12 ">

                    <h1>{{ $hotel->name }}</h1>
                    <p class="mb-5"><i
                            class="fa fa-map-marker text-secondary w-1rem mr-3 text-center"></i>{{ $hotel->detail->map_address }}
                    </p>

                    <div class="mt-10">
                        <!-- Additional required wrapper-->
                        <div class="owl-carousel owl-theme" data-items-xl="1" data-items-lg="1" data-items-md="1"
                            data-items-sm="1" data-items-xs="1">
                            <!-- Slides-->
                            <div class="item"><a data-toggle="gallery-top" title="Our street"><img
                                        src="{{ asset('sites/images/hotels/room-details1.jpg') }}" alt="Our street"
                                        class="img-fluid"></a></div>
                            <div class="item"><a data-toggle="gallery-top" title="Outside"><img
                                        src="{{ asset('sites/images/hotels/room-details2.jpg') }}" alt="Outside"
                                        class="img-fluid"></a></div>
                            <div class="item"><a data-toggle="gallery-top" title="Rear entrance"><img
                                        src="{{ asset('sites/images/hotels/room-details3.jpg') }}" alt="Rear entrance"
                                        class="img-fluid"></a></div>
                            <div class="item"><a data-toggle="gallery-top" title="Kitchen"><img
                                        src="{{ asset('sites/images/hotels/room-details4.jpg') }}" alt="Kitchen"
                                        class="img-fluid"></a></div>
                            <div class="item"><a data-toggle="gallery-top" title="Bedroom"><img
                                        src="{{ asset('sites/images/hotels/room-details.jpg') }}" alt="Bedroom"
                                        class="img-fluid"></a></div>
                            <div class="item"><a data-toggle="gallery-top" title="Bedroom"><img
                                        src="{{ asset('sites/images/hotels/room-details2.jpg') }}" alt="Bedroom"
                                        class="img-fluid"></a></div>
                        </div>
                        {{-- <div class="swiper-pagination swiper-pagination-white"></div>
                <div class="swiper-button-prev swiper-button-white"></div>
                <div class="swiper-button-next swiper-button-white"></div> --}}
                    </div>



                    <ul class="nav nav-tabs tab-line">
                        <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#tab-about"> About </a>
                        </li>
                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tab-facilities"> Facilities </a>
                        </li>
                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tab-offers"> Offer & Packages
                            </a> </li>
                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tab-food"> Food </a> </li>
                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tab-complimentary"> Complimentary
                            </a> </li>
                        <li class="nav-item dropdown">
                            <a href="javascript: void(0);" class="nav-link" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="true">More</a>
                            <ul class="dropdown-menu">
                                <li role="presentation" class="active"><a href="#id-proofs-tab"
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
                    <div class="tab-content">
                        <div class="tab-pane show active" id="tab-about">
                            <div class="text-block NopaddingDetails">
                                <p class="text-muted font-weight-light">
                                    {{ $hotel->description }}
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
                            <div class="alert alert-warning mt15">No offer and packages found.</div>
                        </div>
                        <div class="tab-pane" id="tab-food">
                            <div class="section">
                                <h2>Food</h2>
                                <div class="row mt-3">
                                    <div class="col-md-4 f-15">
                                        <i class="fa fa-cogs mr-3"></i>
                                        <span>In House Kitchen</span>
                                    </div>

                                    <div class="col-md-4 f-15">
                                        <i class="fa fa-cogs mr-3"></i>
                                        <span>Indian</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-complimentary">
                            <div class="alert alert-warning mt15">No complimentary found.</div>
                        </div>
                        <div class="tab-pane" id="id-proofs-tab">

                            <div class="section">
                                <h2>ID Proofs</h2>
                                <ul>
                                    <li>
                                        <span>Aadhaar Card, issued by UIDAI </span>
                                    </li>

                                    <li >
                                        <span>Passport </span>
                                    </li>

                                    <li>
                                        <span>Voter ID card, issued by the Election Commission of India  </span>
                                    </li>

                                    <li >
                                        <span>Overseas Citizenship of India document</span>
                                    </li>


                                </ul>
                            </div>

                        </div>

                        <div class="tab-pane" id="rules-tab">
                            Coming Soon!!!
                        </div>
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

@endsection
