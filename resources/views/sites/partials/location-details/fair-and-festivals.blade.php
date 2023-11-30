@php 
$fair_and_festivals_banner = (!empty($location->locationMeta->fair_and_festivals_image) && isset($location->locationMeta->fair_and_festivals_image[0]['id']))?getConversionUrl($location->locationMeta->fair_and_festivals_image[0]['id']):null;
@endphp
@if(!empty($location->locationMeta->fair_and_festivals_image) && isset($location->locationMeta->fair_and_festivals_image[0]['id']))
<div class="row mb-4">
	<div class="col-md-12 p-2">
		<img class="banner-image-lt" src="{{$fair_and_festivals_banner ?? asset('sites/images/dummy/1250x500.jpg')}}" style="width: 100%;height: 500px;" />
	</div>
</div>
@endif
@if(!empty($location->locationMeta->fair_and_festivals_description))
<div id="fair-and-festivals-description" class="st_location_extra_desc">
	{!!$location->locationMeta->fair_and_festivals_description!!}
</div>

@endif
@if(!empty($location->locationMeta->fair_and_festivals))
<h2 class="p-2" style="color:#07509c;font-weight:600;">Fair And Festivals</h2>
<div class="row">
	@foreach($location->locationMeta->fair_and_festivals as $key => $fair_and_festivals)
	<div class="col-md-4">
		<div class="grid-item ">
			<div class="item-border">
				<div class="item">
					<div class="thumbnail fair-and-festivals-image">
						@php 
						if(!empty($fair_and_festivals['fair_and_festivals-image'])){

						$fair_and_festivals_image_arr = json_decode($fair_and_festivals['fair_and_festivals-image'],true);
						$fair_and_festivals_image = (!empty($fair_and_festivals_image_arr) && isset($fair_and_festivals_image_arr[0]['id']))?getConversionUrl($fair_and_festivals_image_arr[0]['id'],'270x200'):null;
						}
						@endphp
						<img class="" src="{{$fair_and_festivals_image ?? asset('sites/images/dummy/270x200.jpg')}}" alt="{{strtolower($fair_and_festivals['fair_and_festivals-title'])}} image">
					</div>
				</div>
			</div>
			<h4 class="service-title">{!!$fair_and_festivals['fair_and_festivals-title']!!}
			</h4>
			<div class="tab-item-description">{!!shortDescription(strip_tags($fair_and_festivals['fair_and_festivals-description']),30)!!}</div>
			<div class="read_more">
				<a data-toggle="modal" data-target="#showMoreData" onclick="showMoreData(this)" data-more_data="{{$fair_and_festivals['fair_and_festivals-description']}}" data-more_data_label="{{$fair_and_festivals['fair_and_festivals-title']}}" style="color:#fba009;" style="cursor: pointer;">Read More....</a>    
			</div>
		</div>
	</div>
	@endforeach
</div>
@endif