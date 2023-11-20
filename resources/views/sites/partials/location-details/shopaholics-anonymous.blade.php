@if(!empty($location->locationMeta->shopaholics_anonymous_description))
<div id="shopaholics-anonymous-description" class="st_location_extra_desc">
	{!!$location->locationMeta->shopaholics_anonymous_description!!}
</div>

@endif
@if(!empty($location->locationMeta->shopaholics_anonymous))
<h2 class="p-2" style="color:#07509c;font-weight:600;">Shopaholics Anonymous</h2>
<div class="row">
	@foreach($location->locationMeta->shopaholics_anonymous as $key => $shopaholics_anonymous)
	<div class="col-md-4">
		<div class="grid-item ">
			<div class="item-border">
				<div class="item">
					<div class="thumbnail shopaholics-anonymous-image">
						@php 
						if(!empty($shopaholics_anonymous['shopaholics_anonymous-image'])){
						$shopaholics_anonymous_image_arr = json_decode($shopaholics_anonymous['shopaholics_anonymous-image'],true);
						$shopaholics_anonymous_image = (!empty($shopaholics_anonymous_image_arr) && isset($shopaholics_anonymous_image_arr[0]['id']))?getConversionUrl($shopaholics_anonymous_image_arr[0]['id'],'270x200'):null;
						}
						@endphp
						<img class="" src="{{$shopaholics_anonymous_image ?? asset('sites/images/dummy/270x200.jpg')}}" alt="{{strtolower($shopaholics_anonymous['shopaholics_anonymous-title'])}} image">
					</div>
				</div>
			</div>
			<h4 class="service-title">{!!$shopaholics_anonymous['shopaholics_anonymous-title']!!}
			</h4>
			<div class="tab-item-description">{!!shortDescription(strip_tags($shopaholics_anonymous['shopaholics_anonymous-description']),30)!!}</div>
			<div class="read_more">
				<a data-toggle="modal" data-target="#showMoreData" onclick="showMoreData(this)" data-more_data="{{$shopaholics_anonymous['shopaholics_anonymous-description']}}" data-more_data_label="{{$shopaholics_anonymous['shopaholics_anonymous-title']}}" style="color:#fba009;" style="cursor: pointer;">Read More....</a>    
			</div>
		</div>
	</div>
	@endforeach
</div>
@endif