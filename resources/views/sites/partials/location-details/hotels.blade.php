<div class="hotels-list">
	<h3 class="st-section-title">Hotels</h3>
	@if($location->hotels()->count() > 0)
	<div class="owl-carousel owl-theme row">
		@foreach($location->hotels as $key => $location_hotel)
		<div class="item">
			<div class="listroBox">
				<figure> {{--<a href="hotel-detailed.html" class="wishlist_bt"></a>--}}
					{!!is_featured($location_hotel->is_featured)!!}
					@php $featured_image = (!empty($location_hotel->featured_image) && isset($location_hotel->featured_image[0]['id']))?getConversionUrl($location_hotel->featured_image[0]['id'],'450x417'):null;@endphp
					<a href="{{route('hotel',$location_hotel->slug)}}"><img src="{{$featured_image ?? asset('sites/images/dummy/450x417.jpg')}}" class="img-fluid" alt="" >
						{{--<div class="read_more"><span>Read more</span></div>--}}
					</a> </figure>
					<div class="listroBoxmain p-2">
						<h2 class="service-title"><a href="{{route('hotel',$location_hotel->slug)}}">{{$location_hotel->name}}</a></h2>
						<p>{!!$location_hotel->description!!}</p>
						{{--<a class="address" href="#">Get directions</a>--}} </div>
						<ul>
							<li>
								<p class="card-text text-muted"><span class="h4 text-primary">{!!get_price($location_hotel)!!}</span></p>
							</li>
							<li class="m-0">
								<a href="{{route('hotel',$location_hotel->slug)}}" class="btn btn-grad btn-sm">Hotel Detail</a>
							</li>
						</ul>
					</div>

				</div>
				@endforeach
			</div>
			@else
			<div class="col-md-8 col-sm-8 col-xs-12 alert alert-warning mt15">No Hotels found.</div>
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