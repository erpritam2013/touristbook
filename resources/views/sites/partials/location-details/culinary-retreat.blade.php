@if(!empty($location->locationMeta->culinary_retreat_description))
<div id="culinary-retreat-description" class="st_location_extra_desc">
	{!!$location->locationMeta->culinary_retreat_description!!}
</div>

@endif
@if(!empty($location->locationMeta->culinary_retreat))
<h2 class="p-2" style="color:#07509c;font-weight:600;">Culinary Retreat</h2>
<div class="row">
	@foreach($location->locationMeta->culinary_retreat as $key => $culinary_retreat)
	<div class="col-md-4">
		<div class="grid-item ">
			<div class="item-border">
				<div class="item">
					<div class="thumbnail culinary-retreat-image">
						@php 
						if(!empty($culinary_retreat['culinary_retreat-image'])){

						$culinary_retreat_image_arr = json_decode($culinary_retreat['culinary_retreat-image'],true);
						$culinary_retreat_image = (!empty($culinary_retreat_image_arr) && isset($culinary_retreat_image_arr[0]['id']))?getConversionUrl($culinary_retreat_image_arr[0]['id'],'450x417'):null;
						}
						@endphp
						<img class="" src="{{$culinary_retreat_image ?? asset('sites/images/dummy/450x417.jpg')}}" alt="{{strtolower($culinary_retreat['culinary_retreat-title'])}} image">
					</div>
				</div>
			</div>
			<h4 class="service-title">{!!$culinary_retreat['culinary_retreat-title']!!}
			</h4>
			<div class="tab-item-description">{!!shortDescription(strip_tags($culinary_retreat['culinary_retreat-description']),30)!!}</div>
			<div class="read_more">
				<a data-toggle="modal" data-target="#showMoreData" onclick="showMoreData(this)" data-more_data="{{$culinary_retreat['culinary_retreat-description']}}" data-more_data_label="{{$culinary_retreat['culinary_retreat-title']}}" style="color:#fba009;" style="cursor: pointer;">Read More....</a>    
			</div>
		</div>
	</div>
	@endforeach
</div>
@endif