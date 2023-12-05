@php 
$save_your_pocket_image = $location->locationMeta->save_your_pocket_image;
$save_your_pocket = $location->locationMeta->save_your_pocket;
@endphp
@php 
$save_your_pocket_banner = (!empty($location->locationMeta->save_your_pocket_image) && isset($location->locationMeta->save_your_pocket_image[0]['id']))?getConversionUrl($location->locationMeta->save_your_pocket_image[0]['id']):null;
@endphp
@if(!empty($location->locationMeta->save_your_pocket_image) && isset($location->locationMeta->save_your_pocket_image[0]['id']))


<div class="row mb-4">
	<div class="col-md-12 p-2">
		<img class="banner-image-lt" src="{{$save_your_pocket_banner ?? asset('sites/images/dummy/1250x500.jpg')}}">
	</div>
</div>

@endif

@if(!empty($save_your_pocket))
<div class="row">
	@foreach($save_your_pocket as $gtk)
	<div class="col-xs-12 col-md-12">
		<div class="st-overview content">
            <h2 class="p-2" style="color:#07509c;font-weight:600;">{!!$gtk['save_your_pocket-title']!!}</h2>
			

			<div class="st-description">
				{!!$gtk['save_your_pocket-description']!!}
			</div>




		</div>
	</div>
	@endforeach
</div>

@endif
