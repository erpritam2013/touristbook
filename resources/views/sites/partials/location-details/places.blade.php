 @if(!empty($location->locationMeta->place_to_visit_description))
 <div id="places-description" class="st_location_extra_desc">
 
 		{!!$location->locationMeta->place_to_visit_description!!}
 	
 </div>
 @endif

 @if(!empty($location->locationMeta->place_to_visit))
<h2 class="p-2" style="color:#07509c;font-weight:600;">Places</h2>
 <div class="row">
 	@foreach($location->locationMeta->place_to_visit as $key => $place_to_visit)
 	<div class="col-md-4">
 		<div class="grid-item ">
 			<div class="item-border">
 				<div class="item">
 					<div class="thumbnail places-image">

 						@php 
 						if(!empty($place_to_visit['place_to_visit-image'])){

 						$place_to_visit_image_arr = json_decode($place_to_visit['place_to_visit-image'],true);
 						$place_to_visit_image = (!empty($place_to_visit_image_arr) && isset($place_to_visit_image_arr[0]['id']))?getConversionUrl($place_to_visit_image_arr[0]['id'],'450x417'):null;
 						}

 						@endphp
 						<img class="rounded" src="{{$place_to_visit_image ?? asset('sites/images/dummy/450x417.jpg')}}" alt="{{strtolower($place_to_visit['place_to_visit-title'])}} image" >
 					</div>
 				</div>
 			</div>
 			<h4 class="service-title">{!!$place_to_visit['place_to_visit-title']!!}
 			</h4>
 			<div class="tab-item-description">{!!shortDescription(strip_tags($place_to_visit['place_to_visit-description']),30)!!}</div>
 			<div class="read_more">
 				@php 

                $trim = strip_tags($place_to_visit['place_to_visit-description']);
                $trim=str_replace([" ","\n","\t","&ndash;","&rsquo;","&#39;","&quot;","&nbsp;"], '', $trim);

                $totalCharacter = strlen(utf8_decode($trim));


 				@endphp
 				<a data-toggle="modal" data-target="#showMoreData" onclick="showMoreData(this)" data-more_data="{{$place_to_visit['place_to_visit-description']}}" data-more_data_label="{{$place_to_visit['place_to_visit-title']}}" style="color:#fba009;" style="cursor: pointer;" data-total_chr="{{$totalCharacter}}">Read More....</a>    
 			</div>
 		</div>
 	</div>
 	@endforeach
 </div>
 @endif
