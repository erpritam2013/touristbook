@extends('sites.layouts.main')
@section('title',$title)
@section('content')


<section>
	<!-- Slider main container-->
	<div class="swiper-container detail-slider slider-gallery" style="height: 300px;">
		<!-- Additional required wrapper-->
		<div class="swiper-wrapper">
			<!-- Slides-->
			@if(!empty($tour->detail->gallery))
			@foreach($tour->detail->gallery as $gallery)
			<div class="swiper-slide"><a data-toggle="gallery-top" title="tour gallery" style="width: 452px;height:300px;" ><img
				src="{{ getConversionUrl($gallery['id'],'450x300') }}" alt="Our street" class="img-fluid" style="452px;height:300px;"></a>
			</div>
			@endforeach
			@else
			<div class="swiper-slide"><a data-toggle="gallery-top" title="tour gallery"><img
				src="{{ asset('sites/images/dummy/450x300.jpg') }}" alt="tour gallery" class="img-fluid"></a>
			</div>
			<div class="swiper-slide"><a data-toggle="gallery-top" title="tour gallery"><img
				src="{{ asset('sites/images/dummy/450x300.jpg') }}" alt="tour gallery" class="img-fluid"></a>
			</div>
			<div class="swiper-slide"><a data-toggle="gallery-top" title="tour gallery"><img
				src="{{ asset('sites/images/dummy/450x300.jpg') }}" alt="tour gallery" class="img-fluid"></a>
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
				$l_route = "#";

				if($tour->locations->count() != 0){
					$l_route = route('our-packages').'?search='.$tour->locations[0]->name.'&source_type=location&source_id='.$tour->locations[0]->id;
				}
				@endphp
				@include('sites.partials.breadcrumb',['location_route'=>$l_route,'location_name'=>$tour->locations[0]->name ?? '','post_name'=>ucwords($tour->name)])
				<h1 class="st-heading">{{ $tour->name }}</h1>
				<div class="st-tour-route">
					@php 

					$package_route = (!empty($tour->detail->package_route))?implode('-',array_column($tour->detail->package_route,'package_route-title')):'';
					@endphp
					<ul class="tour-routes">
						<li>
							<span class="tour-route-span">{!!$package_route!!}</span>
						</li>

					</ul>

				</div>
				<div class="sub-heading">
					<p class="mb-3">{!!getNewIcon('Ico_maps', '#666666', '16px', '16px', true)!!}{{ $tour->detail->map_address }}
						<a href="javascript:void(0)" class="ml-2 text-secondary text-sm view-street-map" data-toggle="modal"
						data-target="#streetModal">View on map</a>
					</p>
				</div>

				<div class="custom-content" id="custom-content">
					<h2 class="st-heading-section">Overview</h2>
					<div class="tab-pane show active" id="tab-about">
						@if(!empty($tour->description))

						<div class="text-block NopaddingDetails">
							<p class="text-muted font-weight-light">
								{!! $tour->description !!}
							</p>
						</div>
						@else
						<div class="alert alert-warning mt15">No Description found!.</div>
						@endif

					</div>
					<div class="tab-pane " id="tab-facilities">
						@if ($tour->types->isNotEmpty())
						<div class="section terms-section" id="type-section">
							<h2 class="st-heading-section">Tour Type</h2>
							<div class="row mt-3">
								@foreach ($tour->types as $type)
								<div class="col-xs-6 col-sm-4 f-15">
									<div class="item-term">
										<i class="fa fa-cogs mr-3"></i>
										<span>{{ $type->name }}</span>
									</div>
								</div>
								@endforeach
							</div>
						</div>
						@endif

						@if ($tour->package_types->isNotEmpty())
						<div class="section mt-4 terms-section" id="package-type-section">
							<h2 class="st-heading-section">Package Types</h2>
							<div class="row mt-3">
								@foreach ($tour->package_types as $package_type)
								<div class="col-xs-6 col-sm-4 f-15">
									<div class="item-term">
										<i class="fa fa-cogs mr-3"></i>
										<span>{{ $package_type->name }}</span>
									</div>
								</div>
								@endforeach
							</div>
						</div>
						@endif

						@if ($tour->languages->isNotEmpty())
						<div class="section mt-4 terms-section" id="longuages">
							<h2 class="st-heading-section">Languages</h2>
							<div class="row mt-3">
								@foreach ($tour->languages as $languages)
								<div class="col-xs-6 col-sm-4 f-15">
									<div class="item-term">
										<i class="fa fa-cogs mr-3"></i>
										<span>{{ $languages->name }}</span>

									</div>
								</div>
								@endforeach
							</div>
						</div>

						@endif
					</div>
					<div class="tab-pane" id="tour-feature">

						@if (!empty($tour->duration_day) || !empty($tour->type_tour))
						<div class="section mt-4">
							<div class="st-tour-feature">
								<div class="row">
									@if(!empty($tour->duration_day))
									<div class="col-xs-6 col-lg-6">
										<div class="item">
											<div class="icon">
												<i class="lar la-clock"></i>
											</div>
											<div class="info">
												<h4 class="name">Duration</h4>
												<p class="value">
													{{$tour->duration_day}}
												</p>
											</div>
										</div>
									</div>
									@endif
									@if(!empty($tour->type_tour))
									<div class="col-xs-6 col-lg-6">
										<div class="item">
											<div class="icon tour_type_single">
												<i class="las la-shoe-prints"></i>
											</div>
											<div class="info">
												<h4 class="name">Tour Type</h4>
												<p class="value">
													{{ucwords(str_replace('_',' ',$tour->type_tour))}}
												</p>
											</div>
										</div>
									</div>
									@endif
								</div>
							</div>
						</div>

						@endif



					</div>
					<div class="tab-pane" id="st-include-exclude">

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
									<h2 class="st-heading-section">Inclusions</h2>
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
									<h2 class="st-heading-section">Exclusions</h2>
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
					<div class="tab-pane" id="st-program-section">
						@if (!empty($tour->detail->tours_program))
						<div class="section mt-4">
							<h2 class="st-heading-section">Itinerary</h2>
							<div class="accordion" id="accordionStProgram">
								@foreach($tour->detail->tours_program as $key => $tours_program)
								<div class="card">
									<div class="card-header {{($key != 0)?'collapsed':''}}" data-toggle="collapse" data-target="#st-program-{{$key}}" aria-expanded="true"> 
										<img src="https://touristbook.s3.ap-south-1.amazonaws.com/wp-content/uploads/2019/05/ico_mapker-2.webp" alt="marker">    
										<span class="title">{{ucwords($tours_program['tours_program-title'])}}</span>
										<span class="accicon"><i class="fas fa-angle-down rotate-icon"></i></span>
									</div>
									<div id="st-program-{{$key}}" class="collapse {{$key == 0?'show':''}}" data-parent="#accordionStProgram">
										<div class="card-body">{!!$tours_program['tours_program-description']!!}
										</div>
									</div>
								</div>

								@endforeach
							</div>
						</div>

						@endif

					</div>

					{{-- helpful facts --}}
					@if (!empty($tour->detail->helpful_facts))

					<div id="section-helpful-facts">
						<h2 class="st-heading-section">Helpful Facts</h2>

						@php 
						$helpful_facts_arr = explode("\n",trim($tour->detail->helpful_facts));
						@endphp
						<div class="st-helpful-facts">
							<div class="row st-htm-blocks"><ul>
								@foreach($helpful_facts_arr as $k_hfp => $v_hfp)
								<li style="color:#000;">{{$v_hfp}}</li>
								@endforeach
							</ul>
						</div>                    
					</div>
				</div>
				@endif

			</div>


			{{-- Important Notes --}}

			<div class="notices listingDetails booking-search mt-4 ">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<h5 class="mb-4 st-heading-section">Important Notice</h5>
					</div>


					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="listing-item">
							<article class="TravelGo-category-listing fl-wrap important-note-wraps">

								<div class="row fetch important-note-rooms mt-4 pl-lg-5 pr-lg-5 pb-5">
									<h1 class="st-heading-section col-md-12">
										Deal With Seasonality Challenges and Bridge the Off-Season Gap
									</h1>

									<div class="col-md-12 text-justify">
										<div class="div-desc">
											Seasonality is a measurable feature of tourism. Unlike other challenges, seasonality can be predictable and anticipated. Since it is a predictable and almost reliable challenge, it makes it more possible to be mitigated.
											<ul>
												<li>Special celebrations can be planned in order to boost and cover the gap</li>
												<li>Special celebrations can be planned in order to boost and cover the gap</li>
												<li>Meetings, incentives, conferences/conventions and exhibitions are not a great run to as business travels are not influenced by seasonal patterns.</li>
												<li>Develop niche-tourism products; Specially designed weekends for tourist’s interests, health and wellness facilities, sport and activity-based vacations, heritage tourism, educational, farm/village tours and eco-tours and medical tourism.</li>
												<li>Discounted prices are offered during low-seasons, while high price in peak seasons</li>
												<li>Offering off-season holiday packages and Group booking offers</li>
												<li>Developing a sound marketing plan for the branding and promotion of new attractions, events and activities.</li>
											</ul> </div>
										</div>
									</div>


								</article>
							</div>


						</div>



					</div>

				</div>

				@if(!empty($tour->detail->tours_highlight))

				<div class="st-highlight p-3">
					<h2 class="mb-4 st-heading-section">Highlights</h2>
					<div class="st-highlight-info">
						<ul> 
							@php  $arr_highlight = explode("\n", trim($tour->detail->tours_highlight)); @endphp
							@foreach($arr_highlight as $k => $v)

							<li>{{$v}}</li>

							@endforeach
						</ul>

					</div>
				</div>
				@endif

				<div class="tab-pane text-justify p-3 border mt-3" id="section-contact">
					@if(!empty($tour->detail->contact))
					<div class="section mt-4">
						<h2 class="st-heading-section">Contact Information</h2>
						<div class="row mt-3">
							<div class="col-md-12 f-15">
								<div class="st-contact-info lh-2-6">

									@php 

									$email = touristbook_string_explode($tour->detail->contact['email']);
									$website = touristbook_string_explode($tour->detail->contact['website']);
									$phone = touristbook_string_explode($tour->detail->contact['phone']);
									$fax = touristbook_string_explode($tour->detail->contact['fax']);

									$address = $tour->address;

									if(!empty($tour->tour_attributes)){
										$st_tour_corporate_address = $tour->tour_attributes['corporateAddress'];
									}else{
										$st_tour_corporate_address = '';
									}
									@endphp

									@if(!empty($email) || !empty($website) || !empty($phone) || !empty($fax) || !empty($address) || !empty($st_tour_corporate_address))
									@if(!empty($address))
									{!!getNewIcon('Ico_maps', '#5E6D77', '16px', '16px')!!}&nbsp;Address :- {!!$address!!}<br>
									@endif
									@if(!empty($st_tour_corporate_address))
									{!!getNewIcon('Ico_maps', '#5E6D77', '16px', '16px')!!}&nbsp;Corporate Address :- {!!$st_tour_corporate_address!!}<br>
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
									<h4 class="pt-3">
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
									<h5 class="pt-3">
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

									@if(!empty($tour->detail->social_links))
									@php 

									$facebook_link = touristbook_string_explode($tour->detail->social_links['facebook_custom_link']);

									$twitter_link = touristbook_string_explode($tour->detail->social_links['twitter_custom_link']);

									$instagram_link = touristbook_string_explode($tour->detail->social_links['instagram_custom_link']);

									$youtube_link = touristbook_string_explode($tour->detail->social_links['you_tube_custom_link']);

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

					@endif
				</div>

				<!-- map location -->

				<div id="map-location">
					<div id="map-street" style="height: 100%; width:100%" lat="{{ $tour->detail->latitude }}"
						lng="{{ $tour->detail->longitude }}" zoom_level="{{ $tour->detail->zoom_level }}"></div>

					</div>


					{{-- country zone --}}

					@if(!empty($countryZone))
					<div class="row mt-5" id="country-zone-area" style="display: none;">
						<div align="center"><a data-toggle="collapse" href="#country-zone-div" role="button" aria-expanded="true" aria-controls="country-zone-div" style="text-decoration: none;" class="btn btn-grad">Country Zone...
						</a></div>

						<div class="col-md-12 collapse" id="country-zone-div">
							<h2 class="st-heading-section">Country Zone</h2>
							@if($countryZone)
							<div class="border {{(isMobileDevice())?'p-3':'p-5'}} mt-3">
								{!! $countryZone->country_zone_description !!}
							</div>
							@endif
						</div>

						@if($countryZone && !empty($countryZone->country_zone))
						<div class="col-md-12 mt-3">



							<ul class="nav nav-tabs custom-tabs-detail" id="country-zone-area-pdf">
								@foreach($countryZone->country_zone as $key => $tzone)
								<li class="nav-item"> <a class="nav-link {{($key == 0)?'active':''}}" data-toggle="tab" href="#{{touristbook_sanitize_title($tzone['country_zone-title'])}}"> {!!$tzone['country_zone-title']!!} </a> </li>
								@endforeach

							</ul>

							<div class="tab-content text-justify">
								@foreach($countryZone->country_zone as $key => $czone)
								<div class="tab-pane" id="{{touristbook_sanitize_title($czone['country_zone-title'])}}">

									{!!$tzone['country_zone-description']!!}

								</div>
								@endforeach

							</div>


						</div>


						@endif

					</div>
					@endif

					@if($tourismZone)
					<div class="mt-2" id="tourism-zone-area">

						<div align="center"><a data-toggle="collapse" href="#tourism-zone-div" role="button" aria-expanded="true" aria-controls="tourism-zone-div" style="text-decoration: none;" class="btn btn-grad">Tourism Zone...
						</a></div>
						<div class="collapse row" id="tourism-zone-div">

							<div class="col-md-12">
								<h2 class="st-heading-section">Tourism Zone</h2>

								<div class="border {{(isMobileDevice())?'p-3':'p-5'}} mt-3">
									{!! $tourismZone->tourism_zone_description !!}
								</div>
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

					<div class="p-4 shadow ml-lg-4 rounded sticky-top tourist-border-top-main-color" style="top: 120px;">

						<div class="submit-group mb30">
							<div class="price-btn service-price">
								<button type="button" class="btn btn-grad w-100 font-weight-bold" title="Price usually vary or subject to change please visit website to view the best deal.">AVG PRICE : {!!get_price($tour)!!}&nbsp;<i class="fa fa-exclamation-circle icon-4x important-note-icon-package" aria-hidden="true" style="font-size: 20px;"></i></button>
							</div>
							<div class="detail-btn">
								<a href="{{$tour->external_link}}" class="btn btn-grad w-100 font-weight-bold" target="_blank">Details</a>
								<a href="{{$tour->detail->contact['website'] ?? '#'}}" class="btn btn-grad w-100 font-weight-bold" target="_blank">Contact</a>
							</div>
							<input style="display:none;" type="submit" class="btn btn-default btn-send-message" data-id="61222" name="st_send_message" value="Send message">
						</div>

					</div>
				</div>

				<div class="col-lg-12 col-md-12 col-sm-12 bt1pxe9ecef">
					<!-- market purpose -->
					<div class="market-purpose">

						<section class="Categories pt10 toursamilar">
							<div class="container">
								<div class="row">
									<div class="col-md-8">
										<p class="mt-0 mb-0 nopadding st-heading-section">Packages</p>
										<h4 class="paddtop1 font-weight lspace-sm">You may also like </h4>
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
											@endif</div>
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
							<section class="Categories pt10 locationsamilar">
								<div class="container">
									<div class="row">
										<div class="col-md-8">
											<p class="mt-0 mb-0 nopadding st-heading-section">Destinations You May Like</p>

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
													<p class="service-location">{!!getNewIcon('Ico_maps', '#666666', '15px', '15px', true)!!}<span>{!!shortDescription($address,30)!!}</span>@if(strlen($address) > 30)
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
														<figure><a href="{{route('hotel',$near_hotel->slug)}}"><img src="{{$featured_image ?? asset('sites/images/dummy/270x200.jpg')}}" class="img-fluid" alt="location image">
															<div class="read_more"><span>{!!ucwords($near_hotel->name ?? '')!!}</span></div>
														</a> </figure>
														<div class="listroBoxmain p-2">
															<h2 class="service-title"><a href="{{route('hotel',$near_hotel->slug)}}">{!!ucwords($near_hotel->name ?? '')!!}</a></h2>
															@php
															$address = (!empty($near_hotel->address ))?$near_hotel->address:$near_hotel->hotel_attributes['corporateAddress'];
															@endphp
															<p class="service-location">{!!getNewIcon('Ico_maps', '#666666', '15px', '15px', true)!!}<span>{!!shortDescription($address,30)!!}</span>@if(strlen($address) > 30)
																&nbsp;<i class="fas fa-plus" data-toggle="modal" data-target="#showMoreData" onclick="showMoreData(this)" data-more_data="{{$address}}" data-more_data_label="Address" style="color:#fba009;"></i>
															@endif</p>
															@if(!empty($near_hotel->duration_day))
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



							{{-- Modal for Street Map --}}


							<div class="modal fade" id="streetModal" tabindex="-1" role="dialog" aria-labelledby="streetLabel"
							aria-hidden="true" style="z-index: 999999;">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="streetLabel">{{ $tour->name }}</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<div id="map-street" style="height: 400px; width:100%" lat="{{ $tour->detail->latitude }}"
											lng="{{ $tour->detail->longitude }}" zoom_level="{{ $tour->detail->zoom_level }}"></div>
										</div>
										<div class="modal-footer">

										</div>
									</div>
								</div>
							</div>


							@endsection
