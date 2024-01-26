@extends('sites.layouts.main')
@section('title',$title)
@section('content')
@if(auth()->check())
@if(auth()->user()->isAdmin() || auth()->user()->isEditor())
@section('get_a_link')
@if(!isMobileDevice())
@php $top = 'top:32px;position:relative;';@endphp
@endif
{!!get_a_link($title,route('admin.pages.edit',$page->id ?? ''))!!}
@endsection
@endif 
@endif
@php
    $banner_image = null;
if(isset($page)) {
if(isJson($page->featured_image)){
    $page->featured_image = json_decode($page->featured_image,true);
}
$banner_image = (!empty($page->featured_image) && isset($page->featured_image[0]['id']))?getConversionUrl($page->featured_image[0]['id']):null;
}

@endphp

@include('sites.partials.banner', [
'bannerUrl' => $banner_image ?? asset('sites/images/dummy/1200x400.jpg'),
'bannerTitle' => 'Contact Us',
'bannerSubTitle' => '',
])

<div class="section pt-4" style="{{$top ?? ''}}">
	<div class="container">
		<div class="row">

			<div class="col-lg-12 col-12 align-self-center mt-4">

				@include('sites.partials.breadcrumb',['location_route'=>"",'location_name'=> '','post_name'=>ucwords($title ?? '')])
			</div>
		</div>
	</div>
</div>
<div class="section pt-4">
	<div class="container">
		<div class="row">
			<div class="col-lg-5 col-5 align-self-center mt-4 contact-form-div">
				<div class="contact-header">
					<h3>We'd love to hear from you
					</h3>
					<p>Send us a message and we'll respond as soon as possible
					</p>
				</div>
				<div class="contact-form">
					<form id="contact-form" action="{{route('contact')}}" method="POST">
						{{ csrf_field() }}
						{{method_field('POST')}}
						<!-- Email -->
						<div class="form-group">

							<input class="form-control" type="email" name="email" placeholder="Email">
						</div>

						<!-- Password -->
						<div class="form-group">

							<input type="text" class="form-control" name="subject" id="subject" placeholder="Subject">
						</div>

						<!-- Textarea -->
						<div class="form-group">

							<textarea class="form-control" rows="5" name="message" placeholder="Message"></textarea>
						</div>



							<button type="submit" id="contact-submit" class="btn btn-default">SEND MESSAGE</button>

							@if(Session::has('success'))
							{!!get_form_success_msg(Session::get('success'))!!}
							@endif
							@if(Session::has('error'))
							{!!get_form_error_msg(Session::get('error'))!!}
							@endif
						

					</form>

				</div>

			</div>

			<div class="col-lg-2 col-2 align-self-center mt-4">
			</div>

			<div class="col-lg-5 col-5 align-self-center mt-4">

				@if(!empty($page->extra_data))
				<div class="st-contact-info">


					@php
                     $contact_info_bg_image_arr = [];
					if(isJson($page->extra_data['contact_info_bg_image'])){
						$contact_info_bg_image_arr = json_decode($page->extra_data['contact_info_bg_image'],true);
					}else{
                       $contact_info_bg_image_arr = $page->extra_data['contact_info_bg_image'];
					}

					$contact_info_bg_image = (!empty($contact_info_bg_image_arr ) && isset($contact_info_bg_image_arr[0]['id']))?getConversionUrl($contact_info_bg_image_arr[0]['id']):null;@endphp
					<div class="info-bg">
						<img decoding="async" src="{{$contact_info_bg_image ?? asset('sites/images/dummy/400x417.jpg')}}" class="img-responsive" alt="Background Contact Info">
					</div>
					<div class="info-content">
						<h3>Tourist Book</h3>
						<div class="sub">
							<div class="tb-mob"><i class="fa fa-phone-square" aria-hidden="true"></i>{{$page->extra_data['contact_info_phone']}}</div>
							@php
							$contact_info_email = (!empty($page->extra_data['contact_info_email']))?explode(',',$page->extra_data['contact_info_email']):null;
							@endphp
							@if($contact_info_email)
							<div class="tb-email">
								@foreach($contact_info_email as $c_email)
								<i class="fa fa-envelope" style="margin-top: 0px;" aria-hidden="true">&nbsp;{{$c_email}}</i><br>
							@endforeach
							</div>
							@endif
							<div class="address"><i class="fa fa-map-marker" aria-hidden="true"></i>{!!$page->extra_data['contact_info_address']!!}</div>
						</div>
					</div>
				</div>
				@endif
			</div>



		</div>
	</div>
</div>


@endsection
