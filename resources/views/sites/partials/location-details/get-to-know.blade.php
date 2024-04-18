@php 
$get_to_know_image = $location->locationMeta->get_to_know_image;
$get_to_know = $location->locationMeta->get_to_know;
@endphp
@php 
$get_to_know_banner = (!empty($location->locationMeta->get_to_know_image) && isset($location->locationMeta->get_to_know_image[0]['id']))?getConversionUrl($location->locationMeta->get_to_know_image[0]['id']):null;
@endphp
@if(!empty($location->locationMeta->get_to_know_image) && isset($location->locationMeta->get_to_know_image[0]['id']))


<div class="row mb-4">
	<div class="col-md-12 p-2">
		<img class="banner-image-lt" src="{{$get_to_know_banner ?? asset('sites/images/dummy/1250x500.jpg')}}">
	</div>
</div>

@endif

@if(!empty($get_to_know))
<div class="row">
	@foreach($get_to_know as $gtk)
	<div class="col-xs-12 col-md-12">
		<div class="st-overview content">
            <h2 class="p-2" style="color:#07509c;font-weight:600;">{!!$gtk['get_to_know-title']!!}</h2>
			

			<div class="st-description">
				{!!$gtk['get_to_know-description']!!}
			</div>




		</div>
	</div>
	@endforeach
</div>

@endif
