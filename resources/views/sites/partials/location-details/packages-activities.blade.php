<div class="packages-list">
	<h3 class="st-section-title">Packages</h3>
	@if($location->tours()->count() > 0)
	<div class="owl-carousel owl-theme row">
		@foreach($location->tours as $key => $location_tour)
		<div class="item">
			<div class="listroBox">
				<figure> {{--<a href="hotel-detailed.html" class="wishlist_bt"></a>--}}
					{!!is_featured($location_tour->is_featured)!!}
					@php $featured_image = (!empty($location_tour->featured_image) && isset($location_tour->featured_image[0]['id']))?getConversionUrl($location_tour->featured_image[0]['id'],'270x200'):null;@endphp
					<a href="{{route('tour',$location_tour->slug)}}"><img src="{{$featured_image ?? asset('sites/images/dummy/270x200.jpg')}}" class="img-fluid" alt="" >
						{{--<div class="read_more"><span>Read more</span></div>--}}
					</a> </figure>
					<div class="listroBoxmain p-2">
						<h2 class="service-title"><a href="{{route('tour',$location_tour->slug)}}">{{$location_tour->name}}</a></h2>
						<p>{!!$location_tour->description!!}</p>
						{{--<a class="address" href="#">Get directions</a>--}} </div>
						<ul>
							<li>
								<p class="card-text text-muted"><span class="h4 text-primary">{!!get_price($location_tour)!!}</span></p>
							</li>
							<li class="m-0">
								<a href="{{route('tour',$location_tour->slug)}}" class="btn btn-grad btn-sm">Tour Detail</a>
							</li>
						</ul>
					</div>

				</div>
				@endforeach
			</div>
			@else
			<div class="col-md-8 col-sm-8 col-xs-12 alert alert-warning mt15">No Packages found.</div>
			@endif
		</div>
		<div class="activities-list">
			<h3 class="st-section-title">Activities</h3>
			@if($location->activities()->count() > 0)
			<div class="owl-carousel owl-theme row">
				@foreach($location->activities as $key => $location_activity)
				<div class="item">

					<div class="listroBox">
						<figure> {{--<a href="hotel-detailed.html" class="wishlist_bt"></a>--}} {!!is_featured($location_activity->is_featured)!!}
							@php $featured_image = (!empty($location_activity->featured_image) && isset($location_activity->featured_image[0]['id']))?getConversionUrl($location_activity->featured_image[0]['id'],'270x200'):null;@endphp
							<a href="{{route('activity',$location_activity->slug)}}"><img
								src="{{$featured_image ?? asset('sites/images/dummy/270x200.jpg')}}" class="img-fluid" alt="activity-image">
								{{--<div class="read_more"><span>Read more</span></div>--}}
							</a> </figure>
							<div class="listroBoxmain p-2">
								<h2 class="service-title"><a href="{{route('activity',$location_activity->slug)}}">{{$location_activity->name}}</a></h2>
								<p>{!!$location_activity->description!!}</p>
								{{--<a class="address" href="#">Get directions</a>--}} 
							</div>
							<ul>
								<li>
									<p class="card-text text-muted"><span class="h4 text-primary">
										<span class="location-avg">{!!getNewIcon('thunder', '#ffab53', '10px', '16px')!!}Avg</span>
									{!!get_price($location_activity)!!}</span></p>
								</li>
								<li class="m-0">
									<a href="{{route('activity',$location_activity->slug)}}" class="btn btn-grad btn-sm">Activity Detail</a>
								</li>
							</ul>
						</div>
					</div>
					@endforeach

				</div>
				@else
				<div class="col-md-8 col-sm-8 col-xs-12 alert alert-warning mt15">No Activities found.</div>
				@endif
			</div>
			<script type="text/javascript">
				var owl = $(".owl-carousel");

				if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
					owl.owlCarousel({
						items: 1,
						margin: 10,
    // loop: true,
						nav: true,
						singleItem: true,
						autoplay:true,
						navigation: true,
						autoplaySpeed:2000,
						autoplayTimeout:3000,
						autoplayHoverPause:true,
						navText : ['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>']
					});
				}else{
					owl.owlCarousel({
						items: 4,
						margin: 10,
    // loop: true,
						nav: true,
						singleItem: true,
						autoplay:true,
						autoplaySpeed:2000,
						autoplayTimeout:3000,
						autoplayHoverPause:true,
						navText : ['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>']
					});
				}

			</script>