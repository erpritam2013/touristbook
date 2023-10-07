@extends('sites.layouts.main')

@section('content')


  <section class="pt80 pb80 listingDetails Campaigns">
    <div class="container">
      <div class="row">

        <!-- Tab line -->
        <div class="col-lg-8 col-md-12 col-sm-12 ">

            <h1>{{$hotel->name}}</h1>
            <p class="mb-5"><i class="fa fa-map-marker text-secondary w-1rem mr-3 text-center"></i>{{$hotel->detail->map_address}}</p>

            <div class="mt-10">
                <!-- Additional required wrapper-->
                <div class="owl-carousel owl-theme" data-items-xl="1" data-items-lg="1" data-items-md="1" data-items-sm="1" data-items-xs="1">
                  <!-- Slides-->
                  <div class="item"><a data-toggle="gallery-top" title="Our street"><img src="{{asset('sites/images/hotels/room-details1.jpg')}}" alt="Our street" class="img-fluid"></a></div>
                  <div class="item"><a data-toggle="gallery-top" title="Outside"><img src="{{asset('sites/images/hotels/room-details2.jpg')}}" alt="Outside" class="img-fluid"></a></div>
                  <div class="item"><a data-toggle="gallery-top" title="Rear entrance"><img src="{{asset('sites/images/hotels/room-details3.jpg')}}" alt="Rear entrance" class="img-fluid"></a></div>
                  <div class="item"><a data-toggle="gallery-top" title="Kitchen"><img src="{{asset('sites/images/hotels/room-details4.jpg')}}" alt="Kitchen" class="img-fluid"></a></div>
                  <div class="item"><a data-toggle="gallery-top" title="Bedroom"><img src="{{asset('sites/images/hotels/room-details.jpg')}}" alt="Bedroom" class="img-fluid"></a></div>
                  <div class="item"><a data-toggle="gallery-top" title="Bedroom"><img src="{{asset('sites/images/hotels/room-details2.jpg')}}" alt="Bedroom" class="img-fluid"></a></div>
                </div>
                {{-- <div class="swiper-pagination swiper-pagination-white"></div>
                <div class="swiper-button-prev swiper-button-white"></div>
                <div class="swiper-button-next swiper-button-white"></div> --}}
              </div>



          <ul class="nav nav-tabs tab-line">
            <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#tab-about"> About </a> </li>
            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tab-facilities"> Facilities </a> </li>
            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tab-de-3"> Amenities </a> </li>
            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tab-de-4"> Calendar </a> </li>
            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tab-de-5"> Gallery </a> </li>
            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tab-de-6"> Reviews </a> </li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane show active" id="tab-about">
              <div class="text-block NopaddingDetails">
                <p class="text-muted font-weight-light">
                    {{$hotel->description}}
                </p>
              </div>

            </div>
            <div class="tab-pane " id="tab-facilities">
                <div class="section">
                    <h2>Amenities</h2>
                    <div class="row mt-3">
                        @if($hotel->amenities->isNotEmpty())
                        @foreach($hotel->amenities as $amenity)
                        <div class="col-md-4 f-15">
                            <i class="fa fa-cogs mr-3"></i>
                            <span>{{$amenity->name}}</span>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>

                <div class="section mt-5">
                    <h2>Medicare Assistance</h2>
                    <div class="row mt-3">
                        @if($hotel->medicare_assistances->isNotEmpty())
                        @foreach($hotel->medicare_assistances as $medicare)
                        <div class="col-md-4 f-15">
                            <i class="fa fa-cogs mr-3"></i>
                            <span>{{$medicare->name}}</span>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>

                <div class="section mt-5">
                    <h2>Property Type</h2>
                    <div class="row mt-3">
                        @if($hotel->propertyTypes->isNotEmpty())
                        @foreach($hotel->propertyTypes as $propertyType)
                        <div class="col-md-4 f-15">
                            <i class="fa fa-cogs mr-3"></i>
                            <span>{{$propertyType->name}}</span>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>

            </div>
            <div class="tab-pane" id="tab-de-3">
              <div class="text-block NopaddingDetails">
                <h5 class="mb-4">Amenities</h5>
                <p class="mb-4">Praesent dolor lectus, rutrum sit amet risus vitae, imperdiet cursus neque. Nulla tempor nec lorem eu suscipit. Donec dignissim lectus a nunc molestie consectetur. Nulla eu urna in nisi adipiscing placerat. Nam vel scelerisque magna. Donec justo urna, posuere ut dictum quis.Praesent dolor lectus, rutrum sit amet risus vitae, imperdiet cursus neque. Nulla tempor nec lorem eu suscipit. Donec dignissim lectus a nunc molestie consectetur. Nulla eu urna in nisi adipiscing placerat. Nam vel scelerisque magna. Donec justo urna, posuere ut dictum quis. <br />
                  <br/>
                  Praesent dolor lectus, rutrum sit amet risus vitae, imperdiet cursus neque. Nulla tempor nec lorem eu suscipit. Donec dignissim lectus a nunc molestie consectetur. Nulla eu urna in nisi adipiscing placerat. Nam vel scelerisque magna. Donec justo urna, posuere ut dictum quis. </p>
                <div class="row">
                  <div class="col-md-6">
                    <ul class="list-unstyled text-muted">
                      <li class="mb-2"><i class="fa fa-wifi text-secondary w-1rem mr-3 text-center"></i> <span class="text-sm">Wifi</span></li>
                      <li class="mb-2"><i class="fa fa-tv text-secondary w-1rem mr-3 text-center"></i> <span class="text-sm">Cable TV</span></li>
                      <li class="mb-2"><i class="fa fa-snowflake text-secondary w-1rem mr-3 text-center"></i> <span class="text-sm">Air conditioning</span></li>
                      <li class="mb-2"><i class="fa fa-thermometer-three-quarters text-secondary w-1rem mr-3 text-center"></i> <span class="text-sm">Heating</span></li>
                    </ul>
                  </div>
                  <div class="col-md-6">
                    <ul class="list-unstyled text-muted">
                      <li class="mb-2"><i class="fa fa-bath text-secondary w-1rem mr-3 text-center"></i><span class="text-sm">Toiletteries</span></li>
                      <li class="mb-2"><i class="fa fa-utensils text-secondary w-1rem mr-3 text-center"></i><span class="text-sm">Equipped Kitchen</span></li>
                      <li class="mb-2"><i class="fa fa-laptop text-secondary w-1rem mr-3 text-center"></i><span class="text-sm">Desk for work</span></li>
                      <li class="mb-2"><i class="fa fa-tshirt text-secondary w-1rem mr-3 text-center"></i><span class="text-sm">Washing machine</span></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="tab-de-4">
              <div class="text-block NopaddingDetails">
                <!-- Gallery-->
                <h5 class="mb-4">Calender</h5>
                <div id="calendar">
                  <table>
                    <tr>
                      <td class="lastmonth">30</td>
                      <td>1</td>
                      <td>2</td>
                      <td>3</td>
                      <td class="hastask">4</td>
                      <td>5</td>
                      <td>6</td>
                    </tr>
                    <tr>
                      <td>7</td>
                      <td class="current">8</td>
                      <td class="hastask">9</td>
                      <td>10</td>
                      <td>11</td>
                      <td class="hastask">12</td>
                      <td>13</td>
                    </tr>
                    <tr>
                      <td>14</td>
                      <td class="hastask">15</td>
                      <td>16</td>
                      <td>17</td>
                      <td>18</td>
                      <td>19</td>
                      <td>20</td>
                    </tr>
                    <tr>
                      <td class="hastask">21</td>
                      <td>22</td>
                      <td>23</td>
                      <td>24</td>
                      <td>25</td>
                      <td class="hastask">26</td>
                      <td>27</td>
                    </tr>
                    <tr>
                      <td>28</td>
                      <td>29</td>
                      <td class="hastask">30</td>
                      <td>31</td>
                      <td class="nextmonth">1</td>
                      <td>2</td>
                      <td>3</td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="tab-de-5">
              <div class="text-block NopaddingDetails">
                <!-- Gallery-->
                <h5 class="mb-4">Gallery</h5>
                <div class="row gallery ml-n1 mr-n1">
                  <div class="col-lg-4 col-6 px-1 mb-2"><a href="#"><img src="images/hotels/room1.jpg" alt="..." class="img-fluid"></a></div>
                  <div class="col-lg-4 col-6 px-1 mb-2"><a href="#"><img src="images/hotels/room7.jpg" alt="..." class="img-fluid"></a></div>
                  <div class="col-lg-4 col-6 px-1 mb-2"><a href="#"><img src="images/hotels/room2.jpg" alt="..." class="img-fluid"></a></div>
                  <div class="col-lg-4 col-6 px-1 mb-2"><a href="#"><img src="images/hotels/room3.jpg" alt="..." class="img-fluid"></a></div>
                  <div class="col-lg-4 col-6 px-1 mb-2"><a href="#"><img src="images/hotels/room4.jpg" alt="..." class="img-fluid"></a></div>
                  <div class="col-lg-4 col-6 px-1 mb-2"><a href="#"><img src="images/hotels/room5.jpg" alt="..." class="img-fluid"></a></div>
                  <div class="col-lg-4 col-6 px-1 mb-2"><a href="#"><img src="images/hotels/room6.jpg" alt="..." class="img-fluid"></a></div>
                  <div class="col-lg-4 col-6 px-1 mb-2"><a href="#"><img src="images/hotels/room7.jpg" alt="..." class="img-fluid"></a></div>
                  <div class="col-lg-4 col-6 px-1 mb-2"><a href="#"><img src="images/hotels/room8.jpg" alt="..." class="img-fluid"></a></div>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="tab-de-6">
              <div class="text-block NopaddingDetails">
                <h5 class="mb-4">Reviews</h5>
                <div class="media d-block d-sm-flex review">
                  <div class="text-md-center mr-4 mr-xl-5"><img src="images/img-22.jpg" alt="Padmé Amidala" class="avatar avatar-xl p-2 mb-2"></div>
                  <div class="media-body">
                    <h6 class="mt-2 mb-1">Deho Smith</h6>
                    <div class="mb-2"><i class="fa fa-xs fa-star text-primary"></i><i class="fa fa-xs fa-star text-primary"></i><i class="fa fa-xs fa-star text-primary"></i><i class="fa fa-xs fa-star text-primary"></i><i class="fa fa-xs fa-star text-primary"></i> </div>
                    <p class="text-muted text-sm">ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
                  </div>
                </div>
                <div class="media d-block d-sm-flex review">
                  <div class="text-md-center mr-4 mr-xl-5"><img src="images/img-11.jpg" alt="Jabba Hut" class="avatar avatar-xl p-2 mb-2"></div>
                  <div class="media-body">
                    <h6 class="mt-2 mb-1">S. M Smithrs</h6>
                    <div class="mb-2"><i class="fa fa-xs fa-star text-primary"></i><i class="fa fa-xs fa-star text-primary"></i><i class="fa fa-xs fa-star text-primary"></i><i class="fa fa-xs fa-star text-primary"></i><i class="fa fa-xs fa-star text-primary"></i> </div>
                    <p class="text-muted text-sm">ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
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
                      <button type="submit" class="btn btn-primary">Post review</button>
                    </form>
                  </div>
                </div>
              </div>
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
                  <input type="text" name="bookingDate" id="bookingDate" placeholder="Choose your dates" required class="form-control">
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
              <p> <a href="#" class="text-secondary text-sm"> <i class="fa fa-heart"></i> Bookmark This Hotels</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection
