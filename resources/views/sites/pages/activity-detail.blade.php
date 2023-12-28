@extends('sites.layouts.main')
@section('title',$title)
@section('content')

<section>
	<!-- Slider main container-->
	<div class="swiper-container detail-slider slider-gallery" style="height: 300;">
		<!-- Additional required wrapper-->
		<div class="swiper-wrapper">
			<!-- Slides-->

			@if(!empty($activity->detail->gallery))
			@foreach($activity->detail->gallery as $gallery)
			<div class="swiper-slide"><a data-toggle="gallery-top" title="activity gallery" style="width: 452px;height:300px;" ><img
				src="{{ getConversionUrl($gallery['id'],'600x250') }}" alt="Our street" class="img-fluid" style="width: 452px;height:300px;"></a>
			</div>
			@endforeach
			@else
			<div class="swiper-slide"><a data-toggle="gallery-top" title="activity gallery"><img
				src="{{ asset('sites/images/dummy/600x450.jpg') }}" alt="activity gallery" class="img-fluid"></a>
			</div>
			<div class="swiper-slide"><a data-toggle="gallery-top" title="activity gallery"><img
				src="{{ asset('sites/images/dummy/600x450.jpg') }}" alt="activity gallery" class="img-fluid"></a>
			</div>
			<div class="swiper-slide"><a data-toggle="gallery-top" title="activity gallery"><img
				src="{{ asset('sites/images/dummy/600x450.jpg') }}" alt="activity gallery" class="img-fluid"></a>
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
				<div class="left">

					<h1 class="st-heading">{{ $activity->name }}</h1>
					<div class="sub-heading">
						<p class="mb-3">{!!getNewIcon('Ico_maps', '#666666', '16px', '16px', true)!!}{{ $activity->detail->map_address }}
							<a href="javascript:void(0)" class="ml-2 text-secondary text-sm view-street-map" data-toggle="modal"
							data-target="#streetModal">View on map</a>
						</p>
					</div>
				</div>
				<div class="right">

					<div class="review-score style-2">
						@if($activity->rating == 0)
						<span class="head-rating">Not Rated</span>
						<div class="st-stars style-2">
							{!!getStar($activity->rating)!!}
						</div>
						<p class="st-link">from {{$activity->rating}} review</p>
						@else
						@if($hotel->rating < 3)
						<span class="head-rating">Good</span>
						@else
						<span class="head-rating">Excellent</span>
						@endif
						<div class="st-stars style-2">
							{!!getStar($activity->rating)!!}
						</div>
						<p class="st-link">from {{$activity->rating}} review</p>
						@endif
					</div>
				</div>


				<div class="tab-pane" id="activity-feature">


					<div class="section mt-4">
						<div class="st-activity-feature">
							<div class="row pt-3">
								<div class="col-xs-6 col-lg-3">
									<div class="item">
										<div class="icon">
											{!!getNewIcon('time-clock-circle-1', '#fba009', '30px', '30px')!!}
										</div>
										<div class="info">
											<h4 class="name">Duration</h4>
											<p class="value">
												@if(!empty($activity->duration))
												{{$activity->duration_day}}
												@endif
											</p>
										</div>
									</div>
								</div>
								<div class="col-xs-6 col-lg-3">
									<div class="item">
										<div class="icon activity_cancellation">
											<i class="fa fa-ban"></i>
										</div>
										<div class="info">
											<h4 class="name">Cancellation</h4>
											<p class="value">
												@if($activity->detail->st_allow_cancel == 1)
												{{$activity->detail->st_cancel_number_days}}
												@else
												No Cancellation
												@endif
											</p>
										</div>
									</div>
								</div>

								<div class="col-xs-6 col-lg-3">
									<div class="item">
										<div class="icon">
											<i class="fas fa-user-friends"></i></div>
											<div class="info">
												<h4 class="name">Group Size</h4>
												<p class="value">
													@php
													$max_people = $activity->max_people;@endphp

													@if ( empty( $max_people ) or $max_people == 0 or $max_people < 0 )
													Unlimited
													@else
													{{$max_people}}&nbsp;people
												@endif</p>
											</div>
										</div>
									</div>
									<div class="col-xs-6 col-lg-3">
										<div class="item">
											<div class="icon">
												<i class="fa fa-language"></i></div>
												<div class="info">
													<h4 class="name">Languages</h4>
													<p class="value">

														@if($activity->languages->isNotEmpty())
														@php 

														$languages__ = implode( ', ', $activity->languages->pluck('name')->toArray() );
														@endphp
														English

														@endif
													</p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="custom-content" id="custom-content">
							<!-- Policy Data -->
							<div class="policy-tab tab-content p-0 bt1pxe9ecef" id="policies" >
								@php 
								$activity_child_policy = $activity->detail->child_policy;
								$activity_booking_policy = $activity->detail->booking_policy;
								$activity_refund_and_cancellation_policy = $activity->detail->refund_and_cancellation_policy;
								@endphp
								@if (!empty($activity_child_policy))
								<div class="tab-pane fade pt-3 pl-0 pr-0 pb-3" id="child-policy">
									<div class="st-hr large"></div>
									<h3 class="st-heading-section">Child Policy</h3>
									<div class="policy-content st-description">
										<div class="div-desc">
											{!!$activity_child_policy!!}
										</div>
									</div>
								</div>
								@endif
								@if (!empty($activity_booking_policy))
								<div class="tab-pane fade pt-3 pl-0 pr-0 pb-3" id="booking-policy" >
									<div class="st-hr large"></div>
									<h3 class="st-heading-section">Booking Policy</h3>
									<div class="policy-content st-description">
										<div class="div-desc">
											{!!$activity_booking_policy!!}

										</div>
									</div>
								</div>
								@endif
								@if(!empty($activity_refund_and_cancellation_policy))
								<div class="tab-pane fade pt-3 pl-0 pr-0 pb-3" id="refund-cancellation-policy">
									<div class="st-hr large"></div>
									<h3 class="st-heading-section">Refund & Cancellation Policy</h3>
									<div class="policy-content st-description"> 
										<div class="div-desc">
											{!!$activity_refund_and_cancellation_policy!!}
										</div>

									</div>
								</div>
								@endif
							</div>
							<!-- End Policy Data -->
							<h2 class="st-heading-section">Overview</h2>
							<div class="tab-pane show active" id="tab-about">
								@if(!empty($activity->description))
								<div class="text-block NopaddingDetails">
									<p class="text-muted font-weight-light">
										{!! $activity->description !!}
									</p>
								</div>
								@else
								<div class="alert alert-warning mt15">No Description found!.</div>
								@endif
							</div>
							<div class="tab-pane " id="tab-facilities">
								@if ($activity->languages->isNotEmpty())
								<div class="section mt-4 terms-section" id="languages">
									<h2 class="st-heading-section">Languages</h2>
									<div class="row mt-3">
										@foreach ($activity->languages as $languages)
										<div class="col-xs-6 {{(isMobileDevice())?'col-sm-6':'col-sm-4'}} f-15">
											<div class="item-term">
												<i class="fa fa-cogs mr-3"></i>
												<span>{{ $languages->name }}</span>
											</div>
										</div>
										@endforeach
									</div>
								</div>
								@endif
								@if ($activity->states->isNotEmpty())
								<div class="section mt-4 terms-section" id="states">
									<h2 class="st-heading-section">States</h2>
									<div class="row mt-3">
										@foreach ($activity->states as $state__)
										<div class="col-xs-6 {{(isMobileDevice())?'col-sm-6':'col-sm-4'}} f-15">
											<div class="item-term">
												<i class="fa fa-cogs mr-3"></i>
												<span>{{ $state__->name }}</span>
											</div>
										</div>
										@endforeach
									</div>
								</div>
								@endif
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-12 col-sm-12 right_Details">
						<div class="p-3 shadow ml-lg-4 rounded sticky-top tourist-border-top-main-color" style="top: 120px;">
							<div class="submit-group mb30">
								<div class="price-btn service-price">
									<button type="button" class="btn btn-grad w-100 font-weight-bold text-uppercase" title="Price usually vary or subject to change please visit website to view the best deal.">
										@if($activity->price != 0)
										AVG PRICE : {!!get_price($activity)!!}
										@else
										Price On Request
										@endif
										&nbsp;<i class="fa fa-exclamation-circle icon-4x important-note-icon-package" aria-hidden="true" style="font-size: 20px;"></i></button>
									</div>
									<div class="detail-btn">
										<a href="{{$activity->detail->contact['website'] ?? '#'}}" class="btn btn-grad w-100 font-weight-bold" target="_blank">Booking Now</a>
									</div>
								</div>
								<div class="policy-pages rounded border-solid-d7dce3" style="color: #000000;">
									<div class="policy-pages-wrapper relative">
										<h4 class="m-2 pl-1">Activity Policies</h4>
										<ul class="nav flex-column policy-pages-link" role="tablist">
											<li class="nav-item m-2 p-2 bg-secondary"><a class="nav-link text-white" data-toggle="tab" href="#child-policy">{!!getNewIcon('cursor-hand-1', '#07509e', '16px', '16px', true)!!}&nbsp;Child Policy</a></li>
											<li class="nav-item m-2 p-2 bg-secondary"><a class="nav-link text-white" data-toggle="tab" href="#booking-policy">{!!getNewIcon('cursor-hand-1', '#07509e', '16px', '16px', true)!!}&nbsp;Booking Policy</a></li>
											<li class="nav-item m-2 p-2 bg-secondary"><a class="nav-link text-white" data-toggle="tab" href="#refund-cancellation-policy">{!!getNewIcon('cursor-hand-1', '#07509e', '16px', '16px', true)!!}&nbsp;Cancellation Policy</a></li>
											<li class="nav-item m-2 p-2 bg-secondary"><a class="nav-link text-white" data-toggle="tab" href="#refund-cancellation-policy">{!!getNewIcon('cursor-hand-1', '#07509e', '16px', '16px', true)!!}&nbsp;Refund Policy</a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-9 col-md-12 col-sm-12 ">

							@if ($activity->term_activity_lists->isNotEmpty())

							<div class="section mt-4 terms-section mb-4" id="term-activity-lists">
								<h2 class="st-heading-section">Activities</h2>
								<div class="row mt-3">
									@foreach ($activity->term_activity_lists as $al_key => $term_activity_lists)
									@php $hidden_class = '';
									@endphp
									@if(count($activity->term_activity_lists) > 5)
									@if($al_key <= 5)
									@php $hidden_class = '';@endphp
									@else
									@php $hidden_class = 'd-none';@endphp
									@endif
									@endif
									<div class="col-xs-6 {{(isMobileDevice())?'col-sm-6':'col-sm-4'}} f-15 ">
										<div class="item-term {{$hidden_class}}">
											<i class="fa fa-dot-circle mr-3"></i>
											<span>{{ $term_activity_lists->name }}</span>

										</div>
									</div>
									@endforeach
								</div>
								<a href="javascript:void(0)" onclick="readMoreTerm(this)" data-show_text="more" class="activity-read-more pt-2 pb-2">Read More...</a>
							</div>


							@endif

							@php
							$st_activity_lists = $activity->activity_lists;

							$al_count = count( $st_activity_lists );

							@endphp

							<div class="activity-list" data-toggle-section="st-activity-list"
							>
							<h2 class="st-heading-section">Activity List</h2>
							<div class="row">
								@foreach( $st_activity_lists as $key => $activity__ )

								@php $al_hidden_class = '';
								@endphp
								@if($al_count > 3)
								@if($key <= 2)
								@php $al_hidden_class = '';@endphp
								@else
								@php $al_hidden_class = 'd-none';@endphp
								@endif
								@endif
								@php
								$custom_icon = getSingleCustomIcon($activity__->custom_icon);
								$long_description = $activity__->description;

								@endphp
								<div class="col-xs-12 col-sm-12">
									<div class="item has-matchHeight">
										<div class="st-activity-item {{$al_hidden_class}}">
											<div class="row">

												<div class="col-xs-12 col-sm-3">
													<div class="st-activity-icon"> 


														@if (!empty($custom_icon))

														<i class="{{$custom_icon}}"></i>
														@else
														<i class="fa fa-cogs"></i>
														@endif

													</div>
												</div>
												<div class="col-xs-12 col-sm-9 ">
													<div class="st-activity-heading">
														<h3>{{$activity__->title}}</h3>
													</div>
													@if (!empty($long_description))
													@php 

													$al_desc_len = strlen($long_description);

													$style_desc = 'style="overflow:hidden;height:100%;"';
													$show_attr = 'data-show_text="all"';
													if($al_desc_len > 700){
														$style_desc = 'style="overflow:hidden;height:170px;"';
														$show_attr = 'data-show_text="more"';
													}

													@endphp
													<div class="st-activity-description">
														<div class="long-description mt-3" id="long-description-{{$key}}" {!!$style_desc!!} {!!$show_attr!!}>
															{!!$long_description!!}
														</div>
													</div>
													@endif
													<div class="more-btn p-2" >
														@if( $al_desc_len > 700 )
														<a href="javascript:void(0);" class="btn btn-grad btn-sm" onclick="readMoreText(this)" id="readBtn" data-len="{{$al_desc_len}}" data-key="{{$key}}" data-desc_id="#long-description-{{$key}}">Read More</a>
														@endif

													</div>
												</div>
											</div>

										</div>


									</div>
								</div>
								@endforeach
							</div>
							@if($al_count > 3)
							<a href="javascript:void(0)" onclick="readMoreActivityList(this)" data-show_text="more" class="activity-read-more pt-2 pb-2">Show All...</a>
							@endif
						</div>
						
						@php
						$st_activity_package = $activity->activity_packages;

						$ap_count = count( $st_activity_package );


						@endphp

						<div class="activity-packages" data-toggle-section="activity-packages"
						>
						<h2 class="st-heading-section">Activity Package</h2>
						<div class="row">


							@foreach( $st_activity_package as $ap_key => $activity_package__ )

							@php $ap_hidden_class = '';
							@endphp
							@if($ap_count > 3)
							@if($ap_key <= 2)
							@php $ap_hidden_class = '';@endphp
							@else
							@php $ap_hidden_class = 'd-none';@endphp
							@endif
							@endif
							@php
							$ap_custom_icon = getSingleCustomIcon($activity_package__->custom_icon);
							$ap_long_description = $activity_package__->description;

							@endphp
							<div class="col-xs-12 col-sm-12">
								<div class="item has-matchHeight">
									<div class="activity-packages-item {{$ap_hidden_class}}">
										<div class="row">

											<div class="col-xs-12 col-sm-3">
												<div class="activity-packages-icon"> 


													@if (!empty($ap_custom_icon))

													<i class="{{$ap_custom_icon}}"></i>
													@else
													<i class="fa fa-cogs"></i>
													@endif

												</div>
											</div>
											<div class="col-xs-12 col-sm-9 ">
												<div class="activity-packages-heading">
													<h3>{{$activity_package__->title}}</h3>
												</div>
												@if (!empty($ap_long_description))
												@php 

												$ap_desc_len = strlen($ap_long_description);
												$ap_style_desc = 'style="overflow:hidden;height:100%;"';
												$ap_show_attr = 'data-show_text="all"';
												if($ap_desc_len > 700){
													$ap_style_desc = 'style="overflow:hidden;height:170px;"';
													$ap_show_attr = 'data-show_text="more"';
												}

												@endphp
												<div class="activity-packages-description">
													<div class="long-description mt-3" id="ap-long-description-{{$ap_key}}" {!!$ap_style_desc!!} {!!$ap_show_attr!!}>
														{!!$ap_long_description!!}
													</div>
												</div>
												@endif
												<div class="more-btn p-2" >
													@if( $ap_desc_len > 700 )
													<a href="javascript:void(0);" class="btn btn-grad btn-sm" onclick="readMoreText(this)" id="readBtn" data-len="{{$ap_desc_len}}" data-key="{{$ap_key}}" data-desc_id="#ap-long-description-{{$ap_key}}">Read More</a>
													@endif

												</div>
											</div>
										</div>

									</div>


								</div>
							</div>
							@endforeach
						</div>

						@if($ap_count > 3)
						<a href="javascript:void(0)" onclick="readMoreActivityPackage(this)" data-show_text="more" class="activity-read-more pt-2 pb-2">Show All...</a>
						@endif
					</div>


					@if(!empty($activity_zone))
					<div class="mt-5 bbpb text-justify" id="activity-zone-area">
						<div align="center"><a data-toggle="collapse" href="#activity-zone-area-pdf" role="button" aria-expanded="true" aria-controls="activity-zone-area-pdf" style="text-decoration: none;" class="btn btn-grad" onclick="showActivityZoneTab(this);">Activity Zone...
						</a></div>
						<div class="collapse row" id="activity-zone-area-pdf">
							<div class="col-md-12">
								<h2 class="st-heading-section">Activity Zone</h2>
								@if($activity_zone)
								<div class="border {{(isMobileDevice())?'p-3':'p-5'}} mt-3">
									{!! $activity_zone->activity_zone_description !!}
								</div>
								@endif
							</div>
							@if($activity_zone && !empty($activity_zone->activity_zone_section))
							<div class="col-md-12 mt-3">
								@if(isMobileDevice())
								@include('sites.partials.filters.activity-tabs',['sections'=>$activity_zone->activity_zone_section,'activity_zone_pdf_link'=>$activity_zone->activity_zone_pdf])
								@endif
								<div class="tab-content text-justify">
									@foreach($activity_zone->activity_zone_section as $key => $azone__)
									<div class="tab-pane" id="{{touristbook_sanitize_title($azone__['activity_zone_section-title'])}}">
										{!!$azone__['activity_zone_section-description']!!}
									</div>
									@endforeach
								</div>
							</div>
							@endif
						</div>
					</div>
					@endif
                    
					{{-- tourism zone --}}
					@if(!empty($tourismZone))
					<div class="mt-5 bbpb text-justify" id="tourism-zone-area" >
						<div align="center"><a data-toggle="collapse" href="#tourism-zone-area-pdf" role="button" aria-expanded="true" aria-controls="tourism-zone-area-pdf" style="text-decoration: none;" class="btn btn-grad"  onclick="tourism_zone_area_pdf(this)">Tourism Zone...
						</a></div>
						<div class="collapse row" id="tourism-zone-area-pdf">
							<div class="col-md-12 ">
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
									@foreach($tourismZone->tourism_zone as $key => $tzone__)
									<div class="tab-pane" id="{{touristbook_sanitize_title($tzone__['tourism_zone-title'])}}">
										<h4 class="st-heading-section">{{$tzone__['tourism_zone-title']}}</h4>
										{!!$tzone__['tourism_zone-description']!!}
									</div>
									@endforeach
								</div>
							</div>
							@endif
						</div>
					</div>
					@endif

					@php 
					$include = $activity->detail->activity_include ?? '';
					$exclude = $activity->detail->activity_exclude ?? '';
					@endphp
					@if(!empty($include) || !empty($exclude))
					<div class="tab-pane" id="st-include-exclude">
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
						
					</div>
					@endif

					{{--<div class="tab-pane" id="st-program-section">
						@if (!empty($activity->detail->activity_program))
						<div class="section mt-4">
							<h2 class="st-heading-section">Itinerary</h2>
							<div class="accordion" id="accordionStProgram">
								@foreach($activity->detail->activity_program as $key => $activity_program)
								<div class="card">
									<div class="card-header {{($key != 0)?'collapsed':''}}" data-toggle="collapse" data-target="#st-program-{{$key}}" aria-expanded="true"> 
										<img src="https://touristbook.s3.ap-south-1.amazonaws.com/wp-content/uploads/2019/05/ico_mapker-2.webp" alt="marker">    
										<span class="title">{{ucwords($activity_program['activity_program-title'])}}</span>
										<span class="accicon"><i class="fas fa-angle-down rotate-icon"></i></span>
									</div>
									<div id="st-program-{{$key}}" class="collapse {{$key == 0?'show':''}}" data-parent="#accordionStProgram">
										<div class="card-body">{!!$activity_program['activity_program-description']!!}
										</div>
									</div>
								</div>
								@endforeach
							</div>
						</div>
						@endif
					</div>--}}

					<div class="tab-pane text-justify p-3 border m-0 mt-3" id="section-contact">
						@if(!empty($activity->detail->contact))
						<div class="section mt-4">
							<h2 class="st-heading-section">Contact Information</h2>
							<div class="row mt-3">
								<div class="col-md-12 f-15">
									<div class="st-contact-info lh-2-6">

										@php 

										$email = touristbook_string_explode($activity->detail->contact['email']);
										$website = touristbook_string_explode($activity->detail->contact['website']);
										$phone = touristbook_string_explode($activity->detail->contact['phone']);
										$fax = touristbook_string_explode($activity->detail->contact['fax']);

										$address = $activity->address;

										if(!empty($activity->activity_attributes)){
											$st_activity_corporate_address = $activity->activity_attributes['corporateAddress'];
										}else{
											$st_activity_corporate_address = '';
										}
										@endphp

										@if(!empty($email) || !empty($website) || !empty($phone) || !empty($fax) || !empty($address) || !empty($st_activity_corporate_address))
										@if(!empty($address))
										{!!getNewIcon('Ico_maps', '#5E6D77', '16px', '16px')!!}&nbsp;Address :- {!!$address!!}<br>
										@endif
										@if(!empty($st_activity_corporate_address))
										{!!getNewIcon('Ico_maps', '#5E6D77', '16px', '16px')!!}&nbsp;Corporate Address :- {!!$st_activity_corporate_address!!}<br>
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
										<h4 class="pt-3">
											{!!getNewIcon('fax-phone', '#5E6D77', '16px', '16px')!!}&nbsp;
											@if(is_array($fax))
											@foreach($fax as $faxs)
											<a href="tel:{{$faxs}}" target="_blank" style="text-decoration: none;">{{$faxs}}</a>
											@endforeach
											@else
											<a href="tel:{{$fax}}" target="_blank" style="text-decoration: none;">{{$fax}}</a>
											@endif
										</h4>
										@endif
										@endif

										@if(!empty($activity->detail->social_links))
										@php 

										$facebook_link = touristbook_string_explode($activity->detail->social_links['facebook_custom_link']);

										$twitter_link = touristbook_string_explode($activity->detail->social_links['twitter_custom_link']);

										$instagram_link = touristbook_string_explode($activity->detail->social_links['instagram_custom_link']);

										$youtube_link = touristbook_string_explode($activity->detail->social_links['you_tube_custom_link']);

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
						{{-- <div id="map-street" style="height: 100%; width:100%" lat="{{ $activity->detail->latitude ?? '' }}"
							lng="{{ $activity->detail->longitude ?? ''}}" zoom_level="{{ $activity->detail->zoom_level ?? ''}}"></div> --}}
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

						<div class="p-3 shadow ml-lg-4 rounded sticky-top d-none" style="top: 120px;" id="zone-tabs-div-section">
							<div class="zone-tabs-div">
								@if(!isMobileDevice())
								@if(!empty($activity_zone->activity_zone_section))
								@include('sites.partials.filters.activity-tabs',['sections'=>$activity_zone->activity_zone_section,'activity_zone_pdf_link'=>$activity_zone->activity_zone_pdf])
								@endif
								@endif
							</div>
						</div>
					</div>
					<div class="col-lg-12 col-md-12 col-sm-12 bt1pxe9ecef">
						<div class="market-purpose">

							<section class="Categories pt10 activitysamilar">
								<div class="container">
									<div class="row">
										<div class="col-md-8">
											<p class="mt-0 mb-0 nopadding st-heading-section">Similer Activities</p>
											<h4 class="paddtop1 font-weight lspace-sm">You may also like </h4>
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
									<section class="Categories pt10 locationsamilar">
										<div class="container">
											<div class="row">
												<div class="col-md-8">
													<p class="mt-0 mb-0 nopadding st-heading-section">Destination You May Like</p>

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
															{{--<div class="read_more"><span>{!!ucwords($near_location->name ?? '')!!}</span></div>--}}
														</a> </figure>
														<div class="listroBoxmain p-2">
															<h2 class="service-title"><a href="{{route('location',$near_location->slug)}}">{!!ucwords($near_location->name ?? '')!!}</a></h2>
															@php
															$address = (!empty($near_location->address ))?$near_location->address:"";
															@endphp
															@if($address)
															<p class="service-location">{!!getNewIcon('Ico_maps', '#666666', '15px', '15px', true)!!}<span>{!!shortDescription($address,30)!!}</span>@if(strlen($address) > 30)
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
														<figure><a href="{{route('hotel',$near_hotel->slug)}}"><img src="{{$featured_image ?? asset('sites/images/dummy/270x200.jpg')}}" class="img-fluid" alt="location image">
															{{--<div class="read_more"><span>{!!ucwords($near_hotel->name ?? '')!!}</span></div>--}}
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
																@endif</p>@if(!empty($near_tour->duration_day))
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
									<h5 class="modal-title" id="streetLabel">{{ $activity->name }}</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<div id="map-street" style="height: 400px; width:100%" lat="{{ $activity->detail->latitude ?? ''}}"
										lng="{{ $activity->detail->longitude ?? ''}}" zoom_level="{{ $activity->detail->zoom_level ?? ''}}"></div>
									</div>
									<div class="modal-footer">

									</div>
								</div>
							</div>
						</div>
						@endsection
